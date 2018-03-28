		@extends('frontend.layouts.app')

		@section('title', 'Evaluation Forms')

		@section('content')
		<section id="company-box">
			<div class="container">
			<div class="row">
				<div class="col-md-12">
				<section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
                        <div>
                            <h4>{{$ques->title}}</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-12">
                                    <strong>Title:</strong> {{$ques->title}}
                                </div>
                                <div class="col-md-12">
                                    <strong>Type:</strong> {{$ques->type}}
                                </div>
                                <div class="col-md-12">
                                    <strong>Duration:</strong> N/A
                                </div>
                            </div>
                            <di class="col-md-5">
                                <div class="col-md-12">
                                    <strong>Submission Days:</strong> {{$ques->submission_date}}
                                </div>
                                <div class="col-md-12">
                                    <strong>Late Submission:</strong> {{$ques->accept_late_submission}}
                                </div>
                                <div class="col-md-12">
                                    <strong>Suffle Quesyion:</strong> {{$ques->shuffle_questions}}
                                </div>
                            </di>
                        </div>
                        <!-- <ul class="resume-details">
                            @if(count($resume['academic']) > 0)
                                @foreach($resume['academic'] as $resumeId => $academic)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getAcademic('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-date">{!! date('M, Y',strtotime($academic->completionDate)) !!}</p>
                                            <p class="rd-title">{!! $academic->degree !!}</p>
                                            <p class="rd-organization">{!! $academic->institution !!}</p>
                                            <p class="rd-location">{!! JobCallMe::cityName($academic->city).' ,'.JobCallMe::countryName($academic->country)!!}</p>
                                            <p class="rd-grade">Grade/GPA : {!! $academic->grade !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul> -->
                </section>
                <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.AddQuestionnaire')asdasd</c></h4>
                        <form method="post" action="{{ url('account/employer/questionnaires/new') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="ques_id" value="{{ $ques->ques_id }}">
                          <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" value="{{$ques->title}}" class="form-control" id="title">
                          </div>
                          <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Select type</option>
                                <option @if($ques->type == 'Test') selected @endif>Test</option>
                                <option @if($ques->type == 'Questionnaires') selected @endif>Questionnaires</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="days">Submission Days:</label>
                            <input type="number" name="submission_date" value="{{ $ques->submission_date}}" class="form-control" id="days">
                          </div>
                          <div class="checkbox">
                            <label><input name="late_submission" value="Yes" type="checkbox" @if($ques->accept_late_submission == 'Yes') checked @endif> Accept Late Submission</label>
                          </div>
                          <div class="checkbox">
                            <label><input name="shuffle_question" value="Yes" type="checkbox" @if($ques->shuffle_questions == 'Yes') checked @endif> Shuffle Questions</label>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 text-right">&nbsp;</label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">@lang('home.save')</button>
                                <button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">Cancel</button>
                            </div>
                          </div>
                        </form>
                </section>
                    <!--Academic Section End-->
                <!-- add question area start -->
                <section class="resume-box" id="question">
                        <a class="btn btn-primary r-add-btn" onclick="addquestion()"><i class="fa fa-plus"></i> </a>
                        <h4>Questions</h4>
                        
                        <div>
                            <ol type='1' style="margin-left:30px;">
                             @foreach($questions as $key => $question)
                                <li style="position:relative;"><strong>{{ $question->question }}</strong>
                                <input type="hidden" value="{{$key}}" id="index">
                                    <ol type="1" style="margin-left:20px;">
                                        <?php $options = explode(',', $question->options); ?>
                                        @foreach($options as $option)
                                        <li>{{ $option }}</li>
                                        @endforeach
                                    </ol>
                                    <span style="position:absolute;top:10px;right:10px;">
                                        <i class="fa fa-edit"></i>
                                        <i class="fa fa-remove"></i>
                                    </span>
                                    
                                </li>
                                @endforeach
                            </ol>
                        </div>
                        
                </section>
                <!-- edit question area start -->
                <section class="resume-box" id="aquestion-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.AddQuestionnaire')asdasd</c></h4>
                        <form method="post" action="{{ url('account/employer/questionnaires/question/new') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="ques_id" value="{{ $ques->ques_id }}">
                          <div class="form-group">
                            <label for="title">Question:</label>
                            <input type="text" name="question" class="form-control" id="title">
                          </div>
                          
                          <div class="form-group">
                            <label for="days">Marks:</label>
                            <input type="number" name="marks" class="form-control" id="days">
                          </div>
                          <div class="form-group" id="addoption">
                            <label for="days">Option:</label>
                            <input type="text" name="options[]" class="form-control" id="days">
                          </div>
                          <div>
                              <button type="button" id="addMore" class="btn btn-success">Add Options</button>
                          </div>
                          <div class="checkbox">
                            <label><input name="shuffle_question" value="Yes" type="checkbox"> Shuffle Questions</label>
                          </div>
                          <div class="checkbox">
                            <label><input name="required" value="Yes" type="checkbox"> Required</label>
                          </div>
                          <div class="form-group">
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">@lang('home.save')</button>
                                <button class="btn btn-default" type="button" onclick="$('#question').fadeIn();$('#aquestion-edit').hide();$('html, body').animate({scrollTop:$('#question').position().top}, 700);">Cancel</button>
                            </div>
                          </div>
                        </form>
                </section>
				</div>
		
		
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
<script type="text/javascript">
		
function addAcademic(){
   /* $('.form-academic input').val('');*/
    $('#academic-edit h4 c').text('@lang('home.AddQuestionnaire')');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
function addquestion(){
   /* $('.form-academic input').val('');*/
    $('#academic-edit h4 c').text('@lang('home.AddQuestionnaire')');
    $('#question').hide();
    $('#aquestion-edit').fadeIn();
}
$('#addMore').on("click",function(){
   $('#addoption').append('<div><input type="text" name="options[]" style="width:98%;display:inline" class="form-control" id="days"><span style="font-size:25px;cursor:pointer;" onclick="$(this).parent().remove()" class="remove">&times;</span></div>');
})

</script>
		@endsection