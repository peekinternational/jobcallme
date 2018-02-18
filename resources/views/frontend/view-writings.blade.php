@extends('frontend.layouts.app')

@section('title', 'Writings')

@section('content')
<section id="postNewJob">
    <div class="container">
        @if(count($writing) > 0)
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3>
                        @lang('home.mywriting') 
                        <a class="btn btn-primary pull-right" href="{{ url('account/writings/article/add') }}" style="border-radius: 50%;margin-top: -5px;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>@lang('home.title')</th>
                                    <th>@lang('home.category')</th>
                                    <th>@lang('home.status')</th>
                                    <th>@lang('home.createdon')</th>
                                    <th>@lang('home.action')</th>
                                </thead>
                                <tbody>
                                    @foreach($writing as $write)
                                        <tr id="write-{{ $write->writingId }}">
                                            <td><a href="{{ url('read/article/'.$write->writingId ) }}">{!! $write->title !!}</a></td>
                                            <td>{!! $write->cat_names !!}</td>
                                            <td>{!! $write->status !!}</td>
                                            <td>{!! date('M d, Y',strtotime($write->createdTime)) !!}</td>
                                            <td>
                                                <a href="{{ url('account/writings/article/edit/'.$write->writingId) }}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:;" onclick="deleteArticle('{{ $write->writingId }}')"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-9">
                <div class="pnj-box">
                    <h3>@lang('home.mywriting')</h3>
                    <div class="upskill-box">
                        <h2>@lang('home.creativewriting')</h2>
                        <p>@lang('home.eagerlywaiting')</p>
                        <a href="{{ url('account/writings/article/add') }}" class="btn btn-primary">@lang('home.WRITE YOUR FIRST ARTICLE')</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
function deleteArticle(writingId){
    if(confirm('Are you sure?')){
        $.ajax({
            url: "{{ url('account/writings/delete') }}/"+writingId,
            success: function(response){
                if($.trim(response) != '1'){
                    toastr.error(response, '', {timeOut: 5000, positionClass: "toast-top-center"});
                }else{
                    $('#write-'+writingId).remove();
                    toastr.success('Article Deleted', '', {timeOut: 5000, positionClass: "toast-top-center"});
                }
            }
        })
    }
}
</script>
@endsection