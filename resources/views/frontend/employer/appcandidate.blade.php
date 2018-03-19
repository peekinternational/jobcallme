@extends('frontend.layouts.app')
@section('title','Applicant')
@section('content')
<section id="myResume">
    <div class="container"> 
        <ul class="nav nav-tabs" style="margin-top:20px">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-user" aria-hidden="true"></i> @lang('home.resume')</a></li>
            <li><a data-toggle="tab" class='openConversation' href="#menu1" ><i class="fa fa-comments" aria-hidden="true"></i> @lang('home.conversation')</a></li>
            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-clipboard" aria-hidden="true"></i> @lang('home.questionnaires')</a></li>
            <li><a data-toggle="tab" href="#menu3"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('home.interviews')</a></li>
        </ul>
        <div class="row">
            <div class="col-md-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
        
                        <!--Personal Info Start-->
                        <section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <img src="{{ url('profile-photos/'.$applicant->profilePhoto) }}" style="width: 100%;height:221px;">
                                    </div>
                                    <h3 class="text-center hidden-md hidden-lg" style="font-weight: 600">$applicant->firstName</h3>
                                    <p class="text-center hidden-md hidden-lg jp-profession-heading">Web Developer and Designer</p>
                                    <a href="#" class="btn btn-primary btn-block jp-contact-btn">@lang('home.contactdetail')</a>
                                    <div class="" style="text-align:center">
                                    <a href="{{ url('account/jobseeker/cv/'.$applicant->userId)}}" style="color:#737373" class=""><i class="fa fa-download"></i> @lang('home.DOWNLOAD')</a>
                                    </div>
                                </div>
                                <div class="col-md-9 personal-info-right">
                                    <h3 class="hidden-sm hidden-xs">{{$applicant->firstName}} {{$applicant->lastName}}</h3>
                                    <p class="jp-profession-heading hidden-sm hidden-xs">Web Developer and Designer</p>
                                    <p><span class="pi-title">@lang('home.experiance'):</span>{{$applicant->experiance}}</p>
                                    <p><span class="pi-title">@lang('home.industry'):</span> {{ JobCallMe::categoryTitle($applicant->industry) }}</p>
                                    <p><span class="pi-title">@lang('home.salary'):</span> {{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',2).' '.$applicant->currency }}</p>
                                    <p><span class="pi-title">@lang('home.location'):</span> {!! JobCallMe::cityName($applicant->city).' ,'.JobCallMe::countryName($applicant->country) !!}</p>
                                    <div class="professional-summary">
                                        <h4>@lang('home.p_summary')</h4>
                                        <p>{{$applicant->about}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--Personal Info End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="academic">
                            <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.academic')</h4>
                            <ul class="resume-details">
                            @if(count($resume['academic']) > 0)
                                    @foreach($resume['academic'] as $resumeId => $academic)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">{!! date('M, Y',strtotime($academic->completionDate)) !!}</p>
                                                <p class="rd-title">{!! $academic->degree !!}</p>
                                                <p class="rd-organization">{!! $academic->institution !!}</p>
                                                <p class="rd-location">{!! ucfirst($academic->country) !!}</p>
                                                <p class="rd-grade">Grade/GPA : {!! $academic->grade !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="experience">
                            <h4><i class="fa fa-star r-icon bg-primary"></i>  @lang('home.experience')</h4>
                            <ul class="resume-details">
                            @if(count($resume['experience']) > 0)
                                    @foreach($resume['experience'] as $resumeId => $experience)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">{!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}</p>
                                                <p class="rd-title">{!! $experience->jobTitle !!}</p>
                                                <p class="rd-organization">{!! $experience->organization !!}</p>
                                                <p class="rd-location">{!! ucfirst($experience->country) !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                    
                        <!--Academic Section End-->

                        <!--Academic Section Start-->
                        <section class="resume-box" id="certification">
                            <h4><i class="fa fa-certificate r-icon bg-primary"></i>  @lang('home.certification')</h4>
                            <ul class="resume-details">
                                @if(count($resume['certification']) > 0)
                                    @foreach($resume['certification'] as $resumeId => $certification)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-date">{!! date('M, Y',strtotime($certification->completionDate)) !!}</p>
                                                <p class="rd-title">{!! $certification->certificate !!}</p>
                                                <p class="rd-organization">{!! $certification->institution !!}</p>
                                                <p class="rd-location">{!! ucfirst($certification->country) !!}</p>
                                                <p class="rd-grade">Score : {!! $certification->score !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!--Academic Section End-->
                        <!---Project -->
                        <section class="resume-box" id="ski"> 
                            <h4><i class="fa fa-edit r-icon bg-primary"></i> @lang('home.project')</h4>
                            <ul class="resume-details">
                                @if(count($resume['project']) > 0)
                                    @foreach($resume['project'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
                                                <p class="rd-location"> {!! $skills->startmonth !!} {!! $skills->startyear !!} - {{ $skills->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($skills->endDate)) }}</p>
                                                <p class="rd-location"> As {!! $skills->position !!} - {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
                                                
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        <!---Affilation -->
                        <section class="resume-box" id="aff"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Affiliation')</h4>
                            <ul class="resume-details">
                                @if(count($resume['affiliation']) > 0)
                                    @foreach($resume['affiliation'] as $resumeId => $afflls)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-title">{!! $afflls->pos !!}</p>
                                                <p class="rd-location"> {!! $afflls->stamonth !!} {!! $afflls->stayear !!} - {!! $afflls->enmonth !!} {!! $afflls->enyear !!}</p>
                                                <p class="rd-location">{!! $afflls->org .', '.JobCallMe::cityName($afflls->city).' ,'.JobCallMe::countryName($afflls->country) !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="sk">                        
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.language')</h4>
                            <ul class="resume-details">
                                @if(count($resume['language']) > 0)
                                    @foreach($resume['language'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                                
                                                <p class="rd-title">{!! $skills->language !!}</p>
                                                <p class="rd-location"> ({!! $skills->level !!})</p>
                                                
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="skill">    
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.references')</h4>
                            <ul class="resume-details">
                                @if(count($resume['reference']) > 0)
                                    @foreach($resume['reference'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->name !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
                                                <p class="rd-location"> Job Title: {!! $skills->jobtitle !!}</p>
                                                <p class="rd-location">Organization: {!! $skills->organization .', '.JobCallMe::cityName($skills->city).', '.JobCallMe::countryName($skills->country)  !!}</p>
                                            <p class="rd-location">Phone Number : {!! $skills->phone !!}</p>
                                            <p class="rd-location">Email : {!! $skills->email !!}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                            <!---Publication -->
                        <section class="resume-box" id="skil">
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.publication')</h4>
                            <ul class="resume-details">
                                @if(count($resume['publish']) > 0)
                                    @foreach($resume['publish'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                            
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->pu_type !!})</span></p>
                                                <p class="rd-location"> {!! $skills->month !!}-{!! $skills->year !!}</p>
                                                <p class="rd-location"> Author: {!! $skills->author !!}</p>
                                                <p class="rd-location">Publisher: {!! $skills->publisher.', '.JobCallMe::cityName($skills->city).' ,'.JobCallMe::countryName($skills->country)  !!}</p>
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <section class="resume-box" id="s"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.award')</h4>
                            <ul class="resume-details">
                                @if(count($resume['award']) > 0)
                                    @foreach($resume['award'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12">
                                                
                                                <p class="rd-title">{!! $skills->title !!}</p>
                                                <p class="rd-location"> {!! $skills->type !!},{!! $skills->startmonth !!} {!! $skills->startyear !!}</p>
                                                <p class="rd-location"> {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
                                                
                                            <p class="rd-location">{!! $skills->detail !!}</p>
                                            
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>
                        
                        <!--Portfolio Section-->
                        <section class="resume-box" id="port"> 
                            <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.Portfolio')</h4>
                            <ul class="resume-details">
                                @if(count($resume['portfolio']) > 0)
                                    @foreach($resume['portfolio'] as $resumeId => $skills)
                                        <li id="resume-{{ $resumeId }}">
                                            <div class="col-md-12"> 
                                                <p class="rd-title">{!! $skills->title !!}<span class="rd-location">({!! $skills->type !!})</span></p>
                                                <p class="rd-location">{!! $skills->startmonth !!} {!! $skills->startyear !!}</p>
                                                <p class="rd-location">http://{!! $skills->website !!}</p>
                                                <p class="rd-location"> {!! $skills->occupation !!}</p> 
                                            <p class="rd-location">{!! $skills->detail !!}</p> 
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </section>

				    </div>
					<div id="menu1" class="tab-pane fade">
						<section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div id="cometchat_embed_synergy_container" style="width:959px;height:500px;max-width:100%;border:1px solid #CCCCCC;border-radius:5px;overflow:hidden;" ></div>
                                <script src="/cometchat/js.php?type=core&name=embedcode" type="text/javascript"></script>
                                <script>var iframeObj = {};iframeObj.module="synergy";iframeObj.style="min-height:420px;min-width:350px;";iframeObj.width="959px";iframeObj.height="500px";iframeObj.src="/cometchat/cometchat_embedded.php"; if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}</script>

                                <!--<div class="col-md-12">
                                    <textarea class="form-control area"  placeholder="Message"></textarea>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Send on enter
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <button  type="button" class="btn btn-success pull-right" style="margin-top:12px">@lang('home.send')</button>
                                </div>-->
                            </div>
						</section>
					</div>
                    <div id="menu2" class="tab-pane fade">
                        <section class="personal-info-section" id="personal-information">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>No Questionnaire or Test scheduled yet.</p>
                                </div>
                            </div>
                        </section>
                    </div>
					<div id="menu3" class="tab-pane fade">
                        <!-- schedule interview -->
                        <div class="col-md-12 ea-scheduleInerview">
                            <div class="col-md-12" style="margin-top: 10px;">
                                <form action="#" method="" class="form-horizontal interview-forms">
                                    <input type="hidden" name="_token" class="token">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.applicants')</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" name="applicantInter[]" value="{{$applicant->firstName}} {{$applicant->lastName}}" onkeypress="return false">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.from')</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" name="fromDate" value="{{ date('Y-m-d',strtotime('+1 Day')) }}" onkeypress="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.to')</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control date-picker" name="toDate" value="{{ date('Y-m-d',strtotime('+2 Day')) }}" onkeypress="return false">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 text-right">@lang('home.timeinterview')</label>
                                        <div class="col-md-6">
                                            <select class="form-control select2" name="perInterview">
                                                @for($i = 1; $i < 10; $i++)
                                                    <option value="{{ $i * 20 }}">{{ ($i * 20).' Minutes' }}</option>
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
                                        <!-- <button type="button" class="btn btn-default" onclick="$('.ea-scheduleInerview').fadeOut()">Cancel</button> !-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
            </div>
			<div class="pnj-box">
				<h4>@lang('home.similarpeople') {{JobCallMe::countryName(JobCallMe::getHomeCountry())}}</h4>
				<div class="row" style="margin-right: 0 !important;">
					@foreach($Query as $appl) 
                        <?php
                            $pImage = url('profile-photos/profile-logo.jpg');
                            if($appl->profilePhoto != '' && $appl->profilePhoto != NULL){
                                $pImage = url('profile-photos/'.$appl->profilePhoto);
                            }
                        ?>
                        <div class="col-md-12 sr-item">
					        <div class="col-md-4">
                                <img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }} @endif" style="width: 70px;height:75px;">
							</div>
							<div class="col-md-8 sp-item">
                                <p><a href="{{ url('account/employer/application/candidate/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
                                <p>{!! $appl->companyName !!}</p>
                                <p>{{ JobCallMe::cityName($appl->city) }}, {{ JobCallMe::countryName($appl->country) }}</p>
                            </div>
						</div>
					@endforeach 
                </div>
			</div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.input-error{color: red;}
</style>
<script type="text/javascript">
    var token = "{{ csrf_token() }}";
    $(document).ready(function(){
        $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
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
                    toastr.success('Action perform successfully', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                    $('.ea-scheduleInerview').fadeOut();
                }
                $('.interview-form button[name="save"]').prop('disabled',false);
            }
        })
        e.preventDefault();
    })

    $(document).on('click','.openConversation',function(){
        $("#cometchat_synergy_iframe").contents().find("#cometchat_userlist_"+"<?=$userId?>").click(); 
    });
</script>
@endsection