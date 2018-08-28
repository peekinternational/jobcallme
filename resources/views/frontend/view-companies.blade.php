@extends('frontend.layouts.app')

@section('title', 'Companies')

@section('content')
<section id="companies-section">
    <div class="container">
        <div class="col-md-12 learn-search-box">
            <h2 class="text-center"><!-- @lang('home.companiesin') @lang('home.'.JobCallMe::countryName(JobCallMe::getHomeCountry())) --></h2>
            <div class="row">
                <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                    <div class="ls-box">
                        <form role="form" action="{{ url('companies') }}" method="get">
                            {{ csrf_field() }}
                            <div class="input-fields">
                                <div class="search-field-box search-item">
                                    <input type="search" placeholder="@lang('home.key')" name="keyword" >
                                </div>
                                <div class="search-field-box search-item">
                                <div class="" id="r_country" style="">
                                    <select class="company-countrys" name="country" style="width: 100% !important;">
                                        <option value="">@lang('home.country')</option>
                                        @foreach(JobCallMe::getJobCountries() as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == trim(Request::input('country')) ? 'selected="selected"' : '' }}>@lang('home.'.$country->name)</option>
                                        @endforeach
                                    </select>
                            
                                    <select class="company-states" name="state" id="state_companys"  style="width: 100% !important;display:none; margin-bottom: 7px;margin-top: 7px;">
                                        <option value="">@lang('home.state')</option>
                                    </select>
                                
                                    <select class="company-citys" name="city" id="city_companys"  style="width: 100% !important;display:none;">
                                        <option value="">@lang('home.city')</option>
                                    </select>
                                    </div>
                                </div>
                                <button type="submit" class="search-btn2">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-2">

                </div>
            </div>-->
            <div class="row text-sm  companies-list">
                <div class="col-md-12">
                    <h4 class="category-label">@lang('home.companiesindustry')</h4>
                    <div class="col-md-3 col-xs-6">
                    <ul class="list-unstyled">
                    <?php 
                    $i = 1; 
                    foreach(JobCallMe::getCategories() as $cat){
                        //if($i == 10){
						if($i == 5){
                            $i = 1; 
                            echo '</ul></div>';
                            echo '<div class="col-md-3 col-xs-6">';
                            echo '<ul class="list-unstyled">';
                        }
						if($cat->categoryId != 17 and $cat->categoryId !=18){
                        echo '<li class="ellipsis"><a href="'.url('companies?in='.$cat->categoryId).'" class="hvr-forward">'.trans('home.'.$cat->name).'</a></li>';
                        $i++;
						}
                    ?>
                    <?php }?>
                    </ul>
                    </div>
                </div>
            </div>
            
        </div>
       
    </div>
     
</section>
<section>
    <div class="container">
        <div class="companies-item-box">

            <div class="row">
           
                @foreach($companies as $company)
               
                    <?php
                    //print_r($company);exit;
                    $cLogo = url('compnay-logo/default-logo.jpg');
                    
					if($company->work_id){
						
						  $is_file_exist = file_exists('compnay-logo/'.$company->work_id.'_Logo.jpg');

						  if ($is_file_exist) {
							$cLogo = url('compnay-logo/'.$company->work_id.'_Logo.jpg');
						  }


						
					}else{
						if($company->companyLogo != ''){
						  
							  $is_file_exist = file_exists('compnay-logo/'.$company->companyLogo);

							  if ($is_file_exist) {
								$cLogo = url('compnay-logo/'.$company->companyLogo);
							  }
						  
						}
					}

					
                    ?>
                    <div class="col-pr-10 col-xs-6 hvr-bob companies-mbl-vew" style="padding-right: 0px;margin-bottom: 5px;">
                        <!-- normal -->
                        <div class="ih-item square effect8 scale_up" style="height: 105px !important;border: 1px solid #a29a9a !important">
                            <a href="{{ url('companies/company/'.$company->companyId) }}">
                          
                            <div class="jobs-logo">
							@if($cLogo == "https://www.jobcallme.com/compnay-logo/default-logo.jpg")
							<span style="margin: 0 auto;"><b><center>{!! $company->companyName !!}</center></b></span>
                            @else
							<img src="{{ $cLogo }}" alt="img" style="width:100%" >
                            @endif
							</div>
                          
                            <div class="info">
                                <h3>{!! $company->companyName !!}</h3>
					<?
					 $string = strip_tags($company->companyAbout);
					 if (strlen($string) > 130) {

								// truncate string
									$stringCut = substr($string, 0, 130);
									 $endPoint = strrpos($stringCut, ' ');

								//if the string doesn't contain any space then it will cut without word basis.
									//$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

									$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
									$string .= '... '.trans('home.Read More').'';
									
					}
					?>

                                <p>{!! $string !!}<!-- {!! substr(strip_tags($company->companyAbout),0,100) !!} --></p>
                            </div></a>
							<div class="info companies-mbl-info">
                                <h3>{!! $company->companyName !!}</h3>                               
                            </div>
                            
                        </div>
                        <!-- end normal -->
                        @if($company->package)
                        <div class="starhave">
                            <i class="fa fa-star-o"></i>
                            </div>
                            @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div style="text-align:center"><?php	echo $companies->render(); ?></div>
    </div>
</section>
<link href="{{ asset('frontend-assets/css/ihover.css') }}" rel="stylesheet">
<style type="text/css">
.ih-item.square.effect8 .info h3 {font-size: 13px;}
</style>

@endsection
@section('page-footer')
<script type="text/javascript">
    $('.company-countrys').on('change',function(){
        var countryId = $(this).val();
        $('#state_companys').show();
        $(".ls-box").css("height", "179px");
        $('.container').append('<style type="text/css">@media screen and (max-width: 465px){ .ls-box { height: 244px !important;}}</style>');
        getStatesssss(countryId)
    })
    function getStatesssss(countryId){
        $.ajax({
            url: "{{ url('account/get-state') }}/"+countryId,
            success: function(response){
                console.log(response)
                

                var currentState = $('.company-states').attr('data-state');
                $(".company-states").html('').trigger('change');
                    $(".company-states").append(response).trigger('change');
            
            }
        })
    }

    $('.company-states').on('change',function(){
        var stateId = $(this).val();
    
        getCitiesssss(stateId)
    })
    function getCitiesssss(stateId){
    
        $.ajax({
            url: "{{ url('account/get-city') }}/"+stateId,
            success: function(response){
                $('#city_companys').show();
                var currentCity = $('.company-citys').attr('data-city');
            
                $(".company-citys").html('').trigger('change');
            
                    $(".company-citys").append(response).trigger('change');
                
            }
        })
    }

         document.getElementById("text_1").value = getSavedValue("text_1");    // set the value to this input
        //document.getElementById("txt_2").value = getSavedValue("txt_2");   // set the value to this input
        /* Here you can add more inputs to set value. if it's saved */

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(e){
            var id = e.id;  // get the sender's id to save it . 
            var val = e.value; // get the value. 
            localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
        }

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedValue  (v){
            if (localStorage.getItem(v) === null) {
                return "";// You can change this to your defualt value. 
            }
            return localStorage.getItem(v);
        }
</script>
@endsection
