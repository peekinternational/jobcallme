@extends('admin.layouts.app')

@section('title', 'Companies')

@section('content')

    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>국가</th>                                        
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        
                                            <tr>
                                               <td>
													<!-- <select class="form-control select2 job-country" name="companyCountry" required="">
														@foreach(JobCallMe::getJobCountries() as $cntry)
															<option value="{{ $cntry->id }}" {{ $company['companyCountry'] == $cntry->id ? 'selected="selected"' : '' }}>@lang('home.'.$cntry->name)</option>
														@endforeach
													</select> -->
											   </td>                                               
                                               <td>
                                                   <a href="javascript:;" onclick="deletegdscrapping()" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-pencil"></i>Glassdoor 등록</a>&nbsp;&nbsp;&nbsp;
												   <!-- <a href="javascript:;" onclick="addgdscrapping()" data-toggle="tooltip" data-original-title="Add"><i class="icon icon-pencil"></i>Glassdoor 등록</a> -->
                                               </td>
                                            </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('page-footer')
<script type="text/javascript">
    

    function deletescrapping(){
        $.ajax({
            url:"{{url('deletescrapping')}}",
            dataType:'json',
            data:{_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                if(res == 1){
                    toastr.success('Feedback Deleted');
                    window.location.href = '{{url("getscrapping")}}';
                }else{
                    alert('data not deleted');
                }
            }
        });
    }


	function addscrapping(){
        $.ajax({
            url:"{{url('addscrapping')}}",
            dataType:'json',
            data:{_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                if(res == 1){
                    toastr.success('Scrapping Add');
                    window.location.href = '{{url("getscrapping")}}';
                }else{
                    alert('data not Add');
                }
            }
        });
    }


	function deletegdscrapping(){
        $.ajax({
            url:"{{url('deletegdscrapping')}}",
            dataType:'json',
            data:{_token:"{{csrf_token()}}"},
            type:"post",
            success:function(res){
                if(res == 1){
                    toastr.success('gd Deleted');
                    window.location.href = '{{url("getgdscrapping")}}';
                }else{
                    alert('gd data not deleted');
                }
            }
        });
    }

</script>

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

</script>
@endsection