<?php

namespace App\Http\Controllers\User;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RankIncomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Rank Achievement Income';
        $user = Auth::user();
        $totalRankIncome = Transaction::where('user_id', $user->id)
                ->where('trx_type', '+')
                ->where('remark', 'master_matching_income')
                ->sum('amount');

        return view(
            'templates.basic.user.rank_income',
            compact('pageTitle', 'totalRankIncome')
        );
    }
}
