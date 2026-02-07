<?php

namespace App\Services;

use App\Models\User;
use App\Models\BvLog;
use App\Models\Transaction;
use App\Models\BinaryIncomeLog;
use Carbon\Carbon;

class BinaryMatchingService
{
    public function runClosing(string $session)
    {
        $users = User::where('status', 1)->get();

        foreach ($users as $user) {
            $this->processUser($user, $session);
        }
    }

    protected function processUser(User $user, string $session)
    {
        $bv = BvLog::where('user_id', $user->id)->latest()->first();
        if (!$bv) return;

        $left  = (int) $bv->bv_left;
        $right = (int) $bv->bv_right;

        if ($left == 0 || $right == 0) return;

        // =========================
        // FIRST MATCH RULE (1:2 or 2:1)
        // =========================
        if (!$this->isValidFirstMatch($left, $right)) {
            return;
        }

        // =========================
        // CALCULATE PAIRS
        // =========================
        $possiblePairs = min($left, $right);
        $pairAllowed   = min($possiblePairs, SESSION_CAPPING);

        if ($pairAllowed <= 0) return;

        //$income = $pairAllowed * BINARY_PAIR_INCOME;
        $pairIncome    = config('mlm.binary.pair_income');
        $sessionCap    = config('mlm.binary.session_capping');
        
        $pairAllowed   = min($possiblePairs, $sessionCap);
        $income        = $pairAllowed * $pairIncome;


        // =========================
        // UPDATE USER WALLET
        // =========================
        $user->balance += $income;
        $user->total_binary_com += $income;
        $user->save();

        // =========================
        // TRANSACTION ENTRY
        // =========================
        Transaction::create([
            'user_id'      => $user->id,
            'amount'       => $income,
            'post_balance' => $user->balance,
            'trx_type'     => '+',
            'remark'       => 'binary_income',
            'details'      => "Binary Income ($session Closing)",
            'trx'          => getTrx(),
        ]);

        // =========================
        // BINARY LOG
        // =========================
        BinaryIncomeLog::create([
            'user_id' => $user->id,
            'pair'    => $pairAllowed,
            'amount'  => $income,
            'session' => $session,
            'date'    => now()->toDateString(),
        ]);

        // =========================
        // CARRY FORWARD POWER LEG
        // =========================
        if ($left > $right) {
            $bv->bv_left  = $left - $pairAllowed;
            $bv->bv_right = 0;
        } else {
            $bv->bv_right = $right - $pairAllowed;
            $bv->bv_left  = 0;
        }

        $bv->save();
    }

    protected function isValidFirstMatch(int $left, int $right): bool
    {
        if ($left == 0 || $right == 0) return false;

        $ratio = max($left, $right) / min($left, $right);

        return in_array($ratio, [2]);
    }
}
