<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTING PAGES
    |--------------------------------------------------------------------------
    */

    public function pending(?int $userId = null)
    {
        $pageTitle = 'Pending Withdrawals';
        $withdrawals = $this->withdrawalData('pending', false, $userId);

        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals'));
    }

    public function approved(?int $userId = null)
    {
        $pageTitle = 'Approved Withdrawals';
        $withdrawals = $this->withdrawalData('approved', false, $userId);

        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals'));
    }

    public function rejected(?int $userId = null)
    {
        $pageTitle = 'Rejected Withdrawals';
        $withdrawals = $this->withdrawalData('rejected', false, $userId);

        return view('admin.withdraw.withdrawals', compact('pageTitle', 'withdrawals'));
    }

    public function all(?int $userId = null)
    {
        $pageTitle = 'All Withdrawals';

        $withdrawalData = $this->withdrawalData(null, true, $userId);

        return view('admin.withdraw.withdrawals', [
            'pageTitle'   => $pageTitle,
            'withdrawals' => $withdrawalData['data'],
            'successful' => $withdrawalData['summary']['successful'],
            'pending'    => $withdrawalData['summary']['pending'],
            'rejected'   => $withdrawalData['summary']['rejected'],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY BUILDER
    |--------------------------------------------------------------------------
    */

    protected function withdrawalData(?string $scope = null, bool $summary = false, ?int $userId = null)
    {
        // Base Query
        if ($scope && method_exists(Withdrawal::class, $scope)) {
            $withdrawals = Withdrawal::$scope();
        } else {
            $withdrawals = Withdrawal::where('status', '!=', Status::PAYMENT_INITIATE);
        }

        // Filter by user
        if ($userId) {
            $withdrawals->where('user_id', $userId);
        }

        // Search & Date Filter
        $withdrawals->searchable(['trx', 'user:username'])->dateFilter();

        // Filter by Method
        if (request()->filled('method')) {
            $withdrawals->where('method_id', request()->method);
        }

        // Summary Mode
        if ($summary) {
            $successful = (clone $withdrawals)
                ->where('status', Status::PAYMENT_SUCCESS)
                ->sum('amount');

            $pending = (clone $withdrawals)
                ->whereIn('status', [
                    Status::PAYMENT_PENDING,
                    Status::PAYMENT_INITIATE
                ])
                ->sum('amount');

            $rejected = (clone $withdrawals)
                ->where('status', Status::PAYMENT_REJECT)
                ->sum('amount');

            return [
                'data' => $withdrawals
                    ->with(['user', 'method'])
                    ->orderByDesc('id')
                    ->paginate(getPaginate()),

                'summary' => [
                    'successful' => $successful,
                    'pending'    => $pending,
                    'rejected'   => $rejected,
                ],
            ];
        }

        // Normal Listing
        return $withdrawals
            ->with(['user', 'method'])
            ->orderByDesc('id')
            ->paginate(getPaginate());
    }

    /*
    |--------------------------------------------------------------------------
    | DETAILS
    |--------------------------------------------------------------------------
    */

    public function details(Withdrawal $withdraw)
    {
        $pageTitle = ($withdraw->user->username ?? 'User')
            . ' Withdraw Requested '
            . showAmount($withdraw->amount);

        $details = $withdraw->withdraw_information
            ? json_encode($withdraw->withdraw_information)
            : null;

        return view('admin.withdraw.detail', [
            'pageTitle'  => $pageTitle,
            'withdrawal' => $withdraw,
            'details'   => $details,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE
    |--------------------------------------------------------------------------
    */

    public function approve(Withdrawal $withdraw, Request $request)
    {
        $request->validate([
            'details' => 'required|string|max:255',
        ]);

        // Block only if already final
        if (in_array($withdraw->status, [
            Status::PAYMENT_SUCCESS,
            Status::PAYMENT_REJECT,
        ])) {
            return back()->withErrors([
                'error' => 'This withdrawal has already been processed.',
            ]);
        }

        // Approve
        $withdraw->admin_feedback = $request->details;
        $withdraw->status = Status::PAYMENT_SUCCESS;
        $withdraw->save();

        // Transaction Log
        Transaction::create([
            'user_id' => $withdraw->user_id,
            'amount'  => $withdraw->final_amount,
            'trx'     => $withdraw->trx,
            'remark'  => 'withdraw_approved',
        ]);

        // Notify User
        notify($withdraw->user, 'WITHDRAW_APPROVED', [
            'amount' => showAmount($withdraw->final_amount),
            'method' => $withdraw->method->name ?? '',
        ]);

        return redirect()
            ->route('admin.withdraw.data.details', $withdraw->id)
            ->with('success', 'Withdrawal approved successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT
    |--------------------------------------------------------------------------
    */

    public function reject(Withdrawal $withdraw, Request $request)
    {
        $request->validate([
            'details' => 'required|string|max:255',
        ]);

        // Block only if already final
        if (in_array($withdraw->status, [
            Status::PAYMENT_SUCCESS,
            Status::PAYMENT_REJECT,
        ])) {
            return back()->withErrors([
                'error' => 'This withdrawal has already been processed.',
            ]);
        }

        // Reject
        $withdraw->admin_feedback = $request->details;
        $withdraw->status = Status::PAYMENT_REJECT;
        $withdraw->save();

        // Notify User
        notify($withdraw->user, 'WITHDRAW_REJECTED', [
            'reason' => $request->details,
        ]);

        return redirect()
            ->route('admin.withdraw.data.details', $withdraw->id)
            ->with('success', 'Withdrawal rejected successfully.');
    }
}
