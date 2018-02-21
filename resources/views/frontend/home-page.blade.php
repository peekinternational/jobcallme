@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<?php
$lToken = csrf_token();
?>
    <section class="main-slide">
        <div class="container">
            <div class="hp_strip">
                <div class="wrapper">
                    <h1 class="text-center">
                        @lang('home.headerHeading')
                    </h1>
                </div>
            </div>
            <div class="col-md-12 job-search">
                <!--<h1 class="second">Your Future Starts Here Now</h1>
                <h3 class="third">Finding your next job or career more 1000+ availabilities</h3>-->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#search_tab_1" data-toggle="tab">@lang('home.jobs')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_2" data-toggle="tab">@lang('home.companies') </a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_3" data-toggle="tab">@lang('home.peoples')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_4" data-toggle="tab">@lang('home.read')</a>
                                    </li>
                                    <li>
                                        <a href="#search_tab_5" data-toggle="tab">@lang('home.learn')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="search_tab_1">
                                        <form method="post" action="{{ url('jobs/homeJobSearch') }}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingjob')" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="width:100%">
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
                                                    <input type="search" placeholder="Looking for company..." name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="City" name="city" style="width: 100%">
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
                                                    <input type="search" placeholder="Looking for people..." name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="City" name="city" style="width: 100%">
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- read tab starts from here -->
                                    <div class="tab-pane" id="search_tab_4">
                                        <form role="form" method="POST" action="{{url('read')}}">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="keywords" name="keyword">
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <select class="form-control" id="home-cat" name="category" style="background: transparent;color: #fff">
                                                        <option value="0">Category</option>
                                                        @foreach(JobCallMe::getCategories() as $cat)
                                                        <option value="{{$cat->categoryId}}">{{$cat->name}}</option>
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
                                                    <input type="search" placeholder="keywords" name="keyword" >
                                                </div>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="City" name="city" style="width: 100%">
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
    <!--Slider Section End-->

    <section class="login-type-section">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-md-6 login-type ">
                    <div class=" hi-icon-effect-8">
                    <a href="{{ url('account/jobseeker') }}" class="hi-icon"> <i style="margin-top: 16px;"  class='fa fa-user'></a></i>
                    </div>
                    <p>@lang('home.ijobseeker')</p>
                    <span>@lang('home.postresume')</span>
                </div>
                <div class="col-md-6 login-type ">
                    <div class="hi-icon-effect-8">
                        <a href="{{ url('account/employer') }}" class="hi-icon"> <i style="margin-top: 16px;" class='fa fa-globe'></a></i>
                    </div>
                    <p>@lang('home.iemployer')</p>
                    <span>@lang('home.postjob')</span>
                </div>
            </div>
			<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="job-locations-box">
					@foreach(JobCallMe::getHomeCities() as $loca)
                        <a class="job-location" href="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca->state_id.'&city='.$loca->id )}}" style="background-color: {{ $colorArr[array_rand($colorArr)] }}"><span class="shine"></span><span class="text">Jobs in {{ $loca->name }}</span></a>
                    @endforeach
                       
                    </div>
                    <div class="clearfix"></div>
                    <div class="job-schedule-box">
					 @foreach($jobShifts as $shift)
                        <a href="{{ url('jobs?shift='.$shift->name) }}" class="hvr-shutter-in-horizontal">{{ $shift->name }}</a>
                    @endforeach
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="ticker-container">
            <!--<div class="ticker-caption">
                <p>Breaking News</p>
            </div>-->
            <ul>
			@foreach($jobs as $job)
                <div><li><span>{!! $job->title !!} &ndash; <a href="{{ url('jobs/'.$job->jobId) }}">Latest Job</a></span></li></div>
				@endforeach
               
            </ul>
        </div>
    </section>

    <!--Premium Jobs Section Start-->
    <section class="job-types-section">
        <div class="container">
		<div>
            <p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.prjob')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
			</div>
            <!-- Left to right-->
            <div class="row">
                <!--Premium Job Single item Start-->
				@foreach($jobs as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect15 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img pj-type-job">
                                <img class="img-responsive" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="height:70px;width:200px !important" alt="img">
                                <b class="pull-right">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="pj-single-details">
                                    <p>{!! $job->title !!}</p>
                                    <p>ASK Development</p>
                                    <p>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
								<p>{!! $job->description !!}</p>
                                
                                <div class="job-status eye-icon">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
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
        <div class="container">
		<p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.topcompanies')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
            
            <!--<p class="text-center" id="feature-companies-caption">Sigh ever way now many. Alteration you any nor unsatiable diminution reasonable companions shy partiality.</p>-->
            <!-- Scale up-->
            <div class="row">
			@foreach($companies as $comp)
                <div class="col-md-5ths">
                    <!-- colored -->
                    <div class="ih-item square effect8 scale_up tc-box">
                        <a href="{{ url('companies/company/'.$comp->companyId) }}">
                            <div class="img-class">
                                <img class="img-responsive img-inner" src="{!! $comp->companyLogo != '' ? url('/compnay-logo/'.$comp->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="" alt="img">
<span>{!! $comp->companyName !!}</span>
                            </div>
							<span class="brand-jobs-link">View {!! $comp->count !!}jobs</span>
                            <div class="info">
                                <h3>{!! $comp->companyName !!}</h3>
                                <p>{!! $comp->companyAbout !!}</p>
                              
                            </div>
							  
                        </a>
                    </div>
                    <!-- end colored -->
                </div>
@endforeach
            </div>
            <!-- end Scale up-->

        </div>
    </section>
    <!--Top Companies Section End-->

    <!--Hot Jobs Section Start-->
    <section class="job-types-section">
        <div class="container">
			<p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.hotjob')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Hot Job Single item Start-->
				 @foreach($hot as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect14 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img hj-type-job">
                                <img class="img-responsive" src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width:150px !important;height:50px;"  alt="img">
                                <b class="pull-right">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="pj-single-details">
                                    <p>{!! $job->title !!}</p>
                                    <p>ASK Development</p>
                                    <p>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p>{!! $job->description !!}</p>
                                <div class="job-status eye-icon">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
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
    <section class="job-types-section" id="latest-jobs">
        <div class="container">
		<p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.latestjob')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>
          
            <div class="row">
                <!--Latest Job Single item Start-->
				@foreach($Gallery as $job)
                <div class="col-sm-3">
                    <div class="ih-item square effect13 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img lj-type-job">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width:115px !important;height:35px;" alt="img">
                                <b class="pull-right">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="lj-single-details">
                                    <p>{!! $job->title !!}</p>
                                    <p>ASK Development</p>
                                    <p>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p>{!! $job->description !!}</p>
                                <div class="job-status eye-icon">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
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
    <section class="job-types-section">
        <div class="container">
		<p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.specialjob')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
			@foreach($jobs as $job)
                <!--Special Job Single item Start-->
                <div class="col-md-5ths">
                    <div class="ih-item square effect2">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                        <div class="img sj-job-type">
                            <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 50px !important;height:21px;"  alt="img">
                            <b class="pull-right">{!! $job->companyName !!}</b>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="lj-single-details">
                                <p>{!! $job->title !!}</p>
                                <p>ASK Development</p>
                                <p>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                            </div>
                        </div>
                        <div class="info">
                            <h3>{!! $job->companyName !!}</h3>
                            <p>{!! $job->description !!}</p>
                            <div class="job-status eye-icon">
                                <i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>
                            </div>
                            <div class="job-status days-left">
                                <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
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
    <section class="job-types-section" style="background-color: #FFFFFF">
        <div class="container">
		<p style="font-size: 24px;margin-top: 12px;"><span>@lang('home.goldjob')</span><span style="float:right"><a style="color:#333" href="{{ url('account/employer/job/new') }}">@lang('home.postjoblike')</a></span></p>

            <div class="row">
                <div id="check"></div>
                <!--Golden Job Single item Start-->
					@foreach($jobs as $job)
                <div class="col-md-5ths">
                    <div class="ih-item square effect2">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img sj-job-type">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 50px !important;height:21px;" alt="img">
                                <b class="pull-right">{!! $job->companyName !!}</b>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="lj-single-details">
                                    <p>{!! $job->title !!}</p>
                                    <p>ASK Development</p>
                                    <p>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</p>
                                </div>
                            </div>
                            <div class="info">
                                <h3>{!! $job->companyName !!}</h3>
                                <p>{!! $job->description !!}</p>
                                <div class="job-status eye-icon">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<i class="fa fa-heart"></i>
                                </div>
                                <div class="job-status days-left">
                                    <span>{{ JobCallMe::timeInDays($job->expiryDate) }} days left</span>
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
  
</script>
@endsection
<style type="text/css">
    select option{
        color:#000;
    }
</style>