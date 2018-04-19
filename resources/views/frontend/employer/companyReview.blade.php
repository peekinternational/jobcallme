@extends('frontend.layouts.app')

@section('title', "CompanyReview")

@section('content')
<div class="container margintop bg-white content-area">
	<form method="post" action="{{ url('account/employer/company/addreview')}}">
		@if(Session::has('review-message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('review-message') }}</p>
		@endif
	  <h4><strong>@lang('home.Add Review')</strong></h4><br>	
	  <div class="form-group">
	    <label for="exampleInputEmail1">@lang('home.Overall Review')</label>
	    <select class="form-control" name="overall_review" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
	    	<option value="">@lang('home.Select Review')</option>
	    	<option value="Excellent">@lang('home.Excellent')</option>
	    	<option value="Verygood">@lang('home.Verygood')</option>
	    	<option value="Good">@lang('home.Good')</option>
	    	<option value="Fair">@lang('home.Fair')</option>
	    	<option value="Poor">@lang('home.Poor')</option>
	    </select>
	    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Employed Since')</label>
	    <input type="text" name="employee_sience" class="form-control date-picker" placeholder="@lang('home.Employed Since')">
	    <input type="hidden" name="company_id" value="{{$companyId}}">
	    <input type="hidden" name="user_id" value="{{$userid}}">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	  </div>
	  <div class="form-group" id="upto">
	    <label for="exampleInputPassword1">@lang('home.Employed Upto')</label>
	    <input type="text" name="employer_upto" class="form-control date-picker" placeholder="@lang('home.Employed Upto')">
	  </div>
	  <div class="form-check">
	    <input type="checkbox" class="form-check-input" id="current_working">
	    <label class="form-check-label" name="current_working" value="Yes" for="current_working"> @lang('home.i am working currently')</label>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Designation')</label>
	    <input type="text" name="designation" class="form-control" placeholder="@lang('home.Designation')">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">@lang('home.Job type')</label>
	    <select class="form-control" name="job_type" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
	    	<option value="">@lang('home.Select type')</option>
	    	<option value="Full Time">@lang('home.Full Time')</option>
	    	<option value="Part Time">@lang('home.Part Time')</option>
	    	<option value="Intership">@lang('home.Intership')</option>
	    	<option value="Seasonal">@lang('home.Freelancer')</option>
	    	<option value="Temporary/Contract">@lang('home.Temporary/Contract')</option>
	    	<option value="Work Study">@lang('home.Work Study')</option>

	    </select>
	    </div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Review title')</label>
	  	  <input type="text" name="review_title" class="form-control" placeholder="@lang('home.Review title')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Pros')</label>
	  	  <input type="text" name="pros" class="form-control" placeholder="@lang('home.Pros')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Cons')</label>
	  	  <input type="text" name="cons" class="form-control" placeholder="@lang('home.Cons')">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">@lang('home.Advice to Management')</label>
	  	  <input type="text" name="advice_management" class="form-control" placeholder="@lang('home.Advice to Management')">
	  	</div>
	  	<div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Career Opportunities')</label>
		    <select class="form-control" name="career_opportunity" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Career Opportunities')</option>
		    	<option value="Excellent">@lang('home.Excellent')</option>
	    		<option value="Verygood">@lang('home.Verygood')</option>
	    		<option value="Good">@lang('home.Good')</option>
	    		<option value="Fair">@lang('home.Fair')</option>
	    		<option value="Poor">@lang('home.Poor')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Compensation & Benefits')</label>
		    <select class="form-control" name="benefits" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Compensation & Benefits')</option>
		    	<option value="Excellent">@lang('home.Excellent')</option>
	    		<option value="Verygood">@lang('home.Verygood')</option>
	    		<option value="Good">@lang('home.Good')</option>
	    		<option value="Fair">@lang('home.Fair')</option>
	    		<option value="Poor">@lang('home.Poor')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Work/Life Balance')</label>
		    <select class="form-control" name="work_lifebalance" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Work/Life Balance')</option>
		    	<option value="Excellent">@lang('home.Excellent')</option>
	    		<option value="Verygood">@lang('home.Verygood')</option>
	    		<option value="Good">@lang('home.Good')</option>
	    		<option value="Fair">@lang('home.Fair')</option>
	    		<option value="Poor">@lang('home.Poor')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Rate Management')</label>
		    <select class="form-control" name="rate_management" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Rate Management')</option>
		    	<option value="Excellent">@lang('home.Excellent')</option>
	    		<option value="Verygood">@lang('home.Verygood')</option>
	    		<option value="Good">@lang('home.Good')</option>
	    		<option value="Fair">@lang('home.Fair')</option>
	    		<option value="Poor">@lang('home.Poor')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Rate Organization Culture')</label>
		    <select class="form-control" name="rate_culture" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Rate Organization Culture')</option>
		    	<option value="Excellent">@lang('home.Excellent')</option>
	    		<option value="Verygood">@lang('home.Verygood')</option>
	    		<option value="Good">@lang('home.Good')</option>
	    		<option value="Fair">@lang('home.Fair')</option>
	    		<option value="Poor">@lang('home.Poor')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Recommend CEO')</label>
		    <select class="form-control" name="recommend_ceo" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Recommend CEO')</option>
		    	<option value="Recommended">@lang('home.Recommended')</option>
		    	<option value="Natural">@lang('home.Natural')</option>
		    	<option value="Not Recommended">@lang('home.Not Recommended')</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">@lang('home.Expectations About Future')</label>
		    <select class="form-control" name="future" aria-describedby="reviewAll" placeholder="@lang('home.Overall Review')">
		    	<option value="">@lang('home.Select Expectations About Future')</option>
		    	<option value="Growing Up">@lang('home.Growing Up')</option>
		    	<option value="Remain Same">@lang('home.Remain Same')</option>
		    	<option value="Growing Down">@lang('home.Growing Down')</option>
		    </select>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="recommend" class="form-check-input" id="exampleCheck1">
	    <label class="form-check-label" for="exampleCheck1"> @lang('home.I recommended working in this organization')</label>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="anonymous" class="form-check-input" id="exampleCheck1">
	    <label class="form-check-label" for="exampleCheck1"> @lang('home.Post as Anonymous')</label>
	  </div>
	  <button type="submit" class="btn btn-primary">@lang('home.Submit')</button>
	</form>
</div>



@endsection
@section('page-footer')
<script type="text/javascript">
	$('#current_working').on('change',function(){
		if($('#current_working').is(':checked')){
			$('#upto').hide();
		}else{
			$('#upto').show();
		}
	})
	
</script>

@endsection