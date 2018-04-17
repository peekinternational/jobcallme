		@extends('frontend.layouts.app')

		@section('title', 'Evaluation Forms')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
				 <section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
                        <h4> @lang('home.evaluationforms')</h4>
                        <?php// print_r($record); ?>
                        <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Evaluation Form</th>
                                            <th>No. of Criterion</th>
                                            <th>Created on</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($record as $order)
                                        <tr id="form-{{$order->id}}">
                                            <td>{{$order->title}}</td>
                                            <td>{{$order->criterion}}</td>
                                            <td>{{$order->created_at}}</td>
        							
        							       <td><a href="javascript:;" title="Edit" onclick="getAcademic('{{ $order->id }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                 <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $order->id}}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;</td>
                                         </tr>
                                           	@endforeach                
        					</tbody>
        				</table>
                            
                        </ul>
                    </section>
                    <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.evaluationforms')</c></h4>
                        <form class="form-horizontal form-academic" method="post" action="">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                         
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.title')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="title">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
								
								</div>
								</div>
								
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Academic Section End-->

				</div>
		
		
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
		var pageToken = '{{ csrf_token() }}';
function addAcademic(){
    $('.form-academic input').val('');
    $('#academic-edit h4 c').text('@lang('home.evaluationforms')');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
$('form.form-academic').submit(function(e){
    //alert('hello');
    $('.form-academic input[name="_token"]').val('{{ csrf_token() }}');
    $('.form-academic button[name="save"]').prop('disabled',true);
    $('.form-academic .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-academic').serialize(),
        url: "{{ url('account/employer/form/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-academic .error-group').show();
                $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
                $('.form-academic button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/employer/addevaluation') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-academic .error-group').show();
            $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-academic button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getAcademic(resumeId){
    $.ajax({
        url: "{{ url('account/employer/form/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            console.log(obj);
            $('.form-academic input[name="resumeId"]').val(obj.id);
            $('.form-academic input[name="title"]').val(obj.title);
            
            $('#academic-edit h4 c').text('Edit @lang('home.evaluationforms')');
            $('#academic').hide();
            $('#academic-edit').fadeIn();
        }
    })
}
function deleteElement(resumeId){
    if(confirm('Are you sure to delete this?')){
        $.ajax({
            url: "{{ url('account/employer/form/delete') }}/"+resumeId,
            success: function(response){
                $('#form-'+resumeId).remove();
            }
        })
    }
}
		</script>
		@endsection