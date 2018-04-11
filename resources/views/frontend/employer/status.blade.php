@extends('frontend.layouts.app')

@section('title','Application')

@section('content')
<?php
$inbox = 'ja-tab-active';
if(Request::input('show') != ''){
    $showTab = Request::input('show');
    $$showTab = 'ja-tab-active';
    $inbox = '';
}
?>
<section id="jobs" style="margin-bottom:70px">
    <div class="container">
        <div class="col-md-12">
            <!-- Mobile View Only -->
            <div class="col-md-2 hidden-sm hidden-md hidden-lg">
                <div class="row">
                    <div class="col-md-12 jobApp-tabs jobMblTabs">
                        <ul class="nav nav-tabs jobMblTabs">
                            <li>
                                <a id="inbox" class="mblTabBtn nav-tab-active {{ $inbox }}"><i class="fa fa-users"></i> @lang('home.inbox')</a>
                            </li>
                            <li>
                                <a id="junk" class="mblTabBtn {{ $junk }}"><i class="fa fa-ban"></i>  @lang('home.junks')</a>
                            </li>
                            <li>
                                <a id="shortlist" class="mblTabBtn {{ $shortlist }}"><i class="fa fa-thumbs-up"></i>  @lang('home.shortlists')</a>
                            </li>
                            <li>
                                <a id="screened" class="mblTabBtn {{ $screened }}"><i class="fa fa-mobile"></i>  @lang('home.screened')</a>
                            </li>
                            <li>
                                <a id="interview" class="mblTabBtn {{ $interview }}"><i class="fa fa-calendar"></i>  @lang('home.interviews')</a>
                            </li>
                            <li>
                                <a id="offer" class="mblTabBtn {{ $offer }}"><i class="fa fa-ticket"></i>  @lang('home.offered')</a>
                            </li>
                            <li>
                                <a id="hire" class="mblTabBtn {{ $hire }}"><i class="fa fa-archive"></i>  @lang('home.hire')</a>
                            </li>
                            <li>
                                <a id="reject" class="mblTabBtn {{ $reject }}"><i class="fa fa-thumbs-down"></i>  @lang('home.reject')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Mobile View -->

            <div class="col-md-2 hidden-xs">
                <div class="row">
                    <div class="col-md-12 jobApp-tabs">
                        <a href="{{ url('account/employer/application') }}" id="inbox" class="btn btn-block jaTabBtn {{ $inbox }}"><i class="fa fa-users"></i> @lang('home.inbox')</a>
                        <a href="{{ url('account/employer/application') }}" id="junk" class="btn btn-block jaTabBtn {{ $junk }}"><i class="fa fa-ban"></i>  @lang('home.junks')</a>
                        <a href="{{ url('account/employer/application') }}"  id="shortlist" class="btn btn-block jaTabBtn {{ $shortlist }}"><i class="fa fa-thumbs-up"></i>  @lang('home.shortlists')</a>
                        <a href="{{ url('account/employer/application') }}" id="screened" class="btn btn-block jaTabBtn {{ $screened }}"><i class="fa fa-mobile"></i>  @lang('home.screened')</a>
                        <a href="{{ url('account/employer/application') }}" id="interview" class="btn btn-block jaTabBtn {{ $interview }}"><i class="fa fa-calendar"></i>  @lang('home.interviews')</a>
                        <a href="{{ url('account/employer/application') }}" id="offer" class="btn btn-block jaTabBtn {{ $offer }}"><i class="fa fa-ticket"></i>  @lang('home.offered')</a>
                        <a href="{{ url('account/employer/application') }}" id="hire" class="btn btn-block jaTabBtn {{ $hire }}"><i class="fa fa-archive"></i>  @lang('home.hire')</a>
                        <a href="{{ url('account/employer/application') }}" id="reject" class="btn btn-block jaTabBtn {{ $reject }}"><i class="fa fa-thumbs-down"></i>  @lang('home.reject')</a>
                    </div>
                    <div class="jd-job-details">
                <h4>Posted By</h4>
                <span style="color:#3f535c;">{{ $job->firstName }} {{ $job->lastName }}</span>
                </div>
                 <div class="jd-job-details">
                <h4>Hiring Managers</h4>
                <span style="color:#3f535c;">{{ $job->firstName }} {{ $job->lastName }}</span>
                </div>
                 <div class="jd-job-details">
                <h4>Job Ad Type</h4>
               <span style="color:#3f535c;"> {!! $job->p_title !!}</span>
                @if ($job->p_title =='Basic')
				<a href="{{ url('account/employer/jobupdate/'.$job->jobId) }}">(@lang('home.upgrade'))</a>
                 @else
				 @endif
                </div>
                </div>
                
                
            </div>
            <div class="col-md-10">
                <div class="ja-content">
                    <div class="ea-top-panel">
                        
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="shortlist">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> @lang('home.status')
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="reject">
                            <a href="{{url('account/employer/setfilter/'.$job->jobId)}}" style="color: black;"><i class="fa fa-filter" aria-hidden="true"></i> @lang('home.filters')</a>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="screened">
                          <a href="{{url('account/employer/job/share/'.$job->jobId)}}" style="color: black;"><i class="fa fa-share-alt" aria-hidden="true"></i> @lang('home.share')</a>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="offer">
                            <i class="fa fa-question" aria-hidden="true"></i> @lang('home.evaluation')
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" >
                            <a href="{{url('account/employer/job_update/'.$job->jobId )}}" style="color: black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> @lang('home.edit')</a>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="junk">
                         <a href="{{ url('account/employer/delete/'.$job->jobId) }}" style="color: black;"><i class="fa fa-trash-o" aria-hidden="true"></i> @lang('home.delete')</a>
                        </button>
                        
                        
                    </div>
               
                   
                    <!-- Application area -->
                 

            <!--JOB Details-->
            <div class="jd-job-details">
              

                <!--Large Screen-->
                <table class="table table-bordered hidden-xs hidden-sm">
                    <tbody>
                       <tr>
                        <td class="active">@lang('home.experience')</td>
                        <td>{{ $job->experience }}</td>
                        <td class="active">@lang('home.salary')</td>
                        <td>{{ number_format($job->minSalary) }} - {{ number_format($job->maxSalary) }} {{ $job->currency }}</td>
                    </tr>
					
                    <tr>
                        <td class="active">@lang('home.shift')</td>
                        <td>{{ $job->jobShift }}</td>
                          <td class="active">@lang('home.travelling')</td>
                        <td>@if($benefits != '')
							@foreach( $benefits as $benefit)
						     @if($benefit == 'Travelling')
							   <?php $travelFound = true; ?>
						     @endif
						    @endforeach
							
							@endif
							<?php if($travelFound){
								 echo Yes;
							}
							else{
								echo No;
							}
							?>
							
						</td>
                    </tr>
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
                        <td class="active">@lang('home.experience')</td>
                        <td>{{ $job->experience }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.salary')</td>
                        <td>{{ number_format($job->minSalary) }} - {{ number_format($job->maxSalary) }} {{ $job->currency }}</td>
                    </tr>
					
                    <tr>
                        <td class="active">@lang('home.shift')</td>
                        <td>{{ $job->jobShift }}</td>
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
                        <td class="active">@lang('home.locationsss')</td>
                        <td>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</td>
                    </tr>
					
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
                        <td class="active">@lang('home.locationsss')</td>
                        <td>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</td>
                    </tr>
					
                    </tbody>
                </table>
                <h4>@lang('home.description')</h4>
                <p><strong>We are conveniently located in {{ JobCallMe::getCompany($job->companyId)->companyAddress }}.</strong></p>
                <p>{!! $job->description !!}</p>
                <h4>@lang('home.skills')</h4>
                <p>{!! $job->skills !!}</p>
                <br>
                  <h4>@lang('home.admissionsprocess')</h4>
                @if($process != '')
	                <ul class="jd-rewards" style="margin-bottom: 32px;">
	                	@foreach( $process as $pro)
						
	                		<li><i class="fa fa-check-circle"></i> {{ $pro }}</li>
	                	@endforeach
	                </ul>
                @endif
                <br>
                <br>
                <div>
                <h4>@lang('home.rewardsbenefits')</h4>
                @if($benefits != '')
	                <ul class="jd-rewards">
	                	@foreach( $benefits as $benefit)
						
	                		<li><i class="fa fa-check-circle"></i> {{ $benefit }}</li>
	                	@endforeach
	                </ul>
                @endif
                </div>
                <br>
              
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
var isRunning = false;
var token = "{{ csrf_token() }}";
$(document).ready(function(){
    initialize();
    $('.jaTabBtn.ja-tab-active').click();
})
$('.jaTabBtn').click(function () {
    var type = $(this).attr('id');
    if(isRunning == true || $('#application-content').attr('data-application') == type){ return false; }

    var jobId = $('.select-jobs option:selected:selected').val();

    $(this).addClass('ja-tab-active').siblings().removeClass('ja-tab-active');
    isRunning = true;
    getApplications(type,jobId);
});
function getApplications(type,jobId){
    $.ajax({
        url: "{{ url('account/employer/application') }}/"+type+"?jobId="+jobId,
        success: function(response){
            isRunning = false;
            var obj = $.parseJSON(response);
            $('#application-content').html(obj.vhtml);
            $('#application-content').attr('data-application',type);

            var eApplicant = {};
            if($('input[name="applicant[]"]:checked:checked').length > 0){
                $('input[name="applicant[]"]:checked:checked').each(function(){
                    eApplicant.push($(this).val());
                })
            }
            $('.mul-appl').html('').trigger('change');
            $.each(obj.userArr,function(i,k){
                var vOption = $.inArray(i,eApplicant) != '-1' ? true : false;
                var newOption = new Option(k, i, true, vOption);
                $(".mul-appl").append(newOption).trigger('change');
            })
            initialize();
        }
    })
}
$('.ea-panel-btn').hover(function () {
    $(this).children(".ea-toolkit").show();
});
$('.ea-panel-btn').mouseleave(function () {
    $(this).children(".ea-toolkit").hide();
});
$("#ea-showFrom").click(function(){
    var vlength = $('input[name="applicant[]"]:checked:checked').length;
    if(vlength == 0){
        toastr.error('Please select some applicant first', '', {timeOut: 5000, positionClass: "toast-top-center"});
    }else{
        $(".ea-messageForm").slideToggle("slow");
    }
});
function initialize(){
    $(".cbx-field").prop("checked", false);
    $(".cbx-field").click(function () {
        if ($(this).is(":checked")) {
            //checked
            $(this).parent('td').parent().addClass("ea-record-selected");
        } else {
            //unchecked
            $(this).parent('td').parent().removeClass("ea-record-selected");
        }
    })
    $('#select-all').click(function(event) {
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;

                $('.ea-single-record').addClass('ea-record-selected');
            });
        }
        else{
            $(':checkbox').each(function() {
                this.checked = false;
                $('table tr').removeClass('ea-record-selected');
            });
        }
    });
}
$('#full-screen').click(function(e){
    $('.ja-content').toggleClass('ea-fullscreen');
});



</script>
@endsection