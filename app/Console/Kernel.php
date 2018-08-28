<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Mail;  
use App\Jobs;
use App\CometChat;
use App\JobsApplied;
use App\User; 
use Storage;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\LogDemo',
        'App\Console\Commands\sajid'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       $schedule->call(function () {
		    
            $comet=CometChat::whereNull('custom_data')->get()->toArray();
            $emailSent=[];
            if(count($comet)>0):
                //echo "Comet count: ".count($comet).' ////<br/>';
                foreach($comet as $items): 
                    if(!in_array("{$items['from']}-{$items['to']}",$emailSent)):
                        $where=['from'=>$items['to'],'to'=>$items['from']]; //check if 'to' has replied back?
                        /*$foundTo=CometChat::where($where)->count();
                        if($foundTo>0): //if yes (update both two user as communicating)
                            $orWhere=['to'=>$items['to'],'from'=>$items['from']];
                            CometChat::where($where)->orWhere($orWhere)->update(['custom_data' => 1]); 
                            //echo "Found: {$items['from']} -- {$items['to']} <br/>";
                        else:*/
                            //echo "Not Found: {$items['from']} -- {$items['to']} <br/>";
                            //Employer check (email should always sent from employer to applicant)
                            $cJobs=Jobs::where('userId',$items['from'])->get();
                            if(count($cJobs)>0):
                                foreach($cJobs as $jobs): 
                                    $jobWhere=['userId'=>$items['to'],'jobId'=>$jobs->jobId];
                                    $jApplied=JobsApplied::where($jobWhere)->count();
                                    if($jApplied>0): //to has applied on from job
                                        //send email 
                                        $employer=User::where('userId',$items['from'])->first();
                                        $empName="{$employer->firstName} {$employer->lastName}";
                                        $applicant=User::where('userId',$items['to'])->first();
                                        $appName="{$applicant->firstName} {$applicant->lastName}";
                                        $myContent=
                                        trans('home.Dear') ." {$appName} ".trans('home.Dear2') ." <br/>"
                                        .trans('home.ChatEmployer') ."<span style='color:red'>[</span><span style='color:#337ab7'>{$empName}</span><span style='color:red'>]</span>" .trans('home.has sent you message, reply him back by logging at <a href="https://www.jobcallme.com" target="_blank">JobCallMe</a>').
                                        "<br/><br/>"
                                        .trans('home.Regards.').""; 
                                        $subject=trans('home.Employer Message: JobCallMe');
                                        $email=$applicant->email;
                                        Mail::send([],[], function ($message) use($email,$myContent,$subject){  
                                            $message->to($email, $email)->subject($subject)->setBody($myContent,'text/html');
                                        }); 
                                        array_push($emailSent,"{$items['from']}-{$items['to']}");
                                        $fileName='cron.txt';
                                        $fileContents= Storage::disk('local')->get($fileName);
                                        $fileContents.=" =========== Cron Job 'every minute' at ".date("l jS \of F Y h:i:s A")." email sent {$items['from']}-{$items['to']} ============== ";
                                        Storage::disk('local')->put($fileName, $fileContents);
                                        break;
                                    endif;
                                endforeach;	 
                                $orWhere=['to'=>$items['to'],'from'=>$items['from']];
                                CometChat::where($where)->orWhere($orWhere)->update(['custom_data' => 1]);
                            endif; 
                        /*endif;*/
                    endif;
                endforeach;

            endif; 
			
        })->everyMinute();

		$schedule->command('sendjobs')->daily();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
