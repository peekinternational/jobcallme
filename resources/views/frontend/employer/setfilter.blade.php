		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
			 <div class="col-md-2">
			 </div>
				<div class="col-md-8 company-box-left">
				<h4>Set Filter</h4>
				 <form role="form" action="{{ url('jobs') }}" method="get">
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="modal-body">
							<div class="row">
								<div class="col-md-12 pnj-form-field">
								   <div class="form-group">
                                    <select class="form-control" name="degreeLevel">
									<option value="">@lang('home.selectdegree')</option>
                                        <option value="High School">High School</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Bachelor">Bachelor</option>
                                        <option value="Master">Master</option>
                                        <option value="PhD">PhD</option>
                                    </select>
                                </div>
                            </div>
								 <div class="col-md-6 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="number" class="form-control" name="exmin" placeholder="@lang('home.experiencemin')">
                              </div>
                           </div>
					   </div>
					   	 <div class="col-md-6 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="number" class="form-control" name="exmaz" placeholder="@lang('home.experiencemin')">
                              </div>
                           </div>
					   </div>
			       <div class="col-md-12 pnj-form-field">
                          <div class="form-group">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
						<div class="col-md-12 pnj-form-field">
                              <div class="form-group">
                                <select class="form-control select2 job-state" name="state">
                                </select>
                                 </div>
                              </div>
						 
                            <div class="col-md-12 pnj-form-field">
                             <div class="form-group">
                                <select class="form-control select2 job-city" name="citys">
                                </select>
                            </div>
                        </div>
                  
							
			</div>
                   </div>
        <div class="modal-footer">
          <button type="submit" style="float:left" class="btn btn-success" >@lang('home.save')</button>   <button type="button" style="float:left" class="btn btn-default"><a href="{{url('account/employer')}}">@lang('home.close')</a></button>
        </div>
      </form>	
				</div>
			   <div class="col-md-2">
	</div>
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
		</script>
		@endsection