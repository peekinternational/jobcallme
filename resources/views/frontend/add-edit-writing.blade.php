@extends('frontend.layouts.app')

@section('title', 'Writing')

@section('content')
<section id="postNewJob">
    <div class="container">
        <div class="col-md-9">
            <div class="pnj-box">
                <form id="pnj-form" action="" method="post" class="writing-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="prevIcon" value="{{ $article->wIcon }}">
                    <input type="hidden" name="writingId" value="{{ $article->writingId }}">
                    <h3>@lang('home.warticle')</h3>
                    

					


					<div class="pnj-form-section">
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.title')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="text" class="form-control" name="title" id="title" placeholder="@lang('home.title')" required="" value="{{ $article->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.tags')</label>
                            <div class="col-sm-9 pnj-form-field">
                               <select class="form-control" id="readcat" multiple name="category[]" required="">
                                    <option value="">@lang('home.s_type')</option>
                                    @foreach(JobCallMe::getReadCategories() as $cat)
                                        <option value="{{ $cat->id }}">@lang('home.'.$cat->name)</option>
                                    @endforeach
                                </select>
								
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.description')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="description" class="form-control tex-editor">{{ $article->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.citation')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <textarea name="citation" class="form-control" placeholder="@lang('home.citation')" required="" rows="6">{{ $article->citation }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <input type="file" name="articleImage" class="form-control">
                            </div>
                        </div>
                        @if($article->wIcon != '')
                        <div class="form-group">
                            <label class="control-label col-sm-3">&nbsp;</label>
                            <div class="col-sm-9 pnj-form-field">
                                <span style="background-color: #f8f8f8;padding: 10px;text-align: center;display: block;">
                                    <img src="{{ url('article-images/'.$article->wIcon) }}" alt="" style="max-width: 200px;">
                                </span>
                            </div>
                        </div>
                        @endif

						<div class="form-group">
                            <label class="control-label col-sm-3">@lang('home.adduration')</label>
                            <div class="col-sm-9 pnj-form-field">
                                <select class="form-control" name="adduration">
                                    <?for($i=3; $i<31; $i++){?>
                                        <option value="{!! $i !!}">{!! $i !!}@lang('home.adday')</option>
                                    <?}?>
                               </select>
								
                            </div>
                        </div>

                    </div>

					<div class="col-md-offset-2 col-md-3  pnj-btns">
                        <span style="font-size:17px;padding-right:50px;">@lang('home.TotalAmount') : US$ </span>						
                    </div>

                    <div class="col-md-6  pnj-btns">
                        <button type="submit" class="btn btn-primary" name="publis" onclick="saveOption('p')">@lang('home.publish')</button>
                        <button type="submit" class="btn btn-default" name="draft" onclick="saveOption('d')">@lang('home.draft')</button>
                        <a href="{{ url('account/writings') }}" class="btn btn-default">@lang('home.cancel')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
@section('page-footer')
<style type="text/css">
input[type="file"] {
    padding: 0;
}
.text-danger{color: #ff0000 !important;}
</style>
<script type="text/javascript">
$(document).ready(function(){
    $('#readcat').select2();
});
tinymce.init({
    selector: '.tex-editor',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    },
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify bullist numlist outdent indent | link'
});
var isARunning = false;
var svOption = 'Publish';
function saveOption(op){
    if(op == 'd'){
        svOption = 'Draft';
    }else{
        svOption = 'Publish';
    }
}
$('form.writing-form').submit(function(e){
    if(isARunning == true){
        return false;
    }
    isARunning = true;
    var formData = new FormData($(this)[0]);
    $('.writing-form .text-danger').remove();
    $('.writing-form button[type="submit"]').prop('disabled',true);
    $.ajax({
        url: window.location.href+'?option='+svOption,
        type: 'POST',
        data: formData,
        async: false,
        success: function(response) {
            console.log(response);
            isARunning = false;
            toastr.success('Article successfully saved', '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            window.location.href = "{{ url('account/writings') }}";
            $('.writing-form button[type="submit"]').prop('disabled',false);
        },
        error: function(data){
            isARunning = false;
            var errors = data.responseJSON;
            var j = 1;
            var vError = '';
            $.each(errors, function(i,k){
                var vParent = $('.writing-form input[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');

                var vParent = $('.writing-form select[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                
                var vParent = $('.writing-form textarea[name="'+i+'"]').parent();
                vParent.append('<p class="text-danger">'+k+'</p>');
                if(j == 1){
                    vError = k;
                }
                j++;
            });
            toastr.error(vError, '', {timeOut: 5000, positionClass: "toast-bottom-center"});
            $('.writing-form button[type="submit"]').prop('disabled',false);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    e.preventDefault();
})
</script>
@endsection