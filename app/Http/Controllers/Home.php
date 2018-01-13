<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use app\Mail\AccountNotification;
use Mail;
use Storage;
use App\Jobs;
class Home extends Controller{
    
    public function notFound(){
    	echo 'here';
    }

    public function sendEmail(Request $request){
    	$message = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
    	$event = array('name' => 'M Umair', 'msgBody' => $message, 'subject' => 'Welcome');
    	//print_r($event);exit;
    	//Mail::to('mu.cp15@gmail.com')->send(new \app\Mail\AccountNotification($event));
    	Mail::send('emails.welcome', $event, function($message){
		    $message->to('mu.cp15@gmail.com')->subject('Welcome!');
		});
    }

	public function jobCallMePayResult()
    { 
		//$postedData=$_POST;
		$data=json_encode($_POST);
		$postedData=json_decode($data); 
		$fileName='test.txt';
		$fileContents= Storage::disk('local')->get($fileName);
		$fileContents.=$data." ================================================== ";
        Storage::disk('local')->put($fileName, $fileContents);
		

		if($postedData->buyerName){
			$jId=rtrim($postedData->buyerName.replace(" ",""));
			$authCode=rtrim($postedData->authCode.replace(" ",""));

			$fileContents= Storage::disk('local')->get($fileName);
			$fileContents.=" ======== IN TESTING ====== ";
			Storage::disk('local')->put($fileName, $fileContents);

			$jobData=Jobs::findOrFail($jId);
			$jobData->status=1;
			$jobData->pay_id=$authCode;
			$jobData->save();

			$fileContents= Storage::disk('local')->get($fileName);
			$fileContents.=" <== Run Successfully ====== > ";
			Storage::disk('local')->put($fileName, $fileContents);
		}
		die('hmm');
    }

	public function paymentCompleted(){
		return view('frontend.paymentCompleted');
	}
}
?>