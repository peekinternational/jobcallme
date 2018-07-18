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
        $yesterday = date('Y-m-d',strtotime("-1 days"));
        $allusers = DB::table('jcm_users')->where('subscribe','Y')->get();
        //echo $yesterday;
        foreach ($allusers as $user) {
            //echo $user->email;
            $getCat = DB::table('jcm_users_meta')->where('userId',$user->userId)->first()->industry;
            $jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
                ->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
                ->where('jcm_jobs.category',$getCat)->whereDate('jcm_jobs.createdTime','=',$yesterday)
                >limit(12)
                ->get();
            // $jobs = DB::table('jcm_jobs')->where('category',$getCat)->whereDate('createdTime','=',$yesterday)->get();
            if(count($jobs) > 0){
                $jobstoview = array('jobs' => $jobs, 'getCat'=>$getCat);
                Mail::send('emails.jobs',$jobstoview,function($message) use ($user){
                    $message->to($user->email)->subject('Latest jobs');
                });
            }
    
        }
    $allsub = DB::table('jcm_save_packeges')->where('status','1')->where('expire_date','>','0')->where('type','Resume Download')->where('quantity','>','0')->get();
    foreach ($allsub as $users) {
        
        $newdate=$users->expire_date;
        $date=$newdate-1;
        $input['expire_date']=$date;
        DB::table('jcm_save_packeges')->where('status','1')->where('expire_date','>','0')->where('type','Resume Download')->where('quantity','>','0')->where('user_id',$users->user_id)->update($input);
    }
    
//dd($users);
    }
}
