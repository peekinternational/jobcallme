@extends('frontend.layouts.app')

@section('title', 'Learn')

@section('content')
<style>
                                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                                        color: #cccccc !important;
                                        line-height: 28px; }
                                    </style>
<section id="learn-section">
    <div class="container">
        <div class="col-md-12 learn-search-box">
            <h2 class="text-center"><!-- # @lang('home.learn') --><!-- @lang('home.l_heading') --></h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                  <div class="ls-box hidden-xs">
                        <form role="form" action="{{ url('learn/search')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item" id="l_key">
                                    <input type="search" placeholder="@lang('home.key')" name="learn-keyword">
                                </div>
                                <div class="search-field-box search-item" id="l_city" style="width: 53%;">
                                <select class="form-control  job-country" name="type" id="cat_select" style="width: 66% !important;display: inline-block;border-radius: 0;">
                                                <option value="">@lang('home.category')</option>
                                        @foreach(JobCallMe::getUpkillsType() as $skill)
                                            <option value="{!! $skill->name !!}">@lang('home.'.$skill->name)</option>
                                        @endforeach
                                    </select>
                                    <span id="l_type" style="display:none;padding-top: 14px;">
									   <button  type="submit" class="btn btn-success btn-sm">
                                        @lang('home.Search')</button>
                                        <button  type="button" id="l_close" class="btn btn-default btn-sm">
                                        @lang('home.Close')</button>
                                   </span>
                                    <div class="" id="l_country" style="display:none;padding-top: 14px;">
                                    <select class="learn-countrys" name="country" style="width: 66% !important;">
                                        <option value="0">@lang('home.country')</option>
                                        @foreach(JobCallMe::getJobCountries() as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                        @endforeach
                                    </select>
                            
                                    <select class="learn-states" name="state" id="state_learns"  style="width: 66% !important;display:none; margin-bottom: 7px;margin-top: 7px;">
                                        <option value="0">@lang('home.state')</option>
                                    </select>
                                
                                    <select class="learn-citys" name="city" id="city_learns"  style="width: 66% !important;display:none;">
                                        <option value="0">@lang('home.city')</option>
                                    </select>
                                    </div>

									<button type="submit" id="l_fasearch" style="width:11% !important;padding-left:-5px;float:none" class="search-btn">
                                    <i class="fa fa-search"></i>
                                    </button> 
                                    <button type="button" class="btn btn-success btn-sm" id="l_search" style="margin-left: 9px;/* width: 7%; */height: 33px;/* background: transparent; *//* border: 2px solid #cecdcd; */">
                                    <span style="color:white">@lang('home.Country')</span></button>
                                    </div>
                                   
								
                            </div>
                        </form>
                    </div>

<!--- mobile -->

                    <div class="mob-box hidden-sm hidden-md hidden-lg" >
                        <form role="form" action="{{ url('learn/search')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item" id="mob_key">
                                    <input type="search" placeholder="@lang('home.key')" name="learn-keyword">
                                </div>
                                <div class="search-field-box search-item" id="mob_city">
                                    <input type="search" placeholder="@lang('home.Cities')" name="city" style="margin-bottom: 12px;">
                                    <button type="submit" id="mob_fasearch" style="width:45% !important" class="search-btn">
                                    <i class="fa fa-search"></i>
                                    </button>
								<button  type="button" class="" id="mob_search" style="margin-left: 9px;width: 45%;height: 33px;background: transparent;border: 2px solid #cecdcd;">
                                <span class="caret" style="color:white"></span></button>
                                </div>
								<div class="search-field-box search-item" id="mob_type" style="display:none;padding-top: 14px;">
								<select class="form-control select2 job-country" name="type" >
                                     <option value="">@lang('home.category')</option>
                              @foreach(JobCallMe::getUpkillsType() as $skill)
                                <option value="{!! $skill->name !!}">@lang('home.'.$skill->name)</option>
                              @endforeach
                          </select>
                                </div>
                                
                                <div class="search-field-box search-item" id="mob_country" style="display:none;padding-top: 14px;">
								
                                    <select class="form-control select2 job-country" name="country" style="background: transparent;color: #fff">
                                        <option value="">@lang('home.country')</option>
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
                                    @endforeach
									</select>
	                           <button  type="submit" class="btn btn-success" style="margin-top: 12px;">
                                @lang('home.Search')</button>
								<button  type="button" id="mob_close" class="btn btn-default" style="margin-top: 12px;">
                                @lang('home.Close')</button>
	                               
									
                                </div>
							
								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="job-schedule-box">
                    <!-- <div class="job-locations-box"> -->
                        <?php 
                        $cArr = array('#0e8bcc','#94a5a5','#8d846e','#4e6c7c','#919090','#b0a48a','#8d7e8d','#a69b82','#6b91a7','#9b9b36');
                        $i = 0;
                        foreach(JobCallMe::getUpkillsType() as $skill){ ?>
                            <a href="{{ url('learn?type='.strtolower($skill->name)) }}" style="background-color: {{ $cArr[$i] }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                /* width: 9.5%; */
                                padding: 5px 5px;
                                color: #ffffff;
                                font-size: 12px;
                                margin-bottom: 10px;
                                /* display: block; */
                                position: relative;
                                /* float: left; */
                                margin-right: 0.5%;
                                overflow: hidden;
                                text-decoration: none;">@lang('home.'.$skill->name)</a>
                        <?php $i++; } ?>
                    </div>
                    <div class="promote-learning-box" style="margin-bottom:30px">
                        <!-- <a href="{{ url('account/upskill/add') }}" class="promote-learning-btn"> --><a href="{{ url('account/upskill') }}" class="promote-learning-btn"><i class="fa fa-bullhorn"></i>&nbsp; @lang('home.promotesoluction')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Learn Articles-->
<section id="learn-articles">
    <div class="container">
		
		<div class="follow-companies3" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.latestcourses')</h3>
				</div>

        
        <div class="grid">
            <div class="grid-sizer col-xs-12 col-sm-6 col-md-3 col-lg-3"></div>
            <!--Article Item-->
            @foreach($lear_record as $rec)
                <div class="col-xs-12 col-sm-6 col-md-3 grid-item">
                    <form id="{{ $rec->skillId }}">
                   <div class="la-item">
                        <div class="la-item-img">
                            @if($rec->upskillImage != '')
                            <img class=" img-responsive" src="{{ url('upskill-images/'.$rec->upskillImage) }}" style="width:100%" alt="">
                            @else
                            <img src="{{ url('d-cover.jpg') }}">
                            @endif
                        </div>
                        
                        <div class="col-md-12">
                            <p> <a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}" class="la-title">{!! $rec->title !!}</a></p>
                            <p>{{ $rec->organiser != '' ?  $rec->organiser : JobCallMe::userName($rec->userId) }}</p>
                            <span>#@lang('home.'.$rec->type)</span>
                            <p>
							  @if($rec->startDate != "0000-00-00")
								@if(app()->getLocale() == "kr")
									<i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($rec->startDate))}} @if($rec->endDate != "0000-00-00")<i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}} @endif
								@else
									<i class="fa fa-calendar"></i> {{ date('M d, Y',strtotime($rec->startDate))}} @if($rec->endDate != "0000-00-00")<i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}} @endif
								@endif 
							  @endif 
							
							</p>
                            <div class="la-text">{{ substr(strip_tags($rec->description),0,200) }}</div>
                            <span><i class="fa fa-map-marker"></i> @lang('home.'.JobCallMe::cityName($rec->city)),@lang('home.'.JobCallMe::countryName($rec->country))</span>
                            <div>
                                <!-- <p class="pull-right la-price">{{ $rec->currency.' '.number_format($rec->cost)}}/-</p> -->
								<!-- <p class="pull-left la-price"> --><p class="pull-left la-price"><span style="font-size:12px">@lang('home.leancostlist') :</span> @if($rec->accommodation == "Yes") {{ $rec->currency.' '.number_format($rec->cost)}} @else @if($rec->accommodation == "on") @lang('home.free') @else @if($rec->website)<a href="{!! $rec->website !!}" target="_blank">@endif @lang('home.Contact person') @endif @endif</p>
                            </div>

                               <div class="newimg">
                                @if($rec->companyLogo !="")<img src="{{ url('compnay-logo/'.$rec->companyLogo) }}" class="img-circle" style="height: 63px;margin-bottom: 0;margin-top: 0;" alt="{{ $rec->companyName }}">@endif

                                <div class="ra-author" style="width: 100%;padding-top: 0px;">
                                    <a href="{{ url('companies/company/'.$rec->companyId) }}">{{ $rec->companyName}}</a><br>
                                  
                                    <div class="newimg">
                               @if($rec->companyLogo)
                               <img src="@if($rec->companyLogo){{ url('compnay-logo/'.$rec->companyLogo) }}@else{{ url('compnay-logo/default-logo.jpg') }} @endif" class="" style="height: 63px;margin-bottom: 0;margin-top: 0;width:63px;" alt="{{ $rec->companyName }}">
							   
							   @endif
							   </div>
                               <span>@if(app()->getLocale() == "kr")
											{{ date('Y-m-d',strtotime($rec->createdTime))}}
										@else      
											{{ date('M d, Y',strtotime($rec->createdTime))}}
										@endif
                                    </span>
                                    <span class="pull-right"><i class="like fa fa-heart <?php echo JOBCALLME::getUserLikes( $rec->skillId,Session::get('jcmUser')->userId,'jcm_upskills' ) ?>"></i> <i class="total-likes"><?php echo JOBCALLME::getReadlikes($rec->skillId,'jcm_upskills')?></i>
                                    </span>
									</div>
                                    <input type="hidden" class="post_id" value="{{ $rec->skillId }}">
                                    <input type="hidden" class="userId" value="{{  Session::get('jcmUser')->userId }}">
                                </div>
                            </div>
                       
                   </div>
                   </form>
                </div>
            @endforeach
        </div>
        <div style="text-align:center"><?php	echo $lear_record->render(); ?></div>
    </div>
	<br><br><br>
</section>
@endsection
@section('page-footer')
<script src="https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function () {

    lightboxOnResize();

});

$(window).resize(function() {
    lightboxOnResize();

});

//***ISOTOPE***
// init Isotope
var $grid = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'masonry'
});

// filter items on button click
$('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({ filter: filterValue });
});

// change is-checked class on buttons
$('.btn-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
    });
});


function lightboxOnResize() {

    if ($(window).width() < 768) {

        $('a[rel="prettyPhoto[portfolio]"]')
            .removeAttr('rel')
            .addClass('lightboxRemoved');

        $('a.lightboxRemoved').click(function( event ) {
            event.preventDefault();
            console.log("test");
        });

    } else {

        $('a.lightboxRemoved').attr('rel', 'prettyPhoto[portfolio]').removeClass("lightboxRemoved");
        $("a[rel='prettyPhoto[portfolio]']").prettyPhoto({
            theme: "light_square",
        });

    }
}
 $("#l_search").click(function(){
        $("#l_type").fadeIn();
		 $("#l_country").fadeIn();
		 $('.ls-box').css('height', '134px');
         $('.mob-box').css('height', '300px');
         $('#l_city').css('width','50%');
         $('#cat_select').css('width','66%');
		 $('#l_city input[name="learn-city"]').css('width', '100%');
		 $('#l_type').css('padding-right', '40px');
		 $('#l_fasearch').hide();
		 $('#l_search').hide();
        
    });
	$("#l_close").click(function(){
        $("#l_type").fadeOut();
		 $("#l_country").fadeOut();
		 $('.ls-box').css('height', 'auto');
         $('.mob-box').css('height', '175px');
         $('#l_city').css('width','53%');
         $('#cat_select').css('width','66%');
		 $('#l_city input[name="learn-city"]').css('width', '88%');
		 $('#l_fasearch').show();
		 $('#l_search').show();
         $('#city_learns').hide();
         $('#state_learns').hide();
        
    });

     $("#mob_search").click(function(){
        $("#mob_type").fadeIn();
		 $("#mob_country").fadeIn();
		
         $('.mob-box').css('height', '300px');
		 $('#mob_city input[name="learn-city"]').css('width', '100%');
		 $('#mob_type').css('padding-right', '40px');
		 $('#mob_fasearch').hide();
		 $('#mob_search').hide();
        
    });
	$("#mob_close").click(function(){
        $("#mob_type").fadeOut();
		 $("#mob_country").fadeOut();
	
         $('.mob-box').css('height', '175px');
		 $('#mob_city input[name="learn-city"]').css('width', '88%');
		 $('#mob_fasearch').show();
		 $('#mob_search').show();
        
    });

    $('.learn-countrys').on('change',function(){
    var countryId = $(this).val();
    $('#state_learns').show();
    $(".ls-box").css("height", "205px");
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
            $('#city_learns').show();
            var currentCity = $('.learn-citys').attr('data-city');
           
            $(".learn-citys").html('').trigger('change');
           
                $(".learn-citys").append(response).trigger('change');
            
        }
    })
}
</script>
@endsection