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
                                               <td>대한민국</td>                                               
                                               <td>
                                                   <a href="javascript:;" onclick="adddeletescrapping()" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i>워크넷 등록한 데이터삭제</a>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="deletescrapping()" data-toggle="tooltip" data-original-title="Delete"><i class="icon icon-remove"></i>워크넷 중복삭제</a>&nbsp;&nbsp;&nbsp;
												   <a href="javascript:;" onclick="addscrapping()" data-toggle="tooltip" data-original-title="Add"><i class="icon icon-pencil"></i>워크넷 등록</a>
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
    

    function adddeletescrapping(){
        $.ajax({
            url:"{{url('adddeletescrapping')}}",
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

</script>
@endsection