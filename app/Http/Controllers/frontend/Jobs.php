<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Mail;
use Illuminate\Support\Facades\Lang;

class Jobs extends Controller{
    public function home(Request $request){
		//if(!$request->session()->has('jcmUser')){
    		//return redirect('account/login?next='.$request->route()->uri);
    	//}
		return view('frontend.view-jobs');
	}
	public function ajexhome(Request $request){
		//dd($request->all());
	
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		
		$_find = trim($request->input('_find'));
		$keyword = trim($request->input('keyword'));
		$categoryId = trim($request->input('categoryId'));
		$htype = trim($request->input('htype'));
		$dtype = trim($request->input('dtype'));
		$jobType = trim($request->input('jobType'));
		$jobShift = trim($request->input('jobShift'));
		$head = trim($request->input('head'));
		$dispatch = trim($request->input('dispatch'));
		$careerLevel = trim($request->input('careerLevel'));
		$experience = trim($request->input('experience'));
		$minSalary = trim($request->input('minSalary'));
		$maxSalary = trim($request->input('maxSalary'));
		$country = trim($request->input('country'));
		$state = trim($request->input('state'));
		$city = trim($request->input('city'));
		$countrys = trim($request->input('countrys'));
		$states = trim($request->input('states'));
		$cityss = trim($request->input('cityss'));
		$currency = trim($request->input('currency'));
		$userinfo=$request->session()->get('jcmUser')->userId;
		$usercountry=$request->session()->get('jcmUser')->country;
		
		$savedJobArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
		}

		
		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyAddress','jcm_companies.companyLogo');
		$jobs->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
		$jobs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobs->where('jcm_jobs.status','=','1');
		$jobs->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
		if($country == '0' || $country == "") $jobs->where('jcm_jobs.country','=','1');
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
		if($cityss == ''){
			$cityss= 0;
		}
		
		
		$cityss = JobCallMe::cityId($cityss);
		if($country != '0' && $country != "") $jobs->where('jcm_jobs.country','=',$country);
		if($countrys != '0' && $countrys != "") $jobs->where('jcm_jobs.country','=',$countrys);
		if($categoryId != '') $jobs->where('jcm_jobs.category','=',$categoryId);
		if($htype != '') $jobs->where('jcm_jobs.head','=',$htype);
		if($dtype != '') $jobs->where('jcm_jobs.dispatch','=',$dtype);
		if($jobType != '') $jobs->where('jcm_jobs.jobType','=',$jobType);
		if($jobShift != '') $jobs->where('jcm_jobs.jobShift','=',$jobShift);
		if($careerLevel != '') $jobs->where('jcm_jobs.careerLevel','=',$careerLevel);
		if($experience != '') $jobs->where('jcm_jobs.experience','=',$experience);
		if($head != '') $jobs->where('jcm_jobs.head','=',$head);
		if($dispatch != '') $jobs->where('jcm_jobs.dispatch','=',$dispatch);
		if($minSalary != '') $jobs->where('jcm_jobs.minSalary','<=',$minSalary);
		if($maxSalary != '') $jobs->where('jcm_jobs.maxSalary','>=',$maxSalary);
		if($state != '0' && $state != "") $jobs->where('jcm_jobs.state','=',$state);
		if($city != '0') $jobs->where('jcm_jobs.city','=',$city);
		if($states != '0' && $states != "") $jobs->where('jcm_jobs.state','=',$states);
		if($cityss != '0') $jobs->where('jcm_jobs.city','=',$cityss);
		if($currency != '') $jobs->where('jcm_jobs.currency','=',$currency);
		$jobs->where('jcm_jobs.jobStatus','=','Publish');
		if($keyword != ''){
			$jobs->where(function ($query) use ($keyword) {
				$expl = @explode(' ', $keyword);
				foreach($expl as $kw){
					$query->orWhere('jcm_jobs.title','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_jobs.skills','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_companies.companyName','LIKE','%'.$kw.'%');
				}
			});
		}
	
		$app = $request->session()->get('jcmUser');
		
		$result = $jobs->orderBy('createdTime','desc')->paginate(7);
		//$result = $jobs->orderBy('jobId','desc')->paginate(8);
		
		//dd($result);
		$head = '';
		$f_company='';
		$vhtml = '';
		$category ='';
		echo '<div class="jobs-suggestions" style="background: none;box-shadow: none;border: none;padding: 0;margin-bottom: 6px;
		">'.$result->render().'</div>';
		if(count($result) > 0){
			foreach($result as $rec){
				$jobApplied = JobCallMe::isAppliedToJob($app->userId,$rec->jobId);

				$job_work = DB::table('jobentity')->where('ID',$rec->work_idx)->first();
				
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
					$vhtml .= '<div class="" style="padding-top:30px;position: absolute;top: 13px;right: 16px;">';
					
					if($rec->jobreceipt01 != ""){
						if($jobApplied == true){
							$vhtml .= '<a href="javascript:void();" class="btn btn-success btn-xs" disabled>'.trans('home.applied').'</a>';
						}
						else{
							$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs">'.trans('home.apply').'</a>';
						}
					}
					elseif($rec->jobreceipt02 != "" and $rec->jobhomgpage != ""){
                        $vhtml .= '<a href="'.$rec->jobhomgpage.'" class="btn btn-primary btn-xs" style="margin-right: 10px;" target="_blank">'.trans('home.jobhomepageapply').'</a>';
					}
					elseif($rec->jobreceipt07 != ""){
                        if($job_work->email){
							//$vhtml .= '<a  href="'.$viewUrl.'" class="btn btn-primary btn-xs" style="margin-right: 10px;">'.trans('home.emailapply').'['.$job_work->email.']</a>';
							$vhtml .= '<a href="javascript:;" class="btn btn-primary btn-xs" onclick="dialogclick2(\''.$job_work->email.'\')" style="margin-right: 10px;">'.trans('home.emailapply').'</a>';
						}else{
							$vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.emailapply').'</a>';
						}
							
					}
					elseif($rec->jobreceipt05 != ""){
                        $vhtml .= '<a href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.telephoneapply').'</a>';
					}
					elseif($rec->jobreceipt06 != ""){
                        $vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.faxapply').'</a>';
					}
					elseif($rec->jobreceipt04 != ""){
                        $vhtml .= '<button class="btn btn-primary btn-xs opener" onclick="dialogclick3(\''.$rec->companyAddress.'\')" style="margin-right: 10px;">'.trans('home.visitapply').'</button>';
					}
					elseif($rec->jobreceipt03 != ""){
                        $vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick3(\''.$rec->companyAddress.'\')" style="margin-right: 10px;" target="_blank">'.trans('home.postapply').'</a>';
					}
					
					
					
				
				
                        if(in_array($rec->jobId, $savedJobArr)){
	                        $vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;" disabled >'.trans('home.saved').'</a>';
	                    }else{
	                    	$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;">'.trans('home.save').'</a>';
	                    }
                    $vhtml .= '</div>';
				}
				if($rec->f_company == "yes")
				{
					$f_company='<span class="label" style="background-color:orange;font-size: 49% !important;">Foreign Co</span>';
				}
				else{
					$f_company="";
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

					if(app()->getLocale() == "kr"){
						if($rec->expiryDate == "2100-12-31"){
							$joblist_date = date('Y-m-d',strtotime($rec->createdTime));
							$joblist_date2 = "채용시 마감<br>(채용공고참조)";
						}else{
							if($rec->expiryDate == date('Y-m-d')){
								$joblist_date = date('Y-m-d',strtotime($rec->createdTime));
								$joblist_date2 = trans('home.daytoday');
							}else{
								$joblist_date = date('Y-m-d',strtotime($rec->createdTime));
								$joblist_date2 = date('Y-m-d',strtotime($rec->expiryDate));
							}							
						}
					}else{
						if($rec->expiryDate == "2100-12-31"){
							$joblist_date = date('M d, Y',strtotime($rec->createdTime));
							$joblist_date2 = "Untill Hire";
						}else{
							if($rec->expiryDate == date('Y-m-d')){
								$joblist_date = date('M d, Y',strtotime($rec->createdTime));
								$joblist_date2 = trans('home.daytoday');
							}else{
								$joblist_date = date('M d, Y',strtotime($rec->createdTime));
								$joblist_date2 = date('M d, Y',strtotime($rec->expiryDate));
							}
							
						}
					}
					

					if($rec->currency == "KRW" or $rec->currency == "KRW|대한민국 원"){
						$salarycurrency = '원';
					}else{
						$salarycurrency = $rec->currency;
					}

					if($rec->afterinterview != ""){
						$Salary_money = trans('home.'.$rec->afterinterview);						
					}else{
						$Salary_money = number_format($rec->minSalary).' - '.number_format($rec->maxSalary).' '.$salarycurrency;						
					}
              
				$colorArr = array('purple','green','darkred','orangered','blueviolet');
                    $vhtml .= '<h4><a href="'.$viewUrl.'">'.$rec->title.' <span class="label" style="background-color:'.$colorArr[array_rand($colorArr)].'">' .$rec->p_title.'</span></a>  '.$head.' '.$dispatch.' '.$f_company.' </h4>';
                    $vhtml .= '<p style="font-size:15px;color:#113886;"><b>'.$rec->companyName.'</b></p>';
                    $vhtml .= '<ul class="js-listing">';
                    	$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000;">'.trans('home.jobtype').'</p>';
                            $vhtml .= '<p>'.trans('home.'.$rec->jobType).'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000;">'.trans('home.shift').'</p>';
                            $vhtml .= '<p>'.trans('home.'.$rec->jobShift).'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000;">'.trans('home.experience').'</p>';
                            if($rec->work_idx){
							$vhtml .= '<p>'.$job_work->Eligibility_Career.'</p>';
							}else{
							$vhtml .= '<p>'.trans('home.'.$rec->experience).'</p>';
							}	
                        $vhtml .= '</li>';
                        $vhtml .= '<li style="border-right: 0px solid #cccccc;">';
                            $vhtml .= '<p class="js-title" style="color:#008000;">'.trans('home.salary').'</p>';
                            if($rec->work_idx){
							$vhtml .= '<p>'.$job_work->WorkingCondition_Wage.'</p>';
							}else{
							$vhtml .= '<p>'.$Salary_money.'</p>';
							}
                        $vhtml .= '</li>';
						$vhtml .= '<li style="border-right: 0px solid #cccccc;">';
                            $vhtml .= '<p class="js-title" style="color:#0000ff;">'.trans('home.poston').'</p>';
                             $vhtml .= '<p>'.$joblist_date.'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#ff4500;">'.trans('home.lastdate').'</p>';
                            $vhtml .= '<p>'.$joblist_date2.'</p>';
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
                            $string .= '<a href="'.$viewUrl.'">... '.trans('home.Read More').'</a>';
                        }
                   

                   
                    $vhtml .= '<p class="js-note">'.$string.'<img style="padding-top: 17px;margin-top:10px;" src="'.$cLogo.'" width="100"></p>';
                    $vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.trans('home.'.JobCallMe::cityName($rec->city)).', '.trans('home.'.JobCallMe::countryName($rec->country)).'<span class="pull-right" style="color: #0000ff;margin-top: 70px;">'.$joblist_date.'</span></p>';
				
				// $job = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyLogo');
				// $job->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
				// $job->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
				// $job->where('jcm_jobs.status','=','1');
				// $job->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
				// $job->where('jcm_jobs.category','=',$rec->category);
				// $results = $job->limit(1)->inRandomOrder()->get();
				//dd($results);
				
				// foreach($results as $sim)
				// {
					$comUrl = url('companies/company/'.$rec->companyId);
					 $cityUrl = url('jobs?state='.$rec->state);
					$vhtml .= '<p style="color: #999999;text-transform: capitalize;"><a style="color: #999999;" href="'.$cityUrl.'"><span style="color:#337ab7">'.trans('home.similerjob').'</span>  '.trans('home.'.JobCallMe::stateName($rec->state)).'</a><br><span style="padding-left: 0px;" ><a style="color: #337ab7;" href="'.$comUrl.'">'.trans('home.jobIn').' <span style="color:#999999"> '.$rec->companyName.'</span></a></span></p>';
				// }
				$vhtml .='</div>';
			}
		}else{
			$vhtml  = '<div class="jobs-suggestions">';
				$vhtml .= '<p class="js-note" style="text-align:center;">'.trans('home.No Matching record found').'</p>';
			$vhtml .= '</div>';
		}
		echo $vhtml,$result->render();
		//echo $result->render();
	}
	public function searchJobs(Request $request){
		//dd($request->all());
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		
		$_find = trim($request->input('_find'));
		$keyword = trim($request->input('keyword'));
		$categoryId = trim($request->input('categoryId'));
		$subCategory = trim($request->input('subCategory'));
		$subCategory2 = trim($request->input('subCategory2'));
		$htype = trim($request->input('htype'));
		$dtype = trim($request->input('dtype'));
		$jobType = trim($request->input('jobType'));
		$jobShift = trim($request->input('jobShift'));
		$head = trim($request->input('head'));
		$dispatch = trim($request->input('dispatch'));
		$careerLevel = trim($request->input('careerLevel'));
		$experience = trim($request->input('experience'));
		$minSalary = trim($request->input('minSalary'));
		$maxSalary = trim($request->input('maxSalary'));
		$country = trim($request->input('country'));
		$state = trim($request->input('state'));
		$city = trim($request->input('city'));
		$countrys = trim($request->input('countrys'));
		$states = trim($request->input('states'));
		$cityss = trim($request->input('cityss'));
		$currency = trim($request->input('currency'));
		$userinfo=$request->session()->get('jcmUser')->userId;
		
		
		$savedJobArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
		}

		
		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyName','jcm_companies.companyAddress','jcm_companies.companyLogo');
		$jobs->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
		$jobs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobs->where('jcm_jobs.status','=','1');
		//if($country == '0' || $country == "") $jobs->where('jcm_jobs.country','=','1');
		//$jobs->where('jcm_jobs.country','=','1');
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
		if($cityss == ''){
			$cityss= 0;
		}
		
		
		$cityss = JobCallMe::cityId($cityss);
		if($country != '0' && $country != "") $jobs->where('jcm_jobs.country','=',$country);
		
		if($countrys != '0' && $countrys != "") $jobs->where('jcm_jobs.country','=',$countrys);
		if($categoryId != '') $jobs->where('jcm_jobs.category','=',$categoryId);
		if($subCategory != '') $jobs->where('jcm_jobs.subCategory','=',$subCategory);
		if($subCategory2 != '') $jobs->where('jcm_jobs.subCategory2','=',$subCategory2);
		if($htype != '') $jobs->where('jcm_jobs.head','=',$htype);
		if($dtype != '') $jobs->where('jcm_jobs.dispatch','=',$dtype);
		if($jobType != '') $jobs->where('jcm_jobs.jobType','=',$jobType);
		if($jobShift != '') $jobs->where('jcm_jobs.jobShift','=',$jobShift);
		if($careerLevel != '') $jobs->where('jcm_jobs.careerLevel','=',$careerLevel);
		if($experience != '') $jobs->where('jcm_jobs.experience','=',$experience);
		if($head != '') $jobs->where('jcm_jobs.head','=',$head);
		if($dispatch != '') $jobs->where('jcm_jobs.dispatch','=',$dispatch);
		if($minSalary != '') $jobs->where('jcm_jobs.minSalary','<=',$minSalary);
		if($maxSalary != '') $jobs->where('jcm_jobs.maxSalary','>=',$maxSalary);
		if($state != '0' && $state != "") $jobs->where('jcm_jobs.state','=',$state);
		if($city != '0') $jobs->where('jcm_jobs.city','=',$city);
		if($states != '0' && $states != "") $jobs->where('jcm_jobs.state','=',$states);
		if($cityss != '0') $jobs->where('jcm_jobs.city','=',$cityss);
		if($currency != '') $jobs->where('jcm_jobs.currency','=',$currency);
		$jobs->where('jcm_jobs.jobStatus','=','Publish');
		if($keyword != ''){
			$jobs->where(function ($query) use ($keyword) {
				$expl = @explode(' ', $keyword);
				foreach($expl as $kw){
					$query->orWhere('jcm_jobs.title','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_jobs.skills','LIKE','%'.$kw.'%');
					$query->orWhere('jcm_companies.companyName','LIKE','%'.$kw.'%');
				}
			});
		}
		$app = $request->session()->get('jcmUser');

		$result = $jobs->orderBy('createdTime','desc')->paginate(7);
		$rr=sizeof($result);
		//$result = $jobs->orderBy('jobId','desc')->paginate(8);
		

		$head = '';
		$f_company = '';
		$vhtml = '';
		$category ='';
		if(count($result) > 0){
			foreach($result as $rec){
				$jobApplied = JobCallMe::isAppliedToJob($app->userId,$rec->jobId);

				$job_work = DB::table('jobentity')->where('ID',$rec->work_idx)->first();
				
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
					$vhtml .= '<div class="js-action" style="padding-top:30px">';
					
					if($rec->jobreceipt01 != ""){
						if($jobApplied == true){
							$vhtml .= '<a href="javascript:void();" class="btn btn-success btn-xs" disabled>'.trans('home.applied').'</a>';
						}
						else{
							$vhtml .= '<a href="'.$applyUrl.'" class="btn btn-primary btn-xs">'.trans('home.apply').'</a>';
						}
					}
					elseif($rec->jobreceipt02 != "" and $rec->jobhomgpage != ""){
                        $vhtml .= '<a href="'.$rec->jobhomgpage.'" class="btn btn-primary btn-xs" style="margin-right: 10px;" target="_blank">'.trans('home.jobhomepageapply').'</a>';
					}
					elseif($rec->jobreceipt07 != ""){
                        if($job_work->email){
							$vhtml .= '<a href="javascript:;" class="btn btn-primary btn-xs" onclick="dialogclick2(\''.$job_work->email.'\')" style="margin-right: 10px;">'.trans('home.emailapply').'</a>';
						}else{
							$vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.emailapply').'</a>';
						}
					}	
					elseif($rec->jobreceipt05 != ""){
                        $vhtml .= '<a href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.telephoneapply').'</a>';
					}
					elseif($rec->jobreceipt06 != ""){
                        $vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick()" style="margin-right: 10px;" target="_blank">'.trans('home.faxapply').'</a>';
					}
					elseif($rec->jobreceipt04 != ""){
                        $vhtml .= '<button class="btn btn-primary btn-xs opener" onclick="dialogclick3(\''.$rec->companyAddress.'\')" style="margin-right: 10px;">'.trans('home.visitapply').'</button>';
					}
					elseif($rec->jobreceipt03 != ""){
                        $vhtml .= '<a  href="javascript:(0)" class="btn btn-primary btn-xs" onclick="dialogclick3(\''.$rec->companyAddress.'\')" style="margin-right: 10px;" target="_blank">'.trans('home.postapply').'</a>';
					}
					
				
				
                        if(in_array($rec->jobId, $savedJobArr)){
	                        $vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-success btn-xs" style="margin-left: 10px;" disabled >'.trans('home.saved').'</a>';
	                    }else{
	                    	$vhtml .= '<a href="javascript:;" onclick="saveJob('.$rec->jobId.',this)" class="btn btn-default btn-xs" style="margin-left: 10px;">'.trans('home.save').'</a>';
	                    }
                    $vhtml .= '</div>';
				}
				if($rec->f_company == "yes")
				{
					$f_company='<span class="label" style="background-color:orange;float: right;">Foreign Co</span>';
				}
				else{
					$f_company="";
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

					if(app()->getLocale() == "kr"){
						if($rec->expiryDate == "2100-12-31"){
							$joblist_date = date('Y-m-d',strtotime($rec->createdTime));
							$joblist_date2 = "채용시 마감<br>(채용공고참조)";
						}else{
							$joblist_date = date('Y-m-d',strtotime($rec->createdTime));
							$joblist_date2 = date('Y-m-d',strtotime($rec->expiryDate));
						}
					}else{
						if($rec->expiryDate == "2100-12-31"){
							$joblist_date = date('M d, Y',strtotime($rec->createdTime));
							$joblist_date2 = "Untill Hire";
						}else{
							$joblist_date = date('M d, Y',strtotime($rec->createdTime));
							$joblist_date2 = date('M d, Y',strtotime($rec->expiryDate));
						}
					}
					

					if($rec->currency == "KRW" or $rec->currency == "KRW|대한민국 원"){
						$salarycurrency = '원';
					}else{
						$salarycurrency = $rec->currency;
					}

					if($rec->afterinterview != ""){
						$Salary_money = trans('home.'.$rec->afterinterview);						
					}else{
						$Salary_money = number_format($rec->minSalary).' - '.number_format($rec->maxSalary).' '.$salarycurrency;						
					}

				$colorArr = array('purple','green','darkred','orangered','blueviolet');
                    $vhtml .= '<h4><a href="'.$viewUrl.'">'.$rec->title.' <span class="label" style="background-color:'.$colorArr[array_rand($colorArr)].'">' .$rec->p_title.'</span></a>  '.$head.' '.$dispatch.' '.$f_company .' </h4>';
                    $vhtml .= '<p style="font-size:15px;color:#113886;"><b>'.$rec->companyName.'</b></p>';
                    $vhtml .= '<ul class="js-listing">';
                    	$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000; border-right: 1px solid;">'.trans('home.jobtype').'</p>';
                            $vhtml .= '<p>'.trans('home.'.$rec->jobType).'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000; border-right: 1px solid;">'.trans('home.shift').'</p>';
                            $vhtml .= '<p >'.trans('home.'.$rec->jobShift).'</p>';
                        $vhtml .= '</li>';
                        $vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#008000; border-right: 1px solid;">'.trans('home.experience').'</p>';
                            if($rec->work_idx){
							$vhtml .= '<p>'.$job_work->Eligibility_Career.'</p>';
							}else{
							$vhtml .= '<p >'.trans('home.'.$rec->experience).'</p>';
							}
                        $vhtml .= '</li>';
                        $vhtml .= '<li style="border-right: 0px solid #cccccc; ">';
                            $vhtml .= '<p class="js-title" style="color:#008000; border-right: 1px solid;">'.trans('home.salary').'</p>';
                            if($rec->work_idx){
							$vhtml .= '<p>'.$job_work->WorkingCondition_Wage.'</p>';
							}else{
							$vhtml .= '<p >'.$Salary_money.'</p>';
							}	
                        $vhtml .= '</li>';
						$vhtml .= '<li style="border-right: 0px solid #cccccc;">';
                            $vhtml .= '<p class="js-title" style="color:#0000ff; border-right: 1px solid;">'.trans('home.poston').'</p>';
                             $vhtml .= '<p >'.$joblist_date.'</p>';
                        $vhtml .= '</li>';
						$vhtml .= '<li>';
                            $vhtml .= '<p class="js-title" style="color:#ff4500;">'.trans('home.lastdate').'</p>';
                            $vhtml .= '<p >'.$joblist_date2.'</p>';
                        $vhtml .= '</li>';
                    $vhtml .= '</ul>';
                    $cLogo = url('compnay-logo/default-logo.jpg');
                    
						if($rec->work_idx){
							
							$is_file_exist = file_exists('compnay-logo/'.$rec->work_id.'_Logo.jpg');

							  if ($is_file_exist) {
								$cLogo = url('compnay-logo/'.$rec->work_id.'_Logo.jpg');
							}

							
						}else{
							if($rec->companyLogo != ''){
								$cLogo = url('compnay-logo/'.$rec->companyLogo);
							}
						}	

						if($rec->work_idx){
							$string = strip_tags($job_work->jobdescription);
						 }else{
								$string = strip_tags($rec->description);
						 }
					
                   
                        if (strlen($string) > 100) {

                        // truncate string
                            $stringCut = substr($string, 0, 600);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            $string .= '<a href="'.$viewUrl.'">... '.trans('home.Read More').'</a>';
                        }
                   

                   
                    $vhtml .= '<p class="js-note">'.$string.'<img style="padding-top: 17px;margin-top:10px;" src="'.$cLogo.'" width="100"></p>';
					if($rec->work_idx){
						$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);							

							$vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.$name_array[0]." ".$name_array[1].', '.trans('home.'.JobCallMe::countryName($rec->country)).'<span class="pull-right" style="color: #0000ff;margin-top: 70px;">'.$joblist_date.'</span></p>';
					 }else{
							if(JobCallMe::cityName($rec->city)){
							$vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.trans('home.'.JobCallMe::cityName($rec->city)).', '.trans('home.'.JobCallMe::countryName($rec->country)).'<span class="pull-right" style="color: #0000ff;margin-top: 70px;">'.$joblist_date.'</span></p>';
							}else{
							$vhtml .= '<p class="js-location"><i class="fa fa-map-marker"></i> '.trans('home.'.JobCallMe::stateName($rec->state)).', '.trans('home.'.JobCallMe::countryName($rec->country)).'<span class="pull-right" style="color: #0000ff;margin-top: 70px;">'.$joblist_date.'</span></p>';
							}
					 }	

                    
				
				// $job = DB::table('jcm_jobs')->select('*');
				// $job->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
				
				// $job->where('jcm_jobs.status','=','1');
				// $job->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
				// $job->where('jcm_jobs.category','=',$rec->category);
				// $results = $job->limit(1)->inRandomOrder()->get();
				//dd($results);
				
				// foreach($results as $sim)
				// {
					$comUrl = url('companies/company/'.$rec->companyId);
					 $cityUrl = url('jobs?state='.$rec->state);
					$vhtml .= '<p style="color: #999999;text-transform: capitalize;"><a style="color: #999999;" href="'.$cityUrl.'"><span style="color:#337ab7">'.trans('home.similerjob').'</span>  '.trans('home.'.JobCallMe::stateName($rec->state)).'</a><br><span style="padding-left: 0px;" ><a style="color: #337ab7;" href="'.$comUrl.'">'.trans('home.jobIn').' <span style="color:#999999"> '.$rec->companyName.'</span></a></span></p>';
				// }
				$vhtml .='</div>';
			}
		}else{
			$vhtml  = '<div class="jobs-suggestions">';
				$vhtml .= '<p class="js-note" style="text-align:center;">'.trans('home.No Matching record found').'</p>';
			$vhtml .= '</div>';
		}
		echo $vhtml,$result->render();
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
		//if(!$request->session()->has('jcmUser')){
    		//return redirect('account/login?next='.$request->route()->uri);
    	//}
		
		$jobId = $request->segment(2);
		//dd($jobId);

		$jobrs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_jobs.category as jobcategory','jcm_payments.title as p_title','jcm_companies.*');
		$jobrs->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId');
		$jobrs->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		$jobrs->where('jcm_jobs.status','=','1');
		$jobrs->where('jcm_jobs.jobId','=',$jobId);
		$job = $jobrs->first();
		//dd($job->companyId);
		$userId = $request->session()->get('jcmUser')->userId;
		//dd($job);

		if(count($job) == 0){
			return redirect('jobs');
		}
		
		$input['userId']=$jobId;
		if($userId){
			$input['checker_id']=$userId;
		}else{
			$input['checker_id']='0';   //로그인없이 채용공고 광고 클릭할경우
		}
		$input['h_type']='Job';
		DB::table('jcm_history')->insert($input);

		$jobcount=DB::table('jcm_history')->where('userId',$jobId)->where('h_type','Job')->count();
		$applycount=DB::table('jcm_job_applied')->where('jobId',$jobId)->count();
		$reviewcount=DB::table('jcm_companyreview')->where('company_id',$job->companyId)->count();
		$learncount=DB::table('jcm_upskills')->where('companyId',$job->companyId)->count();
		$ncount=DB::table('jcm_users_meta')->select('follow')->get();
		$Arr = @explode(',', $ncount);
		$fellow=count(array_keys($Arr, $job->companyId));
		
		$savedJobArr = array();
		$followArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
			$followArr = @explode(',', $meta->follow);
		}
		
		//$sug = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.*');
		$sug = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.*');
		$sug->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId');
		//$sug->Join('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id');
		
		$suggest=$sug->where('jcm_jobs.country','=',JobCallMe::getHomeCountry())->where('jcm_jobs.category','=',$job->jobcategory)->where('jcm_jobs.expiryDate','>=',date('Y-m-d'))->orderBy('jobId','desc')->limit(5)->get();
		$jobApplied = JobCallMe::isAppliedToJob($userId,$jobId);
				$benefits = @explode(',', $job->benefits);
				$process = @explode(',', $job->process);
		     //dd($benefits);
			$companyReview = DB::table('jcm_companyreview')->where('company_id',$job->companyId)->get();
			
			$companyRecommended= DB::table('jcm_companyreview')->where('company_id',$job->companyId)->where('recommend_ceo','Recommended')->get();
			$companyon= DB::table('jcm_companyreview')->where('company_id',$job->companyId)->where('recommend','on')->get();
			$companygrowing= DB::table('jcm_companyreview')->where('company_id',$job->companyId)->where('future','Growing Up')->get();
			
			$allrec=count($companyReview);
			$percec=count($companyRecommended);
			$peron=count($companyon);
			$pergrowing=count($companygrowing);
			$allrecmond=$allrec == 0 ? 0 : ($percec*100/$allrec);
			$allon=$allrec == 0 ? 0 : ($peron*100/$allrec);
			$allgrowing=$allrec == 0 ? 0 : ($pergrowing*100/$allrec);
			//dd($allrecmond);

		$job_work = DB::table('jobentity')->where('ID',$job->work_idx)->first();	
		$job_work2 = DB::table('employer')->where('ID','=',$job->work_id)->first();	

			
		return view('frontend.view-job-detail',compact('allgrowing','allon','allrecmond','fellow','learncount','reviewcount','applycount','jobcount','companyReview','job','savedJobArr','followArr','userId','suggest','jobApplied','benefits','process','job_work','job_work2'));
		
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
			$alert=DB::table('jcm_account_alert')->where('userId',$currentjob->userId)->first();
			//dd($alert->newApplication);

			if($alert->newApplication == 'Yes'){
			$secid=DB::table('jcm_users')->where('userId',$currentjob->userId)->first();
			$secidtoview = array($secid);
			
			//dd($secidtoview);


            $toemail=$secidtoview[0]->email;
			
			Mail::send('emails.applyjob',['data'=>$currentjob,'userdata'=>$secid],function($message) use ($toemail) {
				$message->to($toemail)->subject(trans('home.Jobseeker apply job'));
			});
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
