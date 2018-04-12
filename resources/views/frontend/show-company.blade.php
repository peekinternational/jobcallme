@extends('frontend.layouts.app')

@section('title', $company->companyName)

@section('content')
<?php
$cCover = url('compnay-logo/default-cover.jpg');
if($company->companyCover != ''){
  $cCover = url('compnay-logo/'.$company->companyCover);
}
$cLogo = url('compnay-logo/default-logo.jpg');
if($company->companyLogo != ''){
  $cLogo = url('compnay-logo/'.$company->companyLogo);
}
$opHour = json_decode($company->companyOperationalHour,true);
?>
<section id="edit-organization">
    <div class="container">
        <div class="eo-box">
            <div class="eo-timeline">
                <img src="{{ $cCover }}" class="eo-timeline-cover">
            </div>
            <div class="col-md-12">
               <div class="row">
                   <div class="col-md-2 eo-dp-box">
                       <img src="{{ $cLogo }}" class="eo-dp">
                   </div>
                   <div class="col-md-10 eo-timeline-details">
                       <h1><a href="{{ url('companies/company/'.$company->companyId) }}">{!! $company->companyName !!}</a></h1>
                       <div class="col-md-8 eo-section">
                           <div class="eo-details">
                               <span>@lang('home.industry'):</span> {!! JobCallMe::categoryName($company->category) !!}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.established'):</span> @if($company->companyEstablishDate != "") {!! date('M d, Y',strtotime($company->companyEstablishDate)) !!} @endif
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.noemployees'):</span>  {!! $company->companyNoOfUsers !!}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.location'):</span>  @if($company->companyCity != 0) {!! JobCallMe::cityName($company->companyCity).', '.JobCallMe::stateName($company->companyState).', '.JobCallMe::countryName($company->companyCountry) !!} @endif
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.website'):</span> <a href="{!! $company->companyWebsite !!}">{!! $company->companyWebsite !!}</a>
                           </div>
                       </div>
                       <div class="col-md-4 eo-section text-right">
                           <div class="row">
                                @if(in_array($company->companyId,$followArr))
                                    <a href="javascript:;" onclick="followCompany({{ $company->companyId }},this)" class="btn btn-success hvr-sweep-to-right">@lang('home.following')</a>
                                @else
                                    <a href="javascript:;" onclick="followCompany({{ $company->companyId }},this)" class="btn btn-primary hvr-sweep-to-right">@lang('home.follow')</a>
                                @endif
                                <a href="{{ url('account/employeer/companies/company/review?CompanyId='.$company->companyId) }}" class="btn btn-default">Write Review</a>
                               <div class="jd-share-btn cp-social">
                                   <a href="{!! $company->companyFb !!}"><i class="fa fa-facebook" style="background: #2e6da4;"></i> </a>
                                   <a href="{!! $company->companyLinkedin !!}"><i class="fa fa-linkedin" style=" background: #007BB6;"></i> </a>
                                   <a href="{!! $company->companyTwitter !!}"><i class="fa fa-twitter" style="background: #15B4FD;"></i> </a>
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
                <ul class="nav nav-tabs ">
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
                </ul>
                <div class="tab-content">
                    <!--ABOUT-->
                    <div class="tab-pane active" id="rtj_tab_about">
                        <div class="col-md-12">
                            <h4>@lang('home.aboutus')</h4>
                            <p>{!! $company->companyAbout !!}</p>
                        </div>
                    </div>
                    <!-- company gallery -->
                    <div class="tab-pane" id="rtj_tab_compics">
                        <div class="col-md-12">
                            <p>{!! $company->companypics !!}</p>
                        </div>
                    </div>

                    <!--JOBS-->
                    <div class="tab-pane" id="rtj_tab_jobs">
                        @foreach($jobs as $job)
                            <div class="col-md-12 rtj-item">
                                <div class="rtj-details">
                                    <p><strong><a href="{{ url('jobs/'.$job->jobId) }}">{{ $job->title }}</a></strong></p>
                                    <p>{!! JobCallMe::cityName($company->companyCity).', '.JobCallMe::countryName($company->companyCountry) !!}</p>
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
                                <td>@lang('home.monday')</td>
                                <td>{!! $opHour['mon']['from'] !!} - {!! $opHour['mon']['to'] !!}</td>
                            </tr>
                            <tr>
                                <td>@lang('home.tuesday')</td>
                                <td>{!! $opHour['tue']['from'] !!} - {!! $opHour['thu']['to'] !!}</td>
                            </tr>
                            <tr>
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
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
              <div>
                <!-- companyreview -->
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
                    
                   <h4>{{ $company->companyName }}</h4>
                    <p>{{ JobCallMe::cityName($company->companyCity) }}, {{ JobCallMe::countryName($company->companyCountry) }}</p>
                    <div class="jd-about-organization">
                        <p>{!! $job->companyAbout !!}</p>
                    </div>
                    <p align="center">
                        <?php echo checkreview($star) ?><br>
                        Total reviews <span class="badge">{{ count($companyReview) }} </span>
                    </p>
                    <hr>
                    <p>
                        <table>
                            <tr>
                                <td>Career Growth</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                                <?php echo checkreview($career_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Compensation & Benefits</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                               <?php echo checkreview($benefit_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Work/Life Balance</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                                <?php echo checkreview($lifebalance_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Management</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                                <?php echo checkreview($management_star) ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Culture</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                                <?php echo checkreview($culture_star) ?>
                                </td>
                            </tr>
                        </table>
                    </p>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                            <div class="row" align="center">
                                <div class="col-md-4">
                                    <span style="font-size:12px">{{$ceo_recommend_star}}</span>
                                    <p>CEO Recommended</p>
                                </div>
                                <div class="col-md-4">
                                    <span style="font-size:12px">@if($recommend_star == 'on') Yes @else Not recommend @endif</span>
                                    <p>Recommend to a friend</p>
                                </div>
                                <div class="col-md-4">
                                    <span style="font-size:12px">{{$future_star}}</span>
                                    <p>Future Expectations</p>
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
                      <div class="circle">
                          <img src="{{ url('profile-photos').'/'.$userreview->profilePhoto }}" class="circle-img">
                      </div>
                      <strong class="font-16">{{ $userreview->lastName }}</strong>
                    </div>
                    <div class="col-md-11">
                      <h4>{{ $userreview->review_title }}</h4>
                      <?php echo checkreview($userreview->overall_review) ?>
                      <span><?= date('d M, Y ', strtotime($userreview->created_date))?></span>
                      <p>{{ $userreview->job_type}}, Worked from <?= date('M d, Y ', strtotime($userreview->employee_sience))?> to <?= ($userreview->current_working != 'Yes') ? date('M d, Y ', strtotime($userreview->employer_upto)) : "Currently working"?> as {{ $userreview->designation }}</p>
                      <table style="width:100%">
                      <tr>
                        <th>Recommend CEO:</th>
                        <td><i class="<?php echo checkfont($userreview->recommend_ceo)?>"></i></td>
                        <th>Recommend to friend:</th>
                        <td><i class="<?php echo checkfont($userreview->recommend)?>"></i></td>
                        <th>Company Future:</th>
                        <td><i class="<?php echo checkfont($userreview->future)?>"></i></td>
                      </tr>
                      </table>
                      <strong class="font-16">Pros:</strong>
                      <p>{{ $userreview->pros }}</p>
                      <strong class="font-16">Cons:</strong>
                      <p>{{ $userreview->cons }}</p>
                      <strong class="font-16">Advice to management</strong>
                      <div>Career Growth 
                        <?php echo checkreview($userreview->career_opportunity) ?>
                      </div>
                      <div>Compensation & Benefits
                       <?php echo checkreview($userreview->benefits) ?>
                      </div>
                      <div>Work/Life Balance
                        <?php echo checkreview($userreview->work_lifebalance) ?>
                      </div>
                      <div>Management
                        <?php echo checkreview($userreview->rate_management) ?>
                      </div>
                      <div>Culture
                        <?php echo checkreview($userreview->rate_culture) ?>
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
    }else{

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
        $(obj).text('Following');
    }else{
        $(obj).removeClass('btn-success');
        $(obj).addClass('btn-primary');
        $(obj).text('Follow');
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