<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyBinaryReportMail;
use App\Models\BvLog;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Str;




class BinaryController extends Controller
{
    /* =====================================================
       WEEKLY BINARY EMAIL (CRON)
    ===================================================== */
    public function sendWeeklyBinaryEmails()
    {
        $users = User::where('status', 1)->get();

        foreach ($users as $user) {

            $logs = DB::table('binary_logs')
                ->where('user_id', $user->id)
                ->whereBetween('date', [now()->subDays(6), now()])
                ->get();

            if ($logs->isEmpty()) {
                continue;
            }

            $pdf = \PDF::loadView(
                'templates.basic.user.binary.weeklyPdf',
                compact('user', 'logs')
            )->output();

            Mail::to($user->email)
                ->send(new WeeklyBinaryReportMail($user, $pdf));
        }
    }

    /* =====================================================
       BINARY SUMMARY DASHBOARD
    ===================================================== */
    public function summary()
{
    $user = Auth::user();

    $today = now()->toDateString();
    $todayStart = now()->startOfDay();
    $midDay     = now()->setTime(12, 0, 0);
    $todayEnd   = now()->endOfDay();

    /* ===============================
       TODAY BV (DISPLAY PURPOSE)
    =============================== */
    $bvLeft = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$todayStart, $todayEnd])
        ->where('position', 1)
        ->sum('amount');

    $bvRight = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$todayStart, $todayEnd])
        ->where('position', 2)
        ->sum('amount');

    /* ===============================
       SESSION PAIR PREVIEW
    =============================== */
    $firstHalfLeft = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$todayStart, $midDay])
        ->where('position', 1)
        ->sum('amount');

    $firstHalfRight = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$todayStart, $midDay])
        ->where('position', 2)
        ->sum('amount');

    $firstHalfPair = min(floor(min($firstHalfLeft, $firstHalfRight)), 2);

    $secondHalfLeft = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$midDay, $todayEnd])
        ->where('position', 1)
        ->sum('amount');

    $secondHalfRight = BvLog::where('user_id', $user->id)
        ->whereBetween('created_at', [$midDay, $todayEnd])
        ->where('position', 2)
        ->sum('amount');

    $secondHalfPair = min(floor(min($secondHalfLeft, $secondHalfRight)), 2);

    $dailyCap = 4;
    $pairMatch = min($dailyCap, $firstHalfPair + $secondHalfPair);
    $remainingCap = max(0, $dailyCap - $pairMatch);

    /* ===============================
       TODAY ACTUAL EARNED INCOME
    =============================== */
    $todayIncome = Transaction::where('user_id', $user->id)
        ->where('remark', 'binary_income')
        ->whereDate('created_at', $today)
        ->sum('amount');

    /* ===============================
       REAL CARRY FORWARD
    =============================== */
    $carry = DB::table('binary_carry_forwards')
        ->where('user_id', $user->id)
        ->first();

    $carryForward = [
        'left'  => $carry->carry_left  ?? 0,
        'right' => $carry->carry_right ?? 0,
    ];

    /* ===============================
       POWER LEG (BASED ON CARRY)
    =============================== */
    if ($carryForward['left'] > $carryForward['right']) {
        $powerLeg = 'left';
    } elseif ($carryForward['right'] > $carryForward['left']) {
        $powerLeg = 'right';
    } else {
        $powerLeg = 'equal';
    }

    /* ===============================
       SESSION STATUS
    =============================== */
    $amClosed = DB::table('binary_income_logs')
        ->where('user_id', $user->id)
        ->where('closing_date', $today)
        ->where('closing_session', 'AM')
        ->exists();

    $pmClosed = DB::table('binary_income_logs')
        ->where('user_id', $user->id)
        ->where('closing_date', $today)
        ->where('closing_session', 'PM')
        ->exists();

    return view(activeTemplate().'user.binarySummery', compact(
        'bvLeft',
        'bvRight',
        'firstHalfPair',
        'secondHalfPair',
        'pairMatch',
        'remainingCap',
        'todayIncome',
        'carryForward',
        'powerLeg',
        'amClosed',
        'pmClosed'
    ));
}



    /* =====================================================
       MATRIX INCOME (ROUTE SAFE)
    ===================================================== */
   public function matrixIncome()
{
    $user = Auth::user();
    $pageTitle = 'Matrix Income';

    // ==========================
    // TEAM SIZE CALCULATION
    // ==========================
    $leftTeam = DB::table('bv_logs')
        ->where('user_id', $user->id)
        ->where('position', 1)
        ->where('trx_type', '+')
        ->count();

    $rightTeam = DB::table('bv_logs')
        ->where('user_id', $user->id)
        ->where('position', 2)
        ->where('trx_type', '+')
        ->count();

    $teamSize = $leftTeam + $rightTeam;

    // ==========================
    // MATRIX LEVEL CONFIG
    // ==========================
    $levels = [
        1 => ['team' => 5,    'income' => 50],
        2 => ['team' => 25,   'income' => 125],
        3 => ['team' => 125,  'income' => 625],
        4 => ['team' => 625,  'income' => 3125],
        5 => ['team' => 3125, 'income' => 15625],
    ];

    // ==========================
    // LAST ACHIEVED LEVEL (PREVENT DUPLICATE)
    // ==========================
    $lastLevel = DB::table('matrix_level_incomes')
        ->where('user_id', $user->id)
        ->max('level') ?? 0;

    $achievement = null;
    $nextTarget  = null;

    foreach ($levels as $level => $data) {

        // Skip already paid levels
        if ($level <= $lastLevel) {
            continue;
        }

        // Level achieved
        if ($teamSize >= $data['team']) {

            DB::transaction(function () use ($user, $level, $data) {

                // Save matrix income
                DB::table('matrix_level_incomes')->insert([
                    'user_id'    => $user->id,
                    'level'      => $level,
                    'team_size'  => $data['team'],
                    'income'     => $data['income'],
                    'created_at' => now(),
                ]);

                // Credit wallet
                DB::table('users')
                    ->where('id', $user->id)
                    ->increment('balance', $data['income']);

                // Transaction log
                DB::table('transactions')->insert([
                    'user_id'      => $user->id,
                    'amount'       => $data['income'],
                    'trx_type'     => '+',
                    'post_balance' => DB::table('users')->where('id', $user->id)->value('balance'),
                    'details'      => "Matrix Level {$level} Income",
                    'remark'       => 'matrix_income',
                    'trx'          => uniqid('ML'),
                    'created_at'   => now(),
                ]);
            });

            $achievement = [
                'level'  => $level,
                'team'   => $data['team'],
                'income' => $data['income'],
                'message'=> "🎉 Congratulation! You Have Achieved Your {$level} Level, and Your Income = ₹" . number_format($data['income']),
            ];

        } else {
            // Next target
            $nextTarget = [
                'level'     => $level,
                'required'  => $data['team'],
                'remaining' => max(0, $data['team'] - $teamSize),
            ];
            break;
        }
    }

    return view(
        activeTemplate() . 'user.matrixIncome',
        compact(
            'pageTitle',
            'leftTeam',
            'rightTeam',
            'teamSize',
            'achievement',
            'nextTarget'
        )
    );
}


    /* =====================================================
       WEEKLY PDF DOWNLOAD
    ===================================================== */
    public function weeklyPdf()
    {
        $user = Auth::user();

        $logs = DB::table('binary_logs')
            ->where('user_id', $user->id)
            ->whereBetween('date', [now()->subDays(6), now()])
            ->orderBy('date')
            ->get();

        $totalPair       = $logs->sum('pair');
        $totalCommission = $logs->sum('commission');

        $pdf = \PDF::loadView(
            'templates.basic.user.binary.weeklyPdf',
            compact('user', 'logs', 'totalPair', 'totalCommission')
        );

        return $pdf->download('weekly-binary-report.pdf');
    }

    /* =====================================================
       BINARY INCOME HISTORY
    ===================================================== */
   public function income()
{
    $user = auth()->user();
    $filter = request('filter', 'today');
    
    $transactions = Transaction::where('user_id', auth()->id())
    ->where('remark', 'binary_income')
    ->orderByDesc('id')
    ->paginate(20);


    $query = Transaction::where('user_id', $user->id)
        ->where('remark', 'binary_income');

    // ----------------------
    // FILTER
    // ----------------------
    if ($filter == 'today') {
        $query->whereDate('created_at', today());
    }

    if ($filter == 'week') {
        $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    if ($filter == 'month') {
        $query->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);
    }

    // Clone query BEFORE paginate
    $totalIncome = (clone $query)->sum('amount');

    $transactions = $query->orderByDesc('id')->paginate(20);

    return view(
        activeTemplate().'user.binary_history',
        compact('transactions','filter','totalIncome')
    );
}


    /* =====================================================
       BV LOG HISTORY
    ===================================================== */
    public function bvLog()
    {
        $logs = DB::table('bv_logs')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(20);

        return view(
            activeTemplate() . 'user.binary.bvLog',
            compact('logs')
        );
    }
    public function binaryIncomePdf()
{
    $transactions = Transaction::where('user_id', auth()->id())
        ->where('remark','binary_income')
        ->orderByDesc('id')
        ->get();

    $totalIncome = $transactions->sum('amount');

    $pdf = \PDF::loadView(
        activeTemplate().'user.binary.binaryIncomePdf',
        compact('transactions','totalIncome')
    );

    return $pdf->download('master-matching-income.pdf');
}
public function binaryIncomePrint()
{
    $transactions = Transaction::where('user_id', auth()->id())
        ->where('remark','binary_income')
        ->orderByDesc('id')
        ->get();

    $totalIncome = $transactions->sum('amount');

    return view(
        activeTemplate().'user.binary.binaryIncomePrint',
        compact('transactions','totalIncome')
    );
}

}
