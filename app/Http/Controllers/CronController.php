<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CronJob;
use App\Lib\CurlRequest;
use App\Constants\Status;
use App\Models\UserExtra;
use App\Models\CronJobLog;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Services\BinaryMatchingService;

class CronController extends Controller
{
    public function cron()
    {
        $general = gs();
        $general->last_cron = now();
        $general->save();

        $crons = CronJob::with('schedule');

        if (request()->alias) {
            $crons->where('alias', request()->alias);
        } else {
            $crons->where('next_run', '<', now())
                ->where('is_running', Status::YES);
        }

        $crons = $crons->get();

        foreach ($crons as $cron) {

            $cronLog = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at = now();

            try {
                if ($cron->is_default) {
                    $controller = new $cron->action[0];
                    $method = $cron->action[1];
                    $controller->$method();
                } else {
                    CurlRequest::curlContent($cron->url);
                }
            } catch (\Exception $e) {
                $cronLog->error = $e->getMessage();
            }

            $interval = (int) ($cron->schedule->interval ?? 60);

            $cron->last_run = now();
            $cron->next_run = now()->addSeconds($interval);
            $cron->save();

            $cronLog->end_at = $cron->last_run;
            $cronLog->duration = Carbon::parse($cronLog->start_at)
                ->diffInSeconds(Carbon::parse($cronLog->end_at));
            $cronLog->save();
        }

        // 🔥 Run Binary Matching (Binary Commission Disabled)
        $this->matchingBound();

        return back()->withNotify([['success', 'Cron executed successfully']]);
    }

    public function binaryMatchingCron()
    {
        $service = new BinaryMatchingService();

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $pair = 2;
            $half = 100;

            $service($user, $pair, $half, false);
        }

        return 'Binary Matching Done';
    }

    public function cron_now()
    {
        $general = gs();
        $general->last_cron = now();
        $general->save();

        $crons = CronJob::with('schedule')->get();

        foreach ($crons as $cron) {

            $cronLog = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at = now();

            try {
                if ($cron->is_default) {
                    $controller = new $cron->action[0];
                    $method = $cron->action[1];
                    $controller->$method();
                } else {
                    CurlRequest::curlContent($cron->url);
                }
            } catch (\Exception $e) {
                $cronLog->error = $e->getMessage();
            }

            $interval = (int) ($cron->schedule->interval ?? 60);

            $cron->last_run = now();
            $cron->next_run = now()->addSeconds($interval);
            $cron->save();

            $cronLog->end_at = $cron->last_run;
            $cronLog->duration = Carbon::parse($cronLog->start_at)
                ->diffInSeconds(Carbon::parse($cronLog->end_at));
            $cronLog->save();
        }

        // 🔥 Force binary run
        $this->matchingBound(true);

        return back()->withNotify([['success', 'All cron jobs executed immediately']]);
    }

    /**
     * ===========================
     * BINARY MATCHING ENGINE
     * ===========================
     * Binary Commission DISABLED
     */
    private function matchingBound($force = false)
    {
        $gs   = gs();
        $now  = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i');

        /*
    |--------------------------------------------------------------------------
    | BINARY MATCHING TIME SLOTS
    |--------------------------------------------------------------------------
    */
        $binarySlots = [
            'first'  => '16:30', // Day Slot
            'second' => '04:30', // Night Slot
        ];

        // ===============================
        // DETERMINE CURRENT HALF
        // ===============================
        $half = null;
        if ($currentTime >= $binarySlots['first'] && $currentTime < $binarySlots['second']) {
            $half = 'first';
        } else {
            $half = 'second';
        }

        // ===============================
        // GET USERS WITH BV
        // ===============================
        $users = UserExtra::where('bv_left', '>', 0)
            ->where('bv_right', '>', 0)
            ->get();

        foreach ($users as $uex) {

            $user = User::find($uex->user_id);
            if (!$user) continue;

            // ===============================
            // LOG EVERY RUN (pair = 0) TO TRACK CRON
            // ===============================
            DB::table('binary_logs')->insert([
                'user_id'    => $user->id,
                'date'       => $today,
                'half'       => $half,
                'pair'       => 0,             // no pairs yet, just logging cron run
                'commission' => 0,
                'created_at' => now()
            ]);
        }

        // ===============================
        // PREVENT DUPLICATE RUN (FOR PAID PAIRS)
        // ===============================
        if (!$force) {
            $alreadyRun = DB::table('binary_logs')
                ->where('date', $today)
                ->where('half', $half)
                ->where('pair', '>', 0)
                ->exists();

            if ($alreadyRun) {
                return;
            }
        }

        // ===============================
        // ORIGINAL MATCHING LOGIC STARTS HERE
        // ===============================
        foreach ($users as $uex) {

            $user = User::find($uex->user_id);
            if (!$user) continue;

            // DAILY + HALF CAP
            $dailyPair = DB::table('binary_logs')
                ->where('user_id', $user->id)
                ->where('date', $today)
                ->where('pair', '>', 0)
                ->sum('pair');

            $halfPair = DB::table('binary_logs')
                ->where('user_id', $user->id)
                ->where('date', $today)
                ->where('half', $half)
                ->where('pair', '>', 0)
                ->sum('pair');

            $remainingDaily = max(0, $gs->binary_daily_cap - $dailyPair);
            $remainingHalf  = max(0, $gs->binary_half_cap - $halfPair);

            $allowedPair = min($remainingDaily, $remainingHalf);

            if ($allowedPair <= 0) continue;

            // BV CALCULATION
            $leftBV  = $uex->bv_left;
            $rightBV = $uex->bv_right;
            $pair    = 0;

            // FIRST MATCH (2:1 or 1:2)
            if ($user->first_binary_completed == 0) {

                if ($leftBV >= (2 * $gs->total_bv) && $rightBV >= $gs->total_bv) {

                    $pair = 1;
                    $leftBV  -= (2 * $gs->total_bv);
                    $rightBV -= $gs->total_bv;
                } elseif ($rightBV >= (2 * $gs->total_bv) && $leftBV >= $gs->total_bv) {

                    $pair = 1;
                    $leftBV  -= $gs->total_bv;
                    $rightBV -= (2 * $gs->total_bv);
                }

                if ($pair === 1) {
                    $user->first_binary_completed = 1;
                    $user->save();
                }
            }

            // NORMAL 1:1 MATCH
            $normalPair = min(
                floor($leftBV / $gs->total_bv),
                floor($rightBV / $gs->total_bv)
            );

            $pair += $normalPair;

            // APPLY CAP
            $pair = min($pair, $allowedPair);

            if ($pair <= 0) continue;

            // INCOME
            $masterIncome = $pair * 750;

            $user->balance += $masterIncome;
            $user->save();

            Transaction::create([
                'user_id'  => $user->id,
                'amount'   => $masterIncome,
                'trx_type' => '+',
                'remark'   => 'master_matching_income',
                'trx'      => getTrx(),
                'details'  => "Master Matching Income ({$pair} pairs)"
            ]);

            // INSERT BINARY LOG
            DB::table('binary_logs')->insert([
                'user_id'    => $user->id,
                'date'       => $today,
                'half'       => $half,
                'pair'       => $pair,
                'commission' => 0,
                'created_at' => now()
            ]);

            // BV DEDUCTION
            $paidBV = $pair * $gs->total_bv;

            $uex->bv_left  = max(0, $uex->bv_left - $paidBV);
            $uex->bv_right = max(0, $uex->bv_right - $paidBV);
            $uex->save();

            createBVLog($user->id, 1, $paidBV, 'Binary Paid');
            createBVLog($user->id, 2, $paidBV, 'Binary Paid');
        }
    }
}
