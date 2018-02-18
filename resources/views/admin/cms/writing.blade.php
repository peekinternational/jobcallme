@extends('admin.layouts.app')

@section('title', 'Job Category')

@section('content')
<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
                <div class="col-md-12">
                    @include('admin.includes.alerts')
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created Time</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>

                                        @foreach($writings as $write)
                                            <tr>
                                                <td>
                                                    {{$write->writingId}}
                                                    <input type="hidden" name="id" id="wid" value="{{$write->title}}">
                                                </td>
                                                <td>{{$write->title}}</td>
                                                <td>
                                                    <?php 
                                                    $string = strip_tags($write->description);
                                                    if (strlen($string) > 100) {

                                                        // truncate string
                                                        $stringCut = substr($string, 0, 100);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.
                                                        $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                                                        $string .= '... ReadMore';
                                                    }
                                                    echo $string;

                                                    ?>
                                                </td>
                                                <td>{{$write->cat_names}}</td>
                                                <td>
                                                    <input type="checkbox" class="status" @if($write->status == 'Publish') Checked @endif>
                                                </td>
                                                <td>{{$write->createdTime}}</td>
                                                <td>
                                                    <a href="" data-toggle="tooltip" data-original-title="View Sub Categories"><i class="icon icon-eye"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="" data-toggle="tooltip" data-original-title="Update"><i class="icon icon-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:;" onclick="" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i></a>
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
@endsection
@section('page-footer')
<script type="text/javascript">
 $(function() {
    $('.status').bootstrapToggle({
      on: 'Publish',
      off: 'Draft',
      offstyle:'info',
      onstyle:'success'
    });
    var token = "{{ csrf_token() }}";
    $('.status').on('change',function(e){
        var id = $(this).closest('tr').find('#wid').val();
        var status = '';
        if($(e.target).parent().hasClass('off')){
            status = 'Draft';
        }else{
            status = 'Publish';
        };
        $.ajax({
            url:'{{url("admin/cms/writestatupdate")}}',
            data:{id:id,status:status,_token:token },
            type:'POST',
            success:function(res){
               if(res == 1){
                toastr.success('status Updated');
               }else{
                alert('error in controller admin/Cms/writestatupdate line no 457');
               }
            }
        });
    })
  })

</script>
@endsection