<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function index()
    {
        $pageTitle = 'Rewards Income';

        $rewards = DB::table('rewards')
            ->orderByDesc('id')
            ->paginate(20);

        $totalReward = DB::table('rewards')
            ->where('status', 1)
            ->sum('reward_amount');

        return view(
            'admin.rewards.index',
            compact('pageTitle', 'rewards', 'totalReward')
        );
    }
}
