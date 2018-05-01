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
                <div class="row">
                    <div class="col-md-12">
                        <div id="disqus_thread"></div>
                        <script>

                        /**
                        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        
                        var disqus_config = function () {
                        this.page.url = '{{Request::url()}}';  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = {{$writingId}}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        
                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://jobcallme-com.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                                    
                                                    
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
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
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