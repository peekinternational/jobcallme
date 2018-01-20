@extends('frontend.layouts.app')

@section('title','Post New Job')

@section('content')

<section id="postNewJob">
    <div class="container-fluid">
	
        <div class="col-md-9">
		
            <div class="pnj-box">
			  <h3>@lang('home.postnewjob')</h3>
					<div class="col-md-12">
					   <div class="form-group error-group" style="display: none;">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field"><div class="alert alert-danger"></div></div>
                        </div>
              
               
               
                  <!--  <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypals') !!}" > -->
                        {!! Form::open(['action'=>['frontend\Employer@postPaymentWithpaypals'],'method'=>'post','class'=>'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
                        {{ csrf_field() }}
						
                    
					<div class="mb15" form-prepend="" fxlayout="" fxlayoutwrap="" style="display: flex; box-sizing: border-box; flex-flow: row wrap;margin-bottom:14px;">
                <div fxflex="100" style="flex: 1 1 100%; box-sizing: border-box; max-width: 100%;" class="ng-untouched ng-pristine ng-invalid">
                
 
                        <ul id="post-job-ad-types">
                            <!----><li style="position:relative">
                                <!---->
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" id="md-radio-2-input" name="amount" value="0" name="md-radio-group-0"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span><span class="b">Basic</span></div></label></md-radio-button>
                                <div>
                                    <!----><label for="md-radio-2-input">
                                        <ul class="list-unstyled desc" >
                                            <li>Basic Posting</li>
                                            <li>Lowest Priority</li>
                                        </ul>
                                        <div class="credits b">Free</div>
                                    </label>
                                    <!---->
                                    <!---->
                                    <!---->
                                </div>
                            </li><li style="position:relative">
                                <!---->
                              <input class="mat-radio-input cdk-visually-hidden" type="radio" name="amount" value="20.30" id="gallery"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span><span class="b">Gallery</span></div></label></md-radio-button>
                                <div>
                                    <!---->
                                    <!----><label for="gallery">
                                        <ul class="list-unstyled desc">
                                            <li>Featured on homepage (3 days)</li>
                                            <li>Priority over Basic jobs</li>
                                        </ul>
                                        <div class="credits b">
                                            <!----><div class="">
                                                <span class="text-success">Rs.2,030 / $20.30</span>
                                                <i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
                                            </div>
                                            <!---->
                                        </div>
                                    </label>
                                    <!---->
                                    <!---->
                                </div>
                            </li><li style="position:relative">
                                <!---->
                               <input class="mat-radio-input cdk-visually-hidden" type="radio" name="amount" value="52.20" id="hot"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span><span class="b">Hot</span></div></label></md-radio-button>
                                <div>
                                    <!---->
                                    <!---->
                                    <!----><label for="hot">
                                        <ul class="list-unstyled desc">
                                            <li>Featured on homepage (10 days)</li>
                                            <li>Priority over Gallery jobs</li>
                                        </ul>
                                        <div class="credits b">
                                            <!----><div class="">
                                                <span class="text-success">Rs.5,220 /$52.20 <i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i></span>
                                            </div>
                                            <!---->
                                        </div>
                                    </label>
                                    <!---->
                                </div>
                            </li><li style="position:relative">
                                <!----><div class="ribbon red"><span>Best Value</span></div>
                           <input class="mat-radio-input cdk-visually-hidden" type="radio" name="amount" value="75.40" id="prime"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span><span class="b">Premium</span></div></label></md-radio-button>
                                <div>
                                    <!---->
                                    <!---->
                                    <!---->
                                    <!----><label for="prime">
                                        <ul class="list-unstyled desc">
                                            <li>Featured on homepage (30 days)</li>
                                            <li>Priority over Hot jobs</li>
                                        </ul>
                                        <div class="credits b">
                                            <!----><div class="">
                                                <span class="text-success">Rs.7,540 / $75.40</span>
                                              <i class="fa fa-shopping-cart" aria-hidden="true" style="float: right;"></i>
                                            </div>
                                            <!---->
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                 

                    
                </div>
            </div>
		</div>
               
                  
                    <div class="pnj-form-section">
                       
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.s_department')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="department">
                                    <option value="">@lang('home.s_department')</option>
                                    @foreach(JobCallMe::getDepartments() as $depart)
                                        <option value="{!! $depart->departmentId !!}">{!! $depart->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.category')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-category" name="category" onchange="getSubCategories(this.value)">
                                    @foreach(JobCallMe::getCategories() as $cat)
                                        <option value="{!! $cat->categoryId !!}">{!! $cat->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.Subcategory')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-sub-category" name="subCategory">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.careerlevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="careerLevel">
                                    @foreach(JobCallMe::getCareerLevel() as $career)
                                        <option value="{!! $career !!}">{!! $career !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.experiencelevel')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2" name="experience">
                                    @foreach(JobCallMe::getExperienceLevel() as $experience)
                                        <option value="{!! $experience !!}">{!! $experience !!}</option>
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
                            <label class="control-label col-sm-3">@lang('home.expirydate')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control date-picker" name="expiryDate" onkeypress="return false">
                            </div>
                        </div>
                    </div>

                    <h3>@lang('home.naturejob')</h3>
                    <div class="pnj-form-section">
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.type')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="type">
                                    @foreach(JobCallMe::getJobType() as $jtype)
                                        <option value="{!! $jtype->name !!}">{!! $jtype->name !!}</option>
                                    @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label col-sm-3">@lang('home.shift')</label>
                           <div class="col-sm-9 pnj-form-field">
                               <select class="form-control select2" name="shift">
                                    @foreach(JobCallMe::getJobShifts() as $jshift)
                                        <option value="{!! $jshift->name !!}">{!! $jshift->name !!}</option>
                                    @endforeach
                               </select>
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
                                        <input type="text" class="form-control" name="minSalary" placeholder="@lang('home.minsalary')" required>
                                    </div>
                                    <div class="col-md-4 pnj-salary">
                                        <input type="text" class="form-control" name="maxSalary" placeholder="@lang('home.Maxsalary')" required>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control col-md-4 select2" name="currency">
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
                                <select class="form-control select2 job-state" name="state">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.city')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control select2 job-city" name="city">
                                </select>
                            </div>
                        </div>
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
                    <div class="col-md-offset-4 col-md-8  pnj-btns">
                        <button type="submit" class="btn btn-primary" name="save">@lang('home.postjob')</button>
                        <a href="{{ url('account/employer') }}" class="btn btn-default">@lang('home.CANCEL')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    getStates($('.job-country option:selected:selected').val());
    getSubCategories($('.job-category option:selected:selected').val());
});
$("#md-radio-2-input").trigger('click');
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
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
var formPost = 1;

</script>
@endsection