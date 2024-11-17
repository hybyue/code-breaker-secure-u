<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('app:check-lost-found-exceeded')
    //     ->everyMinute()
    //     ->appendOutputTo(storage_path('logs/scheduler.log'));    }


    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        Log::info("Scheduler is running.");
    })->everyMinute();
}


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
