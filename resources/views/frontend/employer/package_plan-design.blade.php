@extends('frontend.layouts.app')

@section('title','Share Job')

@section('content')

<section id="company-box">
			<div class="container" >
			<div class="row">
   
			<div class="pricing blue" fxflex="calc(50% -15px)" fxflex.xs="100%" style="flex: 1 1 calc(50% - 15px); box-sizing: border-box; margin-right: 15px; min-width: calc(50% - 15px);">
            <div class="col-md-12"  style=" background-color: white; box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);">
		  
            <h3 class="text-center text-lg mb20">
                
                @lang('home.Job Posting that Deliver Results')
            </h3>
			
					<div style="padding-bottom:20px">
						<span>@lang('home.selectcurrency'): &nbsp;</span>
                        <input type="radio" name="gender" id="kr" value="kr" checked="checked"> @lang('home.paykorean')
                      &nbsp;&nbsp;<input type="radio" name="gender" id="us" value="us"> US$
                    </div>

              
			  
				  <div>
                        

						<ul id="post-job-ad-types3">
							@foreach($plan as  $key=>$payment)	
								@if($payment->type == "Basic")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "basic_text";
										$payad_text2 = "basic_text2";
									?>
								@endif
								@if($payment->type == "Golden")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "golden_text";
										$payad_text2 = "golden_text2";
									?>
								@endif
								@if($payment->type == "Special")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "special_text";
										$payad_text2 = "special_text2";
									?>
								@endif
								@if($payment->type == "Latest")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "latest_text";
										$payad_text2 = "latest_text2";
									?>
								@endif
								@if($payment->type == "Hot")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "hot_text";
										$payad_text2 = "hot_text2";
									?>
								@endif
								@if($payment->type == "Top")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "top_text";
										$payad_text2 = "top_text2";
									?>
								@endif
								@if($payment->type == "Premium")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "premium_text";
										$payad_text2 = "premium_text2";
									?>
								@endif

								@if($payment->type == "Resume Download")
                            <!----><li style="position:relative;background-image:url('/frontend-assets/images/package1.png');">
									<?php
										$payad_text = "resumedown_text";
										$payad_text2 = "resumedown_text2";
									?>
								@endif
								
                                <!---->
								<div style="height:40px;text-align: center;padding-top:15px;">
									
									
									<span style="color:#fff;font-size: 15px;padding-left:0px;"><b>@lang('home.'.$payment->type)</b></span>
								</div>

							   <div class="" style="text-align: center;"><span style="display:none">&nbsp;</span>
                             
                                <div>
                                    <!----><label for="{!! $payment->id!!}">

										@if($payment->type == "Resume Download")
										<div style="font-size: 15px;text-align: center;padding-top:35px" >@lang('home.Resume_method')</div>	
										@endif
                                        
										@if($payment->type == "Basic")
										<div style="font-size: 17px;text-align: center;padding:20px 15px 10px 15px;" >@lang('home.'.$payad_text)</div>
										<div style="font-size: 13px;text-align: center;padding:20px 15px 25px 15px;" >@lang('home.'.$payad_text2)</div>
										@elseif($payment->type == "Resume Download")
										<div style="font-size: 17px;text-align: center;padding:0px 15px 0px 15px;" >&nbsp;<!-- @lang('home.'.$payad_text) --></div>
										<div style="font-size: 13px;text-align: center;padding:10px 15px 20px 15px;" >+{{$payment->quantity}}@lang('home.'.$payad_text2)</div>
										@else
										<div style="font-size: 13px;text-align: center;padding:20px 20px 0 15px;" >@lang('home.'.$payad_text)</div>
										@if($payment->type == "Premium")
										<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;" >@lang('home.premium_text8')</div>
										@endif
										<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;" >@lang('home.'.$payad_text2)</div>									
										@endif

										
										
										
										
										@if($payment->type != "Resume Download")
											@if($payment->type == "Premium")
											<div style="font-size: 13px;text-align: center;padding-bottom:10px;color:#ff6600" >@lang('home.paylocation')</div>
											@else										
											<div style="font-size: 13px;text-align: center;padding-top:20px;padding-bottom:17px;color:#ff6600" >@lang('home.paylocation')</div>
											@endif
										@else
										<div style="font-size: 13px;text-align: center;padding-bottom:20px;color:#ff6600" >@lang('home.resumeday1') : @lang('home.resumeday2')</div>										
										@endif
										

										
                                        <div class="credits b" style="font-size: 13px;text-align: center;" >@lang('home.pay_cost') : 
											@if($payment->type == "Premium")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "360")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦440000</strike> [10%]</div>
													@elseif($payment->amount == "260")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦308000</strike> [7%]</div>
													@elseif($payment->amount == "190")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦220000</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "360")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄400</strike> [10%]</div>
													@elseif($payment->amount == "260")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄280</strike> [7%]</div>
													@elseif($payment->amount == "190")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄200</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											@if($payment->type == "Top")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "315")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦385000</strike> [10%]</div>
													@elseif($payment->amount == "227")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦269500</strike> [7%]</div>
													@elseif($payment->amount == "166")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦192500</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "315")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄350</strike> [10%]</div>
													@elseif($payment->amount == "227")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄245</strike> [7%]</div>
													@elseif($payment->amount == "166")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄175</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											@if($payment->type == "Hot")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "270")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦330000</strike> [10%]</div>
													@elseif($payment->amount == "195")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦231000</strike> [7%]</div>
													@elseif($payment->amount == "142")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦165000</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "270")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄150</strike> [10%]</div>
													@elseif($payment->amount == "195")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄210</strike> [7%]</div>
													@elseif($payment->amount == "142")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄300</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											@if($payment->type == "Latest")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "225")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦247500</strike> [10%]</div>
													@elseif($payment->amount == "162")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦192500</strike> [7%]</div>
													@elseif($payment->amount == "118")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦178200</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "225")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄250</strike> [10%]</div>
													@elseif($payment->amount == "162")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄162</strike> [7%]</div>
													@elseif($payment->amount == "118")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄118</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											@if($payment->type == "Special")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "180")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦220000</strike> [10%]</div>
													@elseif($payment->amount == "130")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦154000</strike> [7%]</div>
													@elseif($payment->amount == "95")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦110000</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "180")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄200</strike> [10%]</div>
													@elseif($payment->amount == "130")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄140</strike> [7%]</div>
													@elseif($payment->amount == "95")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄100</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											@if($payment->type == "Golden")
												@if(app()->getLocale() == "kr")
													@if($payment->amount == "135")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦165000</strike> [10%]</div>
													@elseif($payment->amount == "97")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦115500</strike> [7%]</div>
													@elseif($payment->amount == "71")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>￦82500</strike> [5%]</div>
													@endif
												@else
													@if($payment->amount == "135")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄150</strike> [10%]</div>
													@elseif($payment->amount == "97")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄105</strike> [7%]</div>
													@elseif($payment->amount == "71")
													<div style="font-size: 13px;text-align: center;padding:10px 10px 0 15px;color:#db132f;" ><strike>＄75</strike> [5%]</div>
													@endif
												@endif
											
											@endif

											<span class="text-success" id="class_text{{$key}}"></span> @if($payment->type != "Resume Download")<!-- @lang('home.currencyday_text') -->/{{$payment->duration}}@lang('home.currencyday_text3') @endif
										</div>

										


										@if($payment->type == "Basic")
										<div style="text-align: center;padding-top:15px;"><span style="font-size: 15px;padding:5px 20px;color:#fff;width:100px;text-align: center;">@lang('home.Free')</span></div>
										@else
										
										<form class="ng-untouched ng-pristine ng-valid" action="{{ url('account/packageinfo') }}" method="#">
                               
								{{ csrf_field() }}
								
								<input name="pckg_id" type="hidden" value="{!!$payment->pckg_id !!}"/>
                                <input name="cat_id" type="hidden" value="{!!$payment->cat_id !!}"/>
                                <input name="type" type="hidden" value="{{ $payment->type }}"/>
                                <input name="amount" type="hidden" value="{!! $payment->amount !!}"/>
                                <input name="quantity" type="hidden" value="{!! $payment->quantity !!}"/>
                                <input name="duration" type="hidden" value="{!! $payment->duration !!}"/>
								<input name="currency" type="hidden"/>
                                
                                <div style="text-align: center;padding-top:15px;padding-bottom:15px;">
                                    <button color="primary"  type="submit" style="background:#000;color:#fff;border: 1px solid #000;"><span class="mat-button-wrapper" style="padding-left:10px;padding-right:10px;">@lang('home.pay_buy')</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>


										
										@endif

                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li>
							@endforeach
                        </ul>


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

		   ////// FOR PLAN//////////
     var jArray = <?php echo json_encode($plan); ?>;

     for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1100+'(부가세 포함)')
        //alert(jArray[i].amount);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('KRW');
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){

     $('#class_text'+i).html('US$ '+jArray[i].amount+'.00')
        //alert(jArray[i].amount);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('USD');
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<jArray.length;i++){
     $('#class_text'+i).html('￦ '+jArray[i].amount*1100 +'(부가세 포함)')
       // alert(jArray[i].amount*1100);
	 //$('.ng-untouched input[name="amount"]').val(jArray[i].amount*1000);
	 $('.ng-untouched input[name="currency"]').val('KRW');
      }
    }
}) ;
    

    ////// FOR PLAN//////////

 ////// FOR Simle/////////
     var simplearray = <?php echo json_encode($rec); ?>;

     for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1000+'')
        //alert(jArray[i].amount);
       }
     
    $('#us').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){

     $('#simple_text'+i).html('US$ '+simplearray[i].price+'.00')
        //alert(jArray[i].amount);
         }
        }
    }) ;

    $('#kr').click(function(){
    if ($(this).is(':checked')) {
    for(var i=0;i<simplearray.length;i++){
     $('#simple_text'+i).html('￦ '+simplearray[i].price*1000 +'')
       // alert(jArray[i].amount*1100);
      }
    }
}) ;


		</script>
		@endsection