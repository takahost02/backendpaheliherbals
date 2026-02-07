<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\BvLog;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BinaryClosing extends Command
{
    protected $signature = 'binary:closing';
    protected $description = 'Automatic Binary Matching Closing (12 PM / 12 AM)';

    public function handle()
    {
        $now = now();

        if ($now->hour == 12) {
            // 12 PM → AM session closing
            $session = 'AM';
            $from = Carbon::today();
            $to   = Carbon::today()->setTime(11, 59, 59);
        } else {
            // 12 AM → PM session closing
            $session = 'PM';
            $from = Carbon::yesterday()->setTime(12, 0);
            $to   = Carbon::yesterday()->endOfDay();
        }


        $today = Carbon::today()->toDateString();

        $pairBV     = config('binary.pair_bv', 1);
        $pairIncome = config('binary.pair_income', 750);
        $sessionCap = config('binary.session_capping', 2);
        $dailyCap   = config('binary.daily_capping', 4);

        $users = User::where('plan_id', '!=', 0)->get();

        foreach ($users as $user) {

            // -----------------------------
            // PREVENT SESSION DUPLICATE
            // -----------------------------
            $alreadyClosed = DB::table('binary_income_logs')
                ->where('user_id', $user->id)
                ->where('closing_date', $today)
                ->where('closing_session', $session)
                ->exists();

            if ($alreadyClosed) continue;

            // -----------------------------
            // CHECK DAILY CAP
            // -----------------------------
            $todayPairs = DB::table('binary_income_logs')
                ->where('user_id', $user->id)
                ->where('closing_date', $today)
                ->sum('pair_count');

            if ($todayPairs >= $dailyCap) continue;

            // -----------------------------
            // SESSION BV
            // -----------------------------
            $sessionLeftBV = BvLog::where('user_id', $user->id)
                ->where('position', 1)
                ->where('trx_type', '+')
                ->whereBetween('created_at', [$from, $to])
                ->sum('amount');

            $sessionRightBV = BvLog::where('user_id', $user->id)
                ->where('position', 2)
                ->where('trx_type', '+')
                ->whereBetween('created_at', [$from, $to])
                ->sum('amount');

            // -----------------------------
            // PREVIOUS CARRY
            // -----------------------------
            $carry = DB::table('binary_carry_forwards')
                ->where('user_id', $user->id)
                ->first();

            $carryLeft  = $carry->carry_left  ?? 0;
            $carryRight = $carry->carry_right ?? 0;

            $totalLeftBV  = $sessionLeftBV  + $carryLeft;
            $totalRightBV = $sessionRightBV + $carryRight;

            // -----------------------------
            // FIRST MATCH RULE (1:2 or 2:1)
            // -----------------------------
            if (
                !($totalLeftBV >= 1 && $totalRightBV >= 2) &&
                !($totalLeftBV >= 2 && $totalRightBV >= 1)
            ) {
                continue;
            }

            // -----------------------------
            // PAIR CALCULATION
            // -----------------------------
            $weakBV = min($totalLeftBV, $totalRightBV);
            $pairs  = floor($weakBV / $pairBV);

            $remainingDaily = $dailyCap - $todayPairs;

            $pairs = min($pairs, $sessionCap, $remainingDaily);

            if ($pairs <= 0) continue;

            $matchedBV = $pairs * $pairBV;
            $payout    = $pairs * $pairIncome;

            $finalCarryLeft  = max(0, $totalLeftBV  - $matchedBV);
            $finalCarryRight = max(0, $totalRightBV - $matchedBV);

            DB::transaction(function () use (
                $user,
                $today,
                $session,
                $totalLeftBV,
                $totalRightBV,
                $matchedBV,
                $pairs,
                $payout,
                $finalCarryLeft,
                $finalCarryRight
            ) {

                // 1️⃣ Binary Income Log
                DB::table('binary_income_logs')->insert([
                    'user_id'         => $user->id,
                    'closing_date'    => $today,
                    'closing_session' => $session,
                    'bv_left_before'  => $totalLeftBV,
                    'bv_right_before' => $totalRightBV,
                    'matched_bv'      => $matchedBV,
                    'pair_count'      => $pairs,
                    'payout_amount'   => $payout,
                    'carry_left'      => $finalCarryLeft,
                    'carry_right'     => $finalCarryRight,
                    'created_at'      => now(),
                ]);

                // 2️⃣ Wallet Credit
                $user->increment('balance', $payout);
                $user->increment('total_binary_com', $payout);

                $updatedBalance = $user->fresh()->balance;

                // 3️⃣ Transaction Entry
                Transaction::create([
                    'user_id'      => $user->id,
                    'amount'       => $payout,
                    'post_balance' => $updatedBalance,
                    'trx_type'     => '+',
                    'trx'          => Str::upper(Str::random(12)),
                    'details'      => "Binary Income ({$session}) - {$pairs} Pair(s)",
                    'remark'       => 'binary_income',
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                // 4️⃣ Carry Forward Update
                DB::table('binary_carry_forwards')->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'carry_left'  => $finalCarryLeft,
                        'carry_right' => $finalCarryRight,
                        'updated_at'  => now(),
                    ]
                );
            });
        }

        $this->info("Binary Closing {$session} completed successfully.");
    }
}
