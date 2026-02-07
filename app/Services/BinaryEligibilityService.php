<?php

namespace App\Services;

use App\Models\User;
use App\Models\BvLog;

class BinaryEligibilityService
{
    public static function check(int $userId): array
    {
        /* =========================
           USER COUNT
        ========================= */
        $leftUsers = User::where('ref_by', $userId)
            ->where('position', 1)
            ->count();

        $rightUsers = User::where('ref_by', $userId)
            ->where('position', 2)
            ->count();

        $userMatch =
            ($leftUsers === 1 && $rightUsers === 2) ||
            ($leftUsers === 2 && $rightUsers === 1);

        /* =========================
           BV CALCULATION
        ========================= */
        $leftBv = BvLog::where('user_id', $userId)
            ->where('position', 1)
            ->where('trx_type', '+')
            ->sum('amount');

        $rightBv = BvLog::where('user_id', $userId)
            ->where('position', 2)
            ->where('trx_type', '+')
            ->sum('amount');

        $bvMatch = false;

        if ($leftBv > 0 && $rightBv > 0) {
            $ratio = round($leftBv / $rightBv, 2);
            $bvMatch = in_array($ratio, [0.5, 2.0], true);
        }

        /* =========================
           FINAL DECISION
        ========================= */
        return [
            'canWithdraw' => $userMatch || $bvMatch,
            'userMatch'   => $userMatch,
            'bvMatch'     => $bvMatch,
            'leftUsers'   => $leftUsers,
            'rightUsers'  => $rightUsers,
            'leftBv'      => $leftBv,
            'rightBv'     => $rightBv,
            'error'       => ($userMatch || $bvMatch)
                ? null
                : 'You are not eligible for withdrawal right now. First binary match (1:2 or 2:1) required.',
        ];
    }
}
