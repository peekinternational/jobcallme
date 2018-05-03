@extends('frontend.layouts.app')

@section('title', "$record->title")

@section('content')
<!--Read Articles-->
<section id="postNewJob">
    <div class="container">
        <div class="col-md-9">
            <div class="ld-left">
                <div class="ld-thumbnail">
                    <img src="{{ url('article-images/'.$record->wIcon) }}">
                </div>
                <h3>{!! $record->title !!}</h3>
                <div class="col-md-6 article-type">
                    {{ $record->name }}
                </div>
                <div class="col-md-6">
                    <div class="jd-share-btn pull-right">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('read/article/'.$record->writingId ) }}&title=&summary=&source=">
                            <i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                        </a>
                        <a href="https://twitter.com/home?status={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                        </a>
                        <a href="https://plus.google.com/share?url={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                        </a>
                    </div>
                </div>
                <div>{!! $record->description !!}</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rd-author">
                            <form id="{{ $record->writingId }}">
                                <img src="{{ url('profile-photos/'.$record->profilePhoto) }}" class="img-circle" alt="{{ $record->firstName }}">
                                <div class="rd-author-details" style="width: 90%">
                                    <h5><a href="{{ url('account/employer/application/applicant/'.$record->userId) }}">{{ $record->firstName.' '.$record->lastName }}</a></h5>
                                    <span>@if(app()->getLocale() == "kr")
                                        {{ date('Y-m-d',strtotime($record->createdTime))}}
                                    @else
                                        {{ date('M d, Y',strtotime($record->createdTime))}}
                                    @endif</span>
                                    <span class="pull-right"><i class="like fa fa-heart <?php echo JobCallMe::getUserLikes( $record->writingId,Session::get('jcmUser')->userId,'read' ) ?>"></i> <i class="total-likes"><?php echo JobCallMe::getReadlikes($record->writingId,'read')?></i>
                                    </span>
                                </div>
                                <input type="hidden" class="post_id" value="{{ $record->writingId}}">
                                <input type="hidden" class="userId" value="{{  Session::get('jcmUser')->userId }}">
                            </form>
                        </div>
                    </div>      
                </div>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="row">
                            <div class="col-md-12" id="put-comments">
                                @foreach($comments as $comment)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="comment-area">
                                            <div class="col-md-1">
                                                <img src="{{ url('profile-photos').'/'.$comment->profilePhoto }}" class="fullwidth img-circle" alt="{{ $comment->firstName }}">
                                            </div>
                                            <div class="col-md-9 append-edit">
                                                <p style="border:1px solid #ccc;padding: 5px;min-height: 50px;">{{ $comment->comment}}</p>

                                            </div>
                                            @if($comment->commenter_id == Session::get('jcmUser')->userId)
                                            <div class="col-md-2">
                                                <div class="btns">
                                                    <button class="btn btn-warning edit-comment-btn">Edit</button>
                                                    <button delcommentId="{{ $comment->comment_id}}" class="btn btn-danger del-comment-btn">Delete</button>
                                                </div>
                                                <div class="btns-update" style="display: none">
                                                    <button commentId="{{ $comment->comment_id}}" class="btn btn-success update-comment-btn">Update</button>
                                                    <button class="btn btn-danger cancel">Cancel</button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                    <div class="comment-box">
                                        <div class="col-md-1">
                                            <img src="{{ url('profile-photos').'/'.Sajid::getprofilepic() }}" class="img-circle fullwidth" alt="{{ $record->firstName }}">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                            </div>    
                                        </div>
                                        <div class="col-md-2" style="padding-top: 15px;"><button class="btn btn-success" id="comment-btn">Submit</button></div>
                                    </div>    
                                </div>
                            </div>                
                                                    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ld-right">
			<h5>You May Also Like</h5>
			   @foreach($Qry as $rec)
					   <?php
                        
                        if($rec->wIcon != '' && $rec->wIcon != NULL){
                            $pImage = url('article-images/'.$rec->wIcon);
                        }
						else{
							$pImage = url('profile-photos/profile-1516811529-515092.png');
						}
                        ?>
                    <div class="col-md-12 sr-item">
					 <div class="col-md-4">
                        <img src="{{ $pImage }}" style="width: 100%;height:70px;">
						</div>
						 <div class="col-md-8" style="padding-top:10px">
                        <div class="sr-details">
                            <p class="sr-title"><a href="{{ url('read/article/'.$rec->writingId ) }}">{!! $rec->title !!} </a> </p>
                            <p class="sr-author"><a href="{{ url('read/article/'.$rec->writingId ) }}"><span class="glyphicon glyphicon-user"></span>@lang('home.read_writer') <span style="color:#337ab7">{{ $rec->firstName.' '.$rec->lastName }}</a> </p>
                        </div>
						</div>
                    </div>
					   @endforeach
                
            </div>
        </div>
    </div>
<script type="text/custom-template" id="edit">
    <div class="form-group">
        <textarea name="comment" id="comment-edit" class="form-control" rows="3"></textarea>
    </div>
</script>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
    setInterval(function(){ 
        $.ajax({
            url:jsUrl()+"/read/article/comment/save",
            type:"post",
            data:{_token:jsCsrfToken(),post_id:{{ $record->writingId }},table_name:"read"},
            success:function(res){
                $('#put-comments').html(res);
            }
        })

    }, 60000);
    $(document).on("click",".edit-comment-btn",function(){
        $('.btns').show();
        $('.btns-update').hide();
        $('.append-edit p').show();
        $('#comment-edit').remove();
        var text = $(this).closest('.comment-area').find('.append-edit p').text();
        $(this).closest('.comment-area').find('.append-edit').append($('#edit').html());
        $(this).closest('.comment-area').find('#comment-edit').val($.trim(text));
        $(this).closest('.comment-area').find('#comment-edit').parent().siblings().hide();
        $(this).closest('.comment-area').find('.btns').hide();
        $(this).closest('.comment-area').find('.btns-update').show();

    })
    $(document).on("click",".cancel",function(){
        $('.append-edit p').show();
        $('#comment-edit').remove();
        $(this).closest('.comment-area').find('.btns').show();
        $(this).closest('.comment-area').find('.btns-update').hide();

    })
    $(document).on("click","#comment-btn",function(){
        var check = "{{ Session::get('jcmUser')->userId }}";
        if(check == ''){
            window.location.href=jsUrl()+"/account/login";
        }else{
           var comment = $('#comment').val();
           var commenter_id ="{{Session::get('jcmUser')->userId}}";
           $.ajax({
               url:jsUrl()+"/read/article/comment/save",
               type:"post",
               data:{table_name:"read",comment:comment,post_id:{{ $record->writingId }},_token:jsCsrfToken(),commenter_id:commenter_id},
               success:function(res){
                   $('#put-comments').html(res);
               }
           }) 
        }
    })
    $(document).on("click",".del-comment-btn",function(){
       var comment_id = $(this).attr('delcommentId');
        if (confirm("Are you sure to delete!")) {
             $.ajax({
               url:jsUrl()+"/read/article/comment/delete",
               type:"post",
               data:{post_id:{{ $record->writingId }},_token:jsCsrfToken(),comment_id:comment_id},
               success:function(res){
                   $('#put-comments').html(res);
               }
            }) 
          } else {
              
        }
    })
    $(document).on("click",".update-comment-btn",function(){
         var comment_id = 0;
        var comment = $('#comment-edit').val();
        comment_id = $(this).attr('commentId');
       
        $.ajax({
            url:jsUrl()+"/read/article/comment/save",
            type:"post",
            data:{table_name:"read",comment:comment,post_id:{{ $record->writingId }},comment_id:comment_id,_token:jsCsrfToken()},
            success:function(res){
                $('#put-comments').html(res);
            }
        })
    })
$('i.fa').hover(function () {
    $(this).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function () {
        $(this).removeClass('animated bounceIn');
    });
});
$('.like').on('click',function(){
    var id = '#'+$(this).closest('form').attr('id');
    var type = "like";
    if($(this).hasClass('fa-red')){
        $(this).removeClass('fa-red');
        var likes = $(id+' .total-likes').text();
        likes = +likes - 1;
        $(id+' .total-likes').text(likes);
        type = "dislike";
    }else{
        $(this).addClass('fa-red');
        var likes = $(id+' .total-likes').text();
        likes = +likes + 1;
        $(id+' .total-likes').text(likes);
    }
    var post_id = $(id+' .post_id').val();
    var userId = $(id+' .userId').val();
    
    $.ajax({
        url:jsUrl()+"/read/likes/"+type,
        type:"post",
        data:{parent_table:"read",post_id:post_id,user_id:userId,_token:"{{ csrf_token() }}"},
        success:function(res){

        }
    });
});
</script>
@endsection