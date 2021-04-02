<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\remindClient;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send reminder emails to the clients';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return users who don't login to system more than month
        // dd(now()->format('Y-m-d'));
        //loop on All users when lastlogin less than or equal date of now minus month 
        //so they don't login from month ago so send msg for them
            $loginusers= User::where('lastlogin', '<=', new DateTime('-1 months'))->get(); 
            foreach($loginusers as $user){
                // dd($user);
                $user->notify(new remindClient());
            }

        return 0;
    }
}
   
