@extends('frontend.layouts.app')

@section('title', $company->companyName)

@section('content')
<?php
$cCover = url('compnay-logo/default-cover.jpg');
if($company->companyCover != ''){
  $cCover = url('compnay-logo/'.$company->companyCover);
}
$cLogo = url('compnay-logo/default-logo.jpg');

if($company->work_id){
						
	 $is_file_exist = file_exists('compnay-logo/'.$company->work_id.'_Logo.jpg');

	 if ($is_file_exist) {
		$cLogo = url('compnay-logo/'.$company->work_id.'_Logo.jpg');
	 }


						
}else{
	if($company->companyLogo != ''){
	  $is_file_exist = file_exists('compnay-logo/'.$company->companyLogo);

	  if ($is_file_exist) {
		$cLogo = url('compnay-logo/'.$company->companyLogo);
	  }

	  
	}
}


$opHour = json_decode($company->companyOperationalHour,true);
?>

<section id="edit-organization">
    <div class="container">
        <div class="eo-box">
            <div class="eo-timeline">

            @if($company->picLog == '0')
            <iframe src="https://www.youtube.com/embed/{{$company->companyYoutube}}" frameborder="0" allowfullscreen class="eo-timeline-cover"></iframe>
           @else
                @if($company->moviecom)
					<iframe src="https://www.youtube.com/embed/{{ $company->moviecom }}?version=2&amp;loop=1&playlist={{ $company->moviecom }}" frameborder="0" allowfullscreen class="eo-timeline-cover"></iframe>
					
				@else
					<img src="{{ $cCover }}" class="eo-timeline-cover">
				@endif
            @endif

            </div>
            <div class="col-md-12">
               <div class="row">
                   <div class="col-md-2 eo-dp-box hidden-xs">
                       <img src="{{ $cLogo }}" class="eo-dp">
                   </div>

				   <div class="col-md-2 eo-dp-box2 hidden-sm hidden-md hidden-lg">
                       <img src="{{ $cLogo }}" class="eo-dp2">
                   </div>

                   <div class="col-md-10 eo-timeline-details">
                       <h1><a href="{{ url('companies/company/'.$company->companyId) }}">{!! $company->companyName !!}</a></h1>
                       <div class="col-md-8 eo-section">
					   @if($company->companyceo)
						   <div class="eo-details">
                               <span>@lang('home.Company CEO'):</span> {!! $company->companyceo !!}
                           </div>					  
					   @endif	
					   @if($company->typeofbusiness)
						   <div class="eo-details">
                               <span>@lang('home.Bussiness Sectors'):</span> {!! $company->typeofbusiness !!}
                           </div>
					   @else
                           <div class="eo-details">
                               <span>@lang('home.industry'):</span> @if($company->work_id)
									{!! $company_work3->Sectors !!}
							   @else
									@lang('home.'.JobCallMe::categoryName($company->category))
							   @endif
                           </div>
					   @endif
					   @if($company->business_sector)
						   <div class="eo-details">
                               <span>@lang('home.business sectors'):</span> {!! $company->business_sector !!}
                           </div>					  
					   @endif	  
                           <div class="eo-details">
                               <span>@lang('home.established'):</span> @if(app()->getLocale() == "kr")
						    @if($company->companyEstablishDate != "") {!! $company->companyEstablishDate !!}<!-- {!! date('Y-m-d',strtotime($company->companyEstablishDate)) !!} --> @endif
						@else
						    @if($company->companyEstablishDate != "") {!! date('M d, Y',strtotime($company->companyEstablishDate)) !!} @endif
						@endif  
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.noemployees'):</span>
							   @if($company->companyNoOfUsers)
									{!! $company->companyNoOfUsers !!}
							   @else
									@if($company->work_id)
										{!! $company_work2->Sum !!}
									@endif
							   @endif
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.head location'):</span> @if($company->work_id)
								{{ $company->companyAddress }}
								
								@else
									{{ $company->companyAddress }}
								@endif
								<!-- @if($company->companyCity != 0) @lang('home.'.JobCallMe::cityName($company->companyCity)), @lang('home.'.JobCallMe::stateName($company->companyState)), @lang('home.'.JobCallMe::countryName($company->companyCountry)) @endif -->
                           </div>
						   @if($company->companyWebsite)
                           <div class="eo-details">
						     @if($company->companyCountry == "44" or $company->companyCountry == "98" or $company->companyCountry == "109")
                               <span>@lang('home.website'):</span> <a href="http://{!! $company->companyWebsite !!}" target="_blank">{!! $company->companyWebsite !!}</a>
							 @else
							   <span>@lang('home.website'):</span> <a href="{!! $company->companyWebsite !!}" target="_blank">{!! $company->companyWebsite !!}</a>
							 @endif
                           </div>
						   @endif	
                       </div>
                       <div class="col-md-4 eo-section text-right">
                           <div class="row">
                                @if(in_array($company->companyId,$followArr))
                                    <a href="javascript:;" onclick="followCompany({{ $company->companyId }},this)" class="btn btn-success hvr-sweep-to-right">@lang('home.following')</a>
                                @else
                                    <a href="javascript:;" onclick="followCompany({{ $company->companyId }},this)" class="btn btn-primary hvr-sweep-to-right">@lang('home.follow')</a>
                                @endif
                                <a href="{{ url('account/employeer/companies/company/review?CompanyId='.$company->companyId) }}" class="btn btn-default">@lang('home.Write Review')</a>
                               <div class="jd-share-btn cp-social">
                                   <!-- <a href="{!! $company->companyFb !!}" target="_blank"><i class="fa fa-facebook" style="background: #2e6da4;"></i> </a>
                                   <a href="{!! $company->companyLinkedin !!}" target="_blank"><i class="fa fa-linkedin" style=" background: #007BB6;"></i> </a>
                                   <a href="{!! $company->companyTwitter !!}" target="_blank"><i class="fa fa-twitter" style="background: #15B4FD;"></i> </a>
                                   <a href="{!! $company->companyInstagram !!}" target="_blank"><i class="fa fa-google-plus" style="background: #fb3958;"></i> </a>
								   <a href="{!! $company->talksns !!}" target="_blank"><img src="{{asset('website/icon.ico')}}" style="width: 25px !important;border-radius: 50px; cursor: pointer;"></a> -->
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <div class="col-md-12 rtj-box">
                <ul class="nav nav-tabs companybu">
                    <li class="active">
                        <a href="#rtj_tab_about" data-toggle="tab"><i class="fa fa-list"></i> @lang('home.about')</a>
                    </li>
                    <li>
                        <a href="#rtj_tab_compics" data-toggle="tab"><i class="fa fa-image"></i> @lang('home.companyGallery')</a>
                    </li>
                    <li>
                        <a href="#rtj_tab_jobs" data-toggle="tab"><i class="fa fa-briefcase"></i> @lang('home.jobs') </a>
                    </li>
                    <li>
                        <a href="#rtj_tab_operation" data-toggle="tab"><i class="fa fa-clock-o"></i> @lang('home.operationhours')</a>
                    </li>
					<li>
                    <a href="#rtj_tab_companyals" data-toggle="tab"><i class="fa fa-line-chart" aria-hidden="true"></i> @lang('home.Company Analysis')</a>
					</li>
					<!-- <li><a href="https://www.nicebizinfo.com" target="_blank"><i class="fa fa-list"></i> @lang('home.aboutinfo2')</a>
					</li> -->
					<li>
						@if(app()->getLocale() == "kr")
						    <a href="http://dart.fss.or.kr/dsae001/main.do" target="_blank">
						@else
						    <a href="http://englishdart.fss.or.kr/" target="_blank">
						@endif  <i class="fa fa-list"></i> @lang('home.aboutinfo')</a>
                    <!-- @if(app()->getLocale() == "kr")
						    <a href="http://dart.fss.or.kr/dsae001/main.do" target="_blank">
						@else
						    <a href="http://englishdart.fss.or.kr/" target="_blank">
						@endif  <i class="fa fa-list"></i> @lang('home.aboutinfo')</a> -->
					</li>
					
                </ul>
                <div class="tab-content">
                    <!--ABOUT-->
                    <div class="tab-pane active" id="rtj_tab_about">
                        <div class="col-md-12">
                            <h4>@lang('home.aboutus')</h4>
							
								@if($company->work_id == '')
									@if($company->companyCover)
									<p><img src="{{ url('compnay-logo/'.$company->companyCover) }}" width="800px"></p>
									@endif
								@endif
							
                            <p>{!! nl2br($company->companyAbout) !!}</p>
                        </div>
                    </div>
                    <!-- company gallery -->
                   

                    <!--JOBS-->
                    <div class="tab-pane" id="rtj_tab_jobs">
                        @foreach($jobs as $job)
                            <div class="col-md-12 rtj-item">
                                <div class="rtj-details">
                                    <p><strong><a href="{{ url('jobs/'.$job->jobId) }}">{{ $job->title }}</a></strong></p>
                                    <p>@if(JobCallMe::cityName($job->city))@lang('home.'.JobCallMe::cityName($job->city)) @else @lang('home.'.JobCallMe::stateName($job->state)) @endif ,@lang('home.'.JobCallMe::countryName($job->country))
									
									</p>
                                    <p>{{ $job->createdTime }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!--OPERATION HOURS-->
                    <div class="tab-pane" id="rtj_tab_operation">
                        <h4>@lang('home.operationhours')</h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>@lang('home.Working day')</td>
                                <td>
								<!-- @if($company->companydayval)
									@if($company->companydayval != "jobday01")
										@lang('home.'.$company->companydayval)
									@endif
									
									@if($company->companydayval_text) {{$company->companydayval_text}} @endif

								@else
									@if($job->jobdayval != "jobday01")
										@lang('home.'.$job->jobdayval)
									@endif

									@if($job->jobdayval_text) {{$job->jobdayval_text}} @endif

								@endif -->

									@if($job->jobdayval != "jobday01" and $job->jobdayval != "jobday10")
										@lang('home.'.$job->jobdayval)
									@endif

									@if($job->jobdayval_text) {{$job->jobdayval_text}} @endif

								
								</td>
                            </tr>
                            <tr>
                                <td>@lang('home.Working hours')</td>
                                <td>
								<!-- @if($company->companyhoursval)
									@if($company->companyhoursval != "jobhours01")
										@lang('home.'.$company->companyhoursval)
									@endif

									@if($company->companyhoursval_text) {{$company->companyhoursval_text}} @endif
									
								@else
									@if($job->jobhoursval != "jobhours01")
										@lang('home.'.$job->jobhoursval)
									@endif

									@if($job->jobhoursval_text) {{$job->jobhoursval_text}} @endif

								@endif -->

									@if($job->jobhoursval != "jobhours01" and $job->jobhoursval != "jobhours06")
										@lang('home.'.$job->jobhoursval)
									@endif

									@if($job->jobhoursval_text) {{$job->jobhoursval_text}} @endif
								
								</td>
                            </tr>
                            <!-- <tr>
                                <td>@lang('home.wednesday')</td>
                                <td>{!! $opHour['wed']['from'] !!} - {!! $opHour['wed']['to'] !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('home.thursday')</td>
                                <td>{!! $opHour['thu']['from'] !!} - {!! $opHour['thu']['to'] !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('home.friday')</td>
                                <td>{!! $opHour['fri']['from'] !!} - {!! $opHour['fri']['to'] !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('home.saturday')</td>
                                <td>{!! $opHour['sat']['from'] !!} - {!! $opHour['sat']['to'] !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('home.sunday')</td>
                                <td>{!! $opHour['sun']['from'] !!} - {!! $opHour['sun']['to'] !!}</td>
                            </tr> -->
                            </tbody>
                        </table>
                    </div>


					<!--Company Analysis-->
				<div class="tab-pane" id="rtj_tab_companyals">
				@if($companyals->majorbusiness == "")
					<div class="col-md-12 text-center" >
                        <img src="{{ url('compnay-logo/nocompanyals.png') }}">                 
                    </div>
					<div class="col-md-12 text-center" style="padding-top:15px;">
                        <span style="font-size:15px;"><b>@lang('home.nocompanyals-1') <span style="color:#337ab7;">{!! $company->companyName !!}</span> @lang('home.nocompanyals-2')</b></span>                       
                    </div>
					  @if($job->jobType == "Full Time/Contract Workers")
						@if(app()->getLocale() == "kr")
						<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
							<!-- <a href="https://www.msn.com/en-us/money/markets" target="_blank"> --><a href="https://www.bloomberg.com/markets/stocks" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals3')</b></span></a>                       
						</div>
						@else
						<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
							<a href="https://www.bloomberg.com/markets/stocks" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals3')</b></span></a>                       
						</div>						    
						@endif  
					  @else
					    @if($company->companyCountry == '98' or $company->companyCountry =='44')
							@if(app()->getLocale() == "kr")
							
							<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
								<a href="https://www.bloomberg.com/markets/stocks" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals3')</b></span></a>                       
							</div>
							@else
							<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
								<a href="https://www.bloomberg.com/markets/stocks" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals3')</b></span></a>                       
							</div>						    
							@endif

						@else
							@if(app()->getLocale() == "kr")
							<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
								<!-- <a href="http://dart.fss.or.kr/dsae001/main.do" target="_blank"> --><a href="https://www.hometax.go.kr" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals2')</b></span></a>                       
							</div>
							@else
							<div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
								<a href="http://englishdart.fss.or.kr/" target="_blank"><span style="font-size:15px;color:#fff;background:#337ab7;padding:5px 5px;"><b>@lang('home.nocompanyals2')</b></span></a>                       
							</div>						    
							@endif   

						@endif

					  @endif
					
				@else				
					<table class="table table-bordered table-responsive hidden-md">
                    <tbody>
					@if($companyals->companyceo)
					<tr>
                        <td class="active col-width">@lang('home.Company CEO')</td>
                        <td>{!! $companyals->companyceo !!} </td>
                    </tr>
					@endif
					@if($companyals->financialstatus)
					<tr>
                        <td class="active col-width" >@lang('home.Financial Status')</td>
                        <td>{!! $companyals->financialstatus !!} </td>
                    </tr>
					@endif
					@if($companyals->associatecompany)
					<tr>
                        <td class="active col-width">@lang('home.Associate Company')</td>
                        <td>{!! nl2br($companyals->associatecompany) !!} </td>
                    </tr>
					@endif
					@if($companyals->locationinindustry)
					<tr>
                        <td class="active col-width">@lang('home.Location in Industry')</td>
                        <td>{!! nl2br($companyals->locationinindustry) !!} </td>
                    </tr>
					@endif
					@if($companyals->operatingprofit)
					<tr>
                        <td class="active col-width">@lang('home.operating Profit')</td>
                        <td>{!! $companyals->operatingprofit !!} </td>
                    </tr>
					@endif
                    @if($companyals->netincome)
					<tr>
                        <td class="active col-width" width="200px">@lang('home.Net Income')</td>
                        <td>{!! $companyals->netincome !!}</td>
                    </tr>
					@endif
					@if($companyals->majorbusiness)
					<tr>
                        <td class="active col-width" width="150px">@lang('home.Major Business')</td>
                        <td>{!! $companyals->majorbusiness !!}</td>
                    </tr>
					@endif

					@if($companyals->joincompany)
					<tr>
                        <td class="active col-width">@lang('home.Reason to join this company')</td>
                        <td>{!! nl2br($companyals->joincompany) !!}</td>
                    </tr>
					@endif
					
					<!-- @if($companyals->incomestatus)
					<tr>
                        <td class="active">@lang('home.Net income financial status')</td>
                        <td>{!! $companyals->incomestatus !!} </td>
                    </tr>
					@endif -->
					@if($companyals->closingdate)
					<tr>
                        <td class="active col-width">@lang('home.closing date')</td>
                        <td>{!! $companyals->closingdate !!}</td>
                    </tr>
					@endif
					@if($companyals->avgsalary)
					<tr>
                        <td class="active col-width">@lang('home.avg salary')</td>
                        <td>{!! $companyals->avgsalary !!}</td>
                    </tr>
					@endif
					@if($companyals->sameavgsalary)
					<tr>
                        <td class="active col-width">@lang('home.sameavgsalary')</td>
                        <td>{!! $companyals->sameavgsalary !!}</td>
                    </tr>
					@endif
					@if($companyals->begningnewemployee)
					<tr>
                        <td class="active col-width">@lang('home.begning of new employee')</td>
                        <td>{!! $companyals->begningnewemployee !!}</td>
                    </tr>
					@endif
					@if($companyals->joinleave)
					<tr>
                        <td class="active col-width">@lang('home.joinleave')</td>
                        <td>{!! $companyals->joinleave !!}</td>
                    </tr>
					@endif
					@if($companyals->avgsex)
					<tr>
                        <td class="active col-width">@lang('home.avg sex')</td>
                        <td>{!! $companyals->avgsex !!}</td>
                    </tr>
					@endif
								
					
					@if($companyals->chodaejolcredit)
					<tr>
                        <td class="active col-width">@lang('home.avggraduatesscore')</td>
                        <td>
							@lang('home.chodaejol credit') {!! $companyals->chodaejolcredit !!}<br>
							@if($companyals->avggraduates)
								@lang('home.average of college graduates') {!! $companyals->avggraduates !!}<br>
							@endif
							@if($companyals->graduateschool)
								@lang('home.graduate school') {!! $companyals->graduateschool !!}
							@endif
				
						</td>
                    </tr>
					@endif
					
					

					
					

					

					
					
					
					@if($companyals->statusofcertification)
					<tr>
                        <td class="active">@lang('home.Specifications')</td>
                        <td>{!! nl2br($companyals->statusofcertification) !!}</td>
                    </tr>
					@endif

					
					@if($companyals->overseasexperience)
					<tr>
                        <td class="active">@lang('home.overseasexperience')</td>
                        <td>{!! $companyals->overseasexperience !!}</td>
                    </tr>
					@endif
					@if($companyals->internexperience)
					<tr>
                        <td class="active">@lang('home.internexperience')</td>
                        <td>{!! $companyals->internexperience !!}</td>
                    </tr>
					@endif
					@if($companyals->awardsexperience)
					<tr>
                        <td class="active">@lang('home.awardsexperience')</td>
                        <td>{!! $companyals->awardsexperience !!}</td>
                    </tr>
					@endif
					@if($companyals->schoolsocialvolunteer)
					<tr>
                        <td class="active">@lang('home.schoolsocialvolunteer')</td>
                        <td>{!! $companyals->schoolsocialvolunteer !!}</td>
                    </tr>
					@endif
					@if($companyals->schooloforigin)
					<tr>
                        <td class="active">@lang('home.schooloforigin')</td>
                        <td>{!! nl2br($companyals->schooloforigin) !!}</td>
                    </tr>
					@endif
					@if($companyals->employmentstatus)
					<tr>
                        <td class="active">@lang('home.employmentstatus')</td>
                        <td>{!! nl2br($companyals->employmentstatus) !!}</td>
                    </tr>
					@endif
					@if($companyals->schoolmajor)
					<tr>
                        <td class="active">@lang('home.schoolmajor')</td>
                        <td>{!! $companyals->schoolmajor !!}</td>
                    </tr>
					@endif
					<!-- 
					@if($companyals->sausages)
					<tr>
                        <td class="active">@lang('home.sausages')</td>
                        <td>{!! $companyals->sausages !!}</td>
                    </tr>
					@endif
					-->
					@if($companyals->companyhistory)
					<tr>
                        <td class="active" width="200px">@lang('home.companyhistory')</td>
                        <td>
							<p>{!! nl2br($companyals->companyhistory) !!}</p>
							<p>{!! $companyals->companyhistory2 !!}</p>
							<p>{!! $companyals->companyhistory3 !!}</p>
							<p>{!! $companyals->companyhistory4 !!}</p>
							<p>{!! $companyals->companyhistory5 !!}</p>
							<p>{!! $companyals->companyhistory6 !!}</p>
							<p>{!! $companyals->companyhistory7 !!}</p>
							<p>{!! $companyals->companyhistory8 !!}</p>
							<p>{!! $companyals->companyhistory9 !!}</p>
							<p>{!! $companyals->companyhistory10 !!}</p>
							<p>{!! $companyals->companyhistory11 !!}</p>
							<p>{!! $companyals->companyhistory12 !!}</p>
							<p>{!! $companyals->companyhistory13 !!}</p>
							<p>{!! $companyals->companyhistory14 !!}</p>
							<p>{!! $companyals->companyhistory15 !!}</p>
							<p>{!! $companyals->companyhistory16 !!}</p>
							<p>{!! $companyals->companyhistory17 !!}</p>
							<p>{!! $companyals->companyhistory18 !!}</p>
							<p>{!! $companyals->companyhistory19 !!}</p>
						</td>
                    </tr>
					@endif
					
                    
					
                    </tbody>
                </table>


                    <div class="col-md-12">
                        <span style="font-size:13px;float:right;">@lang('home.jcmanalysisdes')</span>                       
                    </div>
			@endif
                </div>




                </div>
                </div>
              <div>
                <!-- companyreview -->
                <?php 
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
                    
                   <h4>{{ $company->companyName }}</h4>
                    <p>@lang('home.'.JobCallMe::cityName($company->companyCity)), @lang('home.'.JobCallMe::countryName($company->companyCountry))</p>
                    <div class="jd-about-organization">
                        <p>{!! $job->companyAbout !!}</p>
                    </div>
                    <p align="center">
                        <span  style="color:#d6a707"><?php echo checkreview($star) ?></span><br>
                        <span>@lang('home.Total reviews') <span class="badge red">{{ count($companyReview) }} </span></span>
                    </p>
                    <hr>
                    <div class="row">
                    <div class="col-md-4">
                    <p>
                        <table>
                            <tr>
                                <td>@lang('home.Career Growth')</td>
                                <td>&nbsp;&nbsp;</td>
                                <td style="color:#d6a707">
                                <?php echo checkreview($career_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('home.Compensation & Benefits')</td>
                                <td>&nbsp;&nbsp;</td>
                                <td style="color:#d6a707">
                               <?php echo checkreview($benefit_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('home.Work/Life Balance')</td>
                                <td>&nbsp;&nbsp;</td>
                                <td style="color:#d6a707">
                                <?php echo checkreview($lifebalance_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('home.Management')</td>
                                <td>&nbsp;&nbsp;</td>
                                <td style="color:#d6a707">
                                <?php echo checkreview($management_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('home.Culture')</td>
                                <td>&nbsp;&nbsp;</td>
                                <td style="color:#d6a707">
                                <?php echo checkreview($culture_star) ?>
                                </td>
                            </tr>
                        </table>
                    </p>
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
                                    <span style="font-size:12px;color:#0d3f6b;">@lang('home.'.$ceo_recommend_star)</span>
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
                                    <span style="font-size:12px;color:#0d3f6b;">@if($recommend_star == 'on') Yes @else @lang('home.Not recommend') @endif</span>
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
                                    <span style="font-size:12px;color:#0d3f6b;">@lang('home.'.$future_star)</span>
                                    <p>@lang('home.Future Expectations')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- review by users -->
                
                @foreach($companyReview as $userreview)
                <div class="row ">
                  <div class="col-md-12">
                  <div class="jobs-suggestions">
                    <div class="pic col-md-1" align="center">
                      <div class="circle2">
                          @if($userreview->employee_sience)<img src="{{ url('profile-photos').'/'.$userreview->profilePhoto }}" class="img-circle fullwidth">@else <img src="{{ url('profile-photos').'/profile-logo3-1.jpg' }}" class="img-circle fullwidth"> @endif
                      </div>
                      @if($userreview->employee_sience)<strong class="font-16">{{ $userreview->lastName }}</strong>@endif
                    </div>
                    <div class="col-md-11">
                      <h4 style="width: 50%;float: left;">{{ $userreview->review_title }}</h4>
                      @if(Session::get('jcmUser')->userId == $userreview->userId)
                      <h4 style="width: 50%;float: right;text-align: right;"><a href="{{ url('account/employeer/companies/company/review?type=edit&&CompanyId='.$company->companyId)}}"><i class="fa fa-edit"></i></a> <a href="{{ url('account/employeer/companies/company/delete/'.$userreview->review_id.'?companyid='.$company->companyId)}}"><i class="fa fa-remove"></i></a></h4>
                      @endif
                      <div class="clearfix"></div>
                      <span style="color:#d6a707"><?php echo checkreview($userreview->overall_review) ?></span>
                      <span><?php 
					  if(app()->getLocale() == "kr"){
					      echo date('Y-m-d ', strtotime($userreview->created_date))."";
					  }else{
						   echo date('d M, Y ', strtotime($userreview->created_date));
					  }?></span>
					  @if($userreview->employee_sience)
                      <p>@lang('home.'.$userreview->job_type), @lang('home.Worked')  
					  <?php
					  if(app()->getLocale() == "kr"){
					     echo date('Y-m-d ', strtotime($userreview->employee_sience))." ~ ";
					  }else{
						echo "from ".date('M d, Y ', strtotime($userreview->employee_sience))." to ";
					  }
					  if(app()->getLocale() == "kr"){
					  echo ($userreview->current_working != 'Yes') ? date('Y-m-d ', strtotime($userreview->employer_upto)) : "현재 재직중";
                    }else{
						echo "to".($userreview->current_working != 'Yes') ? date('M d, Y ', strtotime($userreview->employer_upto)) : "Currently working"; 
					}
						
						if(app()->getLocale() == "kr"){
							 echo " ".$userreview->designation;
						  }else{
							echo "as ".$userreview->designation;
						  }
					
					
					?>	

					  </p>
					  @endif
                      <table style="width:100%">
                      <tr>
                        <th width="80">@lang('home.Recommend CEO'):</th>
                        <td style="color:#2e6da4"><i class="<?php echo checkfont($userreview->recommend_ceo)?>"></i></td>
                        <th width="110">@lang('home.Recommend to friend'):</th>
                        <td style="color:#2e6da4"><i class="<?php echo checkfont($userreview->recommend)?>"></i></td>
                        <th width="80">@lang('home.Company Future'):</th>
                        <td style="color:#2e6da4"><i class="<?php echo checkfont($userreview->future)?>"></i></td>
                      </tr>
                      </table>
                      <strong class="font-16">@lang('home.Pros'):</strong>
                      <p>{{ $userreview->pros }}</p>
                      <strong class="font-16">@lang('home.Cons'):</strong>
                      <p>{{ $userreview->cons }}</p>
                      <strong class="font-16">@lang('home.Advice to management')</strong>
                      <div>@lang('home.Career Growth') 
                        <span style="color:#d6a707"><?php echo checkreview($userreview->career_opportunity) ?></span>
                      </div>
                      <div>@lang('home.Compensation & Benefits')
                       <span style="color:#d6a707"><?php echo checkreview($userreview->benefits) ?></span>
                      </div>
                      <div>@lang('home.Work/Life Balance')
                        <span style="color:#d6a707"><?php echo checkreview($userreview->work_lifebalance) ?></span>
                      </div>
                      <div>@lang('home.Management')
                        <span style="color:#d6a707"><?php echo checkreview($userreview->rate_management) ?></span>
                      </div>
                      <div>@lang('home.Culture')
                        <span style="color:#d6a707"><?php echo checkreview($userreview->rate_culture) ?></span>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
          <div class="col-md-3">
            <div class="rtj-box">
				<a href="https://www.outsourcingok.com" target="_blank"><img src="{{ url('frontend-assets').'/images/outsourcingok.png' }}"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?php 
function checkfont($val){
    if($val == 'Recommended'){
        return 'fa fa-thumbs-up';
    }
    else if($val == 'Natural'){
        return 'fa fa-arrow-right';
    }
    else if($val == 'Not Recommended'){
        return 'fa fa-thumbs-down';
    }
    else if($val == 'on'){
        return 'fa fa-thumbs-up';
    }else if($val == 'Growing Up'){
        return 'fa fa-level-up';
    }
    else if($val == 'Growing Down'){
        return 'fa fa-level-down';
    }
    else if($val == 'Remain Same'){
        return 'fa fa-arrow-right';
    }else if($val == 'off'){
        return 'fa fa-level-down';
    }else{
		return 'fa fa-arrow-right';
    }

}
function checkreview($val){
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
<link href="{{ asset('frontend-assets/css/ihover.css') }}" rel="stylesheet">
<style type="text/css">
.ih-item.square.effect8 .info h3 {font-size: 13px;}
</style>
@endsection
@section('page-footer')
<script type="text/javascript">
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
                window.location.href = "{{ url('account/login?next=companies/company/'.Request()->segment(3)) }}";
            }else if($.trim(response) == 'done'){
            }
        }
    })
}
</script>
@endsection