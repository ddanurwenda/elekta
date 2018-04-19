<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\FacebookUpdater',
        'App\Console\Commands\fetchdata',
        'App\Console\Commands\fetchtwitter',
        'App\Console\Commands\fetchyoutube',
        'App\Console\Commands\fetchgplus',
        'App\Console\Commands\fetchgraph'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
//        $schedule->command('fetch:galert')->everyFifteenMinutes();
//        $schedule->command('fetch:youtube')->everyFifteenMinutes();
//        $schedule->command('fetch:gplus')->everyFifteenMinutes();
        $schedule->command('facebook:update')->everyFifteenMinutes();
        $schedule->command('fetch:twitter')->hourly();
        $schedule->command('fetch:graph')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
