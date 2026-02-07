<?php

namespace App\Services;

use App\Models\User;
use App\Models\BvLog;
use App\Models\Transaction;
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

        // FIRST MATCH RULE
        if (!$this->isValidFirstMatch($left, $right)) {
            return;
        }

        // =========================
        // CALCULATE PAIRS
        // =========================
        $possiblePairs = min($left, $right);

        $pairIncome = config('mlm.binary.pair_income');
        $sessionCap = config('mlm.binary.session_capping');

        $pairAllowed = min($possiblePairs, $sessionCap);

        if ($pairAllowed <= 0) return;

        $income = $pairAllowed * $pairIncome;

        // =========================
        // UPDATE USER WALLET
        // =========================
        $user->balance += $income;
        $user->total_binary_com += $income;
        $user->save();

        // =========================
        // TRANSACTION ENTRY (Binary Income)
        // =========================
        Transaction::create([
            'user_id'      => $user->id,
            'amount'       => $income,
            'post_balance' => $user->balance,
            'trx_type'     => '+',
            'remark'       => 'matching_income',
            'details'      => "Matching Income ($session Closing) - {$pairAllowed} pairs",
            'trx'          => getTrx(),
        ]);

        // =========================
        // EXTRA LOG USING TRANSACTION
        // =========================
        Transaction::create([
            'user_id'  => $user->id,
            'amount'   => 0,
            'trx_type' => '+',
            'remark'   => 'matching_pair_log',
            'details'  => "Matching Pair Logged ({$pairAllowed} pairs) Session: {$session}",
            'trx'      => getTrx(),
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
