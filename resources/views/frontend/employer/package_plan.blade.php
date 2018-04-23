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
                        <input type="radio" name="gender" id="kr" value="kr" checked="checked"> korean
                      &nbsp;&nbsp;<input type="radio" name="gender" id="us" value="us"> US$
                    </div>

              @foreach($plan as  $key=>$payment)
			  
				  <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <h5 class="title">@lang('home.'.$payment->type)</h5>
                            <div class="desc">
                                <!----><ul class="list-unstyled">
                                @if($payment->type == 'Resume Download')
                                  <li>@lang('home.Quantity'): {!!$payment->quantity !!} resumes</li>
                                @else    
                                    <li>@lang('home.On Homepage'): {!!$payment->duration !!} @lang('home.days')</li>
                                    <li>@lang('home.Quantity'): {!!$payment->quantity !!} @lang('home.jobs')</li>
                                    @endif
                                    
                                </ul>
                                
                            </div>
                            <div class="price">
                                <span class="text-success">
                                    <!---->
                                    <span class="text-md b"><span class="text-success" id="class_text{{$key}}"></span></span>
                                </span>
                            </div>

                          <form class="ng-untouched ng-pristine ng-valid" action="{{ url('account/packageinfo') }}" method="post">
                               
								{{ csrf_field() }}
								
								<input name="pckg_id" type="hidden" value="{!!$payment->pckg_id !!}"/>
                                <input name="cat_id" type="hidden" value="{!!$payment->cat_id !!}"/>
                                <input name="type" type="hidden" value="{{ $payment->type }}"/>
                                <input name="amount" type="hidden" value="{!! $payment->amount !!}"/>
                                <input name="quantity" type="hidden" value="{!! $payment->quantity !!}"/>
                                <input name="duration" type="hidden" value="{!! $payment->duration !!}"/>
								<input name="currency" type="hidden"/>
                                
                                <div>
                                    <button class="btn btn-primary" color="primary"  type="submit"><span class="mat-button-wrapper">@lang('home.Buy Now')</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </form>
                        </div>
                    </div>
					
					@endforeach
                 

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