@extends('frontend.layouts.app')

@section('title', 'Upskills')

@section('content')
<?php
$opHour = @json_decode($upskill->timing,true);
$gCountry = Session()->get('jcmUser')->country;
$gState = Session()->get('jcmUser')->state;
$gCity = Session()->get('jcmUser')->city;
$gEmail = Session()->get('jcmUser')->email;
$gPhone = Session()->get('jcmUser')->phoneNumber;
if($upskill->country != 0){
    $gCountry = $upskill->country;
    $gState = $upskill->state;
    $gCity = $upskill->city;
    $gEmail = $upskill->email;
    $gPhone = $upskill->phone;
}
?>
<section id="postNewJob">
    <div class="container">
        <div class="col-md-9">
            <h2>@lang('home.up_heading')</h2>
            <div class="pnj-box">
                <form id="pnj-form" action="" method="post" class="upskill-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="skillId" value="{{ $upskill->skillId }}">
                    <input type="hidden" name="prevIcon" value="{{ $upskill->upskillImage }}">
                    <h3>@lang('home.basicinformation')</h3>

				@if($upskill->skillId)
			
@else
		<div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;margin-left:30px;"">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                
 
                        <ul id="post-job-ad-types">
							@foreach($uppayment as $payment)
							<li style="position:relative">
                                <!---->
                          <span class="pay_skill">
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" id="{!! $payment->id!!}" name="cat_id" value="{!! $payment->cat_id!!}">
							   <input class="mat-radio-input cdk-visually-hidden" id="radioval" type="hidden"   value="{!! $payment->price!!}">
							   </span>
							   <div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                             <span class="b">{!! $payment->title!!}</span></div>
                                <div>
                                    <!----><label for="{!! $payment->id!!}">
                                        <ul class="list-unstyled desc" >
                                            <li>{!! $payment->tag1!!}</li>
                                            <li>{!! $payment->tag2!!}</li>
                                        </ul>
										
                                        <div class="credits b">
										<span class="text-success">$ {!! $payment->price!!}.00</span>
									<i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
									</div>
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

@endif

                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title" placeholder="@lang('home.title')" value="{{ $upskill->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.type')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="type" required="">
                                    <option value="">@lang('home.s_type')</option>
                                    @foreach(JobCallMe::getUpkillsType() as $skill)
                                        <option value="{!! $skill->name !!}" {{ $skill->name == $upskill->type ? 'selected="selected"' : '' }}>@lang('home.'.$skill->name)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.organiser')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="oType" onchange="orgFun(this.value)">
                                    <option value="user">{{ Session()->get('jcmUser')->firstName.' '.Session()->get('jcmUser')->lastName}}</option>
                                    <option value="other" {{ $upskill->organiser != '' ? 'selected="selected="' : ''}}>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-organiser" style="display: none;">
                            <label class="control-label col-sm-3">@lang('home.organiser')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="organiser" value="{{ $upskill->organiser }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor">{{ $upskill->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.cost')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <div class="row">
                                    <div class="col-md-4 pnj-salary">
                                        <input type="number" class="form-control" name="cost" placeholder="@lang('home.cost')" value="{{ $upskill->cost }}">
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency">
                                            @foreach(JobCallMe::siteCurrency() as $currency)
                                         	
                                            <option value="{!! $currency !!}" {{ $currency == $upskill->currency ? 'selected="selected"' : '' }}>{!! $currency !!}</option>
                                             @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-4 pnj-salary">
                                        <div class=" benefits-checks">
                                            <input id="free" type="checkbox" class="cbx-field" name="accommodation" {{ $upskill->cost == '0' ? 'checked=""' : '' }}>
                                            <label class="cbx" for="free"></label>
                                            <label class="lbl" for="free">@lang('home.free')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Cost of Description')</label>
                            <div class="col-sm-9 pnj-form-field">                                
                                    
                                        <input type="text" class="form-control" name="costdescription" id="costdescription" placeholder="@lang('home.type on your details of cost')" value="{{ $upskill->costdescription }}">
                            </div>
                        </div>


					


                    </div>

                    <h3>@lang('home.venue')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.address')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="address" class="form-control" placeholder="@lang('home.address')">{{ $upskill->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.country')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-country" name="country">
                                    @foreach(JobCallMe::getJobCountries() as $cntry)
                                        <option value="{{ $cntry->id }}" {{ $gCountry == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.state')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-state" name="state" data-state="{{ $gState }}">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city" data-city="{{ $gCity }}">
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.contactinformation')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.contactperson')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="contact" class="form-control" placeholder="@lang('home.contactperson')" value="{{ $upskill->contact }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.email')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="email" name="email" class="form-control" placeholder="@lang('home.email')" value="{{ $gEmail }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.phone')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="phone" class="form-control" placeholder="@lang('home.phone')" value="{{ $gPhone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.mobile')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" name="mobile" class="form-control" placeholder="@lang('home.mobile')" value="{{ $upskill->mobile }}">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.onlinepresenc')</h3>
                    <div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.website')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="website" id="website" placeholder="https://www.example.com" value="{{ $upskill->website }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Facebook</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="{{ $upskill->facebook }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Linkedin</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin" value="{{ $upskill->linkedin }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Twitter</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" value="{{ $upskill->twitter }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Google Plus</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="google" id="google" placeholder="Google+" value="{{ $upskill->google }}">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.durationschedule')</h3>
                    <div class="pnj-form-section us-duration">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.sdate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="firstDate" name="startDate" onkeypress="return false;" value="{{ $upskill->startDate }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.edate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" id="second" name="endDate" onkeypress="return false;" value="{{ $upskill->endDate }}">
                            </div>
                        </div>
							<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                              <input type="text" class="form-control" id="adduration" name="duration" value="{{ $upskill->duration }}" >
								
                            </div>
                        </div>
                        <hr>
                        <!--Monday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.monday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[mon][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['mon']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[mon][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['mon']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Tuesday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.tuesday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[tue][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['tue']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[tue][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['tue']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Wednesday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.wednesday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[wed][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['wed']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[wed][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['wed']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Thursday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.thursday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[thu][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['thu']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[thu][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['thu']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Friday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.friday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[fri][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['fri']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[fri][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['fri']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Saturday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.saturday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[sat][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['sat']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[sat][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['sat']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!--Sunday Schedule-->
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.sunday')</label>
                            <div class="col-sm-4 pnj-form-field">
                                <select name="opHours[sun][]" class="form-control">
                                    <option value="">@lang('home.from')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['sun']['from'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 pnj-form-field ">
                                <select name="opHours[sun][]" class="form-control">
                                    <option value="">@lang('home.to')</option>
                                    @foreach(JobCallMe::timeArray() as $time)
                                        <option value="{!! $time !!}" {!! $time == $opHour['sun']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
					  <!-- map area -->
                    <div style="width: 100%; height: 500px;">
	                        {!! Mapper::render() !!}
	                    </div>
                    <!-- map end -->

                    <h3>@lang('home.upskillimage')</h3>
                    <div class="png-form-section us-duration">
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="file" name="upskillImage" class="form-control">
                            </div>
                        </div>
                        @if($upskill->upskillImage != '')
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                    <img src="{{ url('upskill-images/'.$upskill->upskillImage) }}" alt="" style="max-width: 200px;">
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
					
					<div class="col-md-offset-2 col-md-3  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;" id="totalam"></span>						
                    </div>

                    <div class="col-md-6  pnj-btns">
                        <button type="submit" class="btn btn-primary">@lang('home.save')</button>
                        <a href="{{ url('account/upskill') }}" class="btn btn-default">@lang('home.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('page-footer')
<style type="text/css">
input[type="file"] {
    padding: 0;
}
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
var alt="";
$(document).ready(function(){
	$('body').on('click','.pay_skill',function(e){
		console.log($(e.target).val());
	 alt=$(e.target).siblings('input').val();
	 console.log(alrt);
		
	})
    getStates($('.job-country option:selected:selected').val());
    orgFun("{{ $upskill->organiser != '' ? 'other' : 'user'}}");
})
  $('#second').on('change', function() {
				  myfun()
			  });
      
       function myfun(){
       var start =$("#firstDate").datetimepicker("getDate");
      // var start= $("#firstDate").datepicker("getDate");
    	var end= $("#second").datetimepicker("getDate");
   		days = (end- start) / (1000 * 60 * 60 * 24);
      var to= Math.round(days);
      var total= to * alt;
      $('#adduration').val(to);
	  $('#totalam').html("Total Amount : "+total+" $" );
      
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
            var newOption = new Option('Select State', '', true, false);
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
    if(stateId == '0' || stateId == ''){
        $(".job-city").html('').trigger('change');
        var newOption = new Option('Select City', '', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '', true, false);
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
function orgFun(opValue){
    if(opValue == 'other'){
        $('.upskill-form .col-organiser').show();
    }else{
        $('.upskill-form .col-organiser').hide();
        $('.upskill-form input[name="organiser"]').val('');
    }
}
$('form.upskill-form').submit(function(e){
    var formData = new FormData($(this)[0]);
    $('.upskill-form .text-danger').remove();
    $('.upskill-form button[type="submit"]').prop('disabled',true);
    $.ajax({
        url: window.location.href,
        type: 'POST',
        data: formData,
        async: false,
        success: function(response) {
            if($.trim(response) != '1'){
               toastr.success('Upskill successfully update', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
               window.location.href = "{{ url('account/upskill') }}";
                $('.upskill-form button[type="submit"]').prop('disabled',false);
            }else{
				window.location.href = "{{ url('skillpayment') }}";
                toastr.success('Upskill successfully saved', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
                //window.location.href = "{{ url('account/upskill') }}";
                $('.upskill-form button[type="submit"]').prop('disabled',false);
            }
        },
        error: function(data){
            isARunning = false;
            var errors = data.responseJSON;
            var j = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.upskill-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');

                var vParent = $('.upskill-form select[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                
                var vParent = $('.upskill-form textarea[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(j == 1){
                    vError = k;
                }
                j++;
            });
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.upskill-form button[type="submit"]').prop('disabled',false);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
})
</script>
@endsection