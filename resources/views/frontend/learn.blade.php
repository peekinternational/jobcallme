@extends('frontend.layouts.app')

@section('title', 'Learn')

@section('content')
<section id="learn-section">
    <div class="container">
        <div class="col-md-12 learn-search-box">
            <h2 class="text-center">@lang('home.l_heading')</h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="ls-box">
                        <form role="form" action="{{ url('learn/search')}}" method="post">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item" id="l_key">
                                    <input type="search" placeholder="@lang('home.key')" name="learn-keyword">
                                </div>
                                <div class="search-field-box search-item" id="l_city">
                                    <input type="search" placeholder="@lang('home.city')" name="city">
										<button type="submit" id="l_fasearch" style="width:9% !important" class="search-btn">
                                    <i class="fa fa-search"></i>
                                </button> 
                                </div>
								<div class="search-field-box search-item" id="l_type" style="display:none;padding-top: 14px;">
								<select class="form-control select2 job-country" name="type" >
                                     <option value="">@lang('home.type')</option>
                              @foreach(JobCallMe::getUpkillsType() as $skill)
                                <option value="{!! $skill !!}">{!! $skill !!}</option>
                              @endforeach
                          </select>
									<button  type="submit" class="btn btn-success" style="margin-top: 12px;">
                                Search</button>
								<button  type="button" id="l_close" class="btn btn-default" style="margin-top: 12px;">
                                Close</button>
                                </div>
                                
                                <div class="search-field-box search-item" id="l_country" style="display:none;padding-top: 14px;">
								
                                    <select class="form-control select2 job-country" name="country">
                                        <option value="">select country</option>
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                    @endforeach
									</select>
									
									
                                </div>
							
                                
								<button  type="button" id="l_search" style="margin-left: 9px;width: 21px;height: 33px;background: transparent;">
                                <span class="caret" style="color:white"></span></button>
								
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="job-locations-box">
                        <?php 
                        $cArr = array('purple','green','darkred','orangered','blueviolet','#122b40');
                        $i = 0;
                        foreach(JobCallMe::getUpkillsType() as $skill){ ?>
                            <a href="{{ url('learn/search?type='.strtolower($skill)) }}" style="background-color: {{ $cArr[$i] }}">{!! $skill !!}</a>
                        <?php $i++; } ?>
                    </div>
                    <div class="promote-learning-box">
                        <a href="{{ url('account/upskill/add') }}" class="promote-learning-btn"><i class="fa fa-bullhorn"></i>&nbsp; @lang('home.promotesoluction')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Learn Articles-->
<section id="learn-articles">
    <div class="container">
        <h1 style="margin-left: 15px">@lang('home.latestcourses')</h1>
        <div class="grid">
            <div class="grid-sizer col-xs-12 col-sm-6 col-md-3 col-lg-3"></div>
            <!--Article Item-->
            @foreach($lear_record as $rec)
                <div class="col-xs-12 col-sm-6 col-md-3 grid-item">
                   <div class="la-item">
                        @if($rec->upskillImage != '')
                        <img class=" img-responsive" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="">
                        @else
                        <img src="{{ url('d-cover.jpg') }}">
                        @endif
                        <div class="col-md-12">
                            <p> <a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}" class="la-title">{!! $rec->title !!}</a></p>
                            <p>{{ $rec->organiser != '' ?  $rec->organiser : JobCallMe::userName($rec->userId) }}</p>
                            <span>{{ $rec->type }}</span>
                            <p><i class="fa fa-calendar"></i> {{ date('M d, Y',strtotime($rec->startDate))}} <i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</p>
                            <div class="la-text">{{ substr(strip_tags($rec->description),0,200) }}</div>
                            <span><i class="fa fa-map-marker"></i> {{ JobCallMe::cityName($rec->city) }},{{ JobCallMe::countryName($rec->country) }}</span>
                            <div>
                                <p class="pull-right la-price">{{ $rec->currency.' '.number_format($rec->cost)}}/-</p>
                            </div>
                       </div>
                   </div>
                </div>
            @endforeach
        </div>
    </div>
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
		 $('.ls-box').css('height', '175px');
		 $('#l_city input[name="learn-city"]').css('width', '100%');
		 $('#l_type').css('padding-right', '40px');
		 $('#l_fasearch').hide();
		 $('#l_search').hide();
        
    });
	$("#l_close").click(function(){
        $("#l_type").fadeOut();
		 $("#l_country").fadeOut();
		 $('.ls-box').css('height', 'auto');
		 $('#l_city input[name="learn-city"]').css('width', '88%');
		 $('#l_fasearch').show();
		 $('#l_search').show();
        
    });
</script>
@endsection