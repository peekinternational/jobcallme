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

	<div class="follow-companies4" style="background:#57768a;color:#fff;margin-top:70px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.APPLICATION')</h3>
				</div>

		
		
        <div class="col-md-12">
            <!-- Mobile View Only -->
          <div class="col-md-2 hidden-sm hidden-md hidden-lg">
                <div class="row">
                    <div class="col-md-12 jobApp-tabs2 jobMblTabs">
                        <ul class="nav nav-tabs jobMblTabs">
                            <li style="width:50%;">
                            <a id="inbox" class="btn btn-block jaTabBtn {{ $inbox }}"><i class="fa fa-users"></i> @lang('home.inbox')</a>
                            </li>
                            <li style="width:50%;padding-left:23px;">
                            <a id="junk" class="btn btn-block jaTabBtn {{ $junk }}"><i class="fa fa-ban"></i>  @lang('home.junks')</a>
                            </li>
                            <li style="width:50%;">
                            <a id="shortlist" class="btn btn-block jaTabBtn {{ $shortlist }}"><i class="fa fa-thumbs-up"></i>  @lang('home.shortlists')</a>
                            </li>
                            <li style="width:50%;padding-left:23px;">
                            <a id="screened" class="btn btn-block jaTabBtn {{ $screened }}"><i class="fa fa-mobile"></i>  @lang('home.screened')</a>
                            </li>
                            <li style="width:50%;">
                            <a id="interview" class="btn btn-block jaTabBtn {{ $interview }}"><i class="fa fa-calendar"></i>  @lang('home.interviews')</a>
                            </li>
                            <li style="width:50%;padding-left:23px;">
                            <a id="offer" class="btn btn-block jaTabBtn {{ $offer }}"><i class="fa fa-ticket"></i>  @lang('home.empoffered')</a>
                            </li>
                            <li style="width:50%;">
                            <a id="hire" class="btn btn-block jaTabBtn {{ $hire }}"><i class="fa fa-archive"></i>  @lang('home.hire')</a>
                            </li>
                            <li style="width:50%;padding-left:23px;">
                            <a id="reject" class="btn btn-block jaTabBtn {{ $reject }}"><i class="fa fa-thumbs-down"></i>  @lang('home.reject')</a>
                            </li>
                            <li style="width:50%;">
                            <a id="review" href="{{url('employer/status/reviews/all')}}" class="btn btn-block {{ $review }}"><i class="fa fa-file-o"></i>  @lang('home.Reviews list')</a>
                            </li>
                            <li style="width:50%;padding-left:23px;">
                            <a id="offer" href="{{url('employer/status/offer/all')}}" class="btn btn-block {{ $offer }}"><i class="fa fa-bullhorn"></i> @lang('home.Offer Interview list')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Mobile View -->

            <div class="col-md-2 hidden-xs">
                <div class="row">
                    <div class="col-md-12 jobApp-tabs">
                        <a id="inbox" class="btn btn-block jaTabBtn {{ $inbox }}"><i class="fa fa-users"></i> @lang('home.inbox')</a>
                        <a id="junk" class="btn btn-block jaTabBtn {{ $junk }}"><i class="fa fa-ban"></i>  @lang('home.junks')</a>
                        <a id="shortlist" class="btn btn-block jaTabBtn {{ $shortlist }}"><i class="fa fa-thumbs-up"></i>  @lang('home.shortlists')</a>
                        <a id="screened" class="btn btn-block jaTabBtn {{ $screened }}"><i class="fa fa-mobile"></i>  @lang('home.screened')</a>
                        <a id="interview" class="btn btn-block jaTabBtn {{ $interview }}"><i class="fa fa-calendar"></i>  @lang('home.interviews')</a>
                        <a id="offer" class="btn btn-block jaTabBtn {{ $offer }}"><i class="fa fa-ticket"></i>  @lang('home.empoffered')</a>
                        <a id="hire" class="btn btn-block jaTabBtn {{ $hire }}"><i class="fa fa-archive"></i>  @lang('home.hire')</a>
                        <a id="reject" class="btn btn-block jaTabBtn {{ $reject }}"><i class="fa fa-thumbs-down"></i>  @lang('home.reject')</a>

                        <a id="review" href="{{url('employer/status/reviews/all')}}" class="btn btn-block {{ $review }}"><i class="fa fa-file-o"></i>  @lang('home.Reviews list')</a>
                        <a id="offer" href="{{url('employer/status/offer/all')}}" class="btn btn-block {{ $offer }}"><i class="fa fa-bullhorn"></i> @lang('home.Offer Interview list')</a>


                    </div>
                </div>
            </div>
            <div class="col-md-10">
				<div style="font-size:12px;color:#337ab7;">
					<i class="fa fa-info-circle" aria-hidden="true"></i> @lang('home.APPLICATION_method')
				</div>
                <div class="ja-content">
                    <div class="ea-top-panel hidden-xs">
                        <button type="button" class="ea-panel-btn hidden-sm hidden-xs" id="full-screen" style="background:#337ab7;"><i class="fa fa-arrows-alt" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.togglescreen')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="shortlist" style="background:#337ab7;">
                            <i class="fa fa-thumbs-up" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.shortlistapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="reject" style="background:#337ab7;">
                            <i class="fa fa-thumbs-down" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.rejectapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="screened" style="background:#337ab7;">
                            <i class="fa fa-mobile" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit"><p>@lang('home.markscreened') </p></div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="offer" style="background:#337ab7;">
                            <i class="fa fa-ticket" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit"><p>@lang('home.sendjoboffer') </p></div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="hire" style="background:#337ab7;">
                            <i class="fa fa-archive" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.markhired')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="junk" style="background:#337ab7;">
                            <i class="fa fa-ban" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.markjunk')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="ea-showFrom" style="display: none;" style="background:#337ab7;">
                            <i class="fa fa-envelope" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.sendmessageapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="ea-scheduleInerview" style="background:#337ab7;">
                            <i class="fa fa-calendar" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.scheduleinterview')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="resume-download" style="background:#337ab7;"><i class="fa fa-download" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.exportselected')</div>
                        </button>
                        <select class="form-control pull-right select-jobs" style="width: 150px;height: 35px;" onchange="findApplication(this.value)">
                            <option value="0">@lang('home.alljobs')</option>
                            @foreach($jobs as $job)
                                <option value="{!! $job->jobId !!}">{!! $job->title !!}</option>
                            @endforeach
                        </select>
                    </div>


					<div class="ea-top-panel hidden-sm hidden-md hidden-lg">
                        
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="shortlist" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-thumbs-up" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.shortlistapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="reject" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-thumbs-down" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.rejectapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="screened" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-mobile" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit"><p>@lang('home.markscreened') </p></div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="offer" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-ticket" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit"><p>@lang('home.sendjoboffer') </p></div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="hire" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-archive" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.markhired')</div>
                        </button>
                        <button type="button" class="ea-panel-btn ea-npm-click" data-type="junk" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-ban" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.markjunk')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="ea-showFrom" style="display: none;width:32.6%;background:#337ab7;">
                            <i class="fa fa-envelope" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.sendmessageapplicant')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="ea-scheduleInerview" style="width:32.6%;background:#337ab7;">
                            <i class="fa fa-calendar" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.scheduleinterview')</div>
                        </button>
                        <button type="button" class="ea-panel-btn" id="resume-download" style="width:32.6%;background:#337ab7;"><i class="fa fa-download" style="font-size:20px;color:#fff;"></i>
                            <div class="ea-toolkit">@lang('home.exportselected')</div>
                        </button>
                        <select class="form-control pull-right select-jobs" style="width: 150px;height: 35px;" onchange="findApplication(this.value)">
                            <option value="0">@lang('home.alljobs')</option>
                            @foreach($jobs as $job)
                                <option value="{!! $job->jobId !!}">{!! $job->title !!}</option>
                            @endforeach
                        </select>
                    </div>



                    <!--Toggle message box -->
                    <div class="col-md-12 ea-messageForm">
                        <div class="col-md-offset-3 col-md-6">
                            <form action="#" method="">
                                <div class="form-group">
                                    <select class="form-control select2" name="applicantMsg">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="applicant-msg"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">@lang('home.send')</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- schedule interview -->
                    <div class="col-md-12 ea-scheduleInerview" style="display: none">
                        <div class="col-md-12" style="margin-top: 10px;">
                            <form action="#" method="" class="form-horizontal interview-form">
                                <input type="hidden" name="_token" class="token">
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.applicants')</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2 mul-appl" name="applicantInter[]" multiple="">
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.Date from')</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control date-picker" name="fromDate" value="{{ date('Y-m-d',strtotime('+1 Day')) }}" onkeypress="return false">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.Date to')</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control date-picker" name="toDate" value="{{ date('Y-m-d',strtotime('+1 Day')) }}" onkeypress="return false">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.Time from')</label>
                                    <div class="col-md-6">
                                      
                                        <select name="timefrom" class="form-control">
                                                @foreach(JobCallMe::timeArray() as $time)
                                                    <option value="{!! $time !!}">{!! $time !!}</option>
                                                @endforeach
                                           </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.Time to')</label>
                                    <div class="col-md-6">
                                      
                                        <select name="timeto" class="form-control">
                                                @foreach(JobCallMe::timeArray() as $time)
                                                    <option value="{!! $time !!}">{!! $time !!}</option>
                                                @endforeach
                                           </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.timeinterview')</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="perInterview">
                                            @for($i = 1; $i < 10; $i++)
                                                <option value="{{ $i * 20 }}">{{ ($i * 20)}} @lang('home.Minutes')</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">@lang('home.interviewvenue')</label>
                                    <div class="col-md-6">
                                        <select class="form-control select2" name="venue">
                                            @foreach(JobCallMe::interviewVenue() as $venue)
                                                <option value="{{ $venue->venueId }}">{!! $venue->title !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <button type="submit" name="save" class="btn btn-primary pull-right">@lang('home.save')</button>
                                        <button type="button" class="btn btn-default" onclick="$('.ea-scheduleInerview').fadeOut()">@lang('home.cancel')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Application area -->
                    <div id="application-content" class="ja-content-item">
                        <div class="col-md-12 ea-no-record">Loading ...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
         <!-- Modal content-->
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">@lang("home.Download Zip File")</h4>
           </div>
           <div class="modal-body">
             <p>Some text in the modal.</p>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">@lang("home.Close")</button>
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
    $id=$('#user_id').val();
   // alert($id);
    $('.ja-content').toggleClass('ea-fullscreen');
});
function findApplication(jobId){
    var type = $('.jaTabBtn.ja-tab-active').attr('id');
    getApplications(type,jobId);
}
$('.ea-npm-click').click(function(){
    var type = $(this).attr('data-type');
    var appString = '';
    if($('input[name="applicant[]"]:checked:checked').length > 0){
        $('input[name="applicant[]"]:checked:checked').each(function(){
            appString += $(this).val()+',';
        })
        $.ajax({
            type: 'post',
            data: {type:type,ids:appString,_token:token},
            url: "{{ url('account/employer/update/application') }}",
            success: function(response){
                toastr.success('@lang("home.Action successfully perform")', '', {timeOut: 5000});
            }
        })
    }else{
        toastr.error('@lang("home.Please select some applicant")', '', {timeOut: 5000, positionClass: "toast-top-center"});
    }
})
$('#ea-scheduleInerview').click(function(){
    if($('input[name="applicant[]"]:checked:checked').length > 0){
        $('.mul-appl > option').prop("selected",false);
        $('.mul-appl').trigger('change');
        $('input[name="applicant[]"]:checked:checked').each(function(){
            $('.mul-appl option[value="'+$(this).val()+'"]').prop('selected',true);
        });
        $('.mul-appl').trigger('change');
        $('.ea-scheduleInerview').fadeIn();
    }else{
        toastr.error('@lang("home.Please select some applicant")', '', {timeOut: 5000, positionClass: "toast-top-center"});
    }
})
$('form.interview-form').submit(function(e){
    $('.interview-form button[name="save"]').prop('disabled',true);

    $('.interview-form .token').val(token);
    $.ajax({
        type: 'post',
        data: $('.interview-form').serialize(),
        url: "{{ url('account/employer/application/interview/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }else{
                toastr.success('@lang("home.Action perform successfully2")', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                $('.ea-scheduleInerview').fadeOut();
            }
            $('.interview-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
$('body').on('click','#resume-download',function(event) {
    var id_array = [];
$('.ea-record-selected').each(function(index,element){
   var id = $(this).closest('tr').find('#user_id').val();
    id_array.push(id);
})
 
 $.ajax({
    url:"{{ url('resume/download/multiple') }}",
    type:"post",
    data:{id_array:id_array,_token:"{{ csrf_token() }}"},
    success:function(res){
        console.log(res);
        var url = res.split('/');
        var result = res.slice(0,9);
       // alert(result);
        if(result=='resumeZip'){
       
        $('#myModal').modal('show');
        $('#myModal .modal-body').html('<a href="{{ url("")}}/'+res+'" onclick="delresume('+url[1]+')">@lang("home.click to download")</a>');
    }
    else{
        window.location.href = "{{ url('account/manage?plan') }}";
    }
    }
 })
});
function delresume(url){
   setTimeout(function(){
    $.ajax({
        url:"{{ url('') }}/delcv",
        type:"post",
        data:{dir:url,_token:"{{ csrf_token() }}"},
        success:function(res){
            console.log(res);
        }
    });
    }, 60000);
}
</script>
@endsection