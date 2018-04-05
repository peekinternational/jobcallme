@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')
 <?php 
     $cLogo = url('compnay-logo/default-logo.jpg');
       if($job->companyLogo != ''){
          $cLogo = url('compnay-logo/'.$job->companyLogo);
             }
              ?>
<?php
$head='';
$travelFound=false;			
$dispatch='';

  if($job->head == "yes")		
					{		
				$head='<span class="label" style="background-color:green">Headhunting</span>';		
				}		
				else{		
					$head="";		
				}		
					if($job->dispatch == "yes")		
					{		
						$dispatch='<span class="label" style="background-color:blue">Dispatch & Agency</span>';		
					}						else{		
					$dispatch="";		
				}
?>
<section id="jobs">
    <div class="container">
        <div class="col-md-9">
		
            <div class="jobs-suggestions">
			<div style="display: -webkit-box;" class="suggestions-user-info">
			 <img src="{{ $cLogo }}"  style="width:118px;">	<?php $colorArr = array('purple','green','darkred','orangered','blueviolet') ?>
			<div style="padding-left: 42px;">
			<span style="text-transform: uppercase;font-size: 26px;">{{$job->companyName}}</span>
                <p style="font-size: 18px;margin-top: 24px; margin-left: 6px;">{{ $job->title }},  &nbsp;<span style="font-size: 13px; padding-top: 9px;">{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }} </span> &nbsp;<span class="label" style="background-color: {{ $colorArr[array_rand($colorArr)] }}">
				{{ $job->p_title }}
				</span> &nbsp;{!! $head !!} <span style="font-size:9px;margin-left:13px">Never pay for job application, test or interview. <a href="{{ url('/safety')}}">more</a></span></p>
				
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
                        <td>{{ JobCallMe::cityName($job->city) }}, {{ JobCallMe::countryName($job->country) }}</td>
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

            <!--ABOUT Organization-->
            <!-- <div class="jobs-suggestions">
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
            </div> -->
            <div class="jobs-suggestions">
                <div class="jd-action-btn">
                    @if(in_array($job->companyId,$followArr))
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-success">@lang('home.following')</a>
                    @else
                        <a href="javascript:;" onclick="followCompany({{ $job->companyId }},this)" class="btn btn-primary">@lang('home.follow')</a>
                    @endif   
                    <a href="javascript:;" class="btn btn-default">Write Review</a>   
                </div>
                <h4>{{ $job->companyName }} </h4>
                <p>{{ JobCallMe::cityName($job->companyCity) }}, {{ JobCallMe::countryName($job->companyCountry) }}</p>
                <div class="jd-about-organization">
                    <p>{!! $job->companyAbout !!}</p>
                </div>
                <p align="center">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i><br>
                        View all 0 reviews
                </p>
                <hr>
                <p>
                    <table>
                        <tr>
                            <td>Career Growth</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Compensation & Benefits</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Work/Life Balance</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Management</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Culture</td>
                            <td>&nbsp;&nbsp;</td>
                            <td>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </td>
                        </tr>
                    </table>
                </p>
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="row" align="center">
                            <div class="col-md-4">
                                <span style="font-size:12px">Not Rated Yet</span>
                                <p>CEO Recommended</p>
                            </div>
                            <div class="col-md-4">
                                <span style="font-size:12px">Not Rated Yet</span>
                                <p>Recommend to a friend</p>
                            </div>
                            <div class="col-md-4">
                                <span style="font-size:12px">&nbsp;</span>
                                <p>Future Expectations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                    <div class="jobs-suggestions">
                      
                       <input id="pac-input" class="controls" type="hidden" value="{!! $job->Address !!}" >
                       
                              
                    <!-- google map code html -->
                    <div id="map"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <span id="place-name"  class="title"></span><br>
                      <span id="place-address"></span>
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
                       
                            $cLogo = url('compnay-logo/default-logo.jpg');
                            if($appl->companyLogo != ''){
                                $cLogo = url('compnay-logo/'.$appl->companyLogo);
                                    }
                                    ?>
                        <div class="col-md-12 col-xs-12 sp-item">
						<div class="col-md-4 col-xs-4 sp-item">
                            <img src="{{ $cLogo }}" style="">
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
    <style type="text/css">
      #map {
        height: 300px;
      }
      /* Optional: Makes the sample page fill the window. */
      
       #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
      
</style>
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
<!-- google map code start from there  -->
<script>
$(document).ready(function(){
 
});
 
    var addr=$('#pac-input').val();
        
   


      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
               var geocoder = new google.maps.Geocoder();
               var address = addr;
               var longitude="";
               var latitude="";
               var myLatLng="";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
         myLatLng={lat: latitude, lng: longitude}
    //alert(latitude);
     var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 14,
          mapTypeId: 'roadmap'
        });

  } 
   var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr
        });
});
     
      }

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initAutocomplete" async defer></script>

@endsection