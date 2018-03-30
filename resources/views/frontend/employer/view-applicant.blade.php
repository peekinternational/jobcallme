@extends('frontend.layouts.app')

@section('title','Applicant')

@section('content')
 <?php
     $pImage = url('profile-photos/profile-logo.jpg');
      if($applicant->profilePhoto != '' && $applicant->profilePhoto != NULL){
       $pos = strpos($applicant->profilePhoto,"ttp");
        if($pos == 1)
        {
          $pImage = url($applicant->profilePhoto);
         } 
          else{
            $pImage = url('profile-photos/'.$applicant->profilePhoto);
              }
                           
                }
                   ?>
<section id="myResume">
    <div class="container">
    
        <div class="row">
            <div class="col-md-12">
            @if($privacy->profile == 'Yes')
                <div class="col-md-9">
                    <!--Personal Info Start-->
                    <section class="personal-info-section" id="personal-information">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="profile-img">
                                    <img src="@if($privacy->profileImage == 'Yes') {{ $pImage}} @else {{url('profile-photos/profile-logo.jpg')}} @endif" style="width: 100%">
                                </div>
                                <h3 class="text-center hidden-md hidden-lg" style="font-weight: 600">{{$applicant->firstName}} {{$applicant->lastName}}</h3>
                                <p class="text-center hidden-md hidden-lg jp-profession-heading">{{ JobCallMe::categoryTitle($applicant->industry) }}</p>
                                <a href="#" class="btn btn-primary btn-block jp-contact-btn">CONTACT DETAILS</a>
								<div class="" style="text-align:center">
                                   <a href="{{ url('account/jobseeker/cv/'.$applicant->userId)}}" style="color:#737373" class=""><i class="fa fa-download"></i> @lang('home.DOWNLOAD')</a>
                                  </div>
                            </div>
                            <div class="col-md-9 personal-info-right">
                                <h3 class="hidden-sm hidden-xs">{{$applicant->firstName}} {{$applicant->lastName}}</h3>
                                <p class="jp-profession-heading hidden-sm hidden-xs">{{ JobCallMe::categoryTitle($applicant->industry) }}</p>
                                <p><span class="pi-title">Experiance:</span>{{$applicant->experiance}}</p>
                                
                                <p><span class="pi-title">Salary:</span> {{ number_format($applicant->currentSalary != '' ? $applicant->currentSalary : '0',2).' '.$applicant->currency }}</p>
								<p><span class="pi-title">@lang('home.location'):</span> {!! JobCallMe::cityName($applicant->city).' ,'.JobCallMe::countryName($applicant->country) !!}</p>
                                <div class="professional-summary">
                                    <h4>@lang('home.p_summary')</h4>
                                    <p>{!! $applicant->about !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Personal Info End-->

                    <!--Academic Section Start-->
                    @if($privacy->academic == 'Yes')
                    <section class="resume-box" id="academic">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  Academic</h4>
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
                    @endif
                    <!--Academic Section End-->

                    <!--experience Section Start-->
                    @if($privacy->experience == 'Yes')
                    <section class="resume-box" id="experience">
                        <h4><i class="fa fa-star r-icon bg-primary"></i>  Experience</h4>
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
                    @endif
                    
                   <!--Skills Section Start-->
                   @if($privacy->skills == 'Yes')
                    <section class="resume-box" id="skills">
                        <h4><i class="fa fa-graduation-cap r-icon bg-primary"></i> @lang('home.skills')</h4>
                        <ul class="resume-details">
                            @if(count($resume['skills']) > 0)
                                @foreach($resume['skills'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <p class="rd-title">{!! $skills->skill !!}</p>
                                            <p class="rd-location">{!! $skills->level !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    @endif
                    <!--Academic Section Start-->
                    <section class="resume-box" id="certification">
                        <h4><i class="fa fa-certificate r-icon bg-primary"></i>  Certification</h4>
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
                    @if($privacy->projectVisible == 'Yes')
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
                    @endif
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
											<p class="rd-location">{!! $afflls->org .', '.JobCallMe::cityName($afflls->city).' ,'.JobCallMe::countryName($afflls->country) !!}
											
										  
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
                    @if($privacy->publicationsVisible == 'Yes')
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
                    @endif
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
            @else 
                <div class="col-md-9">
                <div class="alert alert-danger"> this profile is restricted</div>
                </div>
            @endif
				<div class="col-md-3">
                    <div class="pnj-box">
                    <h4>@lang('home.similarpeople') {{JobCallMe::countryName(JobCallMe::getHomeCountry())}}</h4>
                        <div class="row" style="margin-right: 0 !important;">
                        @foreach($Query as $appl)
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
                             <div class="col-md-12 sr-item">
                              <div class="col-md-4 applicant-SimilarImg">
                                <img src="@if($appl->privacyImage == 'Yes') {{ $pImage }} @else {{ url('profile-photos/profile-logo.jpg') }} @endif" style="width: 70px;height:75px;">
                                </div>
                                <div class="col-md-8 sp-item">
                                <p><a href="{{ url('account/employer/application/applicant/'.$appl->userId) }}">{!! $appl->firstName.' '.$appl->lastName !!}</a></p>
                                <p>{!! $appl->companyName !!}</p>
                                <p>{{ JobCallMe::cityName($appl->city) }}, {{ JobCallMe::countryName($appl->country) }}</p>
                            </div>
                            </div>
                             @endforeach                         
                        </div>
                    
                    </div>            
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
</script>
@endsection