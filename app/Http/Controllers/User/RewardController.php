<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Rewards Income';

        $rewards = DB::table('reward_incomes')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(20);

        $totalReward = DB::table('reward_incomes')
            ->where('user_id', Auth::id())
            ->where('status',1)
            ->sum('reward_amount');

        return view(
            activeTemplate().'user.reward.index',
            compact('pageTitle','rewards','totalReward')
        );
    }
}
