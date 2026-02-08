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

        return back()->withNotify([['success', 'All cron jobs executed immediately']]);
    }
}
