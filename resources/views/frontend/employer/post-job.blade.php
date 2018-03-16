@extends('frontend.layouts.app')

@section('title','Post New Job')

@section('content')

<section id="postNewJob" style="margin-bottom:70px">
 <form action='{{ url("paypals") }}' method='post' class='form-horizontal' enctype='multipart/form-data'>
                        {{ csrf_field() }}
    <div class="container">

	  <div class="row">
            <div class="col-md-12" style="margin-top:70px">
	
        <div class="col-md-12">
		
            <div class="pnj-box">
			  <h3>@lang('home.postnewjob')</h3>
					<div class="col-md-12">
					   <div class="form-group error-group" style="display: none;">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field"><div class="alert alert-danger"></div></div>
                        </div>
              
               
               
                  <!--  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypals') !!}" > -->
					<div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-top:30px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                
 
                        <ul id="post-job-ad-types">
						 @foreach($rec as $payment)
						 
                            <!----><li style="position:relative">
                                <!---->
								<span class="pay_blog">
									<input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="p_Category" value="{!! $payment->id!!}">
									<input class="mat-radio-input visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
								</span>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             <span class="b">@lang('home.'.$payment->title)</span></div>
                                <div>
                                    <!----><label for="{!! $payment->id!!}">
                                        <ul class="list-unstyled desc" >
											<li>@lang('home.'.$payment->tag1)</li>
                                            <li>@lang('home.adcost')</li>
                                            <!-- <li>{!! $payment->tag1!!}</li>
                                             <li>{!! $payment->tag2!!}</li> -->
                                        </ul>
										
                                        <div class="credits b">@if($payment->price ==0)
									<span class="free">	@lang('home.Free')</span>
										@else
										<span class="text-success">@lang('home.'.$payment->price)</span>
									<i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
									@endif</div>
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
               
                  
                    <div class="pnj-form-section">
                       
                        

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title"  required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_department')</label>
                            <div class="col-md-8 pnj-form-field">
                                <select class="form-control select2" name="department" required>
                                    <option value="">@lang('home.s_department')</option>
                                    <option value="Accounting">@lang('home.Accounting')</option>
                                    <option value="Administration">@lang('home.Administration')</option>
                                    <option value="Customer Services">@lang('home.Customer Services')</option>
                                    <option value="Finance">@lang('home.Finance')</option>
                                    <option value="Human Resources">@lang('home.Human Resources')</option>
                                    <option value="Information Technology">@lang('home.Information Technology')</option>
                                    <option value="Marketing">@lang('home.Marketing')</option>
                                    <option value="Procurement">@lang('home.Procurement')</option>
                                    <option value="Production">@lang('home.Production')</option>
                                    <option value="Quality Control">@lang('home.Quality Control')</option>
                                     <option value="Research & Development">@lang('home.Research & Development')</option>
                                      <option value="Sales">@lang('home.Sales')</option>
                                    

                                    @foreach(JobCallMe::getDepartments() as $depart)
                                        <option value="{!! $depart->name !!}">{!! $depart->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                           <div class="col-md-1 pnj-form-field"> <span><a href="{{ url('account/employer/departments') }}">@lang('home.addDepartment')</a></span></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_category')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-category" name="category" onchange="getSubCategories(this.value)" required>
										<option value="">@lang('home.s_category')</option>
									@foreach(JobCallMe::getCategories() as $cat)
                                        <option value="{!! $cat->categoryId !!}">@lang('home.'.$cat->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category" name="subCategory" onchange="getSubCategories2(this.value)" required>
									<option value="">@lang('home.Subcategory')</option>
								</select>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category2" name="subCategory2" required>
									<option value="">@lang('home.Subcategory2')</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.careerlevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="careerLevel" required>
                                    @foreach(JobCallMe::getCareerLevel() as $career)
                                        <option value="{!! $career !!}">@lang('home.'.$career)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.experiencelevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="experience" required>
                                    @foreach(JobCallMe::getExperienceLevel() as $experience)
                                        <option value="{!! $experience !!}">@lang('home.'.$experience)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.vacancy')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="vacancy" placeholder="@lang('home.numbervacancy')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.requireskills')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="skills" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.qualification')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="qualification" placeholder="@lang('home.qualification')" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.expiryhiringdate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker"  name="expiryDate" onkeypress="return false" required>
                            </div>
                        </div>
                        <div class="form-group" id="expirediv">
                            <label class="control-label col-sm-3">@lang('home.expirydate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="secondDate" name="expiryAd" onkeypress="return false">
                            </div>
                        </div>
						<div class="form-group" id="durationdiv">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                           <input type="text" class="form-control" id="pas" name="duration" >
								
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.naturejob')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.type')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="type" >
                                    @foreach(JobCallMe::getJobType() as $jtype)
                                        <option value="{!! $jtype->name !!}">@lang('home.'.$jtype->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}">@lang('home.'.$jshift->name)</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.jobaddr')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="jobaddr" id="jobaddr" placeholder="@lang('home.jobaddrtext')"  required>
                            </div>
                        </div>

					   <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate1')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 benefits-checks">
                                        <input id="head" type="checkbox" class="cbx-field" name="head" value="yes">								
										<label class="cbx" for="head"></label>
                                        <label class="lbl" for="head">@lang('home.abouthead')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.postcate2')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                
                                        <div class="col-md-4 benefits-checks">                                        
											<input id="dispatch" type="checkbox" class="cbx-field" name="dispatch" value="yes">
											<label class="cbx" for="dispatch"></label>
                                            <label class="lbl" for="dispatch">@lang('home.dispatchinformation')</label>
                                        </div>
                              
                                </div>
                            </div>
                        </div>

                   </div>

				   <h3>@lang('home.admissionsprocess')</h3>
                    <div class="pnj-form-section">                        
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.admissionsprocess')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    @foreach(JobCallMe::jobProcess() as $process)
                                        <div class="col-md-4 benefits-checks">
                                            <input id="{{ str_replace(' ','-',$process) }}"  type="checkbox" class="cbx-field" name="process[]" value="{{ $process }}">
                                            <label class="cbx" for="{{ str_replace(' ','-',$process) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$process) }}">@lang('home.'.$process)<!-- {{ $process }} --></label>
                                        </div>
                                    @endforeach
                                        <div class="col-md-4 ">
                                            <input id="addprocess"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addprocess"></label>
                                            <label class="lbl" for="addprocess">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="moreprocess" style="display:none">
                                            
                                            <div class="col-md-10 block">
                                                <button type="button" class="add btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
						
                                </div>

								

                            </div>							
                        </div>
                    </div>	

                    <h3>@lang('home.compensationbenefits')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.salary')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="minSalary" placeholder="@lang('home.minsalary') 20,000,000" required>
                                    </div>
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="maxSalary" placeholder="@lang('home.Maxsalary') 25,000,000" required>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency" required>
                                            @foreach(JobCallMe::siteCurrency() as $currency)
                                                <option value="{!! $currency !!}">{!! $currency !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.benefits')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    @foreach(JobCallMe::jobBenefits() as $benefit)
                                        <div class="col-md-4 benefits-checks">
                                            <input id="{{ str_replace(' ','-',$benefit) }}"  type="checkbox" class="cbx-field" name="benefits[]" value="{{ $benefit }}">
                                            <label class="cbx" for="{{ str_replace(' ','-',$benefit) }}"></label>
                                            <label class="lbl" for="{{ str_replace(' ','-',$benefit) }}">{{ $benefit }}</label>
                                        </div>
                                    @endforeach
                                        <div class="col-md-4 ">
                                            <input id="addbenefit"  type="checkbox" class="cbx-field" value="yes">
                                            <label class="cbx" for="addbenefit"></label>
                                            <label class="lbl" for="addbenefit">@lang('home.add')</label>
                                        </div>
                                        <div class="optionBox" id="morebenefit" style="display:none">
                                            
                                            <div class="col-md-10 block">
                                                <button type="button" class="add2 btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.location')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ Session()->get('jcmUser')->country == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" required>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input id="pac-input" name="Address" class="form-control" type="text" placeholder="Enter a location">
                                <div class="pac-card" id="pac-card">
                                  <div>
                                    <div id="type-selector" class="pac-controls">
                                      <input type="radio"  id="changetype-all" checked="checked">
                                      <label for="changetype-all">All</label>

                                      <input type="radio"  id="changetype-establishment">
                                      <label for="changetype-establishment">Establishments</label>

                                      <input type="radio"  id="changetype-address">
                                      <label for="changetype-address">Addresses</label>

                                      <input type="radio"  id="changetype-geocode">
                                      <label for="changetype-geocode">Geocodes</label>
                                    </div>
                                    <div id="strict-bounds-selector" class="pac-controls">
                                      <input type="checkbox" id="use-strict-bounds" value="">
                                      <label for="use-strict-bounds">Strict Bounds</label>
                                    </div>
                                  </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- google map code html -->
                    <div id="map"></div>
                    <div id="infowindow-content">
                      <img src="" width="16" height="16" id="place-icon">
                      <span id="place-name"  class="title"></span><br>
                      <span id="place-address"></span>
                    </div>
                    <h3>@lang('home.declarationandacknowledgement')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9 da-box">
                                <p>@lang('home.pleasereadcarefully')</p>
                                <ul>
                                    <li>@lang('home.postli1')</li>
                                    <li>@lang('home.postli2')</li>
                                    <li>@lang('home.postli3')</li>
                                    <li>@lang('home.postli4')</li>
                                </ul>
                                <p>@lang('home.postp')</p>
                            </div>
                        </div>
                    </div>
					<div class="col-md-offset-3 col-md-2  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;" id="total">Total Amount : US$</span>						
                    </div>
                    <div class="col-md-6  pnj-btns">                        
						<button type="submit" class="btn btn-primary" name="save">@lang('home.postjob')</button>
                        <a href="{{ url('account/employer') }}" class="btn btn-default">@lang('home.CANCEL')</a>
                    </div>
                
            </div>
        </div>
    </div>
	</div>
	</div>
</form>
<style type="text/css">
     #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      /*#pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        
      }*/

      #pac-input:focus {
        border-color: #4d90fe;
      }

      
</style>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
var process = "";
var alrt="";
$(document).ready(function(){
    $('#post-job-ad-types li').first().find('span .mat-radio-input').bind('click',function(e){
        $('#durationdiv').hide();
        $('#total').hide();
        $('#expirediv').hide();
    })
    
    $('#post-job-ad-types li').first().find('span .mat-radio-input').trigger('click');
	
    $('body').on('click','.mat-radio-input',function(e){
		console.log($(e.target).val());
	 alrt=$(e.target).siblings('input').val();
	 console.log(alrt);
     if(alrt==0)
     {
         $('#durationdiv').hide();
         $('#total').hide();
         $('#expirediv').hide();
         
        // alert("nabeel");
     }
     else{
          $('#durationdiv').show();
         $('#total').show();
          $('#expirediv').show();
        
     }
		
	})
    $('#addprocess').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
        //$('#addlable').show();
        $('#moreprocess').show();
    }
    else{
        //$('#addlable').hide();
        $('#moreprocess').hide();
    }
});

 $('#addbenefit').on('change', function() {
  // process= $('#addprocess').val();
    if(this.checked)
    {
        //alert("hi nabeel");
       // $('#addlable').show();
        $('#morebenefit').show();
    }
    else{
      //  $('#addlable').hide();
        $('#morebenefit').hide();
    }
})
 
  

    getStates($('.job-country option:selected:selected').val());
    getSubCategories($('.job-category option:selected:selected').val());

	getSubCategories2($('.job-category option:selected:selected').val());
});

$('.add').click(function() {
    $('#moreprocess').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="process[]" required/><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

});
$('.add2').click(function() {
    $('#morebenefit').append('<div class="col-md-8 pnj-salary block" style="display: flex;margin-bottom: 9px;"><input type="text" class="form-control" name="benefits[]" required/><button type="button" class="remove btn btn-danger" style="padding-left: 14px;"><i class="fa fa-minus"></i></button></div>');

});
$('.optionBox').on('click','.remove',function() {
 	$(this).parent().remove();
});
$('#secondDate').on('change', function() {
		  myfunc()
});
      
       function myfunc(){
       var start = new Date();
      // var start= $("#firstDate").datepicker("getDate");
    	var end= $("#secondDate").datetimepicker("getDate");
   		days = (end- start) / (1000 * 60 * 60 * 24);
      var to= Math.round(days);
      var total= to * alrt;
      $('#pas').val(to);
	  $('#total').html("Total Amount : "+total+" $" );
      
      // alert(total);
       
       }
  

$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '0', true, false);
            $(".job-state").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(stateId){
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
            $(".job-city").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
tinymce.init({
    selector: '.tex-editor',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    },
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
function getSubCategories(categoryId){
    $.ajax({
        url: "{{ url('account/get-subCategory') }}/"+categoryId,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-sub-category").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId, true, vOption);
                $(".job-sub-category").append(newOption).trigger('change');
            })
        }
    })
}

function getSubCategories2(categoryId2){
    $.ajax({
        url: "{{ url('account/get-subCategory2') }}/"+categoryId2,
        success: function(response){
            var obj = $.parseJSON(response);
            $(".job-sub-category2").html('').trigger('change');
            $.each(obj,function(i,k){
                var vOption = false;
                var newOption = new Option(k.subName, k.subCategoryId2, true, vOption);
                $(".job-sub-category2").append(newOption).trigger('change');
            })
        }
    })
}

function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
var formPost = 1;
</script>
<!-- google map code start from there  -->
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initMap" async defer></script>

@endsection