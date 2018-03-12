@extends('frontend.layouts.app')

@section('title','Organization')

@section('content')
<?php
$cCover = url('compnay-logo/default-cover.jpg');
if($company->companyCover != ''){
  $cCover = url('compnay-logo/'.$company->companyCover);
}
$cLogo = url('compnay-logo/default-logo.jpg');
if($company->companyLogo != ''){
  $cLogo = url('compnay-logo/'.$company->companyLogo);
}
?>
 
<section id="edit-organization">
    <div class="container">
     @if(Session::has('companyAlert'))
                    <div class="alert alert-danger">
                        {{Session::get('companyAlert')}} 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
        <div class="eo-box">
            <div class="eo-timeline">
                <img src="{{ $cCover }}" class="eo-timeline-cover">
                <input type="file" id="eo-timeline" class="compnay-cover">
                <div class="eo-timeline-toolkit">
                    <label for="eo-timeline"><i class="fa fa-camera"></i> &nbsp;@lang('home.change')</label>
                </div>
            </div>
            <div class="col-md-12">
               <div class="row">
                   <div class="col-md-2 eo-dp-box">
                       <img src="{{ $cLogo }}" class="eo-dp eo-c-logo">
                       <div class="eo-dp-toolkit">
                           <input type="file" id="eo-dp" class="compnay-logo">
                           <label for="eo-dp"><i class="fa fa-camera"></i> @lang('home.change')</label><br>
                           <label  style="margin-left:-23px" onclick="editcompanypic()"><i class="fa fa-edit"></i> Edit</label><br>
                           <label onclick="removecompanypic()"><i class="fa fa-remove">
                             <input type="hidden" value="{{ session()->get('jcmUser')->userId }}" id="userID">
                           </i> Remove</label>
                       </div>

                   </div>

                   <div class="col-md-10 eo-timeline-details">
                       <h1><a href="">{{ $company->companyName }}</a></h1>
                       <div class="col-md-6 eo-section">
                           <h4>@lang('home.basicinformation')</h4>
                           <div class="eo-details">
                               <span>@lang('home.designation'):</span> HR
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.industry'):</span> {{ JobCallMe::categoryName($company->category) }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.address'):</span> {{ $company->companyAddress.' '.JobCallMe::cityName($company->companyCity).' , '.JobCallMe::countryName($company->companyCountry) }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.email'):</span> {{ $company->companyEmail }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.phone'):</span> {{ $company->companyPhoneNumber }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.website'):</span> <a href="{{ $company->companyWebsite }}">{{ $company->companyWebsite }}</a>
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.establishedin'):</span> {{ date('M Y',strtotime($company->companyEstablishDate)) }}
                           </div>
                           <div class="eo-details">
                               <span>@lang('home.noemployees'):</span> {{ $company->companyNoOfUsers }}
                           </div>
                       </div>
                       <div class="col-md-6 eo-section">
                           <a class="btn btn-primary eo-edit-btn" onClick="$('.eo-section').hide(); $('.eo-edit-section').show()"><i class="fa fa-edit"></i> </a>
                           <h4>@lang('home.operationhours')</h4>
                           <?php $opHour = json_decode($company->companyOperationalHour,true); ?>
                           <table class="table">
                               <tbody>
                                   <tr>
                                       <td>@lang('home.monday')</td>
                                       <td>{!! $opHour['mon']['from'] !!} - {!! $opHour['mon']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.tuesday')</td>
                                       <td>{!! $opHour['tue']['from'] !!} - {!! $opHour['thu']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.wednesday')</td>
                                       <td>{!! $opHour['wed']['from'] !!} - {!! $opHour['wed']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.thuresday')</td>
                                       <td>{!! $opHour['thu']['from'] !!} - {!! $opHour['thu']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.friday')</td>
                                       <td>{!! $opHour['fri']['from'] !!} - {!! $opHour['fri']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.saturday')</td>
                                       <td>{!! $opHour['sat']['from'] !!} - {!! $opHour['sat']['to'] !!}</td>
                                   </tr>
                                   <tr>
                                       <td>@lang('home.sunday')</td>
                                       <td>{!! $opHour['sun']['from'] !!} - {!! $opHour['sun']['to'] !!}</td>
                                   </tr>
                               </tbody>
                           </table>
                       </div>
                       <div class="eo-edit-section">
                           <form id="pnj-form" action="" method="post" class="organization-form">
                                <input type="hidden" name="_token" class="token">
                               <div class="pnj-form-section">
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.company')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control companyName" name="companyName" id="companyName" placeholder="Company Title" value="{{ $company->companyName }}" required>
                                       </div>
                                   </div>
								   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.corporatenumber')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control corporatenumber" name="corporatenumber" id="corporatenumber" placeholder="@lang('home.corporatenumbertext')" value="{{ $company->corporatenumber }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.industry')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <select class="form-control select2" name="industry" required>
                                           <option value=""> select industry</option>
                                               <option value="">@lang('home.selectindustry')</option>
                                               @foreach(JobCallMe::getCategories() as $cat)
                                                <option value="{{ $cat->categoryId }}" {{ $cat->categoryId == $company->category ? 'selected="selected"' : '' }}>{{ $cat->name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.address')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <textarea required class="form-control companyAddress" placeholder="Address" name="companyAddress" style="resize: vertical">{{ $company->companyAddress }}</textarea>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.country')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-country companyCountry" name="companyCountry" required>
                                                @foreach(JobCallMe::getJobCountries() as $cntry)
                                                    <option value="{{ $cntry->id }}" {{ $company->companyCountry == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                                @endforeach
                                            </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.state')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-state companyState" name="companyState" data-state="{{ $company->companyState }}" required></select>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.city')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                            <select class="form-control input-sm select2 job-city companyCity" name="companyCity" data-city="{{ $company->companyCity }}" required></select>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.phone')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control companyPhoneNumber" name="companyPhoneNumber" id="companyPhoneNumber" placeholder="Phone" value="{{ $company->companyPhoneNumber }}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.email')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="email" class="form-control companyEmail" name="companyEmail" id="companyEmail" placeholder="Email" value="{{ $company->companyEmail }}" required>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.website')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyWebsite" name="companyWebsite" id="companyWebsite" placeholder="https://www.example.com" value="{{ $company->companyWebsite }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">Facebook</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyFb" name="companyFb" id="companyFb" placeholder="Facebook" value="{{ $company->companyFb }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">Linkedin</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyLinkedin" name="companyLinkedin" id="companyLinkedin" placeholder="Linkedin" value="{{ $company->companyLinkedin }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">Twitter</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="url" class="form-control companyTwitter" name="companyTwitter" id="twitter" placeholder="Twitter" value="{{ $company->companyTwitter }}">
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.noemployees')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="number" class="form-control companyNoOfUsers" name="companyNoOfUsers" id="companyNoOfUsers" placeholder="Total Employees" value="{{ $company->companyNoOfUsers }}" required>
                                       </div>
                                   </div>

								   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.capital')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control" name="capital" id="capital" placeholder="@lang('home.capitaltext')" value="{{ $company->capital }}">
                                       </div>
                                   </div>

								   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.sales')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <input type="text" class="form-control companyNoOfUsers" name="sales" id="sales" placeholder="@lang('home.salestext')" value="{{ $company->sales }}">
                                       </div>
                                   </div>

								   <div class="form-group">
                                       <label class="control-label col-sm-3">@lang('home.formofbusiness')</label>
                                       <div class="col-sm-9 pnj-form-field">
                                           <select class="form-control input-sm select job-country" name="formofbusiness">
												<option value="Small business" {{ $company->formofbussiness == 'Small business' ? 'selected="selected"' : '' }}>@lang('home.Small business')</option>
												<option value="Small and Medium-sized Businesses" {{ $company->formofbussiness == 'Small and Medium-sized Businesses' ? 'selected="selected"' : '' }}>@lang('home.Small and Medium-sized Businesses')</option>
												<option value="Major Company" {{ $company->formofbussiness == 'Major Company' ? 'selected="selected"' : '' }}>@lang('home.Major Company')</option>
												<option value="Listed Company" {{ $company->formofbussiness == 'Listed Company' ? 'selected="selected"' : '' }}>@lang('home.Listed Company')</option>
												<option value="Etc" {{ $company->formofbussiness == 'Etc' ? 'selected="selected"' : '' }}>@lang('home.Etc')</option>

                                           </select>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label">@lang('home.establishin')</label>
                                        <div class="col-sm-9 pnj-form-field">
                                            <input class="form-control date-picker companyEstablishDate" type="text" name="companyEstablishDate" value="{{ $company->companyEstablishDate }}" required>
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
                                           <select name="opHours['sun'][]" class="form-control">
                                                <option value="">@lang('home.to')</option>
                                                @foreach(JobCallMe::timeArray() as $time)
                                                    <option value="{!! $time !!}" {!! $time == $opHour['sun']['to'] ? 'selected="selected"' : '' !!}>{!! $time !!}</option>
                                                @endforeach
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="row">
                                           <div class="col-md-offset-3 col-md-9">
                                               <button type="submit" class="btn btn-primary col-md-3" name="save" style="margin-right:5px">@lang('home.SAVE')</button>
                                               <button type="button" class="btn btn-default col-md-3" onClick="$('.eo-edit-section').hide(); $('.eo-section').show()">@lang('home.CANCEL')</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
            </div>
        </div>

        <div class="eo-box eo-about">
            <a class="btn btn-primary r-add-btn hideThis" onClick="$('.eo-about-org').hide(); $('.hideThis').hide();$('.eo-about-editor').show(); "><i class="fa fa-edit"></i> </a>
            <h3 class="eo-about-heading">@lang('home.aboutorganization')</h3>
            <div class="eo-about-org">
                <p>{!! $company->companyAbout !!}</p>
            </div>
             <div class="eo-about-editor">
                <form action="" id="pnj-form" method="post" class="organization-desc-form">
                    <input type="hidden" name="_token" class="token">
                    <div class="form-group">
                        <label class="control-label col-sm-3">&nbsp;</label>
                        <div class="col-sm-7 pnj-form-field">
                            <textarea class="form-control tex-editor" name="companyAbout" rows="10" style="resize: vertical;">{!! $company->companyAbout !!}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-primary col-md-3" name="save" style="margin-right:5px">@lang('home.SAVE')</button>
                                <button type="button" class="btn btn-default col-md-3" onClick="$('.eo-about-org').show(); $('.hideThis').show();$('.eo-about-editor').hide();">@lang('home.CANCEL')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



		<div class="eo-box eo-about">
            
            <h3 class="eo-about-heading">@lang('home.organizationmap')</h3>
            <div class="eo-about-org">
                <p></p>
            </div>
            
        </div>


    </div>
</section>
<div id="editProCompanyModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-md-9">
                <div id="proEditImg">
                    <img src="" class="img-responsive">
                </div>
           </div>
           <div class="col-md-3">
               <div id="custom-preview-wrapper"></div>
           </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Crop</button>
      </div>
    </div>

  </div>
</div>
@endsection
@section('page-footer')
<style type="text/css">
.input-error{color: red;}
</style>
<script type="text/javascript">
var token = "{{ csrf_token() }}";
$(document).ready(function(){
    $('button[data-toggle="tooltip"],a[data-toggle="tooltip"]').tooltip();
    getStates($('.job-country option:selected:selected').val());
})
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    if(countryId == 0){
        var newOption = new Option('Select State', '0', true, false);
        $(".job-state").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '0', true, false);
            $(".job-state").append(newOption);
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
    if(stateId == 0){
        var newOption = new Option('Select City', '0', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
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
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
$('form.organization-form').submit(function(e){
    $('.organization-form .token').val(token);
    $('.organization-form button[name="save"]').prop('disabled',true);
    $.ajax({
        type: 'post',
        data: $('.organization-form').serialize(),
        url: "{{ url('account/employer/organization/save') }}",
        success: function(response){
            if(response == '1'){
                window.location.reload();
            }else{
                $('.organization-form button[name="save"]').prop('disabled',false);
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        },
        error: function(data){
            var errors = data.responseJSON;
            var x = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.organization-form .'+i+'').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(x == 1){
                    vError = k;
                }
                x++;
            })
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.organization-form button[name="save"]').prop('disabled',false);
        }
    })
    e.preventDefault();
})
tinymce.init({
    selector: '.tex-editor',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
var formOp = 1;
$('form.organization-desc-form').submit(function(e){
    if(formOp == 1){
        formOp++
        return false;
    }
    $('.organization-desc-form .token').val(token);
    $('.organization-desc-form button[name="save"]').prop('disabled',true);
    $.ajax({
        type: 'post',
        data: $('.organization-desc-form').serialize(),
        url: "{{ url('account/employer/organization/about') }}",
        success: function(response){
            if($.trim(response) == '1'){
                window.location.reload();
            }else{
                toastr.error(response, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    })
    e.preventDefault();
})
$('.compnay-logo').on('change',function(){
    var formData = new FormData();
    formData.append('cLogo', $(this)[0].files[0]);
    formData.append('_token', token);

    $.ajax({
        url : "{{ url('account/employer/company/logo') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.eo-c-logo').attr('src',response);
            }else{
                toastr.error('Following format allowed (PNG/JPG/JPEG)', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
})
$('.compnay-cover').on('change',function(){
    var formData = new FormData();
    formData.append('cLogo', $(this)[0].files[0]);
    formData.append('_token', token);

    $.ajax({
        url : "{{ url('account/employer/company/cover') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.eo-timeline-cover').attr('src',response);
            }else{
                toastr.error('Following format allowed (PNG/JPG/JPEG)', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            }
        }
    });
})
  //**dataURL to blob**
    function dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {type:mime});
    }

    //**blob to dataURL**
    function blobToDataURL(blob, callback) {
        var a = new FileReader();
        a.onload = function(e) {callback(e.target.result);}
        a.readAsDataURL(blob);
    }
    function editcompanypic(){
        var proImg = $('.eo-dp').attr('src');
       $('#editProCompanyModel').modal('show');
       $('#proEditImg img').attr('src',proImg);
       $('#proEditImg img').rcrop({
            minSize : [100,100],
            preserveAspectRatio : true,
            
            preview : {
                display: true,
                size : [100,100],
                wrapper : '#custom-preview-wrapper'
            }
        });
      
    }
    $('#proEditImg img').on('rcrop-changed', function(){
        var srcOriginal = $(this).rcrop('getDataURL');
        var srcResized = $(this).rcrop('getDataURL', 50,50);
        var userId = "{{ session()->get('jcmUser')->userId }}";
        $('.eo-dp').attr('src',srcOriginal);
        //test:
        var blob = dataURLtoBlob(srcOriginal);
        var imagelink = $('#proEditImg img').attr('src');

        /*blobToDataURL(blob, function(dataurl){
            console.log(dataurl);
        });*/
        var fd = new FormData();
        fd.append('profileImage', blob);
        fd.append('_token', "{{ csrf_token() }}");
        fd.append('userId', userId);
        fd.append('imagelink', imagelink);
        $.ajax({
            type: 'POST',
            url: '{{ url("cropCompanyProfileImage") }}',
            data: fd,
            processData: false,
            contentType: false
        }).done(function(data) {
               console.log(data);
        });
        
    });
    function removecompanypic(){
       var userId = $('#userID').val();
       $.ajax({
        url:'{{ url("RemCompProImage") }}',
        data:{userId:userId,_token:'{{ csrf_token() }}'},
        type:'POST',
        success:function(res){
            if(res == 1){
                toastr.success('Profile Pic Remove');
                $('.eo-dp').attr('src','{{ asset("compnay-logo/default-logo.jpg") }}');
            }
        }
       });
    }
</script>
@endsection