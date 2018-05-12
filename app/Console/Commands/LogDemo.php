<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use Session;
class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendjobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send latest jobs to jobseeker on daily base related to his field';

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
     * @return mixed
     */
    public function handle()
    { 
      $userid = \Session::get('jcmUser')->userId;
    $getCat = DB::table('jcm_users_meta')->where('userId',$userid)->first()->industry;
    $jobs = DB::table('jcm_jobs')->where('category',$getCat)->get();
    $jobstoview = array('jobs' => $jobs);
    $currentDate = \Carbon\Carbon::now();
    print_r($currentDate->toDateTimeString());
    Mail::send('emails.jobs',$jobstoview,function($message){
        $message->to(\Session()->get('jcmUser')->email)->subject('Latest jobs');
    });
    
    }
}
