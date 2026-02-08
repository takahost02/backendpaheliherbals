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
        $gs = gs();
        $now = Carbon::now();
        $today = $now->toDateString();

        /*
    |--------------------------------------------------------------------------
    | CONFIGURABLE BINARY TIME SLOTS
    |--------------------------------------------------------------------------
    | Change these anytime:
    | 'first'  => '12:00'   (12 PM)
    | 'second' => '00:00'   (12 AM)
    |
    | Example Future:
    | 'first'  => '13:00'
    | 'second' => '03:00'
    */
        $binarySlots = [
            'first'  => '14:18',
            'second' => '14:15',
        ];

        // Determine active slot
        $currentTime = $now->format('H:i');
        $half = null;

        foreach ($binarySlots as $slotName => $slotTime) {
            if ($currentTime >= $slotTime) {
                $half = $slotName;
            }
        }

        // fallback if nothing matched
        if (!$half) {
            $half = array_key_last($binarySlots);
        }

        if (!$force) {
            $alreadyRun = DB::table('binary_logs')
                ->where('date', $today)
                ->where('half', $half)
                ->exists();

            if ($alreadyRun) return;
        }

        $users = UserExtra::where('bv_left', '>', 0)
            ->where('bv_right', '>', 0)
            ->get();

        foreach ($users as $uex) {

            $user = User::find($uex->user_id);
            if (!$user) continue;

            $dailyPair = DB::table('binary_logs')
                ->where('user_id', $user->id)
                ->where('date', $today)
                ->sum('pair');

            $halfPair = DB::table('binary_logs')
                ->where('user_id', $user->id)
                ->where('date', $today)
                ->where('half', $half)
                ->sum('pair');

            $allowedPair = min(
                $gs->binary_daily_cap - $dailyPair,
                $gs->binary_half_cap - $halfPair
            );

            if ($allowedPair <= 0) continue;

            $leftBV  = $uex->bv_left;
            $rightBV = $uex->bv_right;
            $pair = 0;

            // FIRST MATCH
            if ($user->first_binary_completed == 0) {

                if ($leftBV >= (2 * $gs->total_bv) && $rightBV >= $gs->total_bv) {
                    $pair = 1;
                    $leftBV  -= (2 * $gs->total_bv);
                    $rightBV -= $gs->total_bv;
                } elseif ($leftBV >= $gs->total_bv && $rightBV >= (2 * $gs->total_bv)) {
                    $pair = 1;
                    $leftBV  -= $gs->total_bv;
                    $rightBV -= (2 * $gs->total_bv);
                }

                if ($pair === 1) {
                    $user->first_binary_completed = 1;
                    $user->save();
                }
            }

            $normalPair = min(
                floor($leftBV / $gs->total_bv),
                floor($rightBV / $gs->total_bv)
            );

            $pair += $normalPair;
            $pair = min($pair, $allowedPair);

            if ($pair <= 0) continue;

            // ========================
            // PAYOUT (Binary Disabled)
            // ========================
            $masterIncome = $pair * 750;

            $user->balance += $masterIncome;
            $user->save();

            Transaction::create([
                'user_id' => $user->id,
                'amount' => $masterIncome,
                'trx_type' => '+',
                'remark' => 'master_matching_income',
                'trx' => getTrx(),
                'details' => "Master Matching Income ({$pair} pairs)"
            ]);

            DB::table('binary_logs')->insert([
                'user_id' => $user->id,
                'date' => $today,
                'half' => $half,
                'pair' => $pair,
                'commission' => 0,
                'created_at' => now()
            ]);

            // ========================
            // BV DEDUCTION
            // ========================
            $paidBV = $pair * $gs->total_bv;

            $uex->bv_left  = max(0, $leftBV - $paidBV);
            $uex->bv_right = max(0, $rightBV - $paidBV);
            $uex->save();

            createBVLog($user->id, 1, $paidBV, 'Binary Paid');
            createBVLog($user->id, 2, $paidBV, 'Binary Paid');
        }
    }
}
