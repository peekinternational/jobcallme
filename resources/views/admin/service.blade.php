@extends('admin.layouts.app')

@section('title', 'Our Services')


@section('content')


    <div class="layout-content">
        <div class="layout-content-body">
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">Our Services</span>
                    <button class="btn btn-primary pull-right" onclick="addservice()">Add New Services</button>
                </h1>
            </div>
           
         
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Services Detail</th>
                                        <th>Services Link</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $i=> $ourservice)
                                            <tr>
                                                <td>{{$i+1}} </td>
                                                <td>{{ $ourservice->servicesdetail }}</td>
                                                <td>{{ $ourservice->services }}</td>
                                                <td>{{ $ourservice->created_at }}</td>
                                                <td>
                                                    <a href="javascript:;" onclick="editservice('{{ $ourservice->serve_id }}')" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="deleteservice('{{ $ourservice->serve_id }}')" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="shift-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Services</h4>
                </div>
                <form onsubmit="return false" class="service-form">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" class="serveId" name="serveId" value="0">
                        <div class="form-group">
                            <label> Service Detail</label>
                            <input type="text" class="form-control" name="servicesdetail">
                        </div>
                        <div class="form-group">
                            <label> Service Link</label>
                            <input type="text" class="form-control" name="services">
                        </div>
                        
                        <div class="alert alert-danger" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary do-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-warning" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content bg-warning animated bounceIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <span class="icon icon-exclamation-triangle icon-5x"></span>
                        <h3>Are you sure?</h3>
                        <p>You will not be able to undo this action.</p>
                        <div class="m-t-lg">
                            <form method="post" action="{{ url('admin/services/delete') }}">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="serveId" class="actionId">
                                <button class="btn btn-danger" type="submit">Continue</button>
                                <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection
@section('page-footer')
<script type="text/javascript">

function deleteservice(serveId){
    $('.actionId').val(serveId);
    $('#modal-warning').modal();
}
function addservice(){
    $('.service-form .serveId').val('0');
    $('.service-form input[name="services"]').val('');
    $('.service-form input[name="servicesdetail"]').val('');
    $('#shift-modal').modal();
}
$('form.service-form').submit(function(e){
    $('.service-form .do-save').prop('disabled',true);
    $('.service-form .do-save').addClass('spinner spinner-default');
    $('.service-form .alert-danger').hide();
    $.ajax({
        type: 'post',
        data: $('.service-form').serialize(),
        url: "{{ url('admin/services/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.service-form .alert-danger').show();
                $('.service-form .alert-danger').html(response);
                $('.service-form .do-save').prop('disabled',false);
                $('.service-form .do-save').removeClass('spinner spinner-default');
            }else{
                window.location.href = "{{ url('admin/services') }}";
            }
        }
    })
    e.preventDefault();
})
function editservice(serveId){
    $.ajax({
        url: "{{ url('admin/services/get') }}/"+serveId,
        success: function(response){
            var obj = $.parseJSON(response);
            console.log(obj);
            $('.service-form .serveId').val(serveId);
            $('.service-form input[name="services"]').val(obj.services);
            $('.service-form input[name="servicesdetail"]').val(obj.servicesdetail);
            $('#shift-modal').modal();
        }
    })
}
</script>
@endsection