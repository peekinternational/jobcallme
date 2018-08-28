@extends('frontend.layouts.app')

@section('title', "$job->title")

@section('content')

</style>
<section id="jobs">
    <div class="container" id="msg">
        <div class="col-md-10">
            <div class="jobs-suggestions">
            	<h2 style="color:#716a6a">{!!$currentjob->title!!}</h2>
            <div class="bgblue" align="center">
                <h3>@lang('home.Additional Requirements - Submit an Online Questionnaires')</h3>
                <p>@if(app()->getLocale() == "kr")
											@lang('home.You are required to') <strong>@lang('home.submit an online questionaire')</strong>{{$quesdata->submission_date}} <strong>@lang('home.days')</strong> @lang('home.schedule by employer within') 
										@else      
											@lang('home.You are required to') <strong>@lang('home.submit an online questionaire')</strong> @lang('home.schedule by employer within') {{$quesdata->submission_date}} <strong>@lang('home.days')</strong>
										@endif
										
										</p>

				<!-- <p>You are required to <strong>submit an online questionaire</strong> schedule by employer within {{$quesdata->submission_date}} <strong>@lang('home.days')</strong></p> -->
                <button class="btn btn-info" id="next"> @lang('home.Start Now')</button>
            </div>
               
            </div>
        </div>
    </div>
    <div class="container" id="questions" style="display:none;">
        <div class="col-md-10">
            <form method="post" action="{{ url('account/employer/questionnaire/answer') }}">
                <input  type="hidden" name="_token" value="{{ csrf_token() }}">
                <input  type="hidden" name="job_id" value="{{ $currentjob->jobId }}">
                <div class="jobs-suggestions">
                    <h4>@lang('home.applyQuestionaires/Test')</h4>
                    <ol type="1" style="margin-left:30px;">
                    <?php $i =0 ;?>
                    @foreach($questiondata as $question)
                        <li><strong>{{$question->question}}</strong><br>
                        <?php $options = explode(',', $question->options)?>
                        <div class="md-radio md-radio-inline">
                        @foreach($options as $key => $option)
						<div style="padding-top:20px">
                        <input id="{{$i}}" type="radio" name="{{$question->q_id}}" value="{{$option}}" required>
                        <label for="{{$i}}">{{$option}}</label>
                            <?php $i++?>
						</div>
                        @endforeach
                        </div>
                        </li>
                        @endforeach
                    </ol>

                    <button class="btn btn-info"> @lang('home.Submit') </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
$(document).ready(function(){
$('#next').on('click',function(){
    $('#msg').hide();
    $('#questions').show();
})
})

</script>
@endsection