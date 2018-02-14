<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use app\Mail\jobsnotifications;
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
    	/*Mail::to('muhammadsajid9005@gmail.com')->send(new jobsnotifications($name = 'sajid'));*/
    	
    	Mail::send('emails.jobs', $event, function($message){
		    $message->to('muhammadsajid9005@gmail.com')->subject('Welcome!');
		});
		
    }

	 public function jobCallMePayResult()
    {  
		/*$postedData='{"resultCode":"3001","resultMsg":"\uce74\ub4dc \uacb0\uc81c \uc131\uacf5                                                                                      ","authDate":"180113205258","authCode":"31976428                      ","buyerName":"66                            ","mallUserID":"                    ","goodsName":"jobcallme                               ","mid":"nicepay00m","tid":"nicepay00m01011801131153025658","moid":"mnoid1234567890                                                 ","amt":"000000022330","cardCode":"01 ","cardQuota":"00","cardName":"\ube44\uc528                                                                                                ","bankCode":"","bankName":"","rcptAuthCode":"","carrier":"","dstAddr":"","vbankBankCode":"","vbankBankName":"","vbankNum":"","vbankExpDate":""}';*/
		/*echo $jId;
		die('hmmmm');*/
		$data=json_encode($_POST); 		
		$postedData=json_decode($data); 
		$jId=rtrim($postedData->buyerName);
		$authCode=rtrim($postedData->authCode);
		 
		$fileName='test.txt';
		$fileContents= Storage::disk('local')->get($fileName);
		$fileContents.=$data." ================================================== ";
        Storage::disk('local')->put($fileName, $fileContents);
		/*$fileName='test.txt';
		$jId='53'; 
		$authCode='hmmm'; */
		if($jId){ 
			$fileContents= Storage::disk('local')->get($fileName);
			$fileContents.=" ======== IN TESTING ====== ";
			Storage::disk('local')->put($fileName, $fileContents);
			$jId=explode('-',$jId);
			$jobData=Jobs::findOrFail($jId[0]); 
			$jobData->status=1;
			$jobData->pay_id=$authCode;
			$jobData->p_Category=$jId[1];
			$jobData->package_start_time=date('Y-m-d H:i:s');
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