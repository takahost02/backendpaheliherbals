<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\BinaryMatchingService;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $binaryMatchingService = app(BinaryMatchingService::class);
        $schedule->command('binary:match')->everyMinute();
        $schedule->command('binary:closing')->everyMinute();

        $schedule->call(fn() => $binaryMatchingService->runClosing('AM'))
            ->dailyAt('00:00');

        $schedule->call(fn() => $binaryMatchingService->runClosing('PM'))
            ->dailyAt('12:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
