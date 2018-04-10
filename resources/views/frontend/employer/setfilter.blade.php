		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
			 <div class="col-md-2">
			 </div>
				<div class="col-md-8 company-box-left">
				<h4>Set Job Filters</h4>
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
                                        <option value="{{ $cntry->id }}">{{ $cntry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
						<div class="col-md-12 pnj-form-field">
                              <div class="form-group">
                                <select class="form-control select2 job-state" name="state">
                                <option value="">Select State</option>
                                </select>
                                 </div>
                              </div>
						 
                            <div class="col-md-12 pnj-form-field">
                             <div class="form-group">
                                <select class="form-control select2 job-city" name="city">
                                <option value="">Select City</option>

                                </select>
                            </div>
                        </div>
                        <div id="advance" style="display:none">
                         <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="exmaz" placeholder="@lang('home.degress')">
                              </div>
                           </div>
					   </div>
                        <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="exmaz" placeholder="@lang('home.workedas')">
                              </div>
                           </div>
					   </div>
                        <div class="col-md-12 pnj-form-field">
								  <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <input type="text" class="form-control" name="exmaz" placeholder="@lang('home.skills')">
                              </div>
                           </div>
					   </div>
                                <div class="col-md-12 pnj-form-field">
                                <div class="form-group">
                                   <div class=" pnj-form-field">
                                    <select class="form-control input-sm select2" name="language">
                                         <option value="">Languages</option>
                                          <option value="Afrikanns">Afrikanns</option>
										  <option value="Albanian">Albanian</option>
										  <option value="Arabic">Arabic</option>
										  <option value="Armenian">Armenian</option>
										  <option value="Basque">Basque</option>
										  <option value="Bengali">Bengali</option>
										  <option value="Bulgarian">Bulgarian</option>
										  <option value="Catalan">Catalan</option>
										  <option value="Cambodian">Cambodian</option>
										  <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
										  <option value="Croation">Croation</option>
										  <option value="Czech">Czech</option>
										  <option value="Danish">Danish</option>
										  <option value="Dutch">Dutch</option>
										  <option value="English">English</option>
										  <option value="Estonian">Estonian</option>
										  <option value="Fiji">Fiji</option>
										  <option value="Finnish">Finnish</option>
										  <option value="French">French</option>
										  <option value="Georgian">Georgian</option>
										  <option value="German">German</option>
										  <option value="Greek">Greek</option>
										  <option value="Gujarati">Gujarati</option>
										  <option value="Hebrew">Hebrew</option>
										  <option value="Hindi">Hindi</option>
										  <option value="Hungarian">Hungarian</option>
										  <option value="Icelandic">Icelandic</option>
										  <option value="Indonesian">Indonesian</option>
										  <option value="Irish">Irish</option>
										  <option value="Italian">Italian</option>
										  <option value="Japanese">Japanese</option>
										  <option value="Javanese">Javanese</option>
										  <option value="Korean">Korean</option>
										  <option value="Latin">Latin</option>
										  <option value="Latvian">Latvian</option>
										  <option value="Lithuanian">Lithuanian</option>
										  <option value="Macedonian">Macedonian</option>
										  <option value="Malay">Malay</option>
										  <option value="Malayalam">Malayalam</option>
										  <option value="Maltese">Maltese</option>
										  <option value="Maori">Maori</option>
										  <option value="Marathi">Marathi</option>
										  <option value="Mongolian">Mongolian</option>
										  <option value="Nepali">Nepali</option>
										  <option value="Norwegian">Norwegian</option>
										  <option value="Persian">Persian</option>
										  <option value="Polish">Polish</option>
										  <option value="Portuguese">Portuguese</option>
										  <option value="Punjabi">Punjabi</option>
										  <option value="Quechua">Quechua</option>
										  <option value="Romanian">Romanian</option>
										  <option value="Russian">Russian</option>
										  <option value="Samoan">Samoan</option>
										  <option value="Serbian">Serbian</option>
										  <option value="Slovak">Slovak</option>
										  <option value="Slovenian">Slovenian</option>
										  <option value="Spanish">Spanish</option>
										  <option value="Swahili">Swahili</option>
										  <option value="Swedish ">Swedish </option>
										  <option value="Tamil">Tamil</option>
										  <option value="Tatar">Tatar</option>
										  <option value="Telugu">Telugu</option>
										  <option value="Thai">Thai</option>
										  <option value="Tibetan">Tibetan</option>
										  <option value="Tonga">Tonga</option>
										  <option value="Turkish">Turkish</option>
										  <option value="Ukranian">Ukranian</option>
										  <option value="Urdu">Urdu</option>
										  <option value="Uzbek">Uzbek</option>
										  <option value="Vietnamese">Vietnamese</option>
										  <option value="Welsh">Welsh</option>
										  <option value="Xhosa">Xhosa</option>
										
                                    </select>
                                </div>
                                </div>
                                </div>
                                  </div>
                                  <div class="col-md-12 pnj-form-field">
                                <div class="form-group">
                                   <div class=" pnj-form-field">
                                  <label class="switch" id="filter">
                                    <input type="checkbox" checked >
                                    <span class="slider round"></span>
                                   </label>
                                    <span style="color: #CCC;">Filter existing application</span> 
                                    </div>
                                </div>
                                  </div>         
		              	</div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" style="float:left" class="btn btn-success" >@lang('home.save')</button>   <button type="button" style="float:left" class="btn btn-default" id="advance_click">@lang('home.Advancefilters')</button>   <button type="button" style="float:left" class="btn btn-default"><a href="{{url('account/employer')}}">@lang('home.skip')</a></button>
                    </div>
                </form>	
				</div>
			   <div class="col-md-2">
	         </div>
				 
			</div>
		</section>
        <style>
.switch {
  position: relative;
  display: inline-block;
  width: 65px;
  height: 24px;
}

.switch input {}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 9px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
        $('#advance_click').click(function(){
           // alert("hell0");
            $('#advance').toggle();;

        });
		</script>
		@endsection