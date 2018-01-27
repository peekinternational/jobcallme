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
                    <h1 class="text-center"><div id="hp_text2"></div></h1>
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
                                        <form role="form" action="#">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="@lang('home.lookingjob')" name="searchByJob">
                                                </div>
                                                 <div class="search-field-box search-location">
                                                    <select class="location" name="search-by-location">
                                                        <option value="AL">@lang('home.alllocation')</option>
                                                         @foreach(JobCallMe::getJobCountries() as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_2">
                                        <form role="form" action="#">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="Looking for company..." name="searchByCompany">
                                                </div>
                                                <div class="search-field-box search-location">
                                                    <select class="location" name="search-by-location">
                                                        <option value="AL">All Location</option>
                                                       @foreach(JobCallMe::getCategories() as $cat)
                                                        <option value="{{ $cat->categoryId }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="search-btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="search_tab_3">
                                        <form role="form" action="#">
                                            <div class="input-fields">
                                                <div class="search-field-box search-item">
                                                    <input type="search" placeholder="Looking for people..." name="searchByPeople">
                                                </div>
                                                <div class="search-field-box search-location">
                                                    <select class="location" name="search-by-location">
                                                        <option value="AL">All Location</option>
                                                       @foreach(JobCallMe::getCategories() as $cat)
                                                        <option value="{{ $cat->categoryId }}">{{ $cat->name }}</option>
                                                    @endforeach
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
            <h3>@lang('home.prjob')</h3>
            <!-- Left to right-->
            <div class="row">
                <!--Premium Job Single item Start-->
				@foreach($jobs as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect15 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img pj-type-job">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 85px !important;height:85px;" alt="img">
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
            <h2 class="text-center">@lang('home.topcompanies')</h2>
            <!--<p class="text-center" id="feature-companies-caption">Sigh ever way now many. Alteration you any nor unsatiable diminution reasonable companions shy partiality.</p>-->
            <!-- Scale up-->
            <div class="row">
			@foreach($companies as $comp)
                <div class="col-sm-3">
                    <!-- colored -->
                    <div class="ih-item square effect8 scale_up tc-box">
                        <a href="{{ url('companies/company/'.$comp->companyId) }}">
                            <div class="img">
                                <img src="{!! $comp->companyLogo != '' ? url('/compnay-logo/'.$comp->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width:180px;height:180px;margin-bottom: 17px;" alt="img">
                              
                            </div>
							<span class="brand-jobs-link">View 2 jobs</span>
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
            <h3>@lang('home.hotjob')</h3>
            <div class="row">
                <!--Hot Job Single item Start-->
				 @foreach($hot as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect14 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img hj-type-job">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 85px !important;height:85px;"  alt="img">
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
            <h3>@lang('home.latestjob')</h3>
            <div class="row">
                <!--Latest Job Single item Start-->
				@foreach($Gallery as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect13 left_to_right">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img lj-type-job">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 85px !important;height:85px;" alt="img">
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
            <h3>@lang('home.specialjob')</h3>
            <div class="row">
			@foreach($jobs as $job)
                <!--Special Job Single item Start-->
                <div class="col-sm-4">
                    <div class="ih-item square effect2">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                        <div class="img sj-job-type">
                            <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 85px !important;height:85px;"  alt="img">
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
            <h3>@lang('home.goldjob')</h3>
            <div class="row">
                <!--Golden Job Single item Start-->
					@foreach($jobs as $job)
                <div class="col-sm-4">
                    <div class="ih-item square effect2">
                        <a href="{{ url('jobs/'.$job->jobId) }}">
                            <div class="img sj-job-type">
                                <img src="{!! $job->companyLogo != '' ? url('/compnay-logo/'.$job->companyLogo) : url('/compnay-logo/default-logo.jpg') !!}" style="width: 85px !important;height:85px;" alt="img">
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
</script>
@endsection
