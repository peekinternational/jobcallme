@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')
 <?php 
 //print_r($job); die;
     $cLogo = url('compnay-logo/default-logo.jpg');
       
					 if($job->work_id){
						
						  $is_file_exist = file_exists('compnay-logo/'.$job->work_id.'_Logo.jpg');

						  if ($is_file_exist) {
							$cLogo = url('compnay-logo/'.$job->work_id.'_Logo.jpg');
						  }


						
					}else{
						if($job->companyLogo != ''){
							$cLogo = url('compnay-logo/'.$job->companyLogo);
						 }
					}

	   
              ?>
<?php
$head='';
$travelFound=false;			
$dispatch='';
$f_company='';
$onlynational='';
$anynational='';
            if($job->f_company == "yes")		
					{		
				$f_company='<span class="label" style="background-color:orange;font-size: 49% !important;float:right;">Foreign Co</span>';		
				}		
				else{		
					$f_company="";		
				}
               if($job->head == "yes")		
					{		
				$head='<span class="label" style="background-color:green">Headhunting</span>';		
				}		
				else{		
					$head="";		
				}		
					if($job->dispatch == "yes")		
					{		
						$dispatch='<span class="label" style="background-color:blue">Dispatch & Agency</span>';		
                    }					
                    else{		
					    $dispatch="";		
                    }

                
                if($job->anynational == "yes")		
                {		
                   $anynational=trans('home.anynationality');		
                }		
            else{		
                $anynational="";		
            }		
                if($job->onlynational == "yes")		
                {		
                    $onlynational=trans('home.only').' '.trans('home.'.JobCallMe::countryName($job->country)).' '.trans('home.nationality');	
                }	
                else{		
                $onlynational="";		
            }
?>
<section id="jobs">
    <div class="container">
        <div class="col-md-9">
        <div id="dialog1" title="@lang('home.www.jobcallme.com Detail:')" hidden="hidden"><span><center><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#f0ad4e;font-size:25px;"></i></center> @lang('home.Search directly from company information and apply directly.')</span><br></div>
		<div id="dialog2" title="@lang('home.www.jobcallme.com Detail:')" hidden="hidden"><span>@lang('home.email') : {{ $job_work->email }}</span><br><center><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#f0ad4e;font-size:15px;"></i></center>위 개인정보(연락처 및 이메일 등)는 채용 및 취업을 위해서 제공된 정보입니다. 용도 이외의 목적(영리목적의 광고, 자격증 대여 문의 등)으로 사용할 경우 개인정보보호법 위반으로 5년 이하의 징역 또는 5천만원 이하의 벌금에 처할 수 있습니다.</div>
		<div id="dialog3" title="@lang('home.www.jobcallme.com Detail:')" hidden="hidden"><span>{{ $job_work2->CompanyAddress }}<br><center><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#f0ad4e;font-size:15px;"></i></center>위 개인정보(연락처 및 이메일 등)는 채용 및 취업을 위해서 제공된 정보입니다. 용도 이외의 목적(영리목적의 광고, 자격증 대여 문의 등)으로 사용할 경우 개인정보보호법 위반으로 5년 이하의 징역 또는 5천만원 이하의 벌금에 처할 수 있습니다.</span><br></div>

            <div class="jobs-suggestions">
			<div style="display: -webkit-box;" class="suggestions-user-info">
			 <img src="{{ $cLogo }}"  style="width:118px;">	<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
			<div style="padding-left: 42px;">
			<span style="text-transform: uppercase;font-size: 20px;">{{$job->companyName}}</span><span style="text-transform: uppercase;font-size: 26px;">{!! $f_company !!}</span>
                <p style="font-size: 18px;margin-top: 24px; margin-left: 6px;">{{ $job->title }},  &nbsp;<span style="font-size: 13px; padding-top: 9px;">@lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country)) </span> &nbsp;<span class="label" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">
				{{ $job->p_title }}
				</span> &nbsp;{!! $head !!} <span style="font-size:9px;margin-left:13px">@lang('home.Never pay for job application, test or interview') <a href="{{ url('/safety')}}">@lang('home.More')</a></span></p>
				
				</div>
				
					
               
				</div>
               
			 
			@if($job->userId == $userId )
                <div class="jd-action-btn">

                </div>
			
			@else
				  <div class="jd-action-btn">
                    @if(strtotime($job->expiryDate) < strtotime(date('Y-m-d')))
                        <button class="btn btn-danger">@lang('home.s_close')</button>
                    
						@endif

					
						@if($job->jobreceipt01 == 'yes')
							@if($jobApplied == true)
								<a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-success">@lang('home.applied')</a>
							@else
								<a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-primary">@lang('home.apply')</a>
							@endif
                            @elseif($job->jobreceipt02 == 'yes')
							<a href="{{$job->jobhomgpage}}" class="btn btn-primary" style="margin-right: 10px;" target="_blank">@lang('home.jobhomepageapply')</a>
							@elseif($job->jobreceipt07 == 'yes')
								@if($job->work_idx)
									<button class="btn btn-primary" onclick="dialogclick2()" style="margin-right: 10px;" ><!-- <a href="{{$job->companyWebsite}}" style="color:#fff" target="_blank"> -->@lang('home.emailapply')<!-- </a> --></button>
								@else
									<button class="btn btn-primary" onclick="dialogclick()" style="margin-right: 10px;" >@lang('home.emailapply')</button>					
								@endif	
							@elseif($job->jobreceipt05 == 'yes')
							<button class="btn btn-primary" onclick="dialogclick()" style="margin-right: 10px;" >@lang('home.telephoneapply')</button>
                            @elseif($job->jobreceipt06 == 'yes')
							<button class="btn btn-primary" onclick="dialogclick()" style="margin-right: 10px;" >@lang('home.faxapply')</button>  
                            @elseif($job->jobreceipt04 == 'yes')
							<button class="btn btn-primary" onclick="dialogclick3()" style="margin-right: 10px;" >@lang('home.visitapply')</button>
							@elseif($job->jobreceipt03 == 'yes')
							<button class="btn btn-primary" onclick="dialogclick3()" style="margin-right: 10px;" >@lang('home.postapply')</button>  
                           			
                        @endif

					

                        @if(in_array($job->jobId, $savedJobArr))
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-success" style="margin-left: 10px;">@lang('home.saved')</a>
                        @else
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-default" style="margin-left: 10px;">@lang('home.save')</a>
                        @endif
                    
					
                </div>
			@endif
			
			
		
                
                <div class="jd-share-btn">
                    <a  href="javascript: void(0)" onClick="window.open('https://www.facebook.com/dialog/share?app_id=377749349357447&title=<?php echo $job->title; ?>&image=<?php echo $cLogo;?>&display=page&href=https%3A%2F%2Fwww.jobcallme.com%2Fjobs%2F<?php echo $job->jobId; ?>%2F&redirect_uri=https%3A%2F%2Fwww.jobcallme.com ');return false;">
                    	<i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('jobs/'.$job->jobId) }}&title=&summary=&source=">
                    	<i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status={{ url('jobs/'.$job->jobId) }}" target="_blank" >
                    	<i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url={{ url('jobs/'.$job->jobId) }}" target="_blank" >
                    	<i class="fa fa-google-plus" style="background: #F63E28;"></i> 
					</a>

                  <img src="{{asset('website/talksns.png')}}" onclick="OpenWindows('{{ url('jobs/'.$job->jobId) }}')" style="width: 25px !important;border-radius: 50px; cursor: pointer;">

                </div>
                <ul class="js-listing">
                    <li>
                        <p class="js-title " style="border-right: 1px solid;">@lang('home.jobtype')</p>
                        <p >@lang('home.'.$job->jobType)</p>
                    </li>
                    <li>
                        <p class="js-title" style="border-right: 1px solid;">@lang('home.shift')</p>
                        <p >@lang('home.'.$job->jobShift)</p>
                    </li>
                    <li>
                        <p class="js-title" style="border-right: 1px solid;">@lang('home.experience')</p>
                        @if($job->work_idx)
							<p>{{ $job_work->CareerConditions }} </p>		
						@else
							<p >@lang('home.'.$job->experience)</p>							
						@endif
						
                    </li>
                    <li>
                        <p class="js-title" style="border-right: 1px solid;">@lang('home.salary')</p>
                       
						<p >
						@if($job->work_idx)
							<p>{{ $job_work->wagecondition }} </p>		
						@else
							<p>
							@if($job->afterinterview != "")
								@lang('home.'.$job->afterinterview)
							@else
								{{ number_format($job->minSalary) }} - {{ number_format($job->maxSalary) }} @if($job->currency == "KRW" or $job->currency == "KRW|대한민국 원")
									원
								@else
									  {{ $job->currency }}
								@endif
							@endif
								</p>							
							@endif

						
						</p>
                    </li>
					<li>
                        <p class="js-title" style="border-right: 1px solid;">@lang('home.poston')</p>
                        <p >@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</p>
                    </li>
					<li>
                        <p class="js-title">@lang('home.lastdate')</p>

                        <p >
							@if(app()->getLocale() == "kr")
							    @if($job->expiryDate == "2100-12-31")								
									채용시 마감<br>(채용공고 참조)
								@else
									@if($job->expiryDate < date('Y-m-d'))
										@lang('home.Finished')
									@else
										@if($job->expiryDate == date('Y-m-d'))
											@lang('home.daytoday')
										@else
											{{ date('Y-m-d',strtotime($job->expiryDate))}}<span style="color:#d00000;font-size:15px;"><br><b>{{ JobCallMe::timeInDays($job->expiryDate) }}일 남음</b></span>
										@endif
										
									@endif
								@endif
							 
							@else
								@if($job->expiryDate == "2100-12-31")								
									Untill Hire
								@else
									@if($job->expiryDate < date('Y-m-d'))
										@lang('home.Finished')
									@else
										{{ date('M d, Y',strtotime($job->expiryDate))}}<span style="color:#d00000;font-size:15px;">&nbsp;<b>Day-{{ JobCallMe::timeInDays($job->expiryDate) }}</b></span>
									@endif
								@endif
							  
							@endif


						</p>

                    </li>
                </ul>
            </div>

            <!--JOB Details-->
            <div class="jd-job-details">
                <h4><span style="color:#337ab7">{{ $job->title }}</span> @if(app()->getLocale() == "kr")
							  @lang('home.'.JobCallMe::cityName($job->city)), @lang('home.'.JobCallMe::countryName($job->country))
						@else
							  at {{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}
						@endif</h4>

                <!--Large Screen-->
                <table class="table table-bordered hidden-xs hidden-sm">
                    <tbody>
                    <tr>

                     <td class="active" width="150px">@lang('home.category')</td>
                        <td colspan="3">
						@if($job->work_idx)
							{{ $job_work2->Sectors }}		
						@else
							@lang('home.'.JobCallMe::categoryTitle($job->jobcategory)) @if($job->subCategory)/ @lang('home.'.JobCallMe::subcategoryTitle($job->subCategory)) @endif @if($job->subCategory)/ @lang('home.'.JobCallMe::subcategoryTitle2($job->subCategory2))@endif					
						@endif
						</td>     


                                                                 
                    </tr>
                    
					<tr>
                        <td class="active" width="150px">@lang('home.jobaddr')</td>
                        <td>@if($job->work_idx)
							<?php
							$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);
							echo $name_array[0]." ";
							echo $name_array[1];
						?>		
						@else
							@if($job->jobaddr == 'Korea') @lang('home.'.$job->jobaddr) @else {{ $job->jobaddr }} @endif					
						@endif
						</td>   
                        <td class="active" width="150px">@lang('home.jobseekernationality')</td>
                        <td width="150px">{{$anynational}}{{$onlynational}}</td>                    
                    </tr>


					

					<tr>
                        <td class="active">@lang('home.Responsibilities')</td>
                        <td style="color:#337ab7">
						@if($job->work_idx)
							{{ $job_work->jobdescription }}	
						@else
							@if($job->jobType == 'Full Time/Contract Workers'){{ $job->title }} @else {{ $job->responsibilities }} @endif				
						@endif
						</td>
                        <td class="active">@lang('home.expptitle')</td>
                        <td>@lang('home.'.$job->expptitle)
							@if($job->expptitle == "")
							  @lang('home.'.$job->expposition)
							@else	
							  @if($job->expposition)&nbsp;|@lang('home.'.$job->expposition) @endif
							@endif
						
						</td>
                    </tr>
					<tr>
						<td class="active">@lang('home.careerlevel')</td>
                        <td>@lang('home.'.$job->careerLevel)</td>
                        <td class="active">@lang('home.Working day')</td>
                        <td>@if($job->work_idx)
							{{ $job_work->WorkingStyle }}	
						@else
							@if($job->jobdayval == "jobday10")
								{{ $job->jobdayval_text }}
							@else
								@lang('home.'.$job->jobdayval)
							@endif
						@endif</td>                        
                    </tr>
					<tr>
                        <td class="active">@lang('home.Working hours')</td>
                        <td>@if($job->work_idx)
							 <?php $name_array = explode("※", $job_work->workinghours);
							echo $name_array[0]."<br>";
							echo $name_array[1]."<br>";
							//echo $name_array[2];?>
								
						@else
							@lang('home.'.$job->jobhoursval) {{ $job->jobhoursval_text }}		
						@endif</td>
                        <td class="active">@lang('home.jobacademic')</td>
                        <td>
						@if($job->work_idx)
							{{ $job->jobacademic }}	
						@else
							@if($job->jobacademic_not == "yes")
								  @lang('home.Regardless Education')
							@else	
								  @lang('home.'.$job->jobacademic)
							@endif
							@if($job->jobgraduate == "yes")
								  @lang('home.jobgraduate')
							@else							 
							@endif		
						@endif

						</td>
                    </tr>
					<tr>
                        <td class="active">@lang('home.gender')</td>
                        <td>@lang('home.'.$job->gender)</td>
                        <td class="active">@lang('home.age')</td>
                        <td>
						@if($job->work_idx)
							@lang('home.jobnoage')
						@else
							{{ $job->jobage1 }} {{ $job->jobage2 }} 
							@if($job->jobage1 != "" or $job->jobage2 != "")
								  &nbsp;| @lang('home.jobnoage')
							@else		
								  @lang('home.jobnoage')
							@endif			
						@endif
						</td>
                    </tr>

                    <tr>
                        <td class="active">@lang('home.location')</td>
                        <td>@if($job->work_idx)
							<?php
							$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);
							echo $name_array[0]." ";
							echo $name_array[1];
						?>,@lang('home.'.JobCallMe::countryName($job->country))
						@else
							@if(JobCallMe::cityName($job->city))@lang('home.'.JobCallMe::cityName($job->city)) @else @lang('home.'.JobCallMe::stateName($job->state)) @endif ,@lang('home.'.JobCallMe::countryName($job->country))			
						@endif
						
						
						</td>
                        <td class="active">@lang('home.totalvacancies')</td>
                        <td>@if($job->work_idx)							
							<?php
							$name_array = explode("명", $job_work->RecruitmentNumber);
							echo $name_array[0];							
						?>
						@else
							{{ $job->vacancies }}	
						@endif</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</td>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>
							@if(app()->getLocale() == "kr")
							    @if($job->expiryDate == "2100-12-31")								
									채용시 마감
								@else
									{{ date('Y-m-d',strtotime($job->expiryDate))}} @if($job->expiryTime){{ $job->expiryTime }}:00 @endif
								@endif
							 
							@else
								@if($job->expiryDate == "2100-12-31")								
									Untill Hire
								@else
									{{ date('M d, Y',strtotime($job->expiryDate))}} @if($job->expiryTime){{ $job->expiryTime }}:00 @endif
								@endif
							  
							@endif
						</td>
						
                    </tr>
                    <tr>
					 <td class="active">@lang('home.locationcountry')</td>
                        <td>@if($job->work_idx)
							<?php
							$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);
							echo $name_array[0]." ";
							echo $name_array[1];
						?>,@lang('home.'.JobCallMe::countryName($job->country))
						@else
							@if(JobCallMe::cityName($job->city))@lang('home.'.JobCallMe::cityName($job->city)) @else @lang('home.'.JobCallMe::stateName($job->state)) @endif ,@lang('home.'.JobCallMe::countryName($job->country))
						@endif</td>
                        <td class="active">@lang('home.travelling')</td>
                        <td>@if($benefits != '')
							@foreach( $benefits as $benefit)
						     @if($benefit == 'Travelling')
							   <?php $travelFound = true; ?>
							   <?php if($travelFound){
										 echo Yes;
									}
									else{
										echo No;
									}
								?>
						     @elseif($benefit == 'See Description')
									@lang('home.overseasedescription')
									
								 @endif
						    @endforeach
							
							@endif
							
							
						</td>
						
                    </tr>
					
                    </tbody>
                </table>

                <!--Small Screen-->
                <table class="table table-bordered table-responsive hidden-md hidden-lg">
                    <tbody>
                    <tr>
                        <td class="active">@lang('home.category')</td>
                        <td>@if($job->work_idx)
							{{ $job_work2->Sectors }}		
						@else
							@lang('home.'.JobCallMe::categoryTitle($job->category)) @if($job->subCategory)/ @lang('home.'.JobCallMe::subcategoryTitle($job->subCategory)) @endif @if($job->subCategory)/ @lang('home.'.JobCallMe::subcategoryTitle2($job->subCategory2))@endif					
						@endif</td>
                    </tr>

					<tr>
                        <td class="active">@lang('home.jobaddr')</td>
                        <td>@if($job->work_idx)
							<?php
							$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);
							echo $name_array[0]." ";
							echo $name_array[1];
						?>		
						@else
							@if($job->jobaddr == 'Korea') @lang('home.'.$job->jobaddr) @else {{ $job->jobaddr }} @endif					
						@endif
						</td>           
                    </tr>


                    <tr>
                        <td class="active">@lang('home.careerlevel')</td>
                        <td>@lang('home.'.$job->careerLevel)</td>
                    </tr>
					
                    <tr>
                        <td class="active">@lang('home.jobacademic')</td>
                        <td>
						@if($job->work_idx)
							{{ $job->jobacademic }}	
						@else
							@if($job->jobacademic_not == "yes")
								  @lang('home.Regardless Education')
							@else	
								  @lang('home.'.$job->jobacademic)
							@endif
							@if($job->jobgraduate == "yes")
								  @lang('home.jobgraduate')
							@else							 
							@endif		
						@endif
						
						<!-- @lang('home.'.$job->jobacademic)
						@if($job->jobacademic_not == "yes")
							  &nbsp;| @lang('home.Regardless Education')
						@else							 
						@endif
						@if($job->jobgraduate == "yes")
							  &nbsp;| @lang('home.jobgraduate')
						@else							 
						@endif --></td>
                    </tr>

					<tr>
                        <td class="active">@lang('home.age')</td>
                        <td>{{ $job->jobage1 }} {{ $job->jobage2 }} 
						@if($job->jobage1 != "" or $job->jobage2 != "")
							  &nbsp;| @lang('home.jobnoage')
						@else		
							  @lang('home.jobnoage')
						@endif
						
						
						</td>
                    </tr>
					<tr>
                        <td class="active">@lang('home.gender')</td>
                        <td>@lang('home.'.$job->gender)</td>
                    </tr>

                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>@if(app()->getLocale() == "kr")
							  {{ date('Y-m-d',strtotime($job->createdTime))}}
						@else
							  {{ date('M d, Y',strtotime($job->createdTime))}}
						@endif</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>
							@if(app()->getLocale() == "kr")
							    @if($job->expiryDate == "2100-12-31")								
									채용시 마감
								@else
									@if($job->expiryDate = date('Y-m-d'))
										@lang('home.daytoday')
									@else
										{{ date('Y-m-d',strtotime($job->expiryDate))}}<span style="color:#d00000;font-size:15px;">&nbsp;<b>-{{ JobCallMe::timeInDays($job->expiryDate) }}D</b></span>
									@endif
									
								@endif
							 
							@else
								@if($job->expiryDate == "2100-12-31")								
									Untill Hire
								@else
									{{ date('M d, Y',strtotime($job->expiryDate))}}<span style="color:#d00000;font-size:15px;">&nbsp;<b>DL-{{ JobCallMe::timeInDays($job->expiryDate) }}</b></span>
								@endif
							  
							@endif

						</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.locationcountry')</td>
                        <td>@if(JobCallMe::cityName($rec->city))@lang('home.'.JobCallMe::cityName($job->city)) @else @lang('home.'.JobCallMe::stateName($job->state)) @endif ,@lang('home.'.JobCallMe::countryName($job->country))</td>
                    </tr>
					
                    </tbody>
                </table>
                <h4 style="padding-top:20px;"><span style="padding:10px 0px;color:#337ab7;"><b>@lang('home.description-post')</b></h4>
                <p style="padding-top:20px"><strong>@lang('home.We are conveniently located in') {{ JobCallMe::getCompany($job->companyId)->companyAddress }}.</strong></p>
                @if($job->work_idx)
							{{ $job_work->jobdescription }}	
				@else
					@if($job->jobType == 'Full Time/Contract Workers')
					<p class="job-descrptn-img">{!! nl2br($job->description) !!}</p>
					@else
					<div style="margin-left:10px"><p class="job-descrptn-img">{!! $job->description !!}</p></div>
					@endif
				@endif

				
				<br>
                <h4><b>@lang('home.skills')</b></h4>
						@if($job->work_idx)
							{{ $job_work->RecruitmentOccupation }}	
						@else
							<p>@if($job->skills == 'See Description3') @lang('home.'.$job->skills) @else {!! $job->skills !!} @endif</p>				
						@endif
                		
				<br>
				<h4><b>@lang('home.qualification')</b></h4>
                <p>@if($job->qualification == 'See Description3') @lang('home.'.$job->qualification) @else {!! nl2br($job->qualification) !!} @endif</p>			



                <br>
				<div>
                  <h4><b>@lang('home.admissionsprocess')</b></h4>
                @if($process != '')
	                <ul class="jd-rewards" style="margin-bottom: 32px;">
	                	@foreach( $process as $pro)
							<li>
							@if($pro == 'Document Screening')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)						
							@elseif($pro == 'human nature test')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Chat')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Video & Chat')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'First Interview')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Second Interview')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Examination for Employment')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'Final Pass')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@elseif($pro == 'See Description2')
								<i class="fa fa-check-circle"></i> @lang('home.'.$pro)
							@else
								<i class="fa fa-check-circle"></i> {!! $pro !!}
							@endif
							
							</li>
	                		
	                	@endforeach
	                </ul>
                @endif
				</div>
				<br><br>
				<br><br><br><br class="hidden-lg"><br class="hidden-lg"><br class="hidden-lg">	
				<div>
                <h4><b>@lang('home.How to register')<b></h4>
               
	                <ul class="jd-rewards">
	                	
						@if($job->jobreceipt01 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt01')</li>
	                	@endif
						@if($job->jobreceipt02 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt02')</li>
	                	@endif
						@if($job->jobreceipt07 == 'yes')
							<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt07')</li>
						@endif
						@if($job->jobreceipt03 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt03')</li>
	                	@endif
						@if($job->jobreceipt04 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt04')</li>
	                	@endif
						@if($job->jobreceipt05 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt05')</li>
	                	@endif
						@if($job->jobreceipt06 == 'yes')
	                		<li><i class="fa fa-check-circle"></i> @lang('home.jobreceipt06')</li>
	                	@endif

	                </ul>
				</div>
                <br>
                <br><br><br>
                <div>
                <h4><b>@lang('home.rewardsbenefits')</b></h4>
				@if($job->work_idx)
							{{ $job_work->SocialInsurance }}<br>
							{{ $job_work->ServerancePay }}<br>
							<?php
							$name_array = explode(";", $job_work->Benefits);
							
							?>
							@if($name_array[0])
								ㆍ{{ $name_array[0] }}<br>	
							@endif
							@if($name_array[1])
								ㆍ{{ $name_array[1] }}<br>
							@endif
							@if($name_array[2])
								ㆍ{{ $name_array[2] }}<br>
							@endif
							@if($name_array[3])
								ㆍ{{ $name_array[3] }}<br>
							@endif
							@if($name_array[4])
								ㆍ{{ $name_array[4] }}<br>
							@endif
							@if($name_array[5])
								ㆍ{{ $name_array[5] }}<br>
							@endif
							@if($name_array[6])
								ㆍ{{ $name_array[6] }}<br>
							@endif
							@if($name_array[7])
								ㆍ{{ $name_array[7] }}<br>
							@endif


							<br>
							{{ $job_work->Benefits_1 }}
						@else


							@if($benefits != '')
	                <ul class="jd-rewards">
	                	@foreach( $benefits as $benefit)
						
	                		<li>
							@if($benefit == 'National pension')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)							
							@elseif($benefit == 'Employment Insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Industrial accident insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Health Insurance')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Severance Pay')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Lunch offer')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Vehicle oil subsidy')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Overtime pay')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'See Homepage')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'See Description')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@elseif($benefit == 'Comprehensive Health Checkup')
								<i class="fa fa-check-circle"></i> @lang('home.'.$benefit)
							@else
								<i class="fa fa-check-circle"></i> {{ $benefit }}
							@endif
						
	                		</li>
	                	@endforeach
	                </ul>
                @endif


						@endif

                
                </div>
                <br>
              
            </div>

            <!--ABOUT Organization-->
            <!-- <div class="jobs-suggestions">
                <div class="jd-action-btn">
                    @if(in_array($job->companyId,$followArr))
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-success">@lang('home.following')</a>
                    @else
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-primary">@lang('home.follow')</a>
                    @endif
                </div>
                <h4>{{ $job->companyName }} </h4>
                <p>{{ JobCallMe::cityName($job->companyCity) }}, {{ JobCallMe::countryName($job->companyCountry) }}</p>
                <div class="jd-about-organization">
                    <p>{!! $job->companyAbout !!}
                    </p>
                </div>
            </div> -->
            <?php 
            //print_r($companyReview);
            $overallreview = array();
            $career = array();
            $benefit = array();
            $lifebalance = array();
            $management = array();
            $culture = array();
            $recommend_ceo = array();
            $recommend = array();
            $future = array();
            foreach($companyReview as $review)
            {
                $overallreview[] = $review->overall_review;
                $career[] = $review->career_opportunity;
                $benefit[] = $review->benefits;
                $lifebalance[] = $review->work_lifebalance;
                $management[] = $review->rate_management;
                $culture[] = $review->rate_culture;
                $recommend_ceo[] = $review->recommend_ceo;
                $recommend[] = $review->recommend;
                $future[] = $review->future;
            }
            if(sizeof($overallreview) > 0){
                $result = array_count_values($overallreview);
                $max = max($result);
                $star = array_search($max, $result);
            
                /*career*/
                $career_result = array_count_values($career);
                $career_max = max($career_result);
                $career_star = array_search($career_max, $career_result);
                /*benefit*/
                $benefit_result = array_count_values($benefit);
                $benefit_max = max($benefit_result);
                $benefit_star = array_search($benefit_max, $benefit_result);
                /*work/life banlance*/
                $lifebalance_result = array_count_values($lifebalance);
                $lifebalance_max = max($lifebalance_result);
                $lifebalance_star = array_search($lifebalance_max, $lifebalance_result);
                /*Management*/
                $management_result = array_count_values($management);
                $management_max = max($management_result);
                $management_star = array_search($management_max, $management_result);
                 /*Culture*/
                $culture_result = array_count_values($culture);
                $culture_max = max($culture_result);
                $culture_star = array_search($culture_max, $culture_result);
                 /*Ceo recommend*/
                $ceo_recommend_result = array_count_values($recommend_ceo);
                $ceo_recommend_max = max($ceo_recommend_result);
                $ceo_recommend_star = array_search($ceo_recommend_max, $ceo_recommend_result);
                /*recommend to friend*/
                $recommend_result = array_count_values($recommend);
                $recommend_max = max($recommend_result);
                $recommend_star = array_search($recommend_max, $recommend_result);
                /*future*/
                $future_result = array_count_values($future);
                $future_max = max($future_result);
                $future_star = array_search($future_max, $future_result);
            }
            ?>
            <div class="jobs-suggestions">
                <div class="jd-action-btn" style="padding-top:45px">
                    @if(in_array($job->companyId,$followArr))
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-success">@lang('home.following')</a>
                    @else
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-primary">@lang('home.follow')</a>
                    @endif   
                    <a href="{{ url('account/employeer/companies/company/review?CompanyId='.$job->companyId) }}" class="btn btn-default">@lang('home.Write Review')</a>   
                </div>
				<div style="padding-top:10px;float:right;">
					<a href="{{url('companies/company/'.$job->companyId)}}"><span style="padding: 7px;background:#337ab7;border-radius: 5px;color:#fff;font-size:13px;">회사정보 보기</span></a>
				</div><br>
                <h4 style="padding-top:10px"><a href="{{url('companies/company/'.$job->companyId)}}">{{ $job->companyName }}</a></h4>
                <p style="padding-top:10px">@if($job->work_idx)
							<?php
							$name_array = explode("  ", $job_work->WorkingCondition_WorkingArea);
							echo $name_array[0]." ";
							echo $name_array[1];
						?>,@lang('home.'.JobCallMe::countryName($job->country))
						@else
							@if(JobCallMe::cityName($rec->city))@lang('home.'.JobCallMe::cityName($job->city)) @else @lang('home.'.JobCallMe::stateName($job->state)) @endif ,@lang('home.'.JobCallMe::countryName($job->country))			
						@endif
						
						
				
				
				
				</p>
				@if($job_work->phone)
				<div class="jd-about-organization">
                    <p>@lang('home.phone') : {!! $job_work->phone !!}<br>@lang('home.fax') : {!! $job_work->fax !!} @if($job_work->email)<br>@lang('home.email') : {!! $job_work->email !!} @endif</p>					
                </div>
				@endif
                <div class="jd-about-organization">
                    <p>{!! $job->companyAbout !!}</p>
                </div>
                <p align="center">
                   <span  style="color:#d6a707"><?= checkreview($star)?></span><br>
                   <span><a href="{{url('companies/company/'.$job->companyId)}}">@lang('home.View all Review')</a> <span class="badge"><?= count($companyReview)?></span></span>
                </p>
                <hr>
                <p>
                    
                </p>
                <div class="row">
                <div class="col-md-4">
                <table>
                        <tr>
                            <td>@lang('home.Career Growth')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($career_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Compensation & Benefits')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($benefit_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Work/Life Balance')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($lifebalance_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Management')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($management_star)?>
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('home.Culture')</td>
                            <td>&nbsp;&nbsp;</td>
                            <td style="color:#d6a707">
                            <?= checkreview($culture_star)?>
                            </td>
                        </tr>
                    </table>
                </div>
                    <div class="col-md-8">
                        <div class="row" align="center">
                            <div class="col-md-4">
                            <div class="c100 p<?php echo round($allrecmond) ?>">
                            <span><?php echo round($allrecmond) ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>

                                <span style="font-size:12px">{{$ceo_recommend_star}}</span>
                       
                                <p>@lang('home.CEO Recommended')</p>
                            </div>
                            <div class="col-md-4">
                            <div class="c100 p<?php echo round($allon) ?>">
                            <span><?php echo round($allon) ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>

                                <span style="font-size:12px">@if($recommend_star == 'on') Yes @else @lang('home.Not recommend') @endif</span>
                                <p>@lang('home.Recommend to a friend')</p>
                            </div>
                            <div class="col-md-4">
                            <div class="c100 p<?php echo round($allgrowing) ?>">
                            <span><?php echo round($allgrowing) ?>%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                                <span style="font-size:12px">{{$future_star}}</span>
                                <p>@lang('home.Future Expectations')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                     <div style="position: relative;
                                    overflow: auto;
                                    padding: 10px 20px;
                                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                    border: 1px solid #cccccc;
                                    margin-bottom: 20px;
                                    background: #ffffff;">
                      @if($job->work_id)
						<input id="pac-input" class="controls" type="hidden" value="{!! $job->companyAddress !!}" >			
					@else
						<input id="pac-input" class="controls" type="hidden" value="{!! $job->Address !!}" >							
					@endif
					  
                    <!-- google map code html -->
                    <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                    </div>
        
		<div class="col-md-3">
			<div><button class="btn btn-md" style=" border-radius:5px !important;background-color: #337ab7;border: none;color: white;width:100%;"><span style="float:left;padding-left:10px;">@lang('home.Job Searching')</span> <span style="font-size:20px;color:#f7d23a;float:right;padding-right:10px;">{{$applycount}}<span style="font-size:13px;color:#f7d23a;">@lang('home.totApplicant')</span> &nbsp;{{$jobcount}}<span style="font-size:13px;color:#f7d23a;">@lang('home.totView')</span></span></button></div>

			<div style="padding-top:10px;"><button class="btn btn-md" style=" border-radius:5px !important;background-color: #a0b1b9;border: none;color: white;width:100%;"><span style="float:left;padding-left:10px;">@lang('home.Company Review')</span> <span style="font-size:20px;color:#f7d23a;float:right;padding-right:10px;">{{$reviewcount}}</span></button></div>

			<div style="padding-top:10px;"><button class="btn btn-md" style=" border-radius:5px !important;background-color: #5b5c5e;border: none;color: white;width:100%;"><span style="float:left;padding-left:10px;">@lang('home.Company Fellow')</span> <span style="font-size:20px;color:#f7d23a;float:right;padding-right:10px;">{{$fellow}}</span></button></div>

			<div style="padding-top:10px;"><button class="btn btn-md" style=" border-radius:5px !important;background-color: #57768a;border: none;color: white;width:100%;"><span style="float:left;padding-left:10px;">@lang('home.Total Post Upskill')</span> <span style="font-size:20px;color:#f7d23a;float:right;padding-right:10px;">{{$learncount}}</span></button></div>


			
        
		    <br>
            <br>
            <!--Follow Companies - Start -->
                <div class="follow-companies">
                    <h4>@lang('home.similarjobdetail') <!-- @lang('home.'.JobCallMe::countryName(JobCallMe::getHomeCountry())) --></h4>
                    <hr>
                    <div class="row">
					@foreach($suggest as $appl)
					 <?php
                       
                            $cLogo = url('compnay-logo/default-logo.jpg');
                            if($appl->companyLogo != ''){
                                $cLogo = url('compnay-logo/'.$appl->companyLogo);
                                    }
                                    ?>
                        <div class="col-md-12 col-xs-12 sp-item">
						<div class="col-md-4 col-xs-4 sp-item">
                            <img src="{{ $cLogo }}" style="">
							</div>
							<div class="col-md-8 col-xs-8 sp-item" style="text-align:left !important">
                            <p><a href="{{ url('jobs/'.$appl->jobId) }}">{!! $appl->title!!}</a></p>
                            <p>{!! $appl->companyName !!}</p>
                            <p>@if(JobCallMe::cityName($appl->city))@lang('home.'.JobCallMe::cityName($appl->city)) @else @lang('home.'.JobCallMe::stateName($appl->state)) @endif ,@lang('home.'.JobCallMe::countryName($appl->country))     
							
							
							</p>
							 <span class="rtj-action">
                                                <a href="{{ url('jobs/apply/'.$sJob->jobId) }}" title="Apply">
                                                    <i class="fa fa-paper-plane"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" onclick="removeJob({{ $sJob->jobId }})" title="Remove" class="application-remove">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </span>
                        </div>
						
						</div>
						 @endforeach

                      

                        <hr>
                        
                    </div>
                </div>

		</div>
        
    </div>
   <?php  function checkreview($val){
      if($val == "Excellent"){
        return '<span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>';
      }
      else if($val == "Verygood"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Good"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Fair"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
      else if($val == "Poor"){
        return '<span>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }else{
        return '<span>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </span>';
      }
    }
    ?>
    <style type="text/css">
      
      /* Optional: Makes the sample page fill the window. */
      
       #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      
</style>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
  function OpenWindows(url, windowName) {

   newwindow = window.open('https://www.talksns.com/sharer?url=' + url, windowName, 'height=600,width=800');

   if (window.focus) {
      newwindow.focus();
   }
   return false;
}
function dialogclick2() {
      //alert("helllo");
    $("#dialog2").dialog('open');
  }
  $(function () {
  $( "#dialog2" ).dialog({
    autoOpen: false
  });
  
  
});
function dialogclick3() {
      //alert("helllo");
    $("#dialog3").dialog('open');
  }
  $(function () {
  $( "#dialog3" ).dialog({
    autoOpen: false
  });
  
  
});
function dialogclick() {
      //alert("helllo");
    $("#dialog1").dialog('open');
  }
  $(function () {
  $( "#dialog1" ).dialog({
    autoOpen: false
  });
  
  
});
$(document).ready(function(){
})
var popupMeta = {
    width: 400,
    height: 400
}
$(document).on('click', '.social-share', function(event){
    event.preventDefault();

    var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
        hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

    var url = $(this).attr('href');
    var popup = window.open(url, 'Social Share',
        'width='+popupMeta.width+',height='+popupMeta.height+
        ',left='+vPosition+',top='+hPosition+
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

    if (popup) {
        popup.focus();
        return false;
    }
});
function saveJob(jobId,obj){
    if($(obj).hasClass('btn-default')){
        var type = 'save';
    }else{
        var type = 'remove';
    }
    $.ajax({
        url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type,
        success: function(response){
            if($.trim(response) == 'redirect'){
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
                if($(obj).hasClass('btn-default')){
                    $(obj).removeClass('btn-default');
                    $(obj).addClass('btn-success');
                    $(obj).text('@lang("home.saved")');
                }else{
                    $(obj).removeClass('btn-success');
                    $(obj).addClass('btn-default');
                    $(obj).text('@lang("home.save")');
                }
            }
        }
    })
}
function followCompany(companyId,obj){
    if($(obj).hasClass('btn-primary')){
        var type = 'follow';
    }else{
        var type = 'remove';
    }
    if($(obj).hasClass('btn-primary')){
        $(obj).removeClass('btn-primary');
        $(obj).addClass('btn-success');
        $(obj).text('@lang("home.following")');
    }else{
        $(obj).removeClass('btn-success');
        $(obj).addClass('btn-primary');
        $(obj).text('@lang("home.follow")');
    }
    $.ajax({
        url: "{{ url('account/jobseeker/company/action') }}?companyId="+companyId+"&type="+type,
        success: function(response){
            if($.trim(response) == 'redirect'){
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
            }
        }
    })
}
</script>
<!-- google map code start from there  -->
@if($job->jobType == "Full Time/Contract Workers")
<script>
$(document).ready(function(){
 
});
 
    var addr=$('#pac-input').val();
        
   


      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
               var geocoder = new google.maps.Geocoder();
               var address = addr;
               var longitude="";
               var latitude="";
               var myLatLng="";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
         myLatLng={lat: latitude, lng: longitude}
    //alert(latitude);
     var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 8,
          mapTypeId: 'roadmap'
        });

  } 
   var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr
        });
});
     
      }

    </script>
@else
<script>
$(document).ready(function(){
 
});

 
    var addr=$('#pac-input').val();
        
   


      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
               var geocoder = new google.maps.Geocoder();
               var address = addr;
               var longitude="";
               var latitude="";
               var myLatLng="";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
         myLatLng={lat: latitude, lng: longitude}
    //alert(latitude);
     var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 14,
          mapTypeId: 'roadmap'
        });

  } 
   var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr
        });
});
     
      }

    </script>
@endif
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initAutocomplete" async defer></script>

@endsection
@section('og')
<meta property="og:url" content="https://www.jobcallme.com/">
			
		
<meta property="og:title" content="{{ $job->title }}" />
<meta property="og:image" content="{{ $cLogo }}" />
<meta property="og:type" content="website" />
<link rel="canonical" href="{{url('jobs/'.$job->jobId)}}"> 
@endsection


