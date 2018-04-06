@extends('frontend.layouts.app')

@section('title','Orders history')

@section('content')
<section id="orders">
    <div class="container">
        <div class="col-md-12" style="margin-top: 53px">
        	<div class="row">
        		<div class="col-md-2">
        			<div style="background: #fff; margin:20px 0px 20px 0px; padding: 20px 10px 20px 10px">
        				<form method="POST" action="{{ url('account/employer/orders') }}">
        				    <div class="form-group">
        				    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        				    	<input type="text" name="order_id" class="form-control" placeholder="Order Id">
        				    </div>
        				    <div class="form-group">
        				     
        				      <select name="status" class="form-control" id="exampleFormControlSelect1">
        				        <option value="">Select Status</option>
        				        <option>Failed</option>
        				        <option>Approved</option>
        				        <option>Pending</option>
        				        <option>Amount Refunded</option>
        				      </select>
        				    </div>
        				  	<div class="form-group">
        				  	    <select class="form-control" name="payment_mode" id="exampleFormControlSelect1">
        				  	      <option value="">Select Pay Mode </option>
        				  	      <option>Cash Payment</option>
        				  	      <option>Nice Pay</option>
        				  	      <option>PayPal</option>
        				  	    </select>
        				  	  </div>
        				  	  <div class="form-group">
        				    	<input type="text" name="from" class="form-control date-picker" placeholder="Form">
        				    </div>
        				    <div class="form-group">
        				    	<input type="text" name="to" class="form-control date-picker"  placeholder="To">
        				    </div>
        				  <button type="submit" class="btn btn-primary">Submit</button>
        				</form>
        			</div>
        		</div>
        		<div class="col-md-10" >
        			<div style="background: #fff; margin:20px 0px 20px 0px; padding: 10px 10px 10px 10px">
        				<!-- <h5>No data found</h5> -->
        				<table class="table">
        					<thead>
        						<tr>
        							<th>ID</th>
											<th>Category By</th>
        							<th>Ordered By</th>
        							<th>Payment Mode</th>
        							<th>Amount</th>
        							<th>Status</th>
        							<th>Date</th>
        						</tr>
        					</thead>
        					<tbody>
        						@foreach($data as $order)
        						<tr>
        							<td>{{$order->order_id}}</td>
											<td>{{$order->category}}</td>
        							<td>{{$order->orderBy}}</td>
        							<td>{{$order->payment_mode}}</td>
        							<td>{{$order->amount}}$</td>
        							<td>{{$order->status}}</td>
        							<td>{{$order->order_date}}</td>
											@if($order->status == 'Pending' && $order->payment_mode == 'Cash Payment'  )<td>	<div class="col-xs-2 col-md-2"><div class="dropdown">
									  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									  <div class="dropdown-content">
										<a href="{{url('afterpayment/'.$order->order_id)}}"><span style="font-size: 12px;"> @lang('home.MakePayment')</span></a>
										
									  </div>
									</div></div></td>
									@else
									<td></td>
									@endif
        						</tr>
        						@endforeach
        					</tbody>
        				</table>
        			</div>
        			
        		</div>
        	</div>
		</div>
	</div>
</section>
@endsection
@section('page-footer')


@endsection