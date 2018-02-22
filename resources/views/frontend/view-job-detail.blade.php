@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')
<?php
$userImage = url('compnay-logo/profile-logo.jpg');
if($job->companyLogo != ''){
    $userImage = url('compnay-logo/'.$job->companyLogo);
}
?>
<section id="jobs">
    <div class="container">
        <div class="col-md-9">
		
            <div class="jobs-suggestions">
			<div style="display: -webkit-box;">
			 <img src="{{$userImage}}"  style="width:118px;margin-top:32px;">	<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
			<div style="padding-left: 42px;">
			<span style="text-transform: uppercase;font-size: 26px;">{{$job->companyName}}</span>
                <p style="font-size: 18px;margin-top: 24px; margin-left: 6px;">{{ $job->title }},  &nbsp;<span style="font-size: 13px; padding-top: 9px;">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }} </span> &nbsp;<span class="label" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">
				{{ $job->p_title }}
				</span><span style="font-size:9px;margin-left:13px">Never pay for job application, test or interview. <a href="{{ url('/safety')}}">more</a></span></p>
				
				</div>
				
					
               
				</div>
			 
			@if($job->userId == $userId )
                <div class="jd-action-btn">

                </div>
			
			@else
				  <div class="jd-action-btn">
                    @if(strtotime($job->expiryDate) < strtotime(date('Y-m-d')))
                        <button class="btn btn-danger">@lang('home.s_close')</button>
                    @else
						@if($jobApplied == true)
                        <a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-success">@lang('home.applied')</a>
					@else
						<a href="{{ url('jobs/apply/'.$job->jobId) }}" class="btn btn-primary">@lang('home.apply')</a>
					@endif
                        @if(in_array($job->jobId, $savedJobArr))
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-success" style="margin-left: 10px;">@lang('home.saved')</a>
                        @else
                            <a href="javascript:;" onclick="saveJob({{ $job->jobId }},this)" class="btn btn-default" style="margin-left: 10px;">@lang('home.save')</a>
                        @endif
                    @endif
					
                </div>
			@endif
			
			
		
                
                <div class="jd-share-btn">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('jobs/'.$job->jobId) }}&title=&summary=&source=">
                    	<i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url={{ url('jobs/'.$job->jobId) }}">
                    	<i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                    </a>
                </div>
                <ul class="js-listing">
                    <li>
                        <p class="js-title">@lang('home.jobtype')</p>
                        <p>{{ $job->jobType }}</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.shift')</p>
                        <p>{{ $job->jobShift }}</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.experience')</p>
                        <p>{{ $job->experience }}</p>
                    </li>
                    <li>
                        <p class="js-title">@lang('home.salary')</p>
                        <p>{{ number_format($job->minSalary) }} - {{ number_format($job->maxSalary) }} {{ $job->currency }}</p>
                    </li>
					<li>
                        <p class="js-title">@lang('home.poston')</p>
                        <p>{{ date('M d, Y',strtotime($job->createdTime))}}</p>
                    </li>
					<li>
                        <p class="js-title">@lang('home.lastdate')</p>
                        <p>{{ date('M d, Y',strtotime($job->expiryDate))}}</p>
                    </li>
                </ul>
            </div>

            <!--JOB Details-->
            <div class="jd-job-details">
                <h4>{{ $job->title }} at {{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</h4>

                <!--Large Screen-->
                <table class="table table-bordered hidden-xs hidden-sm">
                    <tbody>
                    <tr>
                        <td class="active">@lang('home.category')</td>
                        <td>{{ JobCallMe::categoryTitle($job->category) }}</td>
                        <td class="active">@lang('home.careerlevel')</td>
                        <td>{{ $job->careerLevel }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.qualification')</td>
                        <td>{{ $job->qualification }}</td>
                        <td class="active">@lang('home.totalvacancies')</td>
                        <td>{{ $job->vacancies }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>{{ date('M d, Y',strtotime($job->createdTime))}}</td>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>{{ date('M d, Y',strtotime($job->expiryDate))}}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.location')</td>
                        <td colspan="3">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</td>
                    </tr>
                    </tbody>
                </table>

                <!--Small Screen-->
                <table class="table table-bordered table-responsive hidden-md hidden-lg">
                    <tbody>
                    <tr>
                        <td class="active">@lang('home.category')</td>
                        <td>{{ JobCallMe::categoryTitle($job->category) }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.careerlevel')</td>
                        <td>{{ $job->careerLevel }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.qualification')</td>
                        <td>{{ $job->qualification }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.poston')</td>
                        <td>{{ date('M d, Y',strtotime($job->createdTime))}}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.lastdate')</td>
                        <td>{{ date('M d, Y',strtotime($job->expiryDate))}}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.location')</td>
                        <td>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</td>
                    </tr>
                    </tbody>
                </table>
                <h4>@lang('home.description')</h4>
                <p><strong>We are conveniently located in {{ JobCallMe::getCompany($job->companyId)->companyAddress }}.</strong></p>
                <p>{!! $job->description !!}</p>
                <h4>@lang('home.skills')</h4>
                <p>{!! $job->skills !!}</p>
                <h4>@lang('home.rewardsbenefits')</h4>
                @if($job->benefits != '')
	                <ul class="jd-rewards">
	                	@foreach(@explode(',',$job->benefits) as $benefits)
	                		<li><i class="fa fa-check-circle"></i> {{ $benefits }}</li>
	                	@endforeach
	                </ul>
                @endif
            </div>

            <!--ABOUT Organization-->
            <div class="jobs-suggestions">
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
            </div>
        </div>
		<div class="col-md-3">
		    <!--Follow Companies - Start -->
                <div class="follow-companies">
                    <h4>@lang('home.similarjob') {{JobCallMe::countryName(JobCallMe::getHomeCountry())}}</h4>
                    <hr>
                    <div class="row">
					@foreach($suggest as $appl)
					 <?php
                        $userImage = url('compnay-logo/profile-logo.jpg');
                         if($appl->companyLogo != ''){
                          $userImage = url('compnay-logo/'.$appl->companyLogo);
                               }
?>
                        <div class="col-md-12 col-xs-12 sp-item">
						<div class="col-md-4 col-xs-4 sp-item">
                            <img src="{{ $userImage }}" style="">
							</div>
							<div class="col-md-8 col-xs-8 sp-item" style="text-align:left !important">
                            <p><a href="{{ url('jobs/'.$appl->jobId) }}">{!! $appl->title!!}</a></p>
                            <p>{!! $appl->companyName !!}</p>
                            <p>{{ JobCallMe::cityName($appl->city) }}, {{ JobCallMe::countryName($appl->country) }}</p>
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
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
})
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
                    $(obj).text('Saved');
                }else{
                    $(obj).removeClass('btn-success');
                    $(obj).addClass('btn-default');
                    $(obj).text('Save');
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
                window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
            }
        }
    })
}
</script>
@endsection