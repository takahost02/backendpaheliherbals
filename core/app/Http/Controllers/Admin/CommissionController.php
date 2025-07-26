<?php

namespace App\Http\Controllers\Admin;

use App\Models\CommissionLog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    public function index($userId = null)
    {
        $pageTitle   = 'Commissions';
        $commissions = CommissionLog::query()->with('user');

        if ($userId) {
            $commissions->where('user_id', $userId);
        }

        $commissions = $commissions->orderBy('id', 'desc')->paginate(getPaginate());

        $emptyMessage = 'No commissions found';
        return view('admin.commissions', compact('pageTitle', 'commissions', 'emptyMessage'));
    }

    public function status(Request $request, $id)
    {
        $commission = CommissionLog::findOrFail($id);
        $user       = $commission->user;

        if (!$user) {
            $notify[] = ['error', 'User not found'];
            return back()->withNotify($notify);
        }

        $user->balance += $commission->amount;
        $user->save();

        Transaction::create([
            'user_id'      => $user->id,
            'amount'       => $commission->amount,
            'post_balance' => $user->balance,
            'trx_type'     => '+',
            'trx'          => $commission->trx ?? getTrx(),
            'remark'       => 'commission',
            'details'      => 'Commission applied by admin',
        ]);

        notify($user, 'COMMISSION_ADDED', [
            'amount' => showAmount($commission->amount, false),
            'trx'    => $commission->trx ?? 'N/A',
        ]);

        $notify[] = ['success', 'Commission applied successfully'];
        return back()->withNotify($notify);
    }
}
