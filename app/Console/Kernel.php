<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Notifications\remindClient;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        // SendEmails:: class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $loginusers= User::where('lastlogin', '<=', new DateTime('-1 months'))->get(); 
        // foreach($loginusers as $user){
        //     // dd($user);
        //     // $schedule->command(remindClient::class)->daily();
        //     //for test Only
            $schedule->command(SendEmails:: class)->everyMinute();
        //     // $user->notify(new remindClient()); //byb3t al message
        // }
      
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
