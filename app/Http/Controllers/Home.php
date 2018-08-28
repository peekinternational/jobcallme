<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Sajid;
use Mail;
use App;
date_default_timezone_set("Asia/Seoul");
class Home extends Controller{

	public function home(){

		Sajid::IpBaseLang();		

		if(!\Session::has('loadOne')){
			$ip = \Request::ip();
			$position = \Location::get($ip);
			if($position->countryCode != 'KR'){
				\App::setLocale('en');
				\Session::put('locale', 'en');
				\Session::put('loadOne', 'yes');
			}
		}

		//print_r($position->countryCode);die;
		/* job shift query */
		$jobShifts = DB::table('jcm_job_shift')->get();

		/* companies query */
		$companies = DB::table('jcm_companies')->orderBy('companyId','desc')->limit(15)->get();

		/* jobs query */
		$premium = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','7')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		//->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		//->limit(12)->get();
		if(sizeof($premium) == 0){
		$premium = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','7')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.jobStatus','=','Publish')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		}
		
		/* jobs query top jobs */
		$top_jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','6')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		//->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		if(sizeof($top_jobs) == 0){
		$top_jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','6')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		}
		
		/* jobs query hot jobs */
		$hot = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','5')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		//->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		if(sizeof($hot) == 0){
		$hot = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','5')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		}
		
		$latest = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.p_Category','=','4')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			//->where('jcm_countries.sortname','=',$position->countryCode)
			->orderBy('jcm_jobs.jobId','desc')			
			->get();
		if(sizeof($latest) == 0){
			$latest = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->where('jcm_jobs.p_Category','=','4')
			->where('jcm_jobs.status','=','1')
			->orderBy('jcm_jobs.jobId','desc')			
			->get();
		}
		$special = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
			->where('jcm_jobs.p_Category','=','3')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			//->where('jcm_countries.sortname','=',$position->countryCode)
			->orderBy('jcm_jobs.jobId','desc')			
			->get();
		if(sizeof($special) == 0){
			$special = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
			->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
			->where('jcm_jobs.p_Category','=','3')
			->where('jcm_jobs.status','=','1')
			->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
			->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
			->where('jcm_jobs.jobStatus','=','Publish')
			->orderBy('jcm_jobs.jobId','desc')			
			->get();
		}

		$golden = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->leftJoin('jcm_countries','jcm_countries.id','=','jcm_jobs.country')
		->where('jcm_jobs.p_Category','=','2')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		//->where('jcm_countries.sortname','=',$position->countryCode)
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		if(sizeof($golden) == 0){
		$golden = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo')
		->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
		->where('jcm_jobs.p_Category','=','2')
		->where('jcm_jobs.status','=','1')
		->where('jcm_jobs.expiryAd','>',date('Y-m-d'))
		->where('jcm_jobs.expiryDate','>',date('Y-m-d'))
		->where('jcm_jobs.jobStatus','=','Publish')
		->orderBy('jcm_jobs.jobId','desc')
		->get();
		}
//return $companies;
		return view('frontend.home-page',compact('jobShifts','companies','premium','top_jobs','hot','latest','special','golden'));
	}
	public function nicepay(Request $request){
		//return $request->all();
		return "hello";
	}

	public function contactUs(Request $request){
		if($request->isMethod('post')){
			print_r($request->all());exit;
		} 
		return view('frontend.contact-us');
	}

	public function aboutUs(){
		$record = DB::table('jcm_cms_pages')->where('slug','about')->first();
		return view('frontend.about-us',compact('record'));
	}

	public function termConditions(){
		$record = DB::table('jcm_cms_pages')->where('slug','term-conditions')->first();
		return view('frontend.term-conditions',compact('record'));
	}
	
	public function advertisement(){
		$record = DB::table('jcm_cms_pages')->where('slug','companies-advertisement')->first();
		return view('frontend.companies-advertisement',compact('record'));
	}

	public function privacyPolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','privacy-policy')->first();
		return view('frontend.privacy-policy',compact('record'));
	}

	public function picturepolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','picture-policy')->first();
		return view('frontend.picture-policy',compact('record'));
	}

	public function refundpolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','refund-policy')->first();
		return view('frontend.refund-policy',compact('record'));
	}

	public function howtouse(){
		$record = DB::table('jcm_cms_pages')->where('slug','how-to-use')->first();
		return view('frontend.howtouse',compact('record'));
	}

	public function ReviewWrite(){
		$record = DB::table('jcm_cms_pages')->where('slug','review-write')->first();
		return view('frontend.review-write',compact('record'));
	}

	public function videochatpolicy(){
		$record = DB::table('jcm_cms_pages')->where('slug','video-chat-policy')->first();
		return view('frontend.video-chat-policy',compact('record'));
	}

	public function writeresume(){
		$record = DB::table('jcm_cms_pages')->where('slug','write-resume')->first();
		return view('frontend.write-resume',compact('record'));
	}
	public function selfintroduction(){
		$record = DB::table('jcm_cms_pages')->where('slug','self-introduction')->first();
		return view('frontend.self-introduction',compact('record'));
	}
	public function interviewstrategy(){
		$record = DB::table('jcm_cms_pages')->where('slug','interview-strategy')->first();
		return view('frontend.interview-strategy',compact('record'));
	}
	public function increasedrecruitment(){
		$record = DB::table('jcm_cms_pages')->where('slug','increased-recruitment')->first();
		return view('frontend.interview-strategy',compact('record'));
	}
	public function conformityverification(){
		$record = DB::table('jcm_cms_pages')->where('slug','conformity-verification')->first();
		return view('frontend.interview-strategy',compact('record'));
	}
	public function activecommunication(){
		$record = DB::table('jcm_cms_pages')->where('slug','active-communication')->first();
		return view('frontend.interview-strategy',compact('record'));
	}


	public function accountLogin(Request $request){
		
		if($request->session()->has('jcmUser')){
			$type = $request->session()->get('jcmUser')->type == 'Employer' ? 'employer' : 'jobseeker';
			return redirect('account/'.$type);
		}
		$next = $request->input('next');
		if($request->isMethod('post')){
			$email = $request->input('email');
			$password = $request->input('password');

			$error = '';
			if(trim($email) == ''){
				$error .= 'Email field is required';
			}
			if(trim($password) == ''){
				$error .= 'Password field is required';
			}
			if($error != ''){
				$request->session()->flash('loginAlert', $error);
				redirect('account/login');
			}

			$user = $this->doLogin($email,$password);
			if($user == 'invalid'){
				$request->session()->flash('loginAlert', trans('home.Invalid email/password'));
				if($next != ''){
					return redirect('account/login?next='.$next);
				}else{
					return redirect('account/login');
				}
			}
			else{
				if(JobCallMe::isResumeBuild($user->userId) == false){
					$fNotice = 'To apply on jobs please build your resume. <a href="'.url('account/jobseeker/resume').'">Click Here</a> To create your resume<br><span style="color:#2e6da4;font-size:12px;"><i class="fa fa-info-circle" aria-hidden="true"></i> If you do not have personal resume information with final education information, you will not be able to register for the resume.</span>';
					$request->session()->put('fNotice',$fNotice);
				}
				$request->session()->put('jcmUser', $user);
				setcookie('cc_data', $user->userId, time() + (86400 * 30), "/");
				if($user->subscribe == 'N'){ 
					Session()->put('bell_color','#2e6da4'); 
				}else{ 
					session()->put('bell_color','#45c536'); 
				}
				if($next != ''){
					return redirect($next);
				}else{
					return redirect('account/jobseeker');
				}
			}
		}
		
		$pageType = \Request::segment('2');
		return view('frontend.login-registration',compact('pageType'));
	}

	public function doLogin($email,$password){
		/* do login */
		$user = DB::table('jcm_users')->where('email','=',$email)->where('password','=',md5($password))->where('user_status','Y')->where('type','<>','Admin')->first();
		if(count($user) == 0){
			return 'invalid';
		}else{
			return $user;
		}
		/* end */
	}

	public function accountRegister(Request $request){
		if($request->session()->has('jcmUser')){
			return redirect('account/jobseeker');
		}
		
		if($request->isMethod('post')){
			$this->validate($request,[
				'email' => 'required|email|unique:jcm_users,email',
				'username' => 'required|min:5|max:32|unique:jcm_users,username',
				'password' => 'required|min:6|max:16',
				'firstName' => 'required|min:1|max:50',
				'lastName' => 'required|min:1|max:50',
				'country' => 'required',
				'state' => 'required',
				'phoneNumber' => 'required|digits_between:10,12',
			],[
				'username.unique' => trans('home.Username must be unique'),
				'email.unique' => trans('home.Email must be unique'),
				'username.required' => trans('home.Enter username'),
				'email.required' => trans('home.Enter Email'),
				'firstName.required' => trans('home.Enter First Name'),
				'lastName.required' => trans('home.Enter Last Name'),
				'password.required' => trans('home.Enter password'),	
				'country.required' => trans('home.Enter Country'),
				'state.required' => trans('home.Enter State'),
				'phoneNumber.required' => trans('home.Enter Phone Number'),
				'phoneNumber.digits_between' => trans('home.Phone Number must be contain 10,12 digits'),
			]);
			$regdata['email'] = $request->input('email');
			$regdata['password'] = $request->input('password');
			$regdata['firstName'] = $request->input('firstName');
			$regdata['lastName'] = $request->input('lastName');
			$regdata['phoneNumber'] = $request->input('phoneNumber');
			session()->put('regdata',$regdata);
			$input['companyId'] = '0';
			$input['type'] = 'User';
			$input['secretId'] = JobCallMe::randomString();
			$input['firstName'] = trim($request->input('firstName'));
			$input['lastName'] = trim($request->input('lastName'));
			$input['email'] = trim($request->input('email'));
			//$input['username'] = strtolower($request->input('firstName').$request->input('lastName').rand(00,99));
			$input['username'] = trim($request->input('username'));
			$input['password'] = md5(trim($request->input('password')));
			$input['phoneNumber'] = trim($request->input('phoneNumber'));
			$input['country'] = $request->input('country');
			$input['state'] = $request->input('state');
			$input['city'] = $request->input('city');
			$input['subscribe'] = $request->input('jobalert');
			$input['profilePhoto'] = '';
			$input['about'] = '';
			$input['createdTime'] = date('Y-m-d H:i:s');
			$input['modifiedTime'] = date('Y-m-d H:i:s');
			
			$userId = DB::table('jcm_users')->insertGetId($input);
			setcookie('cc_data', $userId, time() + (86400 * 30), "/");
			extract($request->all());
			$cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => $phoneNumber, 'companyCountry' => $country, 'companyState' => $state, 'companyCity' => $city, 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
			$companyId = DB::table('jcm_companies')->insertGetId($cInput);

			DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));
			/* end */
			$toemail = $input['email'];
			$secidtoview = array('id' => $input['secretId'],'Name' => $input['firstName'],'lastName' => $input['lastName']);
			Mail::send('emails.reg',$secidtoview,function($message) use ($toemail) {
				$message->to($toemail)->subject(trans('home.Account Verification'));
			});
			/*$user = $this->doLogin($request->input('email'),$request->input('password'));
			$request->session()->put('jcmUser', $user);*/

			//$fNotice = trans('home.Please check your email to verify');
			$fNotice = 'Please check your email to verify';

			
			$request->session()->put('fNotice',$fNotice);
			return redirect('account/register');
		}
		$pageType = \Request::segment('2');
		return view('frontend.login-registration',compact('pageType'));
	}

	public function apiaccountRegister(Request $request){
	//	dd($request->all());
	
		if($request->isMethod('post')){
			$this->validate($request,[
				'email' => 'required|email|unique:jcm_users,email',
				'password' => 'required|min:6|max:16',
				'firstName' => 'required|min:1|max:50',
				'lastName' => 'required|min:1|max:50',
				'country' => 'required',
				'state' => 'required',
				'phoneNumber' => 'required|digits_between:10,12',
			],[
				'email.unique' => trans('home.Email must be unique'),
				'email.required' => trans('home.Enter Email'),
				'firstName.required' => trans('home.Enter First Name'),
				'lastName.required' => trans('home.Enter Last Name'),
				'password.required' => trans('home.Enter password'),	
				'country.required' => trans('home.Enter Country'),
				'state.required' => trans('home.Enter State'),
				'phoneNumber.required' => trans('home.Enter Phone Number'),
				'phoneNumber.digits_between' => trans('home.Phone Number must be contain 10,12 digits'),
			]);
			$regdata['email'] = $request->input('email');
			$regdata['password'] = $request->input('password');
			$regdata['firstName'] = $request->input('firstName');
			$regdata['lastName'] = $request->input('lastName');
			$regdata['phoneNumber'] = $request->input('phoneNumber');
		//	session()->put('regdata',$regdata);
			$input['companyId'] = '0';
			$input['type'] = 'User';
			$input['secretId'] = JobCallMe::randomString();
			$input['firstName'] = trim($request->input('firstName'));
			$input['lastName'] = trim($request->input('lastName'));
			$input['email'] = trim($request->input('email'));
			$input['username'] = strtolower($request->input('firstName').$request->input('lastName').rand(00,99));
			$input['password'] = md5(trim($request->input('password')));
			$input['phoneNumber'] = trim($request->input('phoneNumber'));
			$input['country'] = $request->input('country');
			$input['state'] = $request->input('state');
			$input['city'] = $request->input('city');
			$input['subscribe'] = $request->input('jobalert');
			$input['profilePhoto'] = '';
			$input['about'] = '';
			$input['createdTime'] = date('Y-m-d H:i:s');
			$input['modifiedTime'] = date('Y-m-d H:i:s');
			
			$userId = DB::table('jcm_users')->insertGetId($input);
			setcookie('cc_data', $userId, time() + (86400 * 30), "/");
			extract($request->all());
			$cInput = array('companyName' => $firstName.' '.$lastName, 'companyEmail' => $email, 'companyPhoneNumber' => $phoneNumber, 'companyCountry' => $country, 'companyState' => $state, 'companyCity' => $city, 'category' => '0', 'companyCreatedTime' => date('Y-m-d H:i:s'), 'companyModifiedTime' => date('Y-m-d H:i:s'));
			$companyId = DB::table('jcm_companies')->insertGetId($cInput);

			$userinfo=DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId));
			/* end */
			$toemail = $input['email'];
			$secidtoview = array('id' => $input['secretId'],'Name' => $input['firstName'],'lastName' => $input['lastName']);
			Mail::send('emails.reg',$secidtoview,function($message) use ($toemail) {
				$message->to($toemail)->subject(trans('home.Account Verification'));
			});
			/*$user = $this->doLogin($request->input('email'),$request->input('password'));
			$request->session()->put('jcmUser', $user);*/
			$fNotice = trans('home.Please check your email to verify');
			
		//	$request->session()->put('fNotice',$fNotice);
			return $cInput;
		}
		//$pageType = \Request::segment('2');
		return $cInput;
	}

	public function logout(Request $request){
    	$request->session()->flush('jcmUser');
		$request->session()->flush('bell_color');
    	//$request->session()->destroy();
    	setcookie('cc_data', '', -time() + (86400 * 30), "/");
    	return redirect('');
    }

    public function manageUser(Request $request){
    	if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	
    	$app = $request->session()->get('jcmUser');
    	$user = JobCallMe::getUser($app->userId);
    	$meta = JobCallMe::getUserMeta($app->userId);
    	$noti = JobCallMe::getAccountNotification($app->userId);
    	$privacy = JobCallMe::getPrivacySetting($app->userId);

    	return view('frontend.manage-user',compact('user','meta','noti','privacy'));
    }

    public function people(Request $request){
		$app = $request->session()->get('jcmUser');
    	$request->all();
    	/* peoples query */
    	$people = DB::table('jcm_users');
    	$people->select('*','privacy.profileImage as pImage');

		$people->select('*','jcm_users_meta.gender as genderpeople');

    	$people->leftJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
    	$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');
		//$people->leftJoin('jcm_download','jcm_download.seeker_id','=','jcm_users.userId');
		//$people->leftJoin('jcm_resume','jcm_resume.userId','=','jcm_users.userId');
		
    	if($request->isMethod('post')){
    		if($request->input('keyword') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('keyword').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('keyword').'%');
				$people->orWhere('jcm_users.username','like','%'.$request->input('keyword').'%');
			}
			if($request->input('country') != ''){
				$people->where('jcm_users.country','=',$request->input('country'));
			}
			if($request->input('city') != ''){
				$people->where('jcm_users.state','=',$request->input('state'));
			}

			
    		if($request->input('city') != ''){
		        $people->where('jcm_users.city','=',$request->input('city'));
    		}
    	

	    	//if($request->input('city') != ''){
	    		//$people->where('jcm_users.city','=',$request->input('city'));
	    	//}
	    	
	    }
if($request->input('industry') != ''){
	    		$people->where('jcm_users_meta.industry','=',$request->input('industry'));
	    	}
    	$people->where('privacy.profile','=','Yes');
		$people->where('jcm_users.lastName','!=','');
    	//$people->limit(30);

		//$people->where('jcm_users_meta.userId','!=','');
    	
    //	$people->limit(30);


    	$people->orderBy('jcm_users.userId','desc');
		$people->groupBy('jcm_users.userId');
		//$peopleget = $people->get();

    	$peoples = $people->paginate(50);

		$data=$peoples;
			//$data=[];
	 /*  foreach($pes as $user){
>>>>>>> 5603ec9ce04df6ce3b03272fe2fca5b70bccb50f
		//echo $user->userId." / ";
		$resumess = DB::table('jcm_resume')->where('userId','=',$user->userId)->get();
		$type=$resumess->pluck('type');
		$result = $type->toArray();
		$arry=in_array('academic',$result);
		
		if($arry){
		array_push($data,$user);
		}
		
	} */
		//$userId = $peopleget->pluck('userId');
		//dd($peoples);
		
    	return view('frontend.people',compact('data','peoples'));
    }

 public function peoples(Request $request){
	//dd($request->all());
    	/* peoples query */
    	$people = DB::table('jcm_users');
    	$people->select('*','privacy.profileImage as pImage');
    	$people->rightJoin('jcm_users_meta','jcm_users_meta.userId','=','jcm_users.userId');
        $people->rightJoin('jcm_resume','jcm_resume.userId','=','jcm_users.userId');
		$people->leftJoin('jcm_privacy_setting as privacy','privacy.userId','=','jcm_users.userId');

    	if($request->isMethod('post')){
    		if($request->input('keyword') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('keyword').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('keyword').'%');
    		}
    		if($request->input('city') != ''){
    			$cityId = JobCallMe::cityId($request->input('city'));
	    		if($cityId != '0'){
		    		$people->where('jcm_users.city','=',$cityId);
		    	}
    		}
			if($request->input('name') != ''){
    			$people->where('jcm_users.firstName','like','%'.$request->input('name').'%');
    			$people->orWhere('jcm_users.lastName','like','%'.$request->input('name').'%');
    		}
			if($request->input('category') != ''){
    			$people->where('jcm_users_meta.industry','=',$request->input('category'));
    		}
			if($request->input('country') != ''){
    			$people->where('jcm_users.country','=',$request->input('country'));
    		}
			if($request->input('state') != '' && $request->input('state') != '0'){
    			$people->where('jcm_users.state','=',$request->input('state'));
    		}
			if($request->input('citys') != '' && $request->input('citys') != '0'){
    			$people->where('jcm_users.city','=',$request->input('citys'));
    		}
			if($request->input('degreeLevel') != ''){
    			$people->where('jcm_resume.resumeData','like','%'.$request->input('degreeLevel').'%');
    		}
			if($request->input('degree') != ''){
    			$people->where('jcm_resume.resumeData','like','%'.$request->input('degree').'%');
    		}
                        if($request->input('minsalary') != ''){
    			$people->where('jcm_users_meta.currentSalary','=>',$request->input('minsalary'));
    		}
                        if($request->input('maxsalary') != ''){
    			$people->where('jcm_users_meta.expectedSalary','<=',$request->input('maxsalary'));
    		}
                        if($request->input('gender') != ''){
    			$people->where('jcm_users_meta.gender','=',$request->input('gender'));
    		}
                        if($request->input('maritalStatus') != ''){
    			$people->where('jcm_users_meta.maritalStatus','=',$request->input('maritalStatus'));
    		}
            
               
               
    	}else{
	    	if($request->input('city') != ''){
	    		$people->where('jcm_users.city','=',$request->input('city'));
	    	}
	    	if($request->input('industry') != ''){
	    		$people->where('jcm_users_meta.industry','=',$request->input('industry'));
	    	}
	    }
		$people->where('privacy.profile','=','Yes');
    	//$people->limit(30);

		$people->where('jcm_users_meta.userId','!=','');
    	$people->orderBy('jcm_users.userId','desc');
         $people->groupBy('jcm_users.userId');
		$peoples = $people->paginate(18);
		$data=$peoples;
		//$data=[];
 // foreach($pes as $user){
	//echo $user->userId." / ";
	//$resumess = DB::table('jcm_resume')->where('userId','=',$user->userId)->get();
	//$type=$resumess->pluck('type');
	//$result = $type->toArray();
	//$arry=in_array('academic',$result);
	
	//if($arry){
	//array_push($data,$user);
	//}
	
//}
        // dd($peoples);

    	return view('frontend.people',compact('data','peoples'));
    }

    public function learn(Request $request){
		  //dd($request->all());  
    	/* read query */
    	$readQry = DB::table('jcm_upskills');
		$readQry->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_upskills.companyId');
		if($request->input('type') != ''){      
    	$readQry->where('jcm_upskills.type','=',ucfirst($request->input('type')));
    	}  
		$readQry->where('jcm_upskills.status','=','Active');
		$readQry->where('jcm_upskills.adstartDate','<=',date('Y-m-d'));
		$readQry->where('jcm_upskills.adendDate','>=',date('Y-m-d'));
		$readQry->orderBy('jcm_upskills.skillId','desc');
		$readQry->limit(12);
		$lear_record=$readQry->paginate(10);
//dd($lear_record);
    	return view('frontend.learn',compact('lear_record'));
    }

    public function read(Request $request){
    	/* read query */
    	$category = JobCallMe::getreadcat($request->input('category'));
    	$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_read_category','jcm_read_category.id','=','jcm_writings.category');

    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_users.phoneNumber','jcm_read_category.name')->groupBy('jcm_writings.title');

  
    	if($request->input('category') != '0' && $request->input('category') != ''){
    		$readQry->where('jcm_writings.cat_names','LIKE','%'.$category.'%');
    	}
    	if($request->input('keyword') != ''){
    		$readQry->where('jcm_writings.title','LIKE','%'.$request->input('keyword').'%');
		}
		if($request->input('city') != ''){
    		$readQry->where('jcm_writings.city','=',$request->input('city'));
	         }
		if($request->input('country') != ''){
    		$readQry->where('jcm_writings.country','=',$request->input('country'));
		}
		if($request->input('state') != ''){
    		$readQry->where('jcm_writings.state','=',$request->input('state'));
    	}
		$readQry->where('jcm_writings.status','Publish');
    	$readQry->orderBy('jcm_writings.writingId','desc');
    	$read_record = $readQry->paginate(12);
    	
    	return view('frontend.read',compact('read_record'));
    }

    public function viewArticle(Request $request,$writingId){
    	/* article query */
    	$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
    	$readQry->where('jcm_writings.writingId','=',$writingId);
    	$record = $readQry->first();

    	if(count($record) == 0){
    		return redirect('read');
    	}
        $read = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$read->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$read->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
		$read->limit(4);
		$read->inRandomOrder();
		$Qry=$read->get();
		//dd($Qry);
		/*comments on article */
		$comments = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$writingId)->where('table_name','read')->orderBy('jcm_comments.comment_id','desc')->get();
		
    	return view('frontend.view-article',compact('comments','writingId','record','Qry'));
    }

    public function viewUpskill(Request $request,$skillId){
    	$type = $request->segment(2);
    	/* upskill query */
    	$learnQry = DB::table('jcm_upskills')->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_upskills.companyId')->where('type','=',ucfirst($type));
    	$learnQry->where('skillId','=',$skillId);
    	$record = $learnQry->first();

    	if(count($record) == 0){
    		return redirect('learn');
    	}
     $Qry = DB::table('jcm_upskills')->limit(4)->inRandomOrder()->get();

     $comments = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$skillId)->where('table_name','learn')->orderBy('jcm_comments.comment_id','desc')->get();
	// dd($Qry);
    	return view('frontend.view-course',compact('comments','skillId','record','Qry'));
    }

    public function searchSkills(Request $request){  
    //dd($request->input('country'));     / search upskills /  
     
    $learnQry = DB::table('jcm_upskills'); 

    if($request->input('type') != ''){      
    	$learnQry->where('type','=',ucfirst($request->input('type')));
    	}         
    	if($request->input('keyword') != ''){      
    		$learnQry->where('title','LIKE','%'.$request->input('keyword').'%'); 
    		}  
    		if($request->input('city') != ''){      
    				$learnQry->where('city','=',$request->input('city'));      
			} 
			 
			if($request->input('state') != ''){      
				$learnQry->where('state','=',$request->input('state'));      
		} 
    			if($request->input('country') != ''){             
					$learnQry->where('country','=',$request->input('country'));  
				  }     
					$record = $learnQry->orderBy('skillId','desc')->paginate(30);    
					 return view('frontend.search-learn',compact('record'));    
	}


    public function companies(Request $request){
		/* companies query */
		//dd($request->all());
    	$company = DB::table('jcm_companies');
    	
    	if($request->isMethod('get')){
    		if($request->input('keyword') != ''){
				//dd($request->keyword);
    			$company->where('companyName','like','%'.$request->input('keyword').'%');
    		}
    		if($request->input('city') != ''){
    		$company->where('companyCity','=',$request->input('city'));
	         }
		if($request->input('country') != ''){
    		$company->where('companyCountry','=',$request->input('country'));
		}
		if($request->input('state') != ''){
    		$company->where('companyState','=',$request->input('state'));
    	}
    	//if($request->input('in') != ''){
    		//$company->where('category','=',$request->input('in'));
		//}
	}
		if($request->input('in') != ''){
    		$company->where('category','=',$request->input('in'));
		}

		$company->where('jcm_companies.category','!=','');
		$company->where('jcm_companies.companyName','!=','주식회사잡콜미');
		$company->where('jcm_companies.companyAddress','!=','');
		$company->where('jcm_companies.companyAbout','!=',null);
    	
    	//$company->orderBy('package','desc');
    	//$company->orderBy('companyModifiedTime','desc');
		$company->orderBy('companyId','desc');
		$company->orderBy('moviecom','desc');
    	
		$companies = $company->paginate(60);
		$companies->appends(['keyword' => $request->input('keyword')]);
		$companies->appends(['country' => $request->input('country')]);
		
    	return view('frontend.view-companies',compact('companies'));
    }

    public function viewCompany(Request $request,$companyId){
    	$company = DB::table('jcm_companies')->where('companyId','=',$companyId)->first();
		
		$companyals = DB::table('jcm_companies_als')->where('companyId','=',$companyId)->first();

    	$jobs = DB::table('jcm_jobs')->where('companyId','=',$companyId)->limit(10)->get();

		$company_work = DB::table('jobentity')->where('EmployerID','=',$company->work_id)->first();

		$company_work2 = DB::table('companyemployeestat')->where('CompanyID','=',$company->work_id)->first();

		$company_work3 = DB::table('employer')->where('ID','=',$company->work_id)->first();


    	$followArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
			$followArr = @explode(',', $meta->follow);
		}

		$companyReview = DB::table('jcm_companyreview')->leftJoin('jcm_users','jcm_users.userId','=','jcm_companyreview.user_id')->where('company_id','=',$companyId)->get();
	
		    $companyRecommended= DB::table('jcm_companyreview')->leftJoin('jcm_users','jcm_users.userId','=','jcm_companyreview.user_id')->where('company_id',$companyId)->where('recommend_ceo','Recommended')->get();
			$companyon= DB::table('jcm_companyreview')->leftJoin('jcm_users','jcm_users.userId','=','jcm_companyreview.user_id')->where('company_id',$companyId)->where('recommend','on')->get();
			$companygrowing= DB::table('jcm_companyreview')->leftJoin('jcm_users','jcm_users.userId','=','jcm_companyreview.user_id')->where('company_id',$companyId)->where('future','Growing Up')->get();
			
			$allrec=count($companyReview);
			$percec=count($companyRecommended);
			$peron=count($companyon);
			$pergrowing=count($companygrowing);
			$allrecmond=$allrec == 0 ? 0 : ($percec*100/$allrec);
			$allon=$allrec == 0 ? 0 : ($peron*100/$allrec);
			$allgrowing=$allrec == 0 ? 0 : ($pergrowing*100/$allrec);
			//dd($company);

    	return view('frontend.show-company',compact('allgrowing','allon','allrecmond','company','jobs','followArr','companyReview','companyals','company_work','company_work2','company_work3'));
    }

    public function sendFeedback(Request $request){
    	$message = trim($request->input('message'));
    	$type = trim($request->input('type'));
    	echo @json_encode(array('status' => 'success'));
    }
	 public function sendquery(Request $request){
    	//dd($request->all());
		$input['email']=$request->email;
		$input['message']=$request->msg;
		$input['type']='Query';
		$request->session()->put('query','Thank you for contact us');
		DB::table('feedback')->insert($input);
		return back()->withInput();
    }
	/* the below code written fo subscribe functionality*/
    public function subscribe(Request $request){

    	/* check if person is login or not*/
	  if(session()->has('jcmUser')){
	  	/* get user id and on that it get user data*/
	  	$userId = \Session::get('jcmUser')->userId;
	  	$subscribe = DB::table('jcm_users')->where('userId','=',$userId)->first();
	  	/* check if user subscribe then change to unsubscribe else subscribe*/
	  	if($subscribe->subscribe == 'N'){
	  		DB::table('jcm_users')->where('userId','=',$userId)->update(array('subscribe' => 'Y'));
	  		Session()->put('bell_color','#45c536');
	  		//echo session('bell_color');die;
	  	}else{
	  		DB::table('jcm_users')->where('userId','=',$userId)->update(array('subscribe' => 'N'));
	  		session()->put('bell_color','#2e6da4');
	  		//echo session('bell_color');die;
	  	}
	  	/*here after updating the database redirect to home page*/
	  	return redirect('/');
	  }else{
	  	$request->session()->flash('subscribeAlert', trans('home.please login to subscribe'));
	  	return redirect('account/login');
	  }
}

public function getjobnotifications(Request $request){
	if(!session()->has('jcmUser')){
		return redirect('account/login');
	}

	$userid = session()->get('jcmUser')->userId;
	$getCat = DB::table('jcm_users_meta')->where('userId',$userid)->first()->industry;
	$jobs = DB::table('jcm_jobs')->where('category',$getCat)->get();
	$jobstoview = array('jobs' => $jobs);
	$currentDate = \Carbon\Carbon::now();
	print_r($currentDate->toDateTimeString());die;
	Mail::send('emails.jobs',$jobstoview,function($message){

		$message->to(session()->get('jcmUser')->email)->subject(trans('home.Latest jobs Mail'));

	});
}

public function feedback(Request $request){
		$data['email'] = $request->input('email');
		$data['type'] = $request->input('type');
		$data['message'] = $request->input('message');
		DB::table('feedback')->insert($data);
}
public function getfeedback(Request $request){
		$data = DB::table('feedback')->orderBy('id','decs')->get();
		return view('admin.users.feedback',compact('data'));
}
public function editfeedback(Request $request){
	$id = $request->input('id');
	$data = DB::table('feedback')->where('id',$id)->first();
	echo json_encode($data);
}

public function deletefeedback(Request $request){
	$id = $request->input('id');
	if(DB::table('feedback')->where('id',$id)->delete()){
		echo 1;
	}else{
		echo 2;
	}

}



public function deletescrapping(Request $request){

		$data = DB::table('jcm_jobs2')->where('country','=','230')->get();
		foreach($data as $datas){
			//echo $datas->companyId;
			$data2 = DB::table('jcm_jobs2')->where('title',$datas->title)->where('jobId','>',$datas->jobId)->first();
				foreach($data2 as $data2s){
					DB::table('jcm_jobs2')->where('jobId','=',$data2s->jobId)->delete();
				}
		}
	echo 2;
}

public function getscrapping(Request $request){
		
		return view('admin.users.scrapping');
}

public function addscrapping(Request $request){
	
	$data = DB::table('employer2')->get();
	 
	  foreach($data as $datas){	

		$state_array = explode(" ", $datas->CompanyAddress);
							
		if($state_array[1] == "서울특별시"){
			$state_num = "2047";
		}elseif($state_array[1] == "경기도"){
			$state_num = "2048";
		}elseif($state_array[1] == "인천광역시"){
			$state_num = "2049";
		}elseif($state_array[1] == "부산광역시"){
			$state_num = "2050";
		}elseif($state_array[1] == "세종특별자치시"){
			$state_num = "2051";
		}elseif($state_array[1] == "울산광역시"){
			$state_num = "2052";
		}elseif($state_array[1] == "대전광역시"){
			$state_num = "2053";
		}elseif($state_array[1] == "광주광역시"){
			$state_num = "2054";
		}elseif($state_array[1] == "대구광역시"){
			$state_num = "2055";
		}elseif($state_array[1] == "충청북도"){
			$state_num = "2056";
		}elseif($state_array[1] == "충청남도"){
			$state_num = "2057";
		}elseif($state_array[1] == "경상북도"){
			$state_num = "2058";
		}elseif($state_array[1] == "경상남도"){
			$state_num = "2059";
		}elseif($state_array[1] == "전라북도"){
			$state_num = "2060";
		}elseif($state_array[1] == "전라남도"){
			$state_num = "2061";
		}elseif($state_array[1] == "강원도"){
			$state_num = "2062";
		}elseif($state_array[1] == "제주특별자치도"){
			$state_num = "2063";
		}
		
		$state_num2 = $state_array[2];

		$data2 = DB::table('jcm_cities')->where('name_ko2',$state_num2)->first();

		if($data2 > 0){
			$city_num=$data2->id;
		}else{
			$cityid='0';
		}

		$input['companyId'] = '0';
		$input['type'] = 'User';
		$input['secretId'] = JobCallMe::randomString();		
		$input['firstName']=$datas->CompanyName;		
		$input['email']=$datas->CompanyName;
		$input['username']=$datas->CompanyName;
		$input['password']='70e62ba4a094939feaf36b0b728ef97e';
		$input['phoneNumber']='1021426637';
		$input['country']='1';
		$input['state']=$state_num;
		$input['city']=$city_num;
		$input['subscribe']='Y';
		$input['profilePhoto'] = '';
		$input['about'] = '';
		$input['createdTime'] = date('Y-m-d H:i:s');
		$input['modifiedTime'] = date('Y-m-d H:i:s');
		$input['user_status']='Y';
		$input['work_id']=$datas->ID;

		
		$userId = DB::table('jcm_users')->insertGetId($input);

		$data3 = DB::table('jobentity2')->where('EmployerId',$datas->ID)->first();
			
		$input2['companyName']=$datas->CompanyName;	
		$input2['businessType']=$datas->CompanyType;
		$input2['companyUsername']=$datas->CompanyName;
		$input2['category']='20';
		$input2['companyAddress']=$datas->CompanyAddress;
		$input2['companyCountry']='1';
		$input2['companyCity']=$data2->id;
		$input2['companyState']=$state_num;
		$input2['companyEmail']=$data3->email;
		$input2['companyWebsite']=$datas->Website;
		$input2['companyNoOfUsers']=$datas->Employees;
		$input2['companyAbout']=$datas->aboutus;
		$input2['companyMap']=$datas->CompanyAddress;
		$input2['capital']=$datas->Capital;		
		$input2['companycreatedTime'] = date('Y-m-d H:i:s');
		$input2['companymodifiedTime'] = date('Y-m-d H:i:s');		
		$input2['work_id']=$datas->ID;

		
		$companyId = DB::table('jcm_companies')->insertGetId($input2);

		$uemail = $companyId.'@jobcallme.com';

		DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId,'email' => $uemail));

		//$inputall=$datas->all();
		//DB::table('employer')->insertGetId($data);

	  }

//채용공고

	$data4 = DB::table('jobentity2')->get();
	 
	  foreach($data4 as $datas4){	

		$jobreceipt04='';
		$jobreceipt06='';
		$jobreceipt07='';
		$jobreceipt03='';
		$jobreceipt05='';


		$data5 = DB::table('jcm_users')->where('work_id',$datas4->EmployerId)->first();

		if($datas4->EmploymentType == '정규직'){
			$EmploymentType = 'Full Time';
		}elseif($datas4->EmploymentType == '산업기능요원'){
			$EmploymentType = 'Military Service Exception';
		}else{
			$EmploymentType = 'Contract Workers';
		}

		if($datas4->ApplicationDeadline == '채용시까지'){
			$ApplicationDeadline = '2100-12-31';
		}else{
			$ApplicationDeadline = $datas4->ApplicationDeadline;
		}

		$data61 = DB::table('jobentity2')->where('ID','=',$datas4->ID)->where('registermethod','like','%방문%')->first();
		if($data61 > 0){
			$jobreceipt04='yes';
		}

		$data62 = DB::table('jobentity2')->where('ID','=',$datas4->ID)->where('registermethod','like','%팩스%')->first();
		if($data62 > 0){
			$jobreceipt06='yes';
		}

		$data63 = DB::table('jobentity2')->where('ID','=',$datas4->ID)->where('registermethod','like','%이메일%')->first();
		if($data63 > 0){
			$jobreceipt07='yes';
		}

		$data64 = DB::table('jobentity2')->where('ID','=',$datas4->ID)->where('registermethod','like','%우편%')->first();
		if($data64 > 0){
			$jobreceipt03='yes';
		}

		$data65 = DB::table('jobentity2')->where('ID','=',$datas4->ID)->where('registermethod','like','%전화%')->first();
		if($data65 > 0){
			$jobreceipt05='yes';
		}


		$input3['userId']=$data5->userId;	
		$input3['companyId']=$data5->companyId;		
		$input3['amount']='0';
		$input3['p_Category']='1';
		$input3['title']=$datas4->jobname;
		$input3['jType']='Free';
		$input3['department']=$datas4->RecruitmentOccupation;
		$input3['category']=$data5->category;
		$input3['jobType']=$EmploymentType;
		$input3['jobStatus']='Publish';
		$input3['jobShift']='Following Co. regulation';
		$input3['process']=$datas4->selectionmethod;
		$input3['jobacademic']=$datas4->Education;
		$input3['gender']='Nosex';
		$input3['currency']='KRW';
		$input3['anynational']='yes';	
		$input3['onlynational']='no';
		$input3['country']=$data5->country;
		$input3['state']=$data5->state;
		$input3['city']=$data5->city;
		$input3['expiryDate']=$ApplicationDeadline;
		$input3['paymentType']='0';
		$input3['status']='1';
		$input3['createdTime'] = date('Y-m-d H:i:s');			
		$input3['work_id']=$datas4->EmployerId;
		$input3['work_idx']=$datas4->ID;

		$input3['jobreceipt04']=$jobreceipt04;
		$input3['jobreceipt06']=$jobreceipt06;
		$input3['jobreceipt07']=$jobreceipt07;
		$input3['jobreceipt03']=$jobreceipt03;
		$input3['jobreceipt05']=$jobreceipt05;

		

		
		$jobId = DB::table('jcm_jobs')->insertGetId($input3);

					
		
	  }
echo 1;
	 
	
}



public function getgdscrapping(Request $request){
		
		return view('admin.users.gdscrapping');
}

public function deletegdscrapping(Request $request){

	//$row = 1;
	$row = 0;
	if (($handle = fopen("jobs-20180717-124614.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 100000000)) !== FALSE) {
			//$num = count($data);
			
			//$row++;
			//for ($c=0; $c < $num; $c++) {
				//$data[$c];
		if($row22!=0){

			if($data1 = DB::table('jcm_users')->where('firstName',trim($data[3]))->first()){
			}else{

				$data2 = DB::table('jcm_states')->where('name',trim($data[4]))->first();
				
					if($data2->id){
						$stateid = $data2->id;
					}else{
						$stateid = '0';
					}

				$data3 = DB::table('jcm_cities')->where('name',trim($data[4]))->first();

					if($data3->id){
						$cityid = $data3->id;
					}else{
						$cityid = '0';
					}

				$input['companyId'] = '0';
				$input['type'] = 'User';
				$input['secretId'] = JobCallMe::randomString();		
				$input['firstName']=$data[3];		
				$input['email']=$data[3];
				$input['username']=$data[3];
				$input['password']='70e62ba4a094939feaf36b0b728ef97e';
				$input['phoneNumber']='1021426637';
				$input['country']='1';
				$input['state']=$stateid;
				$input['city']=$cityid;
				$input['subscribe']='Y';
				$input['profilePhoto'] = '';
				$input['about'] = '';
				$input['createdTime'] = $data[0];
				$input['modifiedTime'] = $data[0];
				$input['user_status']='Y';
				

				
				$userId = DB::table('jcm_users')->insertGetId($input);




		//기업정보	

			if($data[23] == 'Government'){
				$businessType = 'Government·Pblic·Institutions·Public Corporations';
				$formofbussiness = 'Government·Pblic·Institutions·Public Corporations';
			}elseif($data[23] == 'Subsidiary or Business Segment'){
				$businessType = 'Inc Incorporated';
				$formofbussiness = 'Midsize Business';
			}elseif($data[23] == 'Company - Private'){
				$businessType = 'Sole Proprietorship';
				$formofbussiness = 'Small and Medium-sized Businesses';
			}elseif($data[23] == 'Company - Public'){
				$businessType = 'Inc Incorporated';
				$formofbussiness = 'Midsize Business';
			}elseif($data[23] == 'Non-profit Organisation'){
				$businessType = 'Nonprofits';
				$formofbussiness = 'Etc';
			}elseif($data[23] == 'Other Organisation'){
				$businessType = 'Inc Incorporated';
				$formofbussiness = 'Etc';			
			}else{
				$businessType = 'Sole Proprietorship';
				$formofbussiness = 'Small and Medium-sized Businesses';
			}


			if($data[24] == 'Biotech & Pharmaceuticals'){				
				$category = '11';
			}elseif($data[24] == 'Manufacturing'){
				$category = '7';				
			}elseif($data[24] == 'Government'){
				$category = '13';	
			}elseif($data[24] == 'Information Technology'){
				$category = '1';	
			}elseif($data[24] == 'Aerospace & Defense'){
				$category = '13';				
			}elseif($data[24] == 'Retail'){
				$category = '10';	
			}elseif($data[24] == 'Media'){
				$category = '6';	
			}elseif($data[24] == 'Health Care'){
				$category = '11';				
			}elseif($data[24] == 'Finance'){
				$category = '3';	
			}elseif($data[24] == 'Insurance'){
				$category = '12';	
			}elseif($data[24] == 'Transportation & Logistics'){
				$category = '10';				
			}elseif($data[24] == 'Oil, Gas, Energy & Utilities'){
				$category = '7';	
			}elseif($data[24] == 'Business Services'){
				$category = '8';	
			}elseif($data[24] == 'Telecommunications'){
				$category = '1';				
			}elseif($data[24] == 'Travel & Tourism'){
				$category = '8';	
			}elseif($data[24] == 'Construction, Repair & Maintenance'){
				$category = '2';	
			}elseif($data[24] == 'Education'){
				$category = '4';				
			}elseif($data[24] == 'Accounting & Legal'){
				$category = '12';	
			}elseif($data[24] == 'Real Estate'){
				$category = '2';	
			}elseif($data[24] == 'Mining & Metals'){
				$category = '7';				
			}elseif($data[24] == 'Travel & Tourism'){
				$category = '8';	
			}elseif($data[24] == 'Restaurants, Bars & Food Services'){
				$category = '8';	
			}elseif($data[24] == 'Non-Profit'){
				$category = '13';				
			}elseif($data[24] == 'Unknown'){
				$category = '0';				
			}else{
				$category = '21';
			}
			
			$companyLogo = explode("/",$data[9]);
			$companyCover = explode("/",$data[10]);
			
			if($companyCover[6] == 'banners'){				
				$companyCover_img = '';
			}else{
				$companyCover_img = $companyCover[6];
			}

			$input2['companyName']=$data[3];	
			$input2['businessType']=$businessType;
			$input2['companyUsername']=$data[3];
			$input2['category']=$category;
			$input2['companyAddress']=$data[20];
			$input2['companyCountry']='1';
			$input2['companyCity']=$cityid;
			$input2['companyState']=$stateid;			
			$input2['companyWebsite']=$data[8];
			$input2['companyNoOfUsers']=$data[21];
			$input2['companyAbout']=$data[6];
			$input2['companyMap']=$data[4];
			$input2['formofbussiness']=$formofbussiness;
			$input2['companyEstablishDate']=$data[22];	
			$input2['companyLogo']=$companyLogo[5];
			$input2['companyCover']=$companyCover_img;
			//$input2['picLgo']='1';
			

			$input2['img1']=$data[232];
			$input2['img2']=$data[104];
			$input2['img3']=$data[292];
			$input2['img4']=$data[422];
			$input2['img5']=$data[162];
			$input2['img6']=$data[209];
			$input2['img7']=$data[389];
			$input2['img8']=$data[332];
			$input2['img9']=$data[119];
			$input2['img10']=$data[253];
			$input2['img11']=$data[215];
			$input2['img12']=$data[411];
			$input2['img13']=$data[392];
			$input2['img14']=$data[81];
			$input2['img15']=$data[261];
			$input2['img16']=$data[216];
			$input2['img17']=$data[291];
			$input2['img18']=$data[302];
			$input2['img19']=$data[66];
			$input2['img20']=$data[94];
			$input2['img21']=$data[259];
			$input2['img22']=$data[102];
			$input2['img23']=$data[231];
			$input2['img24']=$data[98];
			$input2['img25']=$data[141];
			$input2['img26']=$data[271];
			$input2['img27']=$data[252];
			$input2['img28']=$data[428];
			$input2['img29']=$data[217];
			$input2['img30']=$data[153];
			$input2['img31']=$data[91];
			$input2['img32']=$data[221];
			$input2['img33']=$data[195];
			$input2['img34']=$data[197];
			$input2['img35']=$data[183];
			$input2['img36']=$data[178];
			$input2['img37']=$data[47];
			$input2['img38']=$data[370];
			$input2['img39']=$data[435];
			$input2['img40']=$data[363];
			$input2['img41']=$data[358];
			$input2['img42']=$data[145];
			$input2['img43']=$data[378];
			$input2['img44']=$data[55];
			$input2['img45']=$data[220];
	




		
						
			

			$input2['companycreatedTime'] = $data[0];
			$input2['companymodifiedTime'] = $data[0];				

			
			$companyId = DB::table('jcm_companies')->insertGetId($input2);

			$uemail = $companyId.'@jobcallme.com';

			//$reviewId = $companyId;

			DB::table('jcm_users')->where('userId','=',$userId)->update(array('companyId' => $companyId,'email' => $uemail));


		//기업리뷰			
				
				$review_degree = '';
				$recommend_ceo = '';
				$future = '';
				$recommend = '';
				
				$review1 = DB::table('jcm_users')->where('firstName',$data[3])->first();
			
				
			    //1
				if($data[388]){	

				if($data[30] == '5'){				
					$review_degree = 'Excellent';
				}elseif($data[30] == '4'){
					$review_degree = 'Verygood';				
				}elseif($data[30] == '3'){
					$review_degree = 'Good';	
				}elseif($data[30] == '2'){
					$review_degree = 'Fair';	
				}elseif($data[30] == '1'){
					$review_degree = 'Poor';				
				}else{
					$review_degree = '';
				}

				if($data[327] == 'Approves of CEO'){				
					$recommend_ceo = 'Recommended';
				}elseif($data[327] == 'No opinion of CEO'){
					$recommend_ceo = 'Natural';				
				}elseif($data[327] == 'Disapproves of CEO'){
					$recommend_ceo = 'Not Recommended';
				}else{
					$recommend_ceo = '';
				}

				if($data[173] == 'Positive Outlook'){				
					$future = 'Growing Up';
				}elseif($data[173] == 'Neutral Outlook'){
					$future = 'Remain Same';				
				}elseif($data[173] == 'Negative Outlook'){
					$future = 'Growing Down';
				}else{
					$future = '';
				}

				if($data[381] == 'Recommends'){				
					$recommend = 'on';
				}else{
					$recommend = 'off';				
				}
				
				$inputreview['company_id']=$companyId;
				$inputreview['user_id']=$userId;
				$inputreview['overall_review']=$review_degree;
				$inputreview['review_title']=$data[388];
				$inputreview['advice_management']=$data[258];
				$inputreview['career_opportunity']=$review_degree;
				$inputreview['benefits']=$review_degree;
				$inputreview['work_lifebalance']=$review_degree;
				$inputreview['rate_management']=$review_degree;
				$inputreview['rate_culture']=$review_degree;
				$inputreview['recommend_ceo']=$recommend_ceo;
				$inputreview['future']=$future;
				$inputreview['recommend']=$recommend;
				$inputreview['pros'] = $data[219];
				$inputreview['cons'] = $data[366];
				$inputreview['created_date'] = date("Y-m-d",strtotime($data[371]));
				$inputreview['updated_date'] = date("Y-m-d",strtotime($data[371]));		

				$companyreview = DB::table('jcm_companyreview')->insertGetId($inputreview);

				}


				//2
				if($data[204]){	

				if($data[404] == '5'){				
					$review_degree = 'Excellent';
				}elseif($data[404] == '4'){
					$review_degree = 'Verygood';				
				}elseif($data[404] == '3'){
					$review_degree = 'Good';	
				}elseif($data[404] == '2'){
					$review_degree = 'Fair';	
				}elseif($data[404] == '1'){
					$review_degree = 'Poor';				
				}else{
					$review_degree = '';
				}

				if($data[276] == 'Approves of CEO'){				
					$recommend_ceo = 'Recommended';
				}elseif($data[276] == 'No opinion of CEO'){
					$recommend_ceo = 'Natural';				
				}elseif($data[276] == 'Disapproves of CEO'){
					$recommend_ceo = 'Not Recommended';
				}else{
					$recommend_ceo = '';
				}

				if($data[298] == 'Positive Outlook'){				
					$future = 'Growing Up';
				}elseif($data[298] == 'Neutral Outlook'){
					$future = 'Remain Same';				
				}elseif($data[298] == 'Negative Outlook'){
					$future = 'Growing Down';
				}else{
					$future = '';
				}

				if($data[68] == 'Recommends'){				
					$recommend = 'on';
				}else{
					$recommend = 'off';				
				}
					
				$inputreview['company_id']=$companyId;
				$inputreview['user_id']=$userId;
				$inputreview['overall_review']=$review_degree;
				$inputreview['review_title']=$data[204];
				$inputreview['advice_management']=$data[385];
				$inputreview['career_opportunity']=$review_degree;
				$inputreview['benefits']=$review_degree;
				$inputreview['work_lifebalance']=$review_degree;
				$inputreview['rate_management']=$review_degree;
				$inputreview['rate_culture']=$review_degree;
				$inputreview['recommend_ceo']=$recommend_ceo;
				$inputreview['future']=$future;
				$inputreview['recommend']=$recommend;
				$inputreview['pros'] = $data[452];
				$inputreview['cons'] = $data[206];
				$inputreview['created_date'] = date("Y-m-d",strtotime($data[168]));
				$inputreview['updated_date'] = date("Y-m-d",strtotime($data[168]));		

				$companyreview = DB::table('jcm_companyreview')->insertGetId($inputreview);

				}


				//3
				if($data[362]){	

				if($data[226] == '5'){				
					$review_degree = 'Excellent';
				}elseif($data[226] == '4'){
					$review_degree = 'Verygood';				
				}elseif($data[226] == '3'){
					$review_degree = 'Good';	
				}elseif($data[226] == '2'){
					$review_degree = 'Fair';	
				}elseif($data[226] == '1'){
					$review_degree = 'Poor';				
				}else{
					$review_degree = '';
				}

				if($data[179] == 'Approves of CEO'){				
					$recommend_ceo = 'Recommended';
				}elseif($data[179] == 'No opinion of CEO'){
					$recommend_ceo = 'Natural';				
				}elseif($data[179] == 'Disapproves of CEO'){
					$recommend_ceo = 'Not Recommended';
				}else{
					$recommend_ceo = '';
				}

				if($data[96] == 'Positive Outlook'){				
					$future = 'Growing Up';
				}elseif($data[96] == 'Neutral Outlook'){
					$future = 'Remain Same';				
				}elseif($data[96] == 'Negative Outlook'){
					$future = 'Growing Down';
				}else{
					$future = '';
				}

				if($data[218] == 'Recommends'){				
					$recommend = 'on';
				}else{
					$recommend = 'off';				
				}
					
				$inputreview['company_id']=$companyId;
				$inputreview['user_id']=$userId;
				$inputreview['overall_review']=$review_degree;
				$inputreview['review_title']=$data[362];
				$inputreview['advice_management']=$data[93];
				$inputreview['career_opportunity']=$review_degree;
				$inputreview['benefits']=$review_degree;
				$inputreview['work_lifebalance']=$review_degree;
				$inputreview['rate_management']=$review_degree;
				$inputreview['rate_culture']=$review_degree;
				$inputreview['recommend_ceo']=$recommend_ceo;
				$inputreview['future']=$future;
				$inputreview['recommend']=$recommend;
				$inputreview['pros'] = $data[374];
				$inputreview['cons'] = $data[424];
				$inputreview['created_date'] = date("Y-m-d",strtotime($data[355]));
				$inputreview['updated_date'] = date("Y-m-d",strtotime($data[355]));		

				$companyreview = DB::table('jcm_companyreview')->insertGetId($inputreview);

				}


				//4
				if($data[380]){	

				if($data[395] == '5'){				
					$review_degree = 'Excellent';
				}elseif($data[395] == '4'){
					$review_degree = 'Verygood';				
				}elseif($data[395] == '3'){
					$review_degree = 'Good';	
				}elseif($data[395] == '2'){
					$review_degree = 'Fair';	
				}elseif($data[395] == '1'){
					$review_degree = 'Poor';				
				}else{
					$review_degree = '';
				}

				if($data[130] == 'Approves of CEO'){				
					$recommend_ceo = 'Recommended';
				}elseif($data[130] == 'No opinion of CEO'){
					$recommend_ceo = 'Natural';				
				}elseif($data[130] == 'Disapproves of CEO'){
					$recommend_ceo = 'Not Recommended';
				}else{
					$recommend_ceo = '';
				}

				if($data[425] == 'Positive Outlook'){				
					$future = 'Growing Up';
				}elseif($data[425] == 'Neutral Outlook'){
					$future = 'Remain Same';				
				}elseif($data[425] == 'Negative Outlook'){
					$future = 'Growing Down';
				}else{
					$future = '';
				}

				if($data[174] == 'Recommends'){				
					$recommend = 'on';
				}else{
					$recommend = 'off';				
				}
					
				$inputreview['company_id']=$companyId;
				$inputreview['user_id']=$userId;
				$inputreview['overall_review']=$review_degree;
				$inputreview['review_title']=$data[380];
				$inputreview['advice_management']=$data[334];
				$inputreview['career_opportunity']=$review_degree;
				$inputreview['benefits']=$review_degree;
				$inputreview['work_lifebalance']=$review_degree;
				$inputreview['rate_management']=$review_degree;
				$inputreview['rate_culture']=$review_degree;
				$inputreview['recommend_ceo']=$recommend_ceo;
				$inputreview['future']=$future;
				$inputreview['recommend']=$recommend;
				$inputreview['pros'] = $data[375];
				$inputreview['cons'] = $data[449];
				$inputreview['created_date'] = date("Y-m-d",strtotime($data[416]));
				$inputreview['updated_date'] = date("Y-m-d",strtotime($data[416]));		

				$companyreview = DB::table('jcm_companyreview')->insertGetId($inputreview);

				}


				
		//기업리뷰


			}	


		//채용공고
		if($datajobs = DB::table('jcm_jobs')->where('title',$data[1])->first()){
		}else{
			
			$data5 = DB::table('jcm_users')->where('firstName',$data[3])->first();
			
				$data6 = DB::table('jcm_states')->where('name',trim($data[4]))->first();
				
					if($data6->id){
						$stateid2 = $data6->id;
					}else{
						$stateid2 = '0';
					}

				$data7 = DB::table('jcm_cities')->where('name',trim($data[4]))->first();

					if($data7->id){
						$cityid2 = $data7->id;
					}else{
						$cityid2 = '0';
					}

			
			$input3['userId']=$data5->userId;	
			$input3['companyId']=$data5->companyId;		
			$input3['amount']='0';
			$input3['p_Category']='1';
			$input3['title']=$data[1];
			$input3['jType']='Free';
			//$input3['department']=$datas4->RecruitmentOccupation;
			$input3['category']=$category;
			$input3['careerLevel']='jobhours07';
			$input3['experience']='Fresh Graduate ~ Experience';
			$input3['vacancies']='0';
			$input3['description']=$data[2];
			$input3['skills']='See Description3';
			$input3['qualification']='See Description3';
			$input3['jobType']='Full Time/Contract Workers';
			$input3['expptitle']='jobhours07';
			$input3['jobStatus']='Publish';
			$input3['jobShift']='Following Co. regulation';
			$input3['jobaddr']=$data[4];
			$input3['jobdayval']='jobday11';
			$input3['jobhoursval']='jobhours07';
			$input3['process']='See Description2';
			$input3['jobacademic']='See Description';
			$input3['gender']='Nosex';
			$input3['jobreceipt02']='yes';
			$input3['jobhomgpage']=$data[15];
			$input3['afterinterview']='Decision after interview';
			$input3['currency']='';
			$input3['anynational']='yes';	
			$input3['onlynational']='no';
			$input3['benefits']='See Description';
			$input3['country']='1';
			$input3['state']=$stateid2;
			$input3['city']=$cityid2;
			$input3['Address']=$data[4];
			$input3['expiryDate']='2100-12-31';
			$input3['paymentType']='0';
			$input3['status']='1';
			$input3['createdTime'] = $data[0];			
			

			
			$jobId = DB::table('jcm_jobs')->insertGetId($input3);
		
		}


		}

		$row22++;

			//}
		}
		fclose($handle);

		echo 2;
	}


	
}



public function readCat(){
		$data = DB::table('jcm_read_category')->get();
       return view('admin.users.readcat',compact('data'));
}
public function addreadCat(Request $request){
	if(!$request->input('id')){
		$name = $request->input('name');
		$data = array('name' => $name);
		if(DB::table('jcm_read_category')->insert($data)){
			echo 1;
		}else{
			echo 2;
		}
	}else{
		$id = $request->input('id');
		$name = $request->input('name');
		$data = array('name' => $name);
		if(DB::table('jcm_read_category')->where('id',$id)->update($data)){
			echo 1;
		}else{
			echo 2;
		}
	}
}
public function deletereadCat(Request $request){
	$id = $request->input('id');
	if(DB::table('jcm_read_category')->where('id',$id)->delete()){
		echo 1;
	}else{
		echo 2;
	}
}
public function verifyUser(Request $request){
	$secretId = trim($request->segment(2));
	$data = DB::table('jcm_users')->where('secretId',$secretId)->first();
	if($data > 0){
		
		DB::table('jcm_users')->where('secretId',$secretId)->update(['user_status' => 'Y']);
		$request->session()->flash('emailAlert', trans('home.Your account is Verified Please Login'));
		return redirect('account/login');
	}else{
		echo "There is a issue in your secret code kindly contact with administration thanks";
	}
}
public function changepropic(Request $request){
	$userid = $request->input('userId');
	$imagelink = $request->input('imagelink');
	$oldImageName = pathinfo($imagelink);
	$image = $_FILES['profileImage'];
	$tmp = $image['tmp_name'];
	$newfile = $oldImageName['basename'];
	unlink('profile-photos/'.$newfile);
	move_uploaded_file($tmp, 'profile-photos/'.$newfile);
	/*DB::table('jcm_users')->where('userId',$userid)->update(['profileImage' => $profileImage,'profilePhoto'=>'']);*/

}
public function changecompanypropic(Request $request){
	$userid = $request->input('userId');
	$imagelink = $request->input('imagelink');
	$oldImageName = pathinfo($imagelink);
	$image = $_FILES['profileImage'];
	$tmp = $image['tmp_name'];
	$newfile = $oldImageName['basename'];
	unlink('compnay-logo/'.$newfile);
	move_uploaded_file($tmp,'compnay-logo/'.$newfile);
	/*DB::table('jcm_users')->where('userId',$userid)->update(['profileImage' => $profileImage,'profilePhoto'=>'']);*/

}
public function removeCompanyProPic(Request $request){
	 $comId = session()->get('jcmUser')->companyId;
	 
	if( DB::table('jcm_companies')->where('companyId',$comId)->update(['companyLogo'=>''])){
		echo 1;
	}else{
		echo 2;
	}
}
public function deactiveUser(Request $request){
	$id = $request->input('id');
	if(DB::table('jcm_users')->where('userId','=',$id)->update(['user_status'=>'N'])){
		$data = DB::table('jcm_users')->where('userId','=',$id)->first();
		DB::table('jcm_companies')->where('companyId','=',$data->companyId)->update(['companyStatus'=>'Inactive']);

		$request->session()->flush('jcmUser');
		$request->session()->flash('loginAlert', trans('home.Your Account is Deactivated for activation contact Administration thanks'));
		   echo 1;
	}else{
		echo 'error in home controller line number 598';
	}
}
public function regvalpass(Request $request){
	echo JobCallMe::registrationPassValidation($request->input('password'));
}
public function savecompic(Request $request){
	$data = $request->input('comppics');
	$comId = session()->get('jcmUser')->companyId;
	if( DB::table('jcm_companies')->where('companyId',$comId)->update(['companypics'=> $data])){
		echo 1;
	}else{
		echo 2;
	}
}
public function savecomabout(Request $request){
	$data = $request->input('compabout');
	$comId = session()->get('jcmUser')->companyId;
	if( DB::table('jcm_companies')->where('companyId',$comId)->update(['companyAbout'=> $data])){
		echo 1;
	}else{
		echo 2;
	}
}
  public function after_payment(Request $request, $id){
    	$userinfo = session()->get('jcmUser');
    	//$request->session()->destroy();
		$makeorder= DB::table('jcm_orders')->where('status','=','pending')->where('payment_mode','=','Cash Payment')->where('order_id','=',$id)->get();
		$order=$makeorder[0];
		//dd($order);
    	return view('frontend.after_payment',compact('userinfo','order'));
    }
	  public function make_payment(Request $request){
		  $input=$request->all();
		  $userinfo = session()->get('jcmUser');
		  $name=$userinfo->firstName.' '.$userinfo->lastName;
		  $email=$userinfo->email;
		  $phone=$userinfo->phoneNumber;
		  $input['user_id']=$userinfo->userId;
		  $input['name']=$name;
		  $input['email']=$email;
		  $input['phonenum']=$phone;
		  $data=DB::table('jcm_make_payment')->insert($input);

		  return view('frontend.Completed');

    	
    }
    public function likes(Request $request,$type){
    	$data = $request->input();
    	unset($data['_token']);
    	if($type == "like"){
    		DB::table('jcm_likes')->insert($data);
    	}else{
    		DB::table('jcm_likes')->where('parent_table',$data['parent_table'])->where('post_id',$data['post_id'])->where('user_id',$data['user_id'])->delete();
    	}
    }



}
?>