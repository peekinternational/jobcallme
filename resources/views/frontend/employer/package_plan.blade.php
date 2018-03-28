@extends('frontend.layouts.app')

@section('title','Share Job')

@section('content')

<section id="company-box">
			<div class="container" >
			<div class="row">
   
			<div class="pricing blue" fxflex="calc(50% -15px)" fxflex.xs="100%" style="flex: 1 1 calc(50% - 15px); box-sizing: border-box; margin-right: 15px; min-width: calc(50% - 15px);">
            <div class="col-md-12"  style=" background-color: white; box-shadow: 0 3px 1px -2px rgba(0,0,0,.2), 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);">
		  
            <h3 class="text-center text-lg mb20">
                
                Job Posting that Deliver Results
            </h3>
           
              @foreach($plan as  $payment)
			  
				  <div class="col-md-4">
                        <div class="pricing-block mat-elevation-z6">
                            <h5 class="title">Jobs {!!$payment->type !!}</h5>
                            <div class="desc">
                                <!----><ul class="list-unstyled">
                                    
                                    <li>On Homepage: {!!$payment->duration !!} days</li>
                                    <li>Quantity: {!!$payment->quantity !!} jobs</li>
                                    
                                </ul>
                                
                            </div>
                            <div class="price">
                                <span class="text-success">
                                    <!---->
                                    <span class="text-md b">${!!$payment->amount !!}</span>
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
                                
                                <div>
                                    <button class="btn btn-primary" color="primary"  type="submit"><span class="mat-button-wrapper">Buy Now</span><div class="mat-button-ripple mat-ripple" md-ripple=""></div><div class="mat-button-focus-overlay"></div></button>
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
		</script>
		@endsection