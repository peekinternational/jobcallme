<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use App\Http\Requests;
use DB;
use PDF;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Mapper;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Jobs;

class Employer extends Controller{
	/*paypal*/
	 private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */

	 
	 
    public function payWithPaypal()
    {
        return view('frontend.employer.share-job');
		//return view('frontend.employer.payment');
    }
	
	  public function payWithPaypals()
    {
      
		return view('frontend.employer.payment');
    }
	
	  public function updatepayWithPaypals()
    {
      
		return view('frontend.employer.update-payment');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function post(Request $request)
    {
		// $count=$request->goodscount;
		// $gname=$request->goodsName;
		// $price=$request->price;
		// $bname=$request->buyerName;
		// $tel=$request->tel;
		// $email=$request->Email;
		$price=Session::get('amount');
		$mul=$price*1100;
		$goodsname = Session::get('p_Category');
		$app = $request->session()->get('jcmUser');
		
		$data = http_build_query(array('goodscount' => '1',
		'goodsName' => $goodsname,
		'price' => $mul,
		'buyerName' => $app->firstName,
		'tel' => $app->phoneNumber,
		'Email' => $app->email));
		//dd($data);
		
		$url = "http://peekinternational.com/demos/nicepay/payRequest_utf.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTREDIR, 3);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);
var_dump($server_output);
curl_close ($ch);
	}
	 
	 
    public function postPaymentWithpaypals(Request $request)
    {
	/*dd($request->all());*/
	   $rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
	   //dd();
	   $durations= $amount*$request->duration;

        $mul=$durations;
        $am=$mul*1100;
      //  dd($am);
	  $request->session()->put('p_Category', $request->p_Category);
        $goodsname = Session::get('p_Category');
        $app = $request->session()->get('jcmUser');
		//dd($request->department);
		$request->session()->put('amount', $durations);
		$request->session()->put('title', $request->title);
		$request->session()->put('jobaddr', $request->jobaddr);
		$request->session()->put('head', $request->head);
		$request->session()->put('dispatch', $request->dispatch);
		$request->session()->put('jType', 'Paid');
		$request->session()->put('department', $request->department);
		$request->session()->put('category', $request->category);
		$request->session()->put('subCategory', $request->subCategory);
		$request->session()->put('subCategory2', $request->subCategory2);
		$request->session()->put('careerLevel', $request->careerLevel);
		$request->session()->put('experience', $request->experience);
		$request->session()->put('vacancy', $request->vacancy);
		$request->session()->put('description', $request->description);
		$request->session()->put('skills', $request->skills);
		$request->session()->put('qualification', $request->qualification);
		$request->session()->put('expiryDate', $request->expiryDate);
		$request->session()->put('minSalary', $request->minSalary);
		$request->session()->put('maxSalary', $request->maxSalary);
		$request->session()->put('description', $request->description);
		$request->session()->put('type', $request->type);
		$request->session()->put('currency', $request->currency);
		$request->session()->put('benefits', $request->benefits);
		$request->session()->put('process', $request->process);
		$request->session()->put('state', $request->state);
		$request->session()->put('city', $request->city);
		$request->session()->put('country', $request->country);
		$request->session()->put('Address', $request->Address);
		$request->session()->put('shift', $request->shift);
		$request->session()->put('duration', $request->duration);
		$request->session()->put('expiryDate', $request->expiryDate);
		$request->session()->put('expiryAd', $request->expiryAd);
		
		 $goodsname = Session::get('p_Category');
		if($amount!='0')
		{
			$request->merge(['jType'=>'Paid']);
		}
		if($amount=='0')
		{
			$request->merge(['jType'=>'Free']);
				$app = $request->session()->get('jcmUser');

		$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required|max:1024',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				'minSalary' => 'required|numeric',
				'maxSalary' => 'required|numeric',
				'state' => 'required',
			]);
	
   
		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'status' => '1', 'paymentType' => '0', 'amount' => $amount, 'p_Category' => $p_Category, 'title' => $title, 'jType' => $jType,'dispatch' => $dispatch,'head' => $head,'department' => $department,'duration' => $duration, 'category' => $category, 'subCategory' => $subCategory,'subCategory2' => $subCategory2, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift,'jobaddr' => $jobaddr, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => rtrim(@implode(',', $request->input('benefits')),','), 'process' => rtrim(@implode(',', $request->input('process')),','), 'country' => $country, 'state' => $state, 'city' => $city,'Address' => $Address, 'expiryDate' => $expiryDate, 'expiryAd' => $expiryAd, 'createdTime' => date('Y-m-d H:i:s'));
		
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		//dd($jobId);
		\Session::put('success','Add Job Successfully');
		return Redirect::route('addmoney.account/employer/job/share');	
		}	
		else{
		$request->session()->forget('postedJobId');  /*For nice pay*/
		 return view('frontend.employer.payment',compact('am','app','goodsname'));
	//	return Redirect::route('addmoney.account/employer/payment',compact('am','app','goodsname'));
		}
	}
	
	
		public function postPaymentWithpaypal(Request $request)
    {
		
		//dd(Session::get('amount'));
		//exit();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(Session::get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Session::get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return 'Connection timeout';
                return Redirect::route('add.frontend.employer.post-job');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return 'Some error occur, sorry for inconvenient';
                return Redirect::route('ey.frontend.employer.post-job');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
		 $pay_id=$payment->getId();
         Session::put('paypal_payment_id', $payment->getId());
        /** add payment ID to session **/
		// $pay_id=$payment->getId();
     
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
       return 'Unknown error occurred';
        return Redirect::route('frontend.employer.post-job');
    
	}
    public function getPaymentStatus(Request $request)
    {
		$payment_id = Session::get('paypal_payment_id');
		
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.frontend.employer.post-job');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 

        $payment_id = Session::get('paypal_payment_id');
		$app = $request->session()->get('jcmUser');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
		$title = Session::get('title');
		$department =Session::get('department');
		$category = Session::get('category');
		$subCategory = Session::get('subCategory');
		$subCategory2 = Session::get('subCategory2');
		$careerLevel =Session::get('careerLevel');
		$experience =Session::get('experience');
		$vacancy = Session::get('vacancy');
		$skills =Session::get('skills');
		$jobaddr =Session::get('jobaddr');
		$qualification = Session::get('qualification');
		$expiryDate = Session::get('expiryDate');
		$minSalary = Session::get('minSalary');
		$maxSalary = Session::get('maxSalary');
		$description = Session::get('description');
	    $type = Session::get('type');
		$currency = Session::get('currency');
		$benefits = Session::get('benefits');
		$process = Session::get('process');
		//$jobaddr = Session::get('jobaddr');
		$country = Session::get('country');
		$shift = Session::get('shift');
		$city = Session::get('city');
		$Address = Session::get('Address');
		$head = Session::get('head');
		$dispatch = Session::get('dispatch');
		$duration = Session::get('duration');
		$expiryDate = Session::get('expiryDate');
		$expiryAd = Session::get('expiryAd');
		$state = Session::get('state');

		

		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'status' =>'1', 'pay_id' => $payment_id, 'amount' => $amount, 'p_Category' => $p_Category, 'title' => $title, 'jType' => $jType, 'dispatch' => $dispatch, 'head' => $head, 'department' => $department,'duration' => $duration, 'category' => $category, 'subCategory' => $subCategory,'subCategory2' => $subCategory2, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift,'jobaddr' => $jobaddr, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => @implode(',', $benefits),'process' => @implode(',', $process), 'country' => $country, 'state' => $state, 'city' => $city,'Address' => $Address, 'expiryDate' => $expiryDate,'expiryAd' => $expiryAd, 'createdTime' => date('Y-m-d H:i:s'));
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		echo $jobId;
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Payment success');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }
	
	
	public function completePayment(Request $request){
		/*Sessions for nicepay*/
		Session::put('p_Category',$request->p_Category); 
		Session::put('postedJobId',Session::get('id')); 
		/***/
		$rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
		$am=$amount;
		$p_Category=$request->p_Category;
		$jType=$request->jType;
		$app = $request->session()->get('jcmUser');
		//Session::get('postedJobId')	
		return view('frontend.employer.payment',compact('am','app','p_Category','jType'));
	}		
	
	public function getresponse(Request $request){
		if(!Session::get('postedJobId')): 
			$apps = $request->session()->get('jcmUser'); 
			$payment = "123";
			
			$amounts = Session::get('amount');
			$jTypes = Session::get('jType');
			$p_Categorys = Session::get('p_Category');
			$titles = Session::get('title');
			$departments =Session::get('department');
			$categorys = Session::get('category');
			$subCategorys = Session::get('subCategory');
			$subCategorys2 = Session::get('subCategory2');
			$careerLevels =Session::get('careerLevel');
			$experiences =Session::get('experience');
			$vacancys = Session::get('vacancy');
			$skillss =Session::get('skills');
			$jobaddrs =Session::get('jobaddr');
			$qualifications = Session::get('qualification');
			$durations = Session::get('duration');
			$minSalarys = Session::get('minSalary');
			$maxSalarys = Session::get('maxSalary');
			$descriptions = Session::get('description');
			$types = Session::get('type');
			$currencys = Session::get('currency');
			$benefitss = Session::get('benefits');
			$process = Session::get('process');
			$countrys = Session::get('country');
			$shifts = Session::get('shift');
			$citys = Session::get('city');
			$Addresss = Session::get('Address');
			$expiryDates = Session::get('expiryDate');
			$expiryAds = Session::get('expiryAd');
			$states = Session::get('state');
	
			extract($request->all());

			$inputs = array('userId' => $apps->userId, 'companyId' => $apps->companyId, 'pay_id' => $payment, 'amount' => $amounts, 'p_Category' => $p_Categorys, 'title' => $titles, 'jType' => $jTypes, 'department' => $departments, 'category' => $categorys, 'subCategory' => $subCategorys, 'subCategory2' => $subCategorys2, 'careerLevel' => $careerLevels, 'experience' => $experiences, 'vacancies' => $vacancys,'duration' => $durations, 'description' => $descriptions, 'skills' => $skillss, 'qualification' => $qualifications, 'jobType' => $types, 'jobShift' => $shifts,'jobaddr' => $jobaddrs, 'minSalary' => $minSalarys, 'maxSalary' => $maxSalarys, 'currency' => $currencys, 'benefits' => @implode(',', $benefitss), 'process' => @implode(',', $process),'country' => $countrys, 'state' => $states, 'city' => $citys,'Address' => $Addresss, 'expiryDate' => $expiryDates, 'expiryAd' => $expiryAds,'paymentType'=>2, 'createdTime' => date('Y-m-d H:i:s'));
			if($subCategorys == ''){
				$inputs['subCategory'] = '';
			}
			
			$jobId= DB::table('jcm_jobs')->insertGetId($inputs);
			Session::put('postedJobId',$jobId);
		else: 
			if(Session::get('p_Category')):
				$p_Categorys = Session::get('p_Category');
			else:
				$jobData=Jobs::where('jobId',$p_Categorys)->first();
				$p_Categorys = $jobData->p_Category;
			endif;
			
			$jobId=Session::get('postedJobId');
		endif;

		echo $jobId.'-'.$p_Categorys;
	    die();   
	 }
	
	
    public function home(Request $request){
    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$app = $request->session()->get('jcmUser');

    	/* posted jobs*/
    	//$postedJobs = DB::table('jcm_jobs')->leftJoin('jcm_job_applied','jcm_jobs.jobId','=','jcm_job_applied.jobId')->select(DB::raw('count(jcm_job_applied.userId) as count,jcm_jobs.*'))->where('jcm_jobs.userId','=',$app->userId)->GroupBy('jcm_job_applied.jobId')->orderBy('jcm_jobs.jobId','desc')->get();
		//$postedJobs = DB::table('jcm_jobs')->where('userId','=',$app->userId)->orderBy('jobId','desc')->get();
		$postedJobs = DB::table('jcm_jobs')->leftJoin('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id')->leftJoin('jcm_job_applied','jcm_jobs.jobId','=','jcm_job_applied.jobId')->select(DB::raw('count(jcm_job_applied.userId) as count,jcm_jobs.*,jcm_payments.title as p_title'))->where('jcm_jobs.status','=','1')->where('jcm_jobs.userId','=',$app->userId)->GroupBy('jcm_jobs.jobId')->orderBy('jcm_jobs.jobId','desc')->paginate(8);
    	/* end */
//dd($postedJobs);
    	/* recent application */
    	$applicant = DB::table('jcm_job_applied')
    					->select('jcm_job_applied.applyTime','jcm_jobs.jobId','jcm_users.city','jcm_users.country','jcm_jobs.title','jcm_users.userId','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')
    					->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
    					->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
    					->orderBy('jcm_job_applied.applyId','desc')
    					->where('jcm_jobs.userId','=',$app->userId)
    					->paginate(8);
						
						
		$applicants = DB::table('jcm_companies')
    					->select('jcm_users.city','privacy.profileImage as privacyImage','jcm_users.country','jcm_companies.companyName','jcm_companies.companyId','jcm_users.userId','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')
    					
						->join('jcm_users','jcm_users.companyId','=','jcm_companies.companyId')
						->join('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId')
						->where('privacy.profile','=','Yes')
						->limit(6)
    					->get();				
    	/* end */

    	/* job response */
    	$response = $this->getJobResponse($app);

    	/* experience level */
    	$experience = $this->getJobExperienceLevel($app);

    	/* recruitement activiety */
    	$recruit = $this->getRecruitmentActivity($app);
		
		/* Related read */
		$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
    	if($request->input('category') != '0' && $request->input('category') != ''){
    		$readQry->where('jcm_writings.category','=',$request->input('category'));
    	}
    	if($request->input('keyword') != ''){
    		$readQry->where('jcm_writings.title','LIKE','%'.$request->input('keyword').'%');
    	}
    	$readQry->orderBy('jcm_writings.writingId','desc')->limit(6);
    	$read_record = $readQry->get();
		//dd($postedJobs);
		
		$lear_record = DB::table('jcm_upskills')->orderBy('skillId','desc')->limit(8)->get();
		/* ucomming interview data*/
		$upcommingInterviews = DB::table('jcm_job_interviews')
				->select('jcm_job_interviews.*','jcm_users.firstName','jcm_users.profilePhoto','jcm_users.lastName','jcm_jobs.title','con.name as country','stat.name as state','cit.name as city')
				->leftJoin('jcm_users','jcm_users.userId','=','jcm_job_interviews.jobseekerId')
				->leftJoin('jcm_jobs','jcm_jobs.jobId','=','jcm_job_interviews.jobId')
				->leftJoin('jcm_countries as con','con.id','=','jcm_users.country')
				->leftJoin('jcm_states as stat','stat.id','=','jcm_users.state')
				->leftJoin('jcm_cities as cit','cit.id','=','jcm_users.city')
				->where('jcm_job_interviews.userId',$app->userId)->orderBy('interviewId','desc')
				->limit(8)->get();

		return view('frontend.employer.dashboard',compact('upcommingInterviews','postedJobs','applicant','applicants','response','experience','recruit','read_record','lear_record'));
	}

	public function getJobResponse($app){
		$startFrom = trim(date('m'),'0');

		$dataArr = array();
		$monthArr = array();
		for($i = 1; $i <= $startFrom; $i++){
			$k = $i < 10 ? '0'.$i : $i;
			$dDate = date('Y').'-'.$k;
			$monthArr[] = '"'.date('F',strtotime($dDate)).'"';
			$rec = DB::table('jcm_job_applied')->select(DB::raw('count(jcm_job_applied.applyId) as totalApplied'))->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')->where('jcm_jobs.userId','=',$app->userId)->where('jcm_job_applied.applyTime','like','%'.$dDate.'%')->first();
			$dataArr[] = $rec->totalApplied;
		}
		//print_r($dataArr);exit;
		return array($monthArr, $dataArr);
	}

	public function getJobExperienceLevel($app){
		$dataArr = array();
		$exprArr = array();
		$i=1;
		foreach(JobCallMe::getExperienceLevel() as $exp){
			$exprArr[] = '"'.$exp.'"';
			$rec = DB::table('jcm_jobs')->select(DB::raw('count(jobId) as totalApplied'))->where('userId','=',$app->userId)->where('experience','like','%'.$exp.'%')->first();
			$dataArr[] = $rec->totalApplied;
			if(++$i == 10){break;}
		}
		return array($exprArr, $dataArr);
	}

	public function getRecruitmentActivity($app){
		$startFrom = trim(date('m'),'0');

		$dataArr = array();
		$monthArr = array();
		for($i = 1; $i <= $startFrom; $i++){
			$k = $i < 10 ? '0'.$i : $i;
			$dDate = date('Y').'-'.$k;
			$monthArr[] = '"'.date('F',strtotime($dDate)).'"';
			$rec = DB::table('jcm_jobs')->select(DB::raw('count(jobId) as totalApplied'))->where('userId','=',$app->userId)->where('createdTime','like','%'.$dDate.'%')->first();
			$dataArr[] = $rec->totalApplied;
		}
		//print_r($dataArr);exit;
		return array($monthArr, $dataArr);
	}

	public function jobPost(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
		
		$company = DB::table('jcm_companies')->select('*')->where('companyId','=',$request->session()->get('jcmUser')->companyId)->get();
		//dd($company[0]->category);
		if($company[0]->category== "0")
		{
			$request->session()->flash('companyAlert', 'Please first Complate you company profile then post your job');
			return redirect('account/employer/organization');
		}

	//$departs = DB::table('jcm_departments')->select('departmentId','name')->where('userId','=',$request->session()->get('jcmUser')->userId)->get();
	//	if(sizeof($departs)== "")
	//	{
	//		$request->session()->flash('depAlert', 'Please first add your company department then post your job');
	//		return redirect('account/employer/departments');
	//	}
		
    	$rec = DB::table('jcm_payments')->get();
		//dd($rec);
		return view('frontend.employer.post-job',compact('rec'));
	}

	public function saveJob(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required|max:1024',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				'minSalary' => 'required|numeric',
				'maxSalary' => 'required|numeric',
				'state' => 'required',
			]);

		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'title' => $title, 'department' => $department, 'category' => $category, 'subCategory' => $subCategory, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => @implode(',', $request->input('benefits')), 'country' => $country, 'state' => $state, 'city' => $city, 'expiryDate' => $expiryDate, 'createdTime' => date('Y-m-d H:i:s'));
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		$jobId = DB::table('jcm_jobs')->insertGetId($input);
		echo $jobId;
	}

	public function shareJob(Request $request,$jobId){
		//echo $jobId;
		return view('frontend.employer.share-job',compact('jobId'));
	}

	public function application(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$userId = $request->session()->get('jcmUser')->userId;

    	/* get jobs */
    	$getJobs = DB::table('jcm_jobs')->select('jobId','title')->where('userId','=',$userId)->orderBy('jobId','desc');
    	$jobs = $getJobs->get();
    	/* end */

		return view('frontend.employer.application',compact('jobs'));
	}

	public function getApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$type = $request->segment(4);

		$jobId = $request->input('jobId');
		//'Delivered','Junk','Shortlist','Screened','Interview','Offer','Hire','Reject'

		$vhtml = '';
		switch ($type) {
			case 'inbox':
				$record = DB::table('jcm_job_applied')
							->select('jcm_jobs.title','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*')
							->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
							->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
							->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
							->where('jcm_jobs.userId','=',$app->userId)
							->where('jcm_job_applied.applicationStatus','=','Delivered')
							->where(function ($query) use ($jobId) {
		                        if($jobId != '0'){
		                            $query->where('jcm_job_applied.jobId', '=', $jobId);
		                        }
		                    })
							->orderBy('jcm_job_applied.applyId','desc')
							->get();
			break;
			
			default:
				$record = DB::table('jcm_job_applied')
							->select('jcm_jobs.title','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*')
							->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
							->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
							->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
							->where('jcm_jobs.userId','=',$app->userId)
							->where('jcm_job_applied.applicationStatus','=',ucfirst($type))
							->where(function ($query) use ($jobId) {
		                        if($jobId != '0'){
		                            $query->where('jcm_job_applied.jobId', '=', $jobId);
		                        }
		                    })
							->orderBy('jcm_job_applied.applyId','desc')
							->get();
			break;
		}

		$userArr = array();
		if(count($record) > 0){
			$vhtml  = '<table class="table ea-applicant-tbl" >';
				$vhtml .= '<thead>';
					$vhtml .= '<tr>';
						$vhtml .= '<th><input id="select-all"  type="checkbox" class="cbx-field"><label class="cbx" for="select-all"></label></th>';
						$vhtml .= '<th>';
							$vhtml .= '<div class="col-md-4 hidden-xs hidden-sm">'.trans('home.candidate').'</div>';
							$vhtml .= '<div class="col-md-3 hidden-xs hidden-sm">'.trans('home.education').'</div>';
							$vhtml .= '<div class="col-md-3 hidden-xs hidden-sm">'.trans('home.experience').'</div>';
							$vhtml .= '<div class="col-md-2 hidden-xs hidden-sm">'.trans('home.location').'</div>';
							$vhtml .= '<div class="col-md-12 hidden-md hidden-lg">'.trans('home.selectall').'</div>';
						$vhtml .= '</th>';
					$vhtml .= '</tr>';
				$vhtml .= '</thead>';
				$vhtml .= '<tbody>';
				foreach($record as $rec){
					$userImage = url('profile-photos/profile-logo.jpg');
					if($rec->profilePhoto != ''){
						$userImage = url('profile-photos/'.$rec->profilePhoto);
					}
					$userArr[$rec->userId.'_'.$rec->jobId] = $rec->firstName.' '.$rec->lastName;
					$randId = time().rand(000000,999999);
					$vhtml .= '<tr class="ea-single-record">';
						$vhtml .= '<td scope="row" style="vertical-align: middle">';
							$vhtml .= '<input id="inbox-'.$randId.'"  type="checkbox" class="cbx-field" name="applicant[]" value="'.$rec->userId.'_'.$rec->jobId.'"><label class="cbx" for="inbox-'.$randId.'"></label>';
						$vhtml .= '</td>';
						$vhtml .= '<td>';
							$vhtml .= '<div class="row hidden-sm hidden-xs">';
								$vhtml .= '<div class="col-md-4">';
									$vhtml .= '<img src="'.$userImage.'" class="ea-image">';
									$vhtml .= '<div class="rtj-details">';
										$vhtml .= '<p><strong><a href="'.url('account/employer/application/candidate/'.$rec->userId).'">'.$rec->firstName.' '.$rec->lastName.'</a></strong> - <span class="ea-sm-date">'.date('d M',strtotime($rec->applyTime)).'</span></p>';
										$vhtml .= '<p>'.substr($rec->title,0,28).'</p>';
										$expectedSalary = $rec->expectedSalary != '' ? $rec->expectedSalary : '0';
										$vhtml .= '<p><strong>'.trans('home.expected').':</strong> '.number_format($expectedSalary).' '.$rec->currency.'</p>';
									$vhtml .= '</div>';
								$vhtml .= '</div>';
								$vhtml .= '<div class="col-md-3 ea-details">'.$rec->education.'</div>';
								$vhtml .= '<div class="col-md-3 ea-details"><span style="color: #999">'.$rec->experiance.' </span></div>';
								$vhtml .= '<div class="col-md-2 ea-details">'.JobCallMe::cityName($rec->city).'</div>';
							$vhtml .= '</div>';
						$vhtml .= '</td>';

						$vhtml .= '<div class="row hidden-md hidden-lg">';
							$vhtml .= '<img src="'.$userImage.'" class="img-circle ea-image">';
							$vhtml .= '<div class="ea-details-sm">';
								$vhtml .= '<p><strong><a href="'.url('account/employer/application/applicant/'.$rec->userId).'">'.$rec->firstName.' '.$rec->lastName.'</a></strong> - <span class="ea-sm-date">'.date('d M Y',strtotime($rec->applyTime)).'</span></p>';
                                $vhtml .= '<p class="ea-sm-experience">'.$rec->expertise.'</p>';
                                $expectedSalary = $rec->expectedSalary != '' ? $rec->expectedSalary : '0';
                                $vhtml .= '<p><strong>'.trans('home.expected').':</strong> '.number_format($expectedSalary).' '.$rec->currency.'</p>';
                                $vhtml .= '<p><strong>'.trans('home.education').':</strong> '.$rec->education.'</p>';
                                $vhtml .= '<p><strong>'.trans('home.experience').':</strong> '.$rec->experiance.'</p>';
                                $vhtml .= '<p><strong>'.trans('home.location').':</strong> '.JobCallMe::cityName($rec->city).'</p>';
							$vhtml .= '</div>';
						$vhtml .= '</div>';
					$vhtml .= '</tr>';
				}
				$vhtml .= '</tbody>';
			$vhtml .= '</table>';
		}else{
			$vhtml = '<div class="col-md-12 ea-no-record">'.trans('home.noapplicantshow').'</div>';
		}
		echo @json_encode(array('vhtml' => $vhtml, 'userArr' => $userArr));
		//echo $vhtml;
	}

	public function updateApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$type = trim($request->input('type'));
		$ids = trim($request->input('ids'),',');
		foreach(@explode(',', $ids) as $uIds){
			$userId = @reset(@explode('_', $uIds));
			$jobId = @end(@explode('_', $uIds));
			$input = array('applicationStatus' => ucfirst($type));
			DB::table('jcm_job_applied')->where('userId','=',$userId)->where('jobId','=',$jobId)->update($input);
		}
		exit('1');
	}

	public function interviewVenues(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	

		$app = $request->session()->get('jcmUser');
		$uCountry = $app->country;

		/* get interview venues */
		$venues = DB::table("jcm_interview_venues")->where('userId','=',$app->userId)->orderBy('venueId','desc')->get();
		/* end */
		return view('frontend.employer.interview-venues',compact('venues','uCountry'));
	}

	public function saveInterviewVeneu(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		extract($request->all());
		$this->validate($request,[
				'title' => 'required',
				'address' => 'required',
				'state' => 'required',
				'city' => 'required',
				'contact_person' => 'required',
				'email' => 'sometimes|nullable|email|max:225',
				'mobile' => 'sometimes|nullable|digits_between:10,16',
				'phone' => 'sometimes|nullable|digits_between:10,16',
				'fax' => 'sometimes|nullable|digits_between:10,16',
			]);

		$input = array('title' => $title, 'address' => $address, 'country' => $country, 'state' => $state, 'city' => $city, 'contact' => $contact_person, 'email' => $email, 'mobile' => $mobile, 'phone' => $phone, 'fax' => $fax, 'instruction' => $instruction);
		if($venueId != '0' && $venueId != ''){
			DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->update($input);
		}else{
			$input['userId'] = $request->session()->get('jcmUser')->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_interview_venues')->insert($input);
		}
		exit('1');
	}

	public function getInterviewVenue(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$venueId = $request->segment(5);

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->first();
		echo @json_encode($venue);
	}

	public function deleteInterviewVenue(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$venueId = $request->segment(5);

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->delete();
	}

	public function viewApplicant(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	

		$userId = $request->segment(5);
		$privacy = DB::table('jcm_privacy_setting')->where('userId',$userId)->first();
		$applicant = DB::table('jcm_users')
						->select('jcm_users.*','jcm_users_meta.*')
						->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId')
						->where('jcm_users.userId','=',$userId)
						->first();

		if(count($applicant) == 0){
			return redirect('account/employer/application');
		}
		$app = $request->session()->get('jcmUser');
		$resume = $this->userResume($userId);
		//print_r($resume);exit;
		$people = DB::table('jcm_users');
    	$people->select('jcm_users.*','privacy.profileImage as privacyImage');
    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
    	$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
    	$people->where('privacy.profile','=','Yes');
		$people->limit(4);
		$people->inRandomOrder();
		$Query=$people->get();
		//dd($applicant);
		return view('frontend.employer.view-applicant',compact('applicant','resume','Query','privacy'));
		//return view('frontend.employer.view-applicant',compact('applicant','resume'));
	}
		public function viewApplicants(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	

		$userId = $request->segment(5);

		$applicant = DB::table('jcm_users')
						->select('jcm_users.*','jcm_users_meta.*')
						->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId')
						->where('jcm_users.userId','=',$userId)
						->first();

		if(count($applicant) == 0){
			return redirect('account/employer/application');
		}
		$app = $request->session()->get('jcmUser');
		$resume = $this->userResume($userId);
		//print_r($resume);exit;
		//dd($applicant);
		$people = DB::table('jcm_users');
    	$people->select('jcm_users.*','privacy.profileImage as privacyImage');
    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
		$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
    	$people->where('privacy.profile','=','Yes');
		$people->limit(4);
		$people->inRandomOrder();
		$Query=$people->get();
		//dd($applicant);
		return view('frontend.employer.appcandidate',compact('applicant','resume','Query','userId'));
	}
public function userResume($userId){
		$record = DB::table('jcm_resume')->where('userId','=',$userId)->orderBy('resumeId','asc')->get();
		$return = array();
		foreach($record as $rec){
			$return[$rec->type][$rec->resumeId] = @json_decode($rec->resumeData);
		}
		return $return;
	}
	public function organization(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$app = $request->session()->get('jcmUser');

		$company = JobCallMe::getCompany($app->companyId);
		 Mapper::map(33.6844,  73.0479);
		return view('frontend.employer.view-organization',compact('company'));
	}

	public function savdOrganization(Request $request){
		//dd($request->all());
		
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		extract($request->all());
		$opHours = $request->input('opHours');
		foreach($opHours as $i => $k){
			if($i == 'sun' || $i == 'sat'){
				if($k[0] == ''){ $k[0] = 'Closed';}
				if($k[1] == ''){ $k[1] = 'Closed';}
			}else{
				if($k[0] == ''){ $k[0] = '09:00 AM';}
				if($k[1] == ''){ $k[1] = '05:00 PM';}
			}
			$opHoursArr[$i] = array('from' => $k[0], 'to' => $k[1]);
		}
		
		$inputOr = array('businessType' => $businessType,'category' => $industry,'Capital' =>$capital,'sales' => $sales,'formofbussiness' => $formofbusiness,'corporatenumber'=> $corporatenumber,'companyName' => $companyName, 'companyAddress' => $companyAddress, 'companyEmail' => $companyEmail, 'companyPhoneNumber' => $companyPhoneNumber, 'companyState' => $companyState, 'companyCity' => $companyCity, 'companyCountry' => $companyCountry, 'companyWebsite' => $companyWebsite, 'companyFb' => $companyFb, 'companyLinkedin' => $companyLinkedin, 'companyTwitter' => $companyTwitter, 'companyNoOfUsers' => $companyNoOfUsers, 'companyEstablishDate' => $companyEstablishDate, 'companyOperationalHour' => @json_encode($opHoursArr), 'companyModifiedTime' => date('Y-m-d H:i:s'));
		
		if($companyId != '0'){
			
			DB::table('jcm_companies')->where('companyId','=',$companyId)->update($inputOr);
		}else{
			
			$inputOr['companyCreatedTime'] = date('Y-m-d H:i:s');
			
			$companyId = DB::table('jcm_companies')->insertGetId($inputOr);
		}
		exit('1');
	}

	public function aboutOrganization(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$companyAbout = trim($request->input('companyAbout'));
		if($companyAbout == ''){
			exit('Please enter some text');
		}

		$input = array('companyAbout' => $companyAbout);

		DB::table('jcm_companies')->where('companyId','=',$companyId)->update($input);
		exit('1');
	}

	public function companyLogo(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$fName = $_FILES['cLogo']['name'];
		$ext = @end(@explode('.', $fName));
		if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
			exit('1');
		}
		$company = JobCallMe::getCompany($companyId);
		
		$pImage = '';
		if($company->companyLogo != '' && $company->companyLogo != NULL){
			$pImage = $company->companyLogo;
		}

		$image = $request->file('cLogo');
		$cLogo = time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/compnay-logo');
        $image->move($destinationPath, $cLogo);

        if($pImage != ''){
            @unlink(public_path('/compnay-logo/'.$pImage));
        }
        DB::table('jcm_companies')->where('companyId',$companyId)->update(array('companyLogo' => $cLogo));
        echo url('compnay-logo/'.$cLogo);
	}

	public function companyCover(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$companyId = JobCallMe::getUser($app->userId)->companyId;

		$fName = $_FILES['cLogo']['name'];
		$ext = @end(@explode('.', $fName));
		if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
			exit('1');
		}
		$company = JobCallMe::getCompany($companyId);
		
		$pImage = '';
		if($company->companyCover != '' && $company->companyCover != NULL){
			$pImage = $company->companyCover;
		}

		$image = $request->file('cLogo');
		$cLogo = time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/compnay-logo');
        $image->move($destinationPath, $cLogo);

        if($pImage != ''){
            @unlink(public_path('/compnay-logo/'.$pImage));
        }
        DB::table('jcm_companies')->where('companyId',$companyId)->update(array('companyCover' => $cLogo));
        echo url('compnay-logo/'.$cLogo);
	}

	public function saveJobInterview(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		$applicantInter = $request->input('applicantInter');
		$fromDate = trim($request->input('fromDate'));
		$toDate = trim($request->input('toDate'));
		$perInterview = trim($request->input('perInterview'));
		$venue = trim($request->input('venue'));

		if(count($applicantInter) == 0){
			exit('Please select some applicants');
		}
		if($fromDate == ''){
			exit('Please select from date');
		}
		if($toDate == ''){
			exit('Please select to date');
		}
		if($venue == ''){
			exit('Please select interview venue');
		}

		foreach($applicantInter as $appl){
			$jobseekerId = reset(@explode('_', $appl));
			$jobId = end(@explode('_', $appl));

			$input = array('userId' => $app->userId, 'jobseekerId' => $jobseekerId, 'jobId' => $jobId, 'fromDate' => $fromDate, 'toDate' => $toDate, 'perInterview' => $perInterview, 'venueId' => $venue, 'createdTime' => date('Y-m-d H:i:s'));

			DB::table('jcm_job_interviews')->insert($input);

			DB::table('jcm_job_applied')->where('userId','=',$jobseekerId)->where('jobId','=',$jobId)->update(array('applicationStatus' => 'Interview'));
		}

		exit('1');
	}

	public function viewInterviewVeneu(Request $request,$venueId){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$venue = DB::table('jcm_interview_venues')->where('venueId','=',$venueId)->first();

		$query = http_build_query(array('address'=>$venue->address.' '.JobCallMe::countryName($venue->country), 'sensor'=> 'false'));
		$getDecodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?".$query;
		$geocode_stats = @file_get_contents($getDecodeUrl);

		$output_deals = json_decode($geocode_stats);
		$latLng = $output_deals->results[0]->geometry->location;
		$lat = $latLng->lat;
		$lng = $latLng->lng;

		return view('frontend.employer.interview-venue-detail',compact('venue','latLng'));
	}

	public function saveNotification(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		extract($request->all());

		if($jobAlert == 'on'){
			if($country == '' || $country == '0'){
				exit('Please select country');
			}
			if($state == '' || $state == '0'){
				exit('Please select state');
			}
			if($city == '' || $city == '0'){
				exit('Please select city');
			}
			if($category == '' || $category == '0'){
				exit('Please select category');
			}
		}

		$dataArray = array('serviceAlert' => 'No', 'closingJobs' => 'No', 'jobAlert' => 'No', 'messageAlert' => 'No', 'newApplication' => 'No', 'country' => $country, 'state' => $state, 'city' => $city, 'category' => $category);
		if($serviceAlert == 'on') $dataArray['serviceAlert'] = 'Yes';
		if($closingJobs == 'on') $dataArray['closingJobs'] = 'Yes';
		if($messageAlert == 'on') $dataArray['messageAlert'] = 'Yes';
		if($newApplication == 'on') $dataArray['newApplication'] = 'Yes';
		if($jobAlert == 'on') $dataArray['jobAlert'] = 'Yes';

		$isExist = DB::table('jcm_account_alert')->where('userId','=',$app->userId)->get();
		if(count($isExist) == 0){
			$dataArray['userId'] = $app->userId;
			DB::table('jcm_account_alert')->insert($dataArray);
		}else{
			DB::table('jcm_account_alert')->where('userId','=',$app->userId)->update($dataArray);
		}
		exit('1');
	}

	public function savePrivacy(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');

		extract($request->all());

		$dataArray = array('profile' => 'No', 'profileImage' => 'No', 'academic' => 'No', 'experience' => 'No', 'skills' => 'No', 'projectVisible' => 'No', 'publicationsVisible' => 'No');

		if($profile == 'on') $dataArray['profile'] = 'Yes';
		if($profileImage == 'on') $dataArray['profileImage'] = 'Yes';
		if($academic == 'on') $dataArray['academic'] = 'Yes';
		if($experience == 'on') $dataArray['experience'] = 'Yes';
		if($skills == 'on') $dataArray['skills'] = 'Yes';
		if($projectVisible == 'on') $dataArray['projectVisible'] = 'Yes';
		if($publicationsVisible == 'on') $dataArray['publicationsVisible'] = 'Yes';
		$isExist = DB::table('jcm_privacy_setting')->where('userId','=',$app->userId)->get();
		if(count($isExist) == 0){
			$dataArray['userId'] = $app->userId;
			DB::table('jcm_privacy_setting')->insert($dataArray);
		}else{
			DB::table('jcm_privacy_setting')->where('userId','=',$app->userId)->update($dataArray);
		}
		exit('1');
	}

	public function departments(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$app = $request->session()->get('jcmUser');
		/* departments */
		$departments = DB::table('jcm_departments')->where('userId','=',$app->userId)->orderBy('departmentId','desc')->get();

		return view('frontend.employer.view-departments',compact('departments'));
	}

	public function saveDepartment(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		extract($request->all());
		$this->validate($request,[
				'name' => 'required',
				'country' => 'required',
				'state' => 'required',
				'city' => 'required'
			]);

		$input = array('name' => $name, 'country' => $country, 'state' => $state, 'city' => $city, 'description' => $description);
		if($departmentId != '0' && $departmentId != ''){
			DB::table('jcm_departments')->where('departmentId','=',$departmentId)->update($input);
		}else{
			$input['userId'] = $request->session()->get('jcmUser')->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_departments')->insert($input);
		}
		exit('1');
	}

	public function getDepartment(Request $request,$departmentId){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$department = DB::table('jcm_departments')->where('departmentId','=',$departmentId)->first();
		echo @json_encode($department);
	}

	public function deleteDepartment(Request $request,$departmentId){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$venue = DB::table('jcm_departments')->where('departmentId','=',$departmentId)->delete();
	}
	
	public function jobupdate(Request $request ,$jobId){
		Session::put('id', $jobId);
		$recs = DB::table('jcm_payments')->get();
		return view('frontend.employer.jobupdate',compact('jobId','recs'));
	}
	public function update(Request $request){
		//return $request->all();
		$jobId=Session::get('id');
		//return $request->get('amount');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.edit')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.edit'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('addmoney.frontend.employer.jobupdate');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.frontend.employer.jobupdate');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
		$rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	   $amount=$rec[0]->price;
		Session::put('payment_id', $payment->getId());
		$request->session()->put('amount', $amount);
		$request->session()->put('p_Category', $request->p_Category);
		$request->session()->put('jType', $request->jType);
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('addmoney.frontend.employer.jobupdate');
    }
		
 public function updateStatus(Request $request)
    {
		$payment_id = Session::get('payment_id');
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.frontend.employer.jobupdate');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
			$payment_id = Session::get('payment_id');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
	
      extract($request->all());
	
			$jobId=Session::get('id');

		$input = array('status' =>'1','paymentType' => '1' ,'pay_id' => $payment_id,'amount' => $amount,'p_Category' => $p_Category, 'jType' => $jType);
		//return $input;
		
		$set = DB::table('jcm_jobs')->where('jobId','=',$jobId)->update($input);
			
		echo $set;
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Upgrade Successfully');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.jobupdate');
    }
	public function deletejob($id){
		
			DB::table('jcm_jobs')->where('jobId','=',$id)->delete();
			Session::flash('message', "Successfully Delete Job");
			return redirect(url()->previous());
		}
		
		public function updatejob($id){
			Session::put('jobId', $id);
		
			$data = DB::table('jcm_jobs')->where('jobId','=',$id)->get();
			$result= $data[0];
			//$input = array('title' => $result->title);
			//dd($result);
			$recs = DB::table('jcm_payments')->get();
			
			return view('frontend.employer.update-job',compact('result','recs'));
			//Session::flash('message', "Successfully Delete Job");
			//return redirect(url()->previous());
		}
		
		
   public function updatepostPaymentWithpaypals(Request $request)
      {
		  //dd($request->all());
		$jobid = Session::get('jobId');
		Session::put('postedJobId',$jobid);
	 $rec = DB::table('jcm_payments')->where('id','=',$request->p_Category)->get();
	
	   $amount=$rec[0]->price;
	   
 //dd($amount);
        $mul=$amount;
        $am=$mul*1100;
      //  dd($am);
	  $request->session()->put('p_Category', $request->p_Category);
        $goodsname = Session::get('p_Category');
        $app = $request->session()->get('jcmUser');
		//dd($request->department);
		//$request->session()->put('amount', $amount);
		// $request->session()->put('title', $request->title);
		// //$request->session()->put('jType', 'Paid');
		// $request->session()->put('head', $request->head);
		// $request->session()->put('dispatch', $request->dispatch);
		// $request->session()->put('department', $request->department);
		// $request->session()->put('category', $request->category);
		// $request->session()->put('subCategory', $request->subCategory);
		// $request->session()->put('careerLevel', $request->careerLevel);
		// $request->session()->put('experience', $request->experience);
		// $request->session()->put('vacancy', $request->vacancy);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('skills', $request->skills);
		// $request->session()->put('qualification', $request->qualification);
		// //$request->session()->put('expiryDate', $request->expiryDate);
		// $request->session()->put('minSalary', $request->minSalary);
		// $request->session()->put('maxSalary', $request->maxSalary);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('type', $request->type);
		// $request->session()->put('currency', $request->currency);
		// $request->session()->put('benefits', $request->benefits);
		// $request->session()->put('state', $request->state);
		// $request->session()->put('city', $request->city);
		// $request->session()->put('country', $request->country);
		// $request->session()->put('shift', $request->shift);
		//$request->session()->put('expiryDate', $request->expiryDate);
		
	
		 $goodsname = Session::get('p_Category');
		//if($amount!='0')
		//{
		//	$request->merge(['jType'=>'Paid']);
		//}
		//if($amount=='0')
		//{
			//$request->merge(['jType'=>'Free']);
			//$app = $request->session()->get('jcmUser');

			$this->validate($request,[
				'title' => 'required|max:255',
				'department' => 'required',
				'category' => 'required',
				'careerLevel' => 'required',
				'experience' => 'required',
				'vacancy' => 'required|numeric',
				'description' => 'required|max:1024',
				'skills' => 'required|max:1024',
				'qualification' => 'required',
				'expiryDate' => 'required|date',
				'minSalary' => 'required|numeric',
				'maxSalary' => 'required|numeric',
				'state' => 'required',
			]);
	
   
			extract($request->all());

			$input = array('userId' => $app->userId, 'companyId' => $app->companyId,'title' => $title, 'department' => $department, 'category' => $category, 'head' => $head,'dispatch' => $dispatch,'subCategory' => $subCategory,'subCategory2' => $subCategory2, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => rtrim(@implode(',', $request->input('benefits')),','),'process' => rtrim(@implode(',', $request->input('process')),','), 'country' => $country, 'state' => $state, 'city' => $city,'Address' => $Address);
			if($subCategory == ''){
				$input['subCategory'] = '';
			}
			$jobId = DB::table('jcm_jobs')->where('jobId','=',$jobid)->update($input);
			echo $jobId;
			\Session::put('success','Job Update Successfully');
			return Redirect::route('addmoney.account/employer/job/share');
		//}	
		//else{ 
			//$request->session()->forget('postedJobId');  /*For nice pay*/
		 //	return view('frontend.employer.update-payment',compact('am','app','goodsname'));
	//	return Redirect::route('addmoney.account/employer/payment',compact('am','app','goodsname'));
		//}
	}
	
	
		public function updatepostPaymentWithpaypal(Request $request)
    {
		
		
	
		//dd(Session::get('amount'));
		//exit();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(Session::get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Session::get('amount'));
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.updatestatus')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.updatestatus'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return 'Connection timeout';
                return Redirect::route('add.frontend.employer.post-job');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return 'Some error occur, sorry for inconvenient';
                return Redirect::route('ey.frontend.employer.post-job');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
		 $pay_id=$payment->getId();
         Session::put('paypal_payment_id', $payment->getId());
        /** add payment ID to session **/
		// $pay_id=$payment->getId();
        // Session::put('paypal_payment_id', $payment->getId());
		// $request->session()->put('amount', $request->amount);
		// $request->session()->put('p_Category', $request->p_Category);
		// $request->session()->put('title', $request->title);
		// $request->session()->put('jType', 'Paid');
		// $request->session()->put('department', $request->department);
		// $request->session()->put('category', $request->category);
		// $request->session()->put('subCategory', $request->subCategory);
		// $request->session()->put('careerLevel', $request->careerLevel);
		// $request->session()->put('experience', $request->experience);
		// $request->session()->put('vacancy', $request->vacancy);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('skills', $request->skills);
		// $request->session()->put('qualification', $request->qualification);
		// $request->session()->put('expiryDate', $request->expiryDate);
		// $request->session()->put('minSalary', $request->minSalary);
		// $request->session()->put('maxSalary', $request->maxSalary);
		// $request->session()->put('description', $request->description);
		// $request->session()->put('type', $request->type);
		// $request->session()->put('currency', $request->currency);
		// $request->session()->put('benefits', $request->benefits);
		// $request->session()->put('state', $request->state);
		// $request->session()->put('city', $request->city);
		// $request->session()->put('country', $request->country);
		// $request->session()->put('shift', $request->shift);
		// $request->session()->put('expiryDate', $request->expiryDate);
		
	
        if(isset($redirect_url)) {
            /** redirect to paypal **/
	
            return Redirect::away($redirect_url);
        }
       return 'Unknown error occurred';
        return Redirect::route('frontend.employer.post-job');
    
	}
    public function updategetPaymentStatus(Request $request)
    {
		$jobid = Session::get('jobId');
		$payment_id = Session::get('paypal_payment_id');
		$app = $request->session()->get('jcmUser');
		$amount = Session::get('amount');
		$jType = Session::get('jType');
		$p_Category = Session::get('p_Category');
		$title = Session::get('title');
		$department =Session::get('department');
		$category = Session::get('category');
		$subCategory = Session::get('subCategory');
		$careerLevel =Session::get('careerLevel');
		$experience =Session::get('experience');
		$vacancy = Session::get('vacancy');
		$skills =Session::get('skills');
		$qualification = Session::get('qualification');
		$expiryDate = Session::get('expiryDate');
		$minSalary = Session::get('minSalary');
		$maxSalary = Session::get('maxSalary');
		$description = Session::get('description');
	    $type = Session::get('type');
		$currency = Session::get('currency');
		$benefits = Session::get('benefits');
		$country = Session::get('country');
		$shift = Session::get('shift');
		$city = Session::get('city');
		$expiryDate = Session::get('expiryDate');
		$expiryAd= Session::get('expiryAd');
		$state = Session::get('state');
		$duration = Session::get('duration');

		

		extract($request->all());

		$input = array('userId' => $app->userId, 'companyId' => $app->companyId, 'status' => '1', 'paymentType'=> '1', 'pay_id' => $payment_id, 'amount' => $amount, 'p_Category' => $p_Category, 'title' => $title, 'jType' => $jType, 'department' => $department, 'category' => $category,'duration' => $duration, 'subCategory' => $subCategory, 'careerLevel' => $careerLevel, 'experience' => $experience, 'vacancies' => $vacancy, 'description' => $description, 'skills' => $skills, 'qualification' => $qualification, 'jobType' => $type, 'jobShift' => $shift, 'minSalary' => $minSalary, 'maxSalary' => $maxSalary, 'currency' => $currency, 'benefits' => @implode(',', $benefits), 'country' => $country, 'state' => $state, 'city' => $city, 'expiryDate' => $expiryDate,'expiryAd' => $expiryAd,  'createdTime' => date('Y-m-d H:i:s'));
		if($subCategory == ''){
			$input['subCategory'] = '';
		}
		//dd($input);
		$jobId = DB::table('jcm_jobs')->where('jobId','=',$jobid)->update($input);
		echo $jobId;
        /** Get the payment ID before session clear **/
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.frontend.employer.post-job');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Payment success');
            return Redirect::route('addmoney.account/employer/job/share');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.frontend.employer.post-job');
    }
    public function orders(Request $request){
    	$to = $request->input('to');
    	$from = $request->input('from');
    	$orderId = $request->input('order_id');
    	$status = $request->input('status');
    	$payment_mode = $request->input('payment_mode');
    	$id = session()->get('jcmUser')->userId;
    	$db = DB::table('jcm_orders');
    	if( $orderId != '' ) $db->where('order_id','=',$orderId);
    	if( $status != '' ) $db->where('status','=',$status);
    	if( $payment_mode != '' ) $db->where('payment_mode','LIKE','%'.$payment_mode.'%');
    	if( $from != '' && $to != '') $db->whereBetween('date', array($from, $to));
    	$db->where('user_id','=',$id);
    	$data = $db->get();
    	
    	return view('frontend.employer.orders',compact('data'));
    }
	 public function setfilter(Request $request,$id){
		 
		 return view('frontend.employer.setfilter',compact('id'));
		 
		 }

		 public function cashpayment(Request $request){
		//if(!Session::get('postedJobId')): 
			$apps = $request->session()->get('jcmUser'); 
			$payment = "123";
			
			$amountss = Session::get('amount');
			$jTypess = Session::get('jType');
			$p_Categoryss = Session::get('p_Category');
			$titless = Session::get('title');
			$departmentss =Session::get('department');
			$categoryss = Session::get('category');
			$subCategoryss = Session::get('subCategory');
			$subCategorys2s = Session::get('subCategory2');
			$careerLevelss =Session::get('careerLevel');
			$experiencess =Session::get('experience');
			$vacancyss = Session::get('vacancy');
			$skillsss =Session::get('skills');
			$jobaddrss =Session::get('jobaddr');
			$qualificationss = Session::get('qualification');
			$expiryDatess = Session::get('expiryDate');
			$minSalaryss = Session::get('minSalary');
			$maxSalaryss = Session::get('maxSalary');
			$descriptionss = Session::get('description');
			$typess = Session::get('type');
			$currencyss = Session::get('currency');
			$benefitsss = Session::get('benefits');
			$processs = Session::get('process');
			$countryss = Session::get('country');
			$shiftss = Session::get('shift');
			$cityss = Session::get('city');
			$Addressss = Session::get('Address');
			$expiryDates = Session::get('expiryDate');
			$expiryAdss= Session::get('expiryAd');
			$statess = Session::get('state');
			$durationss = Session::get('duration');
      //	dd($amounts);
			extract($request->all());

			$inputs = array('userId' => $apps->userId, 'companyId' => $apps->companyId, 'pay_id' => $payment, 'paymentType'=> '3','status'=> '2', 'amount' => $amountss,'duration' => $durationss, 'p_Category' => $p_Categoryss, 'title' => $titless, 'jType' => $jTypess, 'department' => $departmentss, 'category' => $categoryss, 'subCategory' => $subCategoryss, 'subCategory2' => $subCategorys2s, 'careerLevel' => $careerLevelss, 'experience' => $experiencess, 'vacancies' => $vacancyss, 'description' => $descriptionss, 'skills' => $skillsss, 'qualification' => $qualificationss, 'jobType' => $typess, 'jobShift' => $shiftss,'jobaddr' => $jobaddrss, 'minSalary' => $minSalaryss, 'maxSalary' => $maxSalaryss, 'currency' => $currencyss, 'benefits' => @implode(',', $benefitsss), 'process' => @implode(',', $processs),'country' => $countryss, 'state' => $statess, 'city' => $cityss,'Address' => $Addressss,'expiryDate' => $expiryDatess,'expiryAd' => $expiryAdss, 'createdTime' => date('Y-m-d H:i:s'));
			if($subCategorys == ''){
				$inputs['subCategory'] = '';
			}
			
			$jobId= DB::table('jcm_jobs')->insertGetId($inputs);
			//dd($inputs);
			return view('frontend.employer.cashpayment_detail',compact('inputs'));
	
		 }
		 public function addUser(Request $request){
		 	$id = session()->get('jcmUser')->userId;
		 	$data = DB::table('jcm_users')->where('addby','=',$id)->get();
		 	return view('frontend.employer.addusers',compact('data'));
		 }
		 public function useradd(Request $request){
		 	$email = $request->input('degree');
		 	$data = DB::table('jcm_users')->where('email','=',$email)->get();
		 	if(sizeof($data) > 0){
		 		$id = session()->get('jcmUser')->userId;
		 		DB::table('jcm_users')->where('email','=',$email)->update(['addby'=>$id]);
		 	}else{
		 			echo 'error';
		 	}
		 }
		public function userdel(Request $request){
			$id = $request->input('userId');
			if(DB::table('jcm_users')->where('userId','=',$id)->update(['addby'=>'NULL'])){
				echo 1;
			}else{
				echo 2;
			}
		}
		public function questionnaires(Request $request){
			return view('frontend.employer.questionnaires');
		}

}
