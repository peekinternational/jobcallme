@extends('admin.layouts.app')

@if($rPath == 'edit')
    @section('title', 'Update Company')
@else
    @section('title', 'Add Company')
@endif
@section('content')
<?php 
$companyLogo = '';
if($company['companyLogo'] != ''){
    $companyLogo = url('/compnay-logo/'.$company['companyLogo']);
}
$companyCover = '';
if($company['companyCover'] != ''){
    $companyCover = url('/compnay-logo/'.$company['companyCover']);
}
 ?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">{{ $rPath == 'edit' ? 'Update Company' : 'Add Company' }}</span>
                    <a class="btn btn-default pull-right" href="{{ url('admin/users/company') }}">Back</a>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal company-form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="companyId" value="{{ $companyId }}">
                                <input type="hidden" name="prevLogo" value="{{ $company['companyLogo'] }}">
                                <input type="hidden" name="prevCover" value="{{ $company['companyCover'] }}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        Required fields are marked *
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">대표자 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyceo" value="{{ $company['companyceo'] != '' ? $company['companyceo'] : old('companyceo') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">매출액 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="financialstatus" value="{{ $company['financialstatus'] != '' ? $company['financialstatus'] : old('financialstatus') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">연관기업 : </label>
                                    <div class="col-md-6">
										<textarea name="associatecompany" class="form-control" id="associatecompany" rows="7">{{ $company['associatecompany'] }}</textarea> 

                                        <!-- <input type="text" class="form-control" name="joincompany" value="{{ $company['joincompany'] != '' ? $company['joincompany'] : old('joincompany') }}"> -->
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">산업 내 위치 : </label>
                                    <div class="col-md-6">
										<textarea name="locationinindustry" class="form-control" id="locationinindustry" rows="7">{{ $company['locationinindustry'] }}</textarea> 

                                        <!-- <input type="text" class="form-control" name="joincompany" value="{{ $company['joincompany'] != '' ? $company['joincompany'] : old('joincompany') }}"> -->
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">영업이익 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="operatingprofit" value="{{ $company['operatingprofit'] != '' ? $company['operatingprofit'] : old('operatingprofit') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">당기순이익 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="netincome" value="{{ $company['netincome'] != '' ? $company['netincome'] : old('netincome') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">주요산업 : *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="majorbusiness" value="{{ $company['majorbusiness'] != '' ? $company['majorbusiness'] : old('majorbusiness') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">기업설명 : </label>
                                    <div class="col-md-6">
										<textarea name="joincompany" class="form-control" id="joincompany" rows="7">{{ $company['joincompany'] }}</textarea> 

                                        <!-- <input type="text" class="form-control" name="joincompany" value="{{ $company['joincompany'] != '' ? $company['joincompany'] : old('joincompany') }}"> -->
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 text-right">당기순이익 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="incomestatus" value="{{ $company['incomestatus'] != '' ? $company['incomestatus'] : old('incomestatus') }}">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">기준 연도 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="closingdate" value="{{ $company['closingdate'] != '' ? $company['closingdate'] : old('closingdate') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">전체평균 연봉 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="avgsalary" value="{{ $company['avgsalary'] != '' ? $company['avgsalary'] : old('avgsalary') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">동종업계 평균연봉비교 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="sameavgsalary" value="{{ $company['sameavgsalary'] != '' ? $company['sameavgsalary'] : old('sameavgsalary') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">신입연봉 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="begningnewemployee" value="{{ $company['begningnewemployee'] != '' ? $company['begningnewemployee'] : old('begningnewemployee') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">월별 입/퇴사자 현황 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="joinleave" value="{{ $company['joinleave'] != '' ? $company['joinleave'] : old('joinleave') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">남녀직원 비율 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="avgsex" value="{{ $company['avgsex'] != '' ? $company['avgsex'] : old('avgsex') }}">
                                    </div>
                                </div>
								<!-- <div class="form-group">
                                    <label class="control-label col-md-3 text-right">평균스펙지수 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="specificationindex" value="{{ $company['specificationindex'] != '' ? $company['specificationindex'] : old('specificationindex') }}">
                                    </div>
                                </div> -->
								<!-- <div class="form-group">
                                    <label class="control-label col-md-3 text-right">외국어 레벨 및 자격증 종류 : </label>
                                    <div class="col-md-6">
										<select class="form-control" name="foreignlanguage">
												<option value="" {{ $company['foreignlanguage'] == '' ? 'selected="selected"' : '' }}></option>
                                                <option value="높음" {{ $company['foreignlanguage'] == '높음' ? 'selected="selected"' : '' }}>높음</option>
												<option value="보통" {{ $company['foreignlanguage'] == '보통' ? 'selected="selected"' : '' }}>보통</option>
												<option value="낮음" {{ $company['foreignlanguage'] == '낮음' ? 'selected="selected"' : '' }}>낮음</option>
                                            
                                        </select>
                                        <!-- <input type="text" class="form-control" name="foreignlanguage" value="{{ $company['foreignlanguage'] != '' ? $company['foreignlanguage'] : old('foreignlanguage') }}"> -->
                                    <!-- </div>
                                </div> -->
								
								
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">스펙현황 : </label>
                                    <div class="col-md-6">
										<textarea name="statusofcertification" class="form-control" id="mos" rows="7">{{ $company['statusofcertification'] }}</textarea>         
                                        
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">해외경험 평균 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="overseasexperience" value="{{ $company['overseasexperience'] != '' ? $company['overseasexperience'] : old('overseasexperience') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">인턴경험 평균 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="internexperience" value="{{ $company['internexperience'] != '' ? $company['internexperience'] : old('internexperience') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">대내외수상 평균 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="awardsexperience" value="{{ $company['awardsexperience'] != '' ? $company['awardsexperience'] : old('awardsexperience') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">교내ㆍ사회ㆍ봉사활동 평균 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="schoolsocialvolunteer" value="{{ $company['schoolsocialvolunteer'] != '' ? $company['schoolsocialvolunteer'] : old('schoolsocialvolunteer') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">업계 연봉순위 : </label>
                                    <div class="col-md-6">
										<textarea name="schooloforigin" class="form-control" id="schooloforigin" rows="7">{{ $company['schooloforigin'] }}</textarea>                                         
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">고용현황 : </label>
                                    <div class="col-md-6">
										<textarea name="employmentstatus" class="form-control" id="employmentstatus" rows="7">{{ $company['employmentstatus'] }}</textarea>                                         
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">전공순위 : </label>
                                    <div class="col-md-6">
										<textarea name="schoolmajor" class="form-control" id="schoolmajor" rows="7">{{ $company['schoolmajor'] }}</textarea>                                         
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁 : </label>
                                    <div class="col-md-6">
										<textarea name="companyhistory" class="form-control" id="companyhistory" rows="7">{{ $company['companyhistory'] }}</textarea>                                        
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁2 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory2" value="{{ $company['companyhistory2'] != '' ? $company['companyhistory2'] : old('companyhistory2') }}" size="30">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁3 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory3" value="{{ $company['companyhistory3'] != '' ? $company['companyhistory3'] : old('companyhistory3') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁4 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory4" value="{{ $company['companyhistory4'] != '' ? $company['companyhistory4'] : old('companyhistory4') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁5 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory5" value="{{ $company['companyhistory5'] != '' ? $company['companyhistory5'] : old('companyhistory5') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁6 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory6" value="{{ $company['companyhistory6'] != '' ? $company['companyhistory6'] : old('companyhistory6') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁7 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory7" value="{{ $company['companyhistory7'] != '' ? $company['companyhistory7'] : old('companyhistory7') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁8 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory8" value="{{ $company['companyhistory8'] != '' ? $company['companyhistory8'] : old('companyhistory8') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁9 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory9" value="{{ $company['companyhistory9'] != '' ? $company['companyhistory9'] : old('companyhistory9') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁10 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory10" value="{{ $company['companyhistory10'] != '' ? $company['companyhistory10'] : old('companyhistory10') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁11 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory11" value="{{ $company['companyhistory11'] != '' ? $company['companyhistory11'] : old('companyhistory11') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁12 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory12" value="{{ $company['companyhistory12'] != '' ? $company['companyhistory12'] : old('companyhistory12') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁13 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory13" value="{{ $company['companyhistory13'] != '' ? $company['companyhistory13'] : old('companyhistory13') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁14 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory14" value="{{ $company['companyhistory14'] != '' ? $company['companyhistory14'] : old('companyhistory14') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁15 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory15" value="{{ $company['companyhistory15'] != '' ? $company['companyhistory15'] : old('companyhistory15') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁16 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory16" value="{{ $company['companyhistory16'] != '' ? $company['companyhistory16'] : old('companyhistory16') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁17 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory17" value="{{ $company['companyhistory17'] != '' ? $company['companyhistory17'] : old('companyhistory17') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁18 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory18" value="{{ $company['companyhistory18'] != '' ? $company['companyhistory18'] : old('companyhistory18') }}">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="control-label col-md-3 text-right">회사연혁19 : </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="companyhistory19" value="{{ $company['companyhistory19'] != '' ? $company['companyhistory19'] : old('companyhistory19') }}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 text-right">&nbsp;</label>
                                    <div class="col-md-6">
                                        <button class="btn btn-block btn-primary do-save" type="submit" name="save">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();
    $('.date-picker').datepicker({format:'yyyy-mm-dd'});
    getStates($('.job-country option:selected:selected').val());
})
function getFileName(obj,aClass){
    var vValue = $(obj).val();
    vValue = vValue.replace("C:\\fakepath\\",'');
    $('.'+aClass).val(vValue);
}
$('form.company-form').submit(function(e){
    $('.company-form .do-save').prop('disabled',true);
    $('.company-form .do-save').addClass('spinner spinner-default');
})
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
</script>
@endsection