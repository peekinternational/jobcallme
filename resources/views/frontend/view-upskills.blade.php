@extends('frontend.layouts.app')

@section('title', 'Upskills')

@section('content')

<section id="read-section">
    <div class="container">
        <div class="col-md-12 learn-search-box" style="padding-top:90px">

            
			<h2 class="text-center">
						@if(app()->getLocale() == "kr")
						    <div id="hp_text5"></div><!-- @lang('home.headerHeading') -->
						@else
						    <div id="hp_text6"></div><!-- @lang('home.headerHeading') -->
						@endif
			</h2>
            
            
        </div>
    </div>
</section>

<section id="postNewJob" style="margin-bottom:50px">
    <div class="container">
        @if(count($upskills) > 0)
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3>
                        @lang('home.promoteofferings')
                        <a class="btn btn-primary pull-right" href="{{ url('account/upskill/add') }}" style="border-radius: 50%;margin-top: -5px;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <div class="col-md-12" style="margin-top:30px;margin-bottom:30px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.title')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.category')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.address')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.createdon')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.action')</th>
                                </thead>
                                <tbody>
                                    @foreach($upskills as $skill)
                                        <tr id="upskill-{{ $skill->skillId }}">
                                            <td><a href="{{ url('learn/'.strtolower($skill->type).'/'.$skill->skillId ) }}">{!! $skill->title !!}</a></td>
                                            <td>@lang('home.'.$skill->type)</td>
                                            <td>{!! $skill->address !!}</td>
                                            <td>@if(app()->getLocale() == "kr")
						    {!! date('Y-m-d',strtotime($skill->createdTime)) !!}
						@else
						    {!! date('M d, Y',strtotime($skill->createdTime)) !!}
						@endif</td>
                                            <td>
                                                <a href="{{ url('account/upskill/edit/'.$skill->skillId) }}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:;" onclick="deleteUpskill('{{ $skill->skillId }}')"><i class="fa fa-remove"></i></a>
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
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3><span style="padding-left:15px;color:#fff;">@lang('home.promoteofferings')</span></h3>
                    <div class="upskill-box">
                        <p style="font-size:17px">@lang('home.advertisecourses')</p>
                        <a href="{{ url('account/upskill/add') }}" class="btn btn-primary">@lang('home.advertisenow')</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
function deleteUpskill(skillId){
    if(confirm('Are you sure?')){
        $.ajax({
            url: "{{ url('account/upskill/delete') }}/"+skillId,
            success: function(response){
                if($.trim(response) != '1'){
                    toastr.error(response, '', {timeOut: 5000, positionClass: "toast-top-center"});
                }else{
                    $('#upskill-'+skillId).remove();
                    toastr.success('Upskill Deleted', '', {timeOut: 5000, positionClass: "toast-top-center"});
                }
            }
        })
    }
}
</script>
@endsection