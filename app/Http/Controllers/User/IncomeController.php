<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class IncomeController extends Controller
{
    public function salary()
    {
        $pageTitle = 'Salary Income';
        $income = Auth::user()->total_salary_com ?? 0;

        return view('templates.basic.user.incomes.salary', compact('pageTitle', 'income'));
    }
    
     public function myIncome()
        {
            $pageTitle = 'My Income';
            $user = auth()->user();
            $matrixLevelTotal = Transaction::where('user_id', $user->id)
                ->where('trx_type', '+')
                ->where('remark', 'matrix_income')
                ->sum('amount');
            $masterMatchingTotal = Transaction::where('user_id', $user->id)
                ->where('trx_type', '+')
                ->where('remark', 'master_matching_income')
                ->sum('amount');
            $income = [
                'salary'      => $user->total_salary_com ?? 0,
                'franchise'   => $user->total_franchise_com ?? 0,
                'retail'      => $user->total_retail_com ?? 0,
                'global'      => $user->total_global_matching_com ?? 0,
                'rank'        => $user->total_royalty_com ?? 0,
                'binary'      => $masterMatchingTotal,
                'level'       => $matrixLevelTotal,
                'referral'    => $user->total_ref_com ?? 0,
            ];
        
            $totalIncome = array_sum($income);
        
            return view(
                'templates.basic.user.incomes.my_income',
                compact('pageTitle', 'income', 'totalIncome')
            );
        }


    public function franchise()
    {
        $pageTitle = 'Franchise Bonus Income';
        $income = Auth::user()->total_franchise_com ?? 0;

        return view('templates.basic.user.incomes.franchise', compact('pageTitle', 'income'));
    }

   /* public function retail()
    {
        $pageTitle = 'Retail Profits Income';
        $income = Auth::user()->total_retail_com ?? 0;

        return view('templates.basic.user.incomes.retail', compact('pageTitle', 'income'));
    }*/

    public function globalMatching()
    {
        $pageTitle = 'Global Matching Income';
        $income = Auth::user()->total_global_matching_com ?? 0;

        return view('templates.basic.user.incomes.global_matching', compact('pageTitle', 'income'));
    }
}
