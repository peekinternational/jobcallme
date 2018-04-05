<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Illuminate\Support\Facades\Lang;

class Jobs extends Controller{
    public function home(){
		return view('frontend.view-jobs');
	}

	public function searchJobs(Request $request){
		
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		
		$_find = trim($request->input('_find'));
		$keyword = trim($request->input('keyword'));
		$categoryId = trim($request->input('categoryId'));
		$jobType = trim($request->input('jobType'));
		$jobShift = trim($request->input('jobShift'));
		$careerLevel = trim($request->input('careerLevel'));
		$experience = trim($request->input('experience'));
		$minSalary = trim($request->input('minSalary'));
		$maxSalary = trim($request->input('maxSalary'));
		$country = trim($request->input('country'));
		$state = trim($request->input('state'));
		$city = trim($request->input('city'));
		$currency = trim($request->input('currency'));
		$userinfo=$request->session()->get('jcmUser')->userId;
		$savedJobArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
		}

		
		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyLogo');
		$jobs->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
		$jobs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobs->where('jcm_jobs.status','=','1');
		$jobs->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
		//$jobs->where('jcm_jobs.country','=',$country);
		/*if($_find == '0'){
			if($request->session()->has('jcmUser')){
				$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
				if($meta->industry != '0' && $meta->industry != ''){
					$jobs->where('jcm_jobs.category','=',$meta->industry);
				}
			}
		}*/
		/* write below code for resolve an issue when city is empty cityId function return 1 which mean record exsist*/
		if($city == ''){
			$city = 0;
		}
		$city = JobCallMe::cityId($city);
		if($country != '0' && $country != "") $jobs->where('jcm_jobs.country','=',$country);
		if($categoryId != '') $jobs->where('jcm_jobs.category','=',$categoryId);
		if($jobType != '') $jobs->where('jcm_jobs.jobType','=',$jobType);
		if($jobShift != '') $jobs->where('jcm_jobs.jobShift','=',$jobShift);
		if($careerLevel != '') $jobs->where('jcm_jobs.careerLevel','=',$careerLevel);
		if($experience != '') $jobs->where('jcm_jobs.experience','=',$experience);
		if($minSalary != '') $jobs->where('jcm_jobs.minSalary','<=',$minSalary);
		if($maxSalary != '') $jobs->where('jcm_jobs.maxSalary','>=',$maxSalary);
		if($state != '0' && $state != "") $jobs->where('jcm_jobs.state','=',$state);
		if($city != '0') $jobs->where('jcm_jobs.city','=',$city);
		if($currency != '') $jobs->where('jcm_jobs.currency','=',$currency);
		$jobs->where('jobStatus','=','Publish');
		if($keyword != ''){
			$jobs->where(function ($query) use ($keyword) {
				$expl = @explode(' ', $keyword);
				foreach($expl as $kw){
					$query->orWhere('jcm_jobs.title','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_jobs.skills','LIKE','%'.$kw.'%');
				}
			});
		}
		$app = $request->session()->get('jcmUser');

		$result = $jobs->orderBy('jobId','desc')->paginate(15);
		
		//dd($result);
        $head = '';
		$vhtml = '';
		$category ='';
		if(count($result) > 0){
			foreach($result as $rec){
				$jobApplied = JobCallMe::isAppliedToJob($app->userId,$rec->jobId);
				
				//dd($jobApplied);
				$applyUrl = url('jobs/apply/'.$rec->jobId);
				$viewUrl = url('jobs/'.$rec->jobId);
				$vhtml .= '<div class="jobs-suggestions">';
				if($rec->userId == $userinfo ){
					$vhtml .= '<div class="js-action" style="display:none">';
                        //$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs"></a>';
                        if(in_array($rec->jobId, $savedJobArr)){
	                        //$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;"></a>';
	                    }else{
	                    	//$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;"></a>';
	                    }
                    $vhtml .= '</div>';
				}
				else{
					$vhtml .= '<div class="js-action">';
					if($jobApplied == true){
                        $vhtml .= '<a href="'.$applyUrl.'" class="btn btn-success btn-xs" disabled>'.trans('home.applied').'</a>';
					}
					else{
						$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs">'.trans('home.apply').'</a>';
					}
                        if(in_array($rec->jobId, $savedJobArr)){
	                        $vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;" disabled >'.trans('home.saved').'</a>';
	                    }else{
	                    	$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;">'.trans('home.save').'</a>';
	                    }
                    $vhtml .= '</div>';
				}
				if($rec->head == "yes")
				{
					$head='<span class="label" style="background-color:green">Headhunting</span>';
				}
				else{
					$head="";
				}
				if($rec->dispatch == "yes")
				{
					$dispatch='<span class="label" style="background-color:blue">Dispatch & Agency</span>';
				}
				else{
					$dispatch="";
				}
				$colorArr = array('purple','green','darkred','orangered','blueviolet');
                    $vhtml .= '<h4><a href="'.$viewUrl.'">'.$rec->title.' <span class="label" style="background-color:'.$colorArr[array_rand($colorArr)].'">' .$rec->p_title.'</span></a>  '.$head.' '.$dispatch.' </h4>';
                    $vhtml .= '<p>'.$rec->companyName.'</p>';
                    $vhtml .= '<ul class="js-listing">';
                    	$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.jobtype').'</p>';
                            $vhtml .= '<p>'.$rec->jobType.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.shift').'</p>';
                            $vhtml .= '<p>'.$rec->jobShift.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.experience').'</p>';
                            $vhtml .= '<p>'.$rec->experience.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.salary').'</p>';
                            $vhtml .= '<p>'.$rec->minSalary.' - '.$rec->maxSalary.' '.$rec->currency.'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.poston').'</p>';
                             $vhtml .= '<p>'.date('M d, Y',strtotime($rec->createdTime)).'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.lastdate').'</p>';
                            $vhtml .= '<p>'.date('M d, Y',strtotime($rec->expiryDate)).'</p>';
                        $vhtml .= '</li>';
                    $vhtml .= '</ul>';
                    $cLogo = url('compnay-logo/default-logo.jpg');
                    if($rec->companyLogo != ''){
                    	$cLogo = url('compnay-logo/'.$rec->companyLogo);
                    }
					
                     $string = strip_tags($rec->description);
                        if (strlen($string) > 100) {

                        // truncate string
                            $stringCut = substr($string, 0, 600);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            $string .= '<a href="'.$viewUrl.'">... ReadMore</a>';
                        }
                   

                   
                    $vhtml .= '<p class="js-note">'.$string.'<img style="padding-top: 17px;" src="'.$cLogo.'" width="100"></p>';
                    $vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.JobCallMe::cityName($rec->city).', '.JobCallMe::countryName($rec->country).'<span class="pull-right" style="color: #999999;margin-top: 28px;">'.date('M d,Y',strtotime($rec->createdTime)).'</span></p>';
				
				$job = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyLogo');
				$job->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
				$job->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
				$job->where('jcm_jobs.status','=','1');
				$job->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
				$job->where('jcm_jobs.category','=',$rec->category);
				$results = $job->limit(1)->inRandomOrder()->get();
				//dd($results);
				
				foreach($results as $sim)
				{
					$comUrl = url('companies/company/'.$sim->companyId);
					$cityUrl = url('jobs?city='.$sim->city);
					$vhtml .= '<p style="color: #999999;text-transform: capitalize;"><a style="color: #999999;" href="'.$cityUrl.'">'.trans('home.similerjob').'  '.JobCallMe::cityName($sim->city).'</a><span style="padding-left: 85px;" ><a style="color: #999999;" href="'.$comUrl.'">'.trans('home.jobIn').' '.$sim->companyName.'</a></span></p>';
				}
				$vhtml .='</div>';
			}
		}else{
			$vhtml  = '<div class="jobs-suggestions">';
				$vhtml .= '<p class="js-note" style="text-align:center;">No Matching record found</p>';
			$vhtml .= '</div>';
		}
		echo $vhtml;
		//echo $result->render();
	}
	public function homePageJobSerach(Request $request){

		/*if(!$request->ajax()){
			exit('Directory access is forbidden');
		}*/
		$savedJobArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
		}
		$keyword = trim($request->input('keyword'));
		$city = trim($request->input('city'));
		$userinfo=$request->session()->get('jcmUser')->userId;
		
		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyLogo','jcm_cities.name');
		$jobs->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
		$jobs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobs->Join('jcm_cities','jcm_jobs.city','=','jcm_cities.id');
		$jobs->where('jcm_jobs.status','=','1');
		
		$jobs->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
		//if($keyword != '') $jobs->where('jcm_jobs.title','=',$keyword);
		if($city != '') $jobs->where('jcm_cities.name','=',$city);

		if($keyword != ''){
			$jobs->where(function ($query) use ($keyword) {
				$expl = @explode(' ', $keyword);
				foreach($expl as $kw){
					$query->orWhere('jcm_jobs.title','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_jobs.skills','LIKE','%'.$kw.'%');
				}
			});
		}

		$result = $jobs->orderBy('jobId','desc')->paginate(20);
		
		
		$vhtml = '';
		$category ='';
		if(count($result) > 0){
			foreach($result as $rec){
				
				$jobApplied = JobCallMe::isAppliedToJob($app->userId,$rec->jobId);
				
				//dd($jobApplied);
				$applyUrl = url('jobs/apply/'.$rec->jobId);
				$viewUrl = url('jobs/'.$rec->jobId);
				$vhtml .= '<div class="jobs-suggestions">';
				if($rec->userId == $userinfo ){
					$vhtml .= '<div class="js-action" style="">';
                        //$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs"></a>';
                        if(in_array($rec->jobId, $savedJobArr)){
	                        //$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;"></a>';
	                    }else{
	                    	//$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;"></a>';
	                    }
                    $vhtml .= '</div>';
				}
				else{
					$vhtml .= '<div class="" style="position: absolute;top: 13px;right: 16px;">';
					if($jobApplied == true){
                        $vhtml .= '<a href="'.$applyUrl.'" class="btn btn-success btn-xs">'.trans('home.applied').'</a>';
					}
					else{
						$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs">'.trans('home.apply').'</a>';
					}
                        if(in_array($rec->jobId, $savedJobArr)){
	                        $vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;">'.trans('home.saved').'</a>';
	                    }else{
	                    	$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;">'.trans('home.save').'</a>';
	                    }
                    $vhtml .= '</div>';
				}
				if($rec->head == "yes")
				{
					$head='<span class="label" style="background-color:green">Headhunting</span>';
				}
				else{
					$head="";
				}
				if($rec->dispatch == "yes")
				{
					$dispatch='<span class="label" style="background-color:blue">Dispatch & Agency</span>';
				}
				else{
					$dispatch="";
				}
				$colorArr = array('purple','green','darkred','orangered','blueviolet');
                    $vhtml .= '<h4><a href="'.$viewUrl.'">'.$rec->title.' <span class="label" style="background-color:'.$colorArr[array_rand($colorArr)].'">' .$rec->p_title.'</span></a>  '.$head.' '.$dispatch.' </h4>';
                    $vhtml .= '<p>'.$rec->companyName.'</p>';
                    $vhtml .= '<ul class="js-listing">';
                    	$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.jobtype').'</p>';
                            $vhtml .= '<p>'.$rec->jobType.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.shift').'</p>';
                            $vhtml .= '<p>'.$rec->jobShift.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.experience').'</p>';
                            $vhtml .= '<p>'.$rec->experience.'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.salary').'</p>';
                            $vhtml .= '<p>'.$rec->minSalary.' - '.$rec->maxSalary.' '.$rec->currency.'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.poston').'</p>';
                             $vhtml .= '<p>'.date('M d, Y',strtotime($rec->createdTime)).'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title">'.trans('home.lastdate').'</p>';
                            $vhtml .= '<p>'.date('M d, Y',strtotime($rec->expiryDate)).'</p>';
                        $vhtml .= '</li>';
                    $vhtml .= '</ul>';
                    $cLogo = url('compnay-logo/default-logo.jpg');
                    if($rec->companyLogo != ''){
                    	$cLogo = url('compnay-logo/'.$rec->companyLogo);
                    }
					
                     $string = strip_tags($rec->description);
                        if (strlen($string) > 100) {

                        // truncate string
                            $stringCut = substr($string, 0, 600);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            $string .= '<a href="'.$viewUrl.'">... ReadMore</a>';
                        }
                   

                   
                    $vhtml .= '<p class="js-note">'.$string.'<img style="padding-top: 17px;" src="'.$cLogo.'" width="100"></p>';
                    $vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.JobCallMe::cityName($rec->city).', '.JobCallMe::countryName($rec->country).'<span class="pull-right" style="color: #999999;margin-top: 28px;">'.date('M d,Y',strtotime($rec->createdTime)).'</span></p>';
				
				$job = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyLogo');
				$job->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
				$job->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
				$job->where('jcm_jobs.status','=','1');
				$job->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
				$job->where('jcm_jobs.category','=',$rec->category);
				$results = $job->limit(1)->inRandomOrder()->get();
				//dd($results);
				
				foreach($results as $sim)
				{
					$comUrl = url('companies/company/'.$sim->companyId);
					$cityUrl = url('jobs?city='.$sim->city);
					$vhtml .= '<p style="color: #999999;text-transform: uppercase;"><a style="color: #999999;" href="'.$cityUrl.'">'.trans('home.similerjob').'  '.JobCallMe::cityName($sim->city).'</a><span style="padding-left: 85px;" ><a style="color: #999999;" href="'.$comUrl.'">'.trans('home.jobIn').' '.$sim->companyName.'</a></span></p>';
				}
				$vhtml .= '</div>';
			}
		}else{
			$vhtml  = '<div class="jobs-suggestions">';
				$vhtml .= '<p class="js-note" style="text-align:center;">No Matching record found</p>';
			$vhtml .= '</div>';
		}
		return view('frontend.advance-job2',compact('vhtml','result'));

	}


	public function viewJob(Request $request){
		
		$jobId = $request->segment(2);

		$jobrs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.*');
		$jobrs->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId');
		$jobrs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobrs->where('jcm_jobs.status','=','1');
		$jobrs->where('jcm_jobs.jobId','=',$jobId);
		$job = $jobrs->first();
		//dd($job);
		$userId = $request->session()->get('jcmUser')->userId;
		//dd($userId);

		if(count($job) == 0){
			return redirect('jobs');
		}
		

		$savedJobArr = array();
		$followArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
			$followArr = @explode(',', $meta->follow);
		}
		
		$sug = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.*');
		$sug->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId');
		$sug->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		
		$suggest=$sug->where('jcm_jobs.country','=',JobCallMe::getHomeCountry())->limit(5)->get();
		$jobApplied = JobCallMe::isAppliedToJob($userId,$jobId);
				$benefits = @explode(',', $job->benefits);
				$process = @explode(',', $job->process);
		     //dd($benefits);

		return view('frontend.view-job-detail',compact('job','savedJobArr','followArr','userId','suggest','jobApplied','benefits','process'));
		
	}

	public function jobApply(Request $request){
		$app = $request->session()->get('jcmUser');

		if(JobCallMe::isResumeBuild($app->userId) == false){
			$fNotice = 'To apply on jobs please build your resume. <a href="'.url('account/jobseeker/resume').'">Click Here</a> To create your resume';
			$request->session()->put('fNotice',$fNotice);
			return redirect('account/jobseeker/resume');
		}
		if($request->isMethod('post')){
			if(!$request->session()->has('jcmUser')){
	    		return redirect('account/login?next='.$request->route()->uri);
	    	}

	    	$jobId = trim($request->input('jobId'));

	    	$input = array('userId' => $app->userId, 'jobId' => $jobId, 'applyTime' => date('Y-m-d H:i:s'));
	    	$currentjob = DB::table('jcm_jobs')->where('jobId',$jobId)->first();
	    	$questionaire_id = $currentjob->questionaire_id;

	    	/* check if this job has questionaire or not if has add one extra step*/
	    	if($questionaire_id != ''){
	    		$quesdata = DB::table('jcm_questionnaire')->where('ques_id',$questionaire_id)->first();
	    		$questiondata = DB::table('jcm_questions')->where('ques_id',$quesdata->ques_id)->get();
	    		DB::table('jcm_job_applied')->insert($input);
	    		return view('frontend.employer.questionaireScreen',compact('currentjob','quesdata','questiondata'));
	    	}
	    	/* insert apply job data to database*/
	    	DB::table('jcm_job_applied')->insert($input);
	    	return redirect('account/jobseeker');
		}else{
			$jobId = $request->segment(3);
			$job = DB::table('jcm_jobs')->where('jobId','=',$jobId)->first();

			if(count($job) == 0){
				return redirect('jobs');
			}

			$jobApplied = JobCallMe::isAppliedToJob($app->userId,$jobId);

			return view('frontend.job-apply',compact('job','jobApplied'));
		}
	}
}
