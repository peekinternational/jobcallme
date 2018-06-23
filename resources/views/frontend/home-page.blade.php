@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<?php
$lToken = csrf_token();
?>
    <section class="main-slide">
        <div class="container">
            <!-- <div class="hp_strip">
                <div class="wrapper">
                    <h2 class="text-center" style="padding-top:85px;">
                        @if(app()->getLocale() == "kr")
						    <div id="hp_text"></div>@lang('home.headerHeading')
						@else
						    <div id="hp_text2"></div>@lang('home.headerHeading')
						@endif
                    </h2>
                </div>
            </div> -->
            <div class="col-md-12 job-search">
                <!--<h1 class="second">Your Future Starts Here Now</h1>
                <h3 class="third">Finding your next job or career more 1000+ availabilities</h3>-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs " style="padding-left:10px">
                                    <li class="active">
                                        <a href="#search_tab_1" data-toggle="tab">@lang('home.jobs_search')</a>
                                    </li>
                                    <li style="padding-left:10px">
                                        <a href="#search_tab_2" data-toggle="tab">@lang('home.companies_search') </a>
                                    </li>
                                    <li style="padding-left:10px">
                                        <a href="#search_tab_3" data-toggle="tab">@lang('home.peoples_search')</a>
                                    </li>
                                    <li style="padding-left:10px">
                                        <a href="#search_tab_4" data-toggle="tab">@lang('home.read_search')</a>
                                    </li>
                                    <li style="padding-left:10px">
                                        <a href="#search_tab_5" data-toggle="tab">@lang('home.learn_search')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="search_tab_1">
                                        <form method="get" action="{{ url('jobs') }}">
                                      
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingjob')" name="keyword">
                                                </div>
                                               
                                                <div class="search-field-box search-item">
                                                                                   
                                                <select class="jobs-countrys" name="country" style="width: 98%;">
                                                    <option value="0">@lang('home.country')</option>
                                                    @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                                    @endforeach
                                                </select>
                                        
                                                <select class=" jobs-states" name="state" id="state_id"  style="width: 98%;display:none; margin-bottom: 7px;margin-top: 7px;">
                                                    <option value="0">@lang('home.state')</option>
                                                </select>
                                            
                                                <select class=" jobs-citys" name="city" id="city_id"  style="width: 98%;display:none;">
                                                    <option value="0">@lang('home.city')</option>
                                                </select>
                                            </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_2">
                                        <form role="form" method="POST" action="{{ url('companies')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingcompany')" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                <select class="country-countrys" name="country" style="width: 98%;">
                                                    <option value="0">@lang('home.country')</option>
                                                    @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                                    @endforeach
                                                </select>
                                        
                                                <select class="country-states" name="state" id="state_country"  style="width: 98%;display:none; margin-bottom: 7px;margin-top: 7px;">
                                                    <option value="0">@lang('home.state')</option>
                                                </select>
                                            
                                                <select class="country-citys" name="city" id="city_country"  style="width: 98%;display:none;">
                                                    <option value="0">@lang('home.city')</option>
                                                </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_3">
                                        <form role="form" method="POST" action="{{url('account/people')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingpeople')" name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                <select class="people-countrys" name="country" style="width: 98%;">
                                                    <option value="0">@lang('home.country')</option>
                                                    @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                                    @endforeach
                                                </select>
                                        
                                                <select class="people-states" name="state" id="state_people"  style="width: 98%;display:none; margin-bottom: 7px;margin-top: 7px;">
                                                    <option value="0">@lang('home.state')</option>
                                                </select>
                                            
                                                <select class="people-citys" name="city" id="city_people"  style="width: 98%;display:none;">
                                                    <option value="0">@lang('home.city')</option>
                                                </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- read tab starts from here -->
                                    <style>
                                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                                        color: #cccccc !important;
                                        line-height: 28px; }
                                    </style>
                                    <div class="tab-pane" id="search_tab_4">
                                        <form role="form" method="POST" action="{{url('read')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingread')" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <select class="form-control" id="home-cat" name="category" style="background: transparent;color: #fff">
                                                        <option value="0">@lang('home.category')</option>
                                                        @foreach(JobCallMe::getReadCategories() as $cat)
                                                        <option value="{{$cat->id}}">@lang('home.'.$cat->name)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- learn tab starts from here -->
                                    <div class="tab-pane" id="search_tab_5">
                                        <form role="form" method="POST" action="{{url('learn/search')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookinglearn')" name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                <select class="learn-countrys" name="country" style="width: 98%;">
                                                    <option value="0">@lang('home.country')</option>
                                                    @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                                    @endforeach
                                                </select>
                                        
                                                <select class="learn-states" name="state" id="state_learn"  style="width: 98%;display:none; margin-bottom: 7px;margin-top: 7px;">
                                                    <option value="0">@lang('home.state')</option>
                                                </select>
                                            
                                                <select class="learn-citys" name="city" id="city_learn"  style="width: 98%;display:none;">
                                                    <option value="0">@lang('home.city')</option>
                                                </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
     <span style="padding-left:10px"><button type="submit" class="btn btn-warning btn-sm" id="Quickbutton" onclick="myFunction()"> @lang('home.Close Quick View V')</span>  </button>
</div>
                                               
    <!--Slider Section End-->

    <section class="login-type-section" id="QuickView">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6 login-type ">
                    <div class=" hi-icon-effect-8">
                    <a href="{{ url('account/jobseeker') }}" class="hi-icon"> <img src="frontend-assets/images/jobseek_icon.png"></a>
                    </div>
                    <p style="font-size:17px;padding-top:5px;"><b>@lang('home.ijobseeker')</b></p>
                    <span>@lang('home.postresume')</span>
                </div>
                <div class="col-md-6 login-type ">
                    <div class="hi-icon-effect-8">
                        <a href="{{ url('account/employer') }}" class="hi-icon"> <img src="frontend-assets/images/employer_icon.png"></a>
                    </div>
                    <p style="font-size:17px;padding-top:5px;"><b>@lang('home.iemployer')</b></p>
                    <span>@lang('home.postjob_main')</span>
                </div>
            </div>
			<?php $colorArr = array('#57768a','#96aaa8','#a09d8e','#605e63','#9e947b','#8a9fa0','#695244','#5b5c5e','#7b767d','#a0b1b9','#6d846f','#a8b3b9') ?>
          @if(Session()->has('jcmUser'))
            <div class="row">
                <div class="col-md-12">
                    <div class="job-locations-box">

						<a class="job-location" href="{{ url('jobs?country='.JobCallMe::getHomeCountry() )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}"><span class="shine"></span><span class="text">@lang('home.All')<!-- @lang('home.jobsin') --></span></a>
					@foreach(JobCallMe::getJobStates(JobCallMe::getHomeCountry()) as $loca2)
                        <a class="job-location" href="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca2->id )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}"><span class="shine"></span><span class="text">@lang('home.'.$loca2->name)</span></a>
                    @endforeach
                       
                    </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="job-schedule-box">
					 @foreach(JobCallMe::getJobType() as $shift)
                        <a href="{{ url('jobs?type='.$shift->name) }}" class="hvr-shutter-in-horizontal">@lang('home.'.ucfirst($shift->name))</a>
                    @endforeach
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
	<div class="hidden-xs" style="margin-top:10px">&nbsp;</div>
        <div class="ticker-container" style="margin-top:25px;">
			
            <!--<div class="ticker-caption">
                <p>Breaking News</p>
            </div>-->
            <ul>
			@foreach($premium as $job)
                <div><li><span>{!! $job->title !!} &ndash; <a href="{{ url('jobs/'.$job->jobId) }}">@lang('home.Latest Job')</a></span></li></div>
				@endforeach
               
            </ul>
        </div>
    </section>

    <!--Premium Jobs Section Start-->
    <div class="container" style="background: #fff;
                                    margin-top: -12px;
                                    /* margin-bottom: -10px; */
                                    width: 100%;
                                    /* margin-left: 64px; */
                                    padding-left: 20px;
                                    padding-bottom: 27px;">
              <div class="col-md-offset-2 hidden-xs" style="margin-top:2px">
                <span style="padding-left:11px;"><button type="submit" class="btn btn-success btn-sm" id="mainbutton" onclick="myFunctions()"> @lang('home.Close AD View')  </button></span>
                    </div>

			  <div class="col-md-offset-2 hidden-sm hidden-md hidden-lg" style="margin-top:-3px">
                <span style="padding-left:5px;"><button type="submit" class="btn btn-success btn-sm" id="mainbutton2" onclick="myFunctions2()"> @lang('home.Close AD View')  </button></span>
                    </div>

                    </div>
    <div id="maindiv" class="feature-companies">
     
    <section class="job-types-section" style="background:#fff;margin-top:-12px;margin-bottom:-10px;">
   
        <div class="container">
		<div>
            <p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.prjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
			</div>
            <!-- Left to right-->
            <div class="row">
                <!--Premium Job Single item Start-->
				@foreach($premium as $job)
				<?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
                <!--Premium Job Single item End-->
@endforeach
                <!--Premium Job Single item End-->
            </div>
        </div>
    </section>
    <!--Premium Jobs Section End-->

    <!--Top Companies Section Start-->
    <section class="feature-companies">
        <div class="container" style="padding-top:10px;padding-bottom:10px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.topcompanies')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
            
            <!--<p class="text-center" id="feature-companies-caption">Sigh ever way now many. Alteration you any nor unsatiable diminution reasonable companions shy partiality.</p>-->
            <!-- Scale up-->
            <div class="row">
			@foreach($top_jobs as $job)
            <?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
@endforeach
            </div>
            <!-- end Scale up-->

        </div>
    </section>
    <!--Top Companies Section End-->

    <!--Hot Jobs Section Start-->
    <section class="job-types-section" id="latest-jobs">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
			<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.hotjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Hot Job Single item Start-->
				 @foreach($hot as $job)
                 <?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
                <!--Hot Job Single item End-->

 @endforeach
            </div>
        </div>
    </section>
    <!--Hot Jobs Section End-->

    <!--Latest Jobs Section Start-->
    <section class="job-types-section">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.latestjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Latest Job Single item Start-->
				@foreach($latest as $job)
                <?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
                <!--Latest Job Single item End-->

          @endforeach
                <!--Latest Job Single item End-->
            </div>
        </div>
    </section>
    <!--Latest Jobs Section End-->

    <!--Special Jobs Section Start-->
    <section class="job-types-section" id="latest-jobs">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.specialjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
			@foreach($special as $job)
            <?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
                <!--Special Job Single item End-->
   @endforeach
                <!--Special Job Single item Start-->
          
                <!--Special Job Single item End-->
            </div>
        </div>
    </section>
    <!--Special Jobs Section End-->

    <!--Golden Jobs Section Start-->
    <section class="job-types-section">
        <div class="container" style="padding-top:0px;padding-bottom:0px;">
		<p style="font-size: 17px;margin-top: 12px;"><span>@lang('home.goldjob')</span><span style="float:right"><a style="font-size: 12px;color:#d7a707" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
                <div id="check"></div>
                <!--Golden Job Single item Start-->
					@foreach($golden as $job)
                    <?php
			 $string = $job->title;
			 if (strlen($string) > 60) {

                        // truncate string
                            $stringCut = substr($string, 0, 60);
                             $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                            
                        }
			?>
                <div class="col-sm-4">
                    <div class="ih-item square effect8 scale_up tc-box">
                        
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="mobile-suggestions ">
                           <div class="row">
					<div class="col-xs-3 jobs-logo" style="padding-left:0;"><img style="width:100%; position: relative;" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" >

                    </div>
                     <div class="col-xs-9" style="padding-left:0; padding-right:0;">
                     <h5 style="overflow: hidden; height: 16px;">{{$string}}</h5>
                     <p style="font-size: 12px;color: #71787b; overflow: hidden; height: 16px;">{{$job->companyName}}</p>
                     <p style="font-size: 13px;overflow: hidden; height: 16px;">{{JobCallMe::cityName($job->city).', '.JobCallMe::countryName($job->country)}} </p>
                     
                    </div>
                    

                         <div class="info" style="overflow: hidden;">
                                <h3>{!! $job->companyName !!}</h3>
								<p style="padding-top:10px">{!! $string !!}
								
                                
                                <div class="job-status eye-icon">
                                    <span style="padding-right:20px">@lang('home.vacancies') {!! $job->vacancies !!}</span><i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>&nbsp;D-{{ JobCallMe::timeInDays($job->expiryDate) }}
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryAd) }}@lang('home.days left')</span>
                                </div>
                            </div>
                    </div>
                    </div>
                        </a>
                    </div>
                    </div>
                <!--Golden Job Single item End-->
  @endforeach
               
            </div>
        </div>
    </section>
    </div>
    <!--Golden Jobs Section End-->
@endsection
@section('page-footer')
<script type="text/javascript">

    $(document).ready(function(){
        $('#home-cat').select2();
        $('#feed').on('mouseover',function(){
            $('#fpi_content form input[type="hidden"]').remove();
            $('#fpi_content form').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
        });
        $('#homeJobSearch').on('submit',function(e){
            e.preventDefault();
            window.location.href = 'jobs/homeJobSearch';
            /*$.ajax({
                url:'jobs/homeJobSearch',
                data:new FormData(this),
                type:'POST',
                processData: false,
                contentType: false,
                cache:false,
                success:function(res){
                    $('#check').html(res);
                    console.log(res);
                }
            });*/
        });  
    });
  $("#Quickbutton").click(function(){
    $("#QuickView").toggle();
});
 $("#mainbutton").click(function(){
    $("#maindiv").toggle();
});

$("#mainbutton2").click(function(){
    $("#maindiv").toggle();
});
function myFunction() {
    var x = document.getElementById("Quickbutton");
    if (x.innerHTML === "@lang('home.Open Quick View V')") {
        x.innerHTML = "@lang('home.Close Quick View V')";
    } else {
        x.innerHTML = "@lang('home.Open Quick View V')";
    }
}
function myFunctions() {
    var x = document.getElementById("mainbutton");
    if (x.innerHTML === "@lang('home.Open AD View')") {
        x.innerHTML = "@lang('home.Close AD View')";
    } else {
        x.innerHTML = "@lang('home.Open AD View')";
    }
}
function myFunctions2() {
    var x = document.getElementById("mainbutton2");
    if (x.innerHTML === "@lang('home.Open AD View')") {
        x.innerHTML = "@lang('home.Close AD View')";
    } else {
        x.innerHTML = "@lang('home.Open AD View')";
    }
}

$('.jobs-countrys').on('change',function(){
    var countryId = $(this).val();
    $('#state_id').show();
    $(".tabbable-panel").css("height", "200px");
    getStatess(countryId)
})
function getStatess(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            console.log(response)
            

            var currentState = $('.jobs-states').attr('data-state');
            $(".jobs-states").html('').trigger('change');
                $(".jobs-states").append(response).trigger('change');
           
        }
    })
}
$('.jobs-states').on('change',function(){
    var stateId = $(this).val();
   
    getCitiess(stateId)
})
function getCitiess(stateId){
   
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            $('#city_id').show();
            var currentCity = $('.jobs-citys').attr('data-city');
           
            $(".jobs-citys").html('').trigger('change');
           
                $(".jobs-citys").append(response).trigger('change');
            
        }
    })
}

$('.country-countrys').on('change',function(){
    var countryId = $(this).val();
    $('#state_country').show();
    $(".tabbable-panel").css("height", "200px");
    getStatesss(countryId)
})
function getStatesss(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            console.log(response)
            

            var currentState = $('.country-states').attr('data-state');
            $(".country-states").html('').trigger('change');
                $(".country-states").append(response).trigger('change');
           
        }
    })
}

$('.country-states').on('change',function(){
    var stateId = $(this).val();
   
    getCitiesss(stateId)
})
function getCitiesss(stateId){
   
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            $('#city_country').show();
            var currentCity = $('.country-citys').attr('data-city');
           
            $(".country-citys").html('').trigger('change');
           
                $(".country-citys").append(response).trigger('change');
            
        }
    })
}

$('.people-countrys').on('change',function(){
    var countryId = $(this).val();
    $('#state_people').show();
    $(".tabbable-panel").css("height", "200px");
    getStatessss(countryId)
})
function getStatessss(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            console.log(response)
            

            var currentState = $('.people-states').attr('data-state');
            $(".people-states").html('').trigger('change');
                $(".people-states").append(response).trigger('change');
           
        }
    })
}

$('.people-states').on('change',function(){
    var stateId = $(this).val();
   
    getCitiessss(stateId)
})
function getCitiessss(stateId){
   
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            $('#city_people').show();
            var currentCity = $('.people-citys').attr('data-city');
           
            $(".people-citys").html('').trigger('change');
           
                $(".people-citys").append(response).trigger('change');
            
        }
    })
}

$('.country-states').on('change',function(){
    var stateId = $(this).val();
   
    getCitiesss(stateId)
})
function getCitiesss(stateId){
   
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            $('#city_country').show();
            var currentCity = $('.country-citys').attr('data-city');
           
            $(".country-citys").html('').trigger('change');
           
                $(".country-citys").append(response).trigger('change');
            
        }
    })
}

$('.learn-countrys').on('change',function(){
    var countryId = $(this).val();
    $('#state_learn').show();
    $(".tabbable-panel").css("height", "200px");
    getStatesssss(countryId)
})
function getStatesssss(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            console.log(response)
            

            var currentState = $('.learn-states').attr('data-state');
            $(".learn-states").html('').trigger('change');
                $(".learn-states").append(response).trigger('change');
           
        }
    })
}

$('.learn-states').on('change',function(){
    var stateId = $(this).val();
   
    getCitiesssss(stateId)
})
function getCitiesssss(stateId){
   
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            $('#city_learn').show();
            var currentCity = $('.learn-citys').attr('data-city');
           
            $(".learn-citys").html('').trigger('change');
           
                $(".learn-citys").append(response).trigger('change');
            
        }
    })
}

function firstCapitals(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}

</script>
@endsection
<style type="text/css">
    select option{
        color:#000;
    }
</style>