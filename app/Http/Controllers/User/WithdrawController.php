<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    /* =====================================================
       STEP 1: WITHDRAW METHODS PAGE
    ===================================================== */
    public function withdrawMoney()
    {
        $pageTitle = 'Withdraw Money';
        $withdrawMethod = WithdrawMethod::active()->get();

        return view('Template::user.withdraw.methods', compact(
            'pageTitle',
            'withdrawMethod'
        ));
    }

    /* =====================================================
       STEP 2: STORE WITHDRAW REQUEST
    ===================================================== */
    public function withdrawStore(Request $request)
    {
        $request->validate([
            'method_code' => 'required|integer',
            'amount'      => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();

        $method = WithdrawMethod::active()
            ->where('id', $request->method_code)
            ->firstOrFail();

        /* ----- LIMIT CHECK ----- */
        if ($request->amount < $method->min_limit || $request->amount > $method->max_limit) {
            return back()->withNotify([
                ['error', 'Withdraw amount must be within allowed limits']
            ])->withInput();
        }

        /* ----- BALANCE CHECK ----- */
        if ($request->amount > $user->balance) {
            return back()->withNotify([
                ['error', 'Insufficient balance']
            ])->withInput();
        }

        $charge = $method->fixed_charge +
            ($request->amount * $method->percent_charge / 100);

        $afterCharge = $request->amount - $charge;

        if ($afterCharge <= 0) {
            return back()->withNotify([
                ['error', 'Withdraw amount too low after charge']
            ])->withInput();
        }

        /* ----- CREATE WITHDRAW ----- */
        $withdraw = Withdrawal::create([
            'method_id'    => $method->id,
            'user_id'      => $user->id,
            'amount'       => $request->amount,
            'currency'     => $method->currency,
            'rate'         => $method->rate,
            'charge'       => $charge,
            'after_charge' => $afterCharge,
            'final_amount' => $afterCharge * $method->rate,
            'trx'          => getTrx(),
            'status'       => Status::PAYMENT_INITIATE,
        ]);

        /* 🔐 store trx safely */
        session()->put('withdraw_trx', $withdraw->trx);

        return redirect()->route('user.withdraw.preview');
    }

    /* =====================================================
       STEP 3: PREVIEW
    ===================================================== */
    public function withdrawPreview()
    {
        $trx = session('withdraw_trx');

        if (!$trx) {
            return redirect()->route('user.withdraw.index')
                ->withNotify([['error', 'Invalid withdraw session']]);
        }

        $withdraw = Withdrawal::with('method')
            ->where('trx', $trx)
            ->where('user_id', Auth::id())
            ->where('status', Status::PAYMENT_INITIATE)
            ->first();

        if (!$withdraw) {
            return redirect()->route('user.withdraw.index')
                ->withNotify([['error', 'Withdraw request expired']]);
        }

        $pageTitle = 'Withdraw Preview';

        return view('Template::user.withdraw.preview', compact(
            'pageTitle',
            'withdraw'
        ));
    }

    /* =====================================================
       STEP 4: FINAL SUBMIT
    ===================================================== */
    public function withdrawSubmit(Request $request)
    {
        $trx = session('withdraw_trx');

        if (!$trx) {
            abort(404);
        }

        $withdraw = Withdrawal::with('method')
            ->where('trx', $trx)
            ->where('user_id', Auth::id())
            ->where('status', Status::PAYMENT_INITIATE)
            ->firstOrFail();

        $method = $withdraw->method;
        $user   = Auth::user();

        if ($method->status == Status::DISABLE) {
            abort(404);
        }

        /* ----- Dynamic Form Validation ----- */
        $formProcessor = new FormProcessor();
        $formData      = $method->form->form_data ?? [];
        $rules         = $formProcessor->valueValidation($formData);

        $request->validate($rules);

        DB::transaction(function () use ($request, $withdraw, $method, $user, $formProcessor, $formData) {

            /* Save withdraw info */
            $withdraw->withdraw_information =
                $formProcessor->processFormData($request, $formData);

            $withdraw->status = Status::PAYMENT_PENDING;
            $withdraw->save();

            /* Balance check again */
            if ($withdraw->amount > $user->balance) {
                throw new \Exception('Insufficient balance');
            }

            /* Deduct balance */
            $user->balance -= $withdraw->amount;
            $user->save();

            /* Transaction log */
            Transaction::create([
                'user_id'      => $user->id,
                'amount'       => $withdraw->amount,
                'post_balance' => $user->balance,
                'charge'       => $withdraw->charge,
                'trx_type'     => '-',
                'details'      => 'Withdraw via ' . $method->name,
                'trx'          => $withdraw->trx,
                'remark'       => 'withdraw',
            ]);

            /* Admin notify */
            AdminNotification::create([
                'user_id'   => $user->id,
                'title'     => 'New withdraw request from ' . $user->username,
                'click_url' => urlPath('admin.withdraw.data.details', $withdraw->id),
            ]);
        });

        session()->forget('withdraw_trx');

        notify($user, 'WITHDRAW_REQUEST', [
            'method_name'  => $method->name,
            'amount'       => showAmount($withdraw->amount),
            'charge'       => showAmount($withdraw->charge),
            'trx'          => $withdraw->trx,
            'post_balance' => showAmount($user->balance),
        ]);

        return redirect()->route('user.withdraw.history')
            ->withNotify([['success', 'Withdraw request submitted successfully']]);
    }

    /* =====================================================
       WITHDRAW HISTORY
    ===================================================== */
    public function withdrawLog()
    {
        $pageTitle = 'Withdraw History';

        $withdraws = Withdrawal::where('user_id', Auth::id())
            ->where('status', '!=', Status::PAYMENT_INITIATE)
            ->with('method')
            ->latest()
            ->paginate(getPaginate());

        return view('Template::user.withdraw.log', compact(
            'pageTitle',
            'withdraws'
        ));
    }
}
