<?php

namespace App\Lib;

use App\Models\User;
use App\Models\Transaction;
use DB;

class BinaryMatching
{
    public static function run($user)
    {
        $now  = now();
        $half = $now->format('H') < 12 ? 'second' : 'first';
        $today = $now->toDateString();

        // Daily & half capping
        $dailyPair = DB::table('binary_logs')
            ->where('user_id',$user->id)
            ->where('date',$today)
            ->sum('pair');

        $halfPair = DB::table('binary_logs')
            ->where('user_id',$user->id)
            ->where('date',$today)
            ->where('half',$half)
            ->sum('pair');

        $allowed = min(4 - $dailyPair, 2 - $halfPair);
        if ($allowed <= 0) return;

        $left  = $user->paid_left;
        $right = $user->paid_right;
        $pairs = 0;

        // FIRST MATCH (2:1 or 1:2)
        if ($user->first_binary_completed == 0) {

            if ($left >= 2 && $right >= 1) {
                $pairs = 1;
                $left -= 2;
                $right -= 1;
            } elseif ($left >= 1 && $right >= 2) {
                $pairs = 1;
                $left -= 1;
                $right -= 2;
            }

            if ($pairs == 1) {
                $user->first_binary_completed = 1;
                $user->save();
            }
        }

        // NORMAL 1:1
        $pairs += min($left, $right);
        $pairs = min($pairs, $allowed);

        if ($pairs <= 0) return;

        $commission = $pairs * gs('binary_pair_commission');

        DB::table('binary_logs')->insert([
            'user_id'=>$user->id,
            'date'=>$today,
            'half'=>$half,
            'pair'=>$pairs,
            'commission'=>$commission,
            'created_at'=>now()
        ]);

        // Wallet credit
        $user->balance += $commission;
        $user->save();

        Transaction::create([
            'user_id'=>$user->id,
            'amount'=>$commission,
            'post_balance'=>$user->balance,
            'trx_type'=>'+',
            'details'=>"Binary income {$pairs} pair"
        ]);

        // FLUSH AT 12 AM
        if ($half == 'second') {
            $user->paid_left = 0;
            $user->paid_right = 0;
            $user->bv_left = 0;
            $user->bv_right = 0;
            $user->save();
        }
    }
}
