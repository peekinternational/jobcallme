@extends('frontend.layouts.app')

@section('title', "CompanyReview")

@section('content')
<div class="container margintop bg-white content-area">
	<form method="post" action="{{ url('account/employer/company/addreview')}}">
		@if(Session::has('review-message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('review-message') }}</p>
		@endif
	  <h4><strong>Add Review</strong></h4><br>	
	  <div class="form-group">
	    <label for="exampleInputEmail1">Overall Review</label>
	    <select class="form-control" name="overall_review" aria-describedby="reviewAll" placeholder="Overall Review">
	    	<option value="">Select Review</option>
	    	<option>Excellent</option>
	    	<option>Verygood</option>
	    	<option>Good</option>
	    	<option>Fair</option>
	    	<option>Poor</option>
	    </select>
	    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Employed Since</label>
	    <input type="text" name="employee_sience" class="form-control date-picker" placeholder="Employed since">
	    <input type="hidden" name="company_id" value="{{$companyId}}">
	    <input type="hidden" name="user_id" value="{{$userid}}">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	  </div>
	  <div class="form-group" id="upto">
	    <label for="exampleInputPassword1">Employed Upto</label>
	    <input type="text" name="employer_upto" class="form-control date-picker" placeholder="Employed upto">
	  </div>
	  <div class="form-check">
	    <input type="checkbox" class="form-check-input" id="current_working">
	    <label class="form-check-label" name="current_working" value="Yes" for="current_working"> i am working currently</label>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Designation</label>
	    <input type="text" name="designation" class="form-control" placeholder="Designation">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Job type</label>
	    <select class="form-control" name="job_type" aria-describedby="reviewAll" placeholder="Overall Review">
	    	<option value="">Select type</option>
	    	<option>Full Time</option>
	    	<option>Part Time</option>
	    	<option>Intership</option>
	    	<option>Seasonal</option>
	    	<option>Temporary/Contract</option>
	    	<option>Work Study</option>

	    </select>
	    </div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">Review title</label>
	  	  <input type="text" name="review_title" class="form-control" placeholder="Review title">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">Pros</label>
	  	  <input type="text" name="pros" class="form-control" placeholder="Review title">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">Cons</label>
	  	  <input type="text" name="cons" class="form-control" placeholder="Review title">
	  	</div>
	  	<div class="form-group">
	  	  <label for="exampleInputPassword1">Advice to Management</label>
	  	  <input type="text" name="advice_management" class="form-control" placeholder="Review title">
	  	</div>
	  	<div class="form-group">
		    <label for="exampleInputEmail1">Career Opportunities</label>
		    <select class="form-control" name="career_opportunity" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Excellent</option>
		    	<option>Verygood</option>
		    	<option>Good</option>
		    	<option>Fair</option>
		    	<option>Poor</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Compensation & Benefits</label>
		    <select class="form-control" name="benefits" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Excellent</option>
		    	<option>Verygood</option>
		    	<option>Good</option>
		    	<option>Fair</option>
		    	<option>Poor</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Work/Life Balance</label>
		    <select class="form-control" name="work_lifebalance" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Excellent</option>
		    	<option>Verygood</option>
		    	<option>Good</option>
		    	<option>Fair</option>
		    	<option>Poor</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Rate Management</label>
		    <select class="form-control" name="rate_management" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Excellent</option>
		    	<option>Verygood</option>
		    	<option>Good</option>
		    	<option>Fair</option>
		    	<option>Poor</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Rate Organization Culture</label>
		    <select class="form-control" name="rate_culture" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Excellent</option>
		    	<option>Verygood</option>
		    	<option>Good</option>
		    	<option>Fair</option>
		    	<option>Poor</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Recommend CEO</label>
		    <select class="form-control" name="recommend_ceo" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Recommended</option>
		    	<option>Natural</option>
		    	<option>Not Recommended</option>
		    </select>
	  </div>
	  <div class="form-group">
		    <label for="exampleInputEmail1">Expectations About Future</label>
		    <select class="form-control" name="future" aria-describedby="reviewAll" placeholder="Overall Review">
		    	<option value="">Career Opportunities</option>
		    	<option>Growing Up</option>
		    	<option>Remain Same</option>
		    	<option>Growing Down</option>
		    </select>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="recommend" class="form-check-input" id="exampleCheck1">
	    <label class="form-check-label" for="exampleCheck1"> I recommended working in this organization</label>
	  </div>
	  <div class="form-check">
	    <input type="checkbox" name="anonymous" class="form-check-input" id="exampleCheck1">
	    <label class="form-check-label" for="exampleCheck1"> Post as Anonymous</label>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
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