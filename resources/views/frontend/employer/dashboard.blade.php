@extends('frontend.layouts.app')

@section('title','Employer')

@section('inner-header')
    @include('frontend.includes.employer-nav')
@endsection

@section('content')
<!--Graph Section-->

<section id="employer-graph">
    <div class="container">
        <div class="row">
		@if (Session::has('message'))
   <div class="alert alert-success  alert-dismissable" style="position: absolute;z-index: 999;width: 86%;"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>{{ Session::get('message') }}</div>
@endif
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.jobresponse')</h4>
                    <canvas id="job-response"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.experiencelevel')</h4>
                    <canvas id="experience-level"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="eg-job-response">
                    <h4>@lang('home.recruitmentactivity')</h4>
                    <canvas id="recruitment-activity"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<!--related-job-->
<section id="relate-to-job">
    <div class="container">
        <div class="row">
            <!--RTJ- Left start-->
            <div class="col-md-7">
				<div class="follow-companies2" style="background:#57768a;color:#fff;">
                    <!-- <ul class="nav nav-tabs"> -->
					<ul class="nav nav-tabs">
                       <li class="active" style="width:33.3%">
                            <a href="#rtj_tab_posted_jobs" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-bars" aria-hidden="true"></i> @lang('home.postedjobs')</a>
                        </li>
                        <li style="width:33.3%">
                            <a href="#rtj_tab_recent_application" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-address-book"></i> @lang('home.recentapplicant')</a>
                        </li>
                        <li style="width:33.3%">
                            <a href="#rtj_tab_interview" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-calendar"></i> @lang('home.upcominginterviews') </a>
                        </li>
                   </ul>
				</div>
                <div class="rtj-box">                    
                    <div class="tab-content joblisting">
                        <div class="tab-pane active" id="rtj_tab_posted_jobs">
						<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
                            @foreach($postedJobs as $pjobs)
							
                                <div class="col-xs-10 col-md-10 rtj-item">
							
                                    <div class="rtj-details">
                                        <p><strong><a href="{{ url('jobs/'.$pjobs->jobId) }}">{!! $pjobs->title !!}</a></strong> <i class="fa fa-check-circle-o"></i></p>
										<?php ($opcl = strtotime($pjobs->expiryDate) <= strtotime(date('Y-m-d')) ? 'Closed' : 'Open')?>
                                         <p>@lang('home.'.$opcl)                                        
										 <span class="label" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">{!! $pjobs->p_title !!}</span>
										 
										
										@if ($pjobs->p_title =='Basic')
											<a href="{{ url('account/employer/jobupdate/'.$pjobs->jobId) }}">(@lang('home.upgrade'))</a>
                                         @else
											 @endif
										 </p>
										 <p><i class="fa fa-users"></i> {{ $pjobs->count}}</p>
                                    </div>
									
                                </div>
									<div class="col-xs-2 col-md-2"><div class="dropdown">
									  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									  <div class="dropdown-content">
										<a href="{{url('account/employer/job_update/'.$pjobs->jobId)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> @lang('home.edit')</a>
										<a href="{{url('account/employer/setfilter/'.$pjobs->jobId)}}"><i class="fa fa-filter" aria-hidden="true"></i> @lang('home.filters')</a>
										<a href="{{url('account/employer/job/share/'.$pjobs->jobId)}}"><i class="fa fa-share-alt" aria-hidden="true"></i> @lang('home.share')</a>
										<a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> @lang('home.status')</a>
										<a href="#"><i class="fa fa-question" aria-hidden="true"></i> @lang('home.evaluation')</a>
										<a href="{{ url('account/employer/delete/'.$pjobs->jobId) }}"><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('home.delete')</a>
									  </div>
									</div></div>
                            @endforeach
							 <div class="col-md-12">
                                <a href="{{ url('jobs')}}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                            </div>
						<div style="text-align:center"><?php	echo $postedJobs->render(); ?></div>
                        </div>
                        <!--Recent Applicant Start-->
                        <div class="tab-pane" id="rtj_tab_recent_application">
                            @foreach($applicant as $appl)
                                <div class="col-md-12 rtj-item">
                                    <img src="{{ url('profile-photos/'.$appl->profilePhoto) }}" style="width: 50px">
                                    <div class="rtj-details">
                                        <p><strong><a href="{{ url('account/employer/application/candidate/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></strong></p>
                                        <p>{!! $appl->title !!}</p>
                                        <p>{{ date('d M',strtotime($appl->applyTime)) }}</p>
                                    </div>
                                </div>
                            @endforeach
							 <div class="col-md-12">
                                <a href="{{ url('account/employer/application')}}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                            </div>
							<div style="text-align:center"><?php	echo $postedJobs->render(); ?></div>
                        </div>
                        <!--Recent Applicant End-->

                        <!--Upcoming Interviews Start-->
                        
                        @foreach( $upcommingInterviews as $interview)
                        <div class="tab-pane" id="rtj_tab_interview">
                            <div class="col-md-12 rtj-item">
                                <img src="{{ url('profile-photos/'.$interview->profilePhoto)}}" style="width: 50px">
                                <div class="rtj-details">
                                    <p><strong><a href="{{ url('account/employer/application/candidate/'.$interview->jobseekerId) }}">{{ $interview->firstName." ".$interview->lastName}}</a></strong></p>
                                    <p><a href="{{ url('jobs/'.$interview->jobId) }}">{{ $interview->title }}</a> <span class="label" style="background-color:{{ $colorArr[array_rand($colorArr)] }}"><a style="color:#fff" href="{{ url('account/employer/application/candidate/'.$interview->jobseekerId) }}">interview Details</a></span></p>
                                    <p><i class="fa fa-clock-o"></i>  {{ $interview->fromDate }} to {{ $interview->toDate }}   <i class="fa fa-map-marker"></i> {{ $interview->country }}, {{ $interview->state }}, {{ $interview->city }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('account/employer/application?show=interview')}}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                            </div>
                        </div>
                        @endforeach
                        <!--Upcoming Interviews End-->
                    </div>
                </div>
            </div>
            <!--RTJ- Left end-->

            <!--RTJ- Right start-->
            <div class="col-md-5" style="margin-bottom:50px">
                <!--Follow Companies - Start -->
                <div class="follow-companies2" style="background:#57768a;color:#fff;">
                    <h4>@lang('home.suggestedpeople')</h4>
				</div>
				<div class="follow-companies">	
                    <div class="row">
					@foreach($applicants as $appl)
					 <?php
                        $pImage = url('profile-photos/profile-logo.jpg');
                        if($appl->profilePhoto != '' && $appl->profilePhoto != NULL){
                        $pos = strpos($appl->profilePhoto,"ttp");
                            if($pos == 1)
                            {
                            $pImage = url($appl->profilePhoto);
                            } 
                            else{
                                $pImage = url('profile-photos/'.$appl->profilePhoto);
                                }
                                            
                                    }
                                    ?>
                        <div class="col-md-4 col-xs-6 sp-item" style="padding-top:10px">
						
								<img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }}@endif" style="width: 70px;height:75px !important;">
							
						
								<p><a href="{{ url('account/employer/application/applicant/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
								<p>{!! $appl->companyName !!}</p>
								<p>{{ JobCallMe::cityName($appl->city) }}, {{ JobCallMe::countryName($appl->country) }}</p>

							
						
						</div>
						 @endforeach

                      

                        <hr>
                        <div class="col-md-12">
                            <a href="people" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                        </div>
                    </div>
                </div>


				 <div class="follow-companies2" style="background:#605e63;color:#fff;">
                    <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.write')</span></a>
                    <h4>@lang('home.suggestedreading')</h4>
				</div>
				<div class="suggested-reading">
                    
					   @foreach($read_record as $rec)
					   <?php
                        $pImage = url('profile-photos/profile-logo.jpg');
                        if($rec->wIcon != '' && $rec->wIcon != NULL){
                            $pImage = url('article-images/'.$rec->wIcon);
                        }
                        ?>
                    <div class="col-md-12 sr-item">
						<div class="col-md-4 col-xs-12">
							<img src="{{ $pImage }}" style="width: 100%;height:autopx !important;">
						</div>
						<div class="col-md-8 col-xs-12" style="padding-top:10px">
							<div class="sr-details">
								<p class="sr-title"><a href="{{ url('read') }}">{!! $rec->title !!} </a> </p>
								<p class="sr-author"><a href="#"><span class="glyphicon glyphicon-user"></span> @lang('home.'.$rec->name)</a> </p>
							</div>
						</div>
                    </div>
					   @endforeach

                    <div class="col-md-12">
                        <a href="{{ url('read') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                    </div>
                </div>


				<div class="follow-companies2" style="background:#8a9fa0;color:#fff;">
                    <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</span></a>
                    <h4>@lang('home.ImproveCompetitiveAdvantage')</h4>					
				</div>
				<div class="follow-companies">
                    <!-- <h4 class="pull-left">@lang('home.ImproveCompetitiveAdvantage')</h4><h5 class="pull-right">@lang('home.ADVERTISE')</h5>
                    <hr style="margin-top:44px !important"> -->
                    <div class="row">
				            @foreach($lear_record as $rec)
                   
                      <div class="col-md-12 sr-item">
				      <div class="col-md-4 col-xs-12">
<<<<<<< HEAD
                        <div class="sr-item-img">
                            @if($rec->upskillImage != '')
                            <img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 100%;height:80px;">
                            @else
                            <img src="{{ url('upskill-images/d-cover.jpg') }}" style="width: 100%;height:80px !important;">
                            @endif
                        </div>
=======
                        @if($rec->upskillImage != '')
                        <img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 100%;height:auto;">
                        @else
                        <img src="{{ url('upskill-images/d-cover.jpg') }}" style="width: 100%;height:80px !important;">
                        @endif
>>>>>>> 28d3ae96a13b1fa20b2df19d14db97193e5f8faa
						</div>
                        <div class="col-md-8 col-xs-12" style="margin-top: 10px;">
                            <p> <a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}" class="la-title">{!! $rec->title !!}</a></p>
                            
                            <span>@lang('home.'.$rec->type)</span>
                            <p><i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($rec->startDate))}} <i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</p>
                            
                            <span><i class="fa fa-map-marker"></i> {{ JobCallMe::cityName($rec->city) }},{{ JobCallMe::countryName($rec->country) }}</span>
                            
                       </div>
                   </div>
                
            @endforeach

                      

                        <hr>
                        <div class="col-md-12">
                            <a href="{{url('learn/search')}}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                        </div>
                    </div>
                </div>



		</div>
                
			
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
    var ctx = document.getElementById('job-response').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: [{!! implode(',',$response[0]) !!}],
            datasets: [{
                label: "Job response",
                //backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [{!! implode(',',$response[1]) !!}],
            }]
        },

        // Configuration options go here
        options: {}
    });
    var ctx = document.getElementById("experience-level");
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
           labels: [{!! implode(',',$experience[0]) !!}],
            datasets: [{
                label: '# of Votes',
                data: [{!! implode(',',$experience[1]) !!}],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 170, 125, 1)',
                    'rgba(75, 120, 225, 1)',
                    'rgba(54, 120, 54, 1)',
                    'rgba(220,60,232,1)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 170, 64, 1)',
                    'rgba(75, 120, 225, 1)',
                    'rgba(54, 120, 54, 1)',
                    'rgba(220,60,232,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById("recruitment-activity");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [{!! implode(',',$recruit[0]) !!}],
            datasets: [{
                label: "@lang('home.recruitmentactivity')",
                data: [{!! implode(',',$recruit[1]) !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection