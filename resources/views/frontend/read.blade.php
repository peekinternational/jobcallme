@extends('frontend.layouts.app')

@section('title', 'Read')

@section('content')

<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #cccccc !important;
    line-height: 28px; }
</style>

<section id="learn-section">
    <div class="container">
        <div class="col-md-12 learn-search-box" style="margin-top:20px">
            <h2 class="text-center"><!-- @lang('home.read_heading') --></h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                    <div class="ls-box">
                        <form role="form" action="{{ url('read') }}" method="post">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item">
                                    <input type="search" placeholder="@lang('home.lookingread')" name="keyword">
                                </div>
                                <div class="search-field-box search-item" style="width: 36%; ">
                                    <select class="form-control select2" name="category">
                                        <option value="0">@lang('home.category')</option>
                                        @foreach(JobCallMe::getReadCategories() as $cat)
                                            <option value="{!! $cat->id !!}">@lang('home.'.$cat->name)</option>
                                        @endforeach
                                    </select>
                                    <div class="" id="r_country" style="display:none;padding-top: 8px;">
                                    <select class="read-countrys" name="country" style="width: 100% !important;">
                                        <option value="0">@lang('home.country')</option>
                                        @foreach(JobCallMe::getJobCountries() as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                        @endforeach
                                    </select>
                            
                                    <select class="read-states" name="state" id="state_reads"  style="width: 100% !important;display:none; margin-bottom: 7px;margin-top: 7px;">
                                        <option value="">@lang('home.state')</option>
                                    </select>
                                
                                    <select class="read-citys" name="city" id="city_reads"  style="width: 100% !important;display:none;">
                                        <option value="">@lang('home.city')</option>
                                    </select>
                                    </div>
                                 </div>
                                 
                                <button type="submit" class="search-btn" style="float:left">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" id="r_search" style="margin-left: 9px;/* width: 7%; */height: 33px;/* background: transparent; *//* border: 2px solid #cecdcd; */">
                                    <span style="color:white">@lang('home.Country')</span></button>
                                    <button type="button" class="btn btn-default btn-sm" id="c_search" style="display: none;margin-left: 9px;/* width: 7%; */height: 33px;/* background: transparent; *//* border: 2px solid #cecdcd; */">
                                    <span>@lang('home.Close')</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2" style="margin-bottom:30px">
					<div class="job-schedule-box">
                    <!-- <div class="job-locations-box"> -->
                        <?php 
                        $cArr = array('#0e8bcc','#94a5a5','#8d846e','#4e6c7c','#919090','#b0a48a','#8d7e8d','#a69b82','#6b91a7','#9b9b36');
                        $i = 0;
                        foreach(JobCallMe::getReadCategories_select() as $cat){ ?>
                            <a href="{{ url('read?category='.$cat->id) }}" style="background-color: {{ $cArr[$i] }};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
    text-decoration: none;">@lang('home.'.$cat->name)</a>
                        <?php if($i == 5){ break; } $i++; } ?>
                    </div>
                    <div class="promote-learning-box">
                        <!-- <a href="{{ url('account/writings/article/add') }}" class="promote-learning-btn"> --><a href="{{ url('account/writings') }}" class="promote-learning-btn"><i class="fa fa-edit"></i>&nbsp; @lang('home.warticle')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Read Articles-->
<section id="learn-articles">
    <div class="container">
		<div class="follow-companies3" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px">@lang('home.larticle')</h3>
				</div>
        
        <div class="grid">
            <div class="grid-sizer col-xs-12 col-sm-6 col-md-3 col-lg-3"></div>
            <!--Article Item-->
            @foreach($read_record as $rec)
                <div class="col-xs-12 col-sm-6 col-md-3 grid-item">
                    <form id="{{ $rec->writingId }}">
                    <div class="la-item">
                        <div class="la-item-img">
                            <img class=" img-responsive" src="{{ url('article-images/'.$rec->wIcon) }}" alt="">
                        </div>
                        <div class="col-md-12">
                            <p> <a href="{{ url('read/article/'.$rec->writingId ) }}" class="la-title">{!! $rec->title !!}</a></p>
                            <?php
								$cat_names = explode(",",$rec->cat_names);
								
							?>

							<span>#<?php for($i=0; $i < count($cat_names); $i++){ ?>@lang('home.'.$cat_names[$i]) @if($cat_names[$i]!="")ㆍ@endif <?php } ?></span>

                            <div class="la-text">{!! $rec->citation !!}</div>
                            <div class="ra-author-box">
                           
                                <img src="@if($rec->profilePhoto !=''){{ url('profile-photos/'.$rec->profilePhoto) }} @else{{url('profile-photos/profile-logo.jpg')}} @endif" class="img-circle" alt="{{ $rec->firstName }}">
                                <div class="ra-author">
                                    @if($rec->phoneNumber == ''){{ $rec->firstName.' '.$rec->lastName }}@else<a href="{{ url('account/employer/application/applicant/'.$rec->userId) }}">{{ $rec->firstName.' '.$rec->lastName }}</a>@endif<br>
                                    <span>
                                        @if(app()->getLocale() == "kr")
											{{ date('Y-m-d',strtotime($rec->createdTime))}}
										@else
											{{ date('M d, Y',strtotime($rec->createdTime))}}
										@endif
                                    </span>
                                    <span class="pull-right"><i class="like fa fa-heart <?php echo JobCallMe::getUserLikes( $rec->writingId,Session::get('jcmUser')->userId,'read' ) ?>"></i> <i class="total-likes"><?php echo JobCallMe::getReadlikes($rec->writingId,'read')?></i>
                                    </span>
                                    <input type="hidden" class="post_id" value="{{ $rec->writingId}}">
                                    <input type="hidden" class="userId" value="{{  Session::get('jcmUser')->userId }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            @endforeach
		
        </div>
			<div style="text-align:center"><?php echo $read_record->render(); ?></div>
    </div>
</section>
@endsection
@section('page-footer')
<script src="https://npmcdn.com/isotope-layout@3.0/dist/isotope.pkgd.min.js"></script>
<script type="text/javascript">

//need this to deactivate lightbox on small screens
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

$("#r_search").click(function(){
    $('#r_country').show();
    $('#c_search').show();
    $('#r_search').hide();
    $(".ls-box").css("height", "116px");
    $('.container').append('<style type="text/css">@media screen and (max-width: 465px){ .ls-box { height: 250px !important;}}</style>');

});

$("#c_search").click(function(){
    $('#r_country').hide();
    $('#c_search').hide();
    $('#r_search').show();
    $(".ls-box").css("height", "96px");
    $('.container').append('<style type="text/css">@media screen and (max-width: 465px){ .ls-box { height: 166px !important;}}</style>');

});

    $('.read-countrys').on('change',function(){
        var countryId = $(this).val();
        $('#state_reads').show();
        $(".ls-box").css("height", "205px");
        $('.container').append('<style type="text/css">@media screen and (max-width: 465px){ .ls-box { height: 350px !important;}}</style>');
        getStatesssss(countryId)
    })
    function getStatesssss(countryId){
        $.ajax({
            url: "{{ url('account/get-state') }}/"+countryId,
            success: function(response){
                console.log(response)
                

                var currentState = $('.read-states').attr('data-state');
                $(".read-states").html('').trigger('change');
                    $(".read-states").append(response).trigger('change');
            
            }
        })
    }

    $('.read-states').on('change',function(){
        var stateId = $(this).val();
    
        getCitiesssss(stateId)
    })
    function getCitiesssss(stateId){
    
        $.ajax({
            url: "{{ url('account/get-city') }}/"+stateId,
            success: function(response){
                $('#city_reads').show();
                var currentCity = $('.read-citys').attr('data-city');
            
                $(".read-citys").html('').trigger('change');
            
                    $(".read-citys").append(response).trigger('change');
                
            }
        })
    }
</script>
@endsection

