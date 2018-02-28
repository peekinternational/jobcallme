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
                    <img src="{{ url('profile-photos/'.$record->profilePhoto) }}" class="img-circle" alt="{{ $record->firstName }}">
                    <div class="rd-author-details">
                        <h5><a href="{{ url('people/profile/'.$record->userId) }}">{{ $record->firstName.' '.$record->lastName }}</a><h5>
                        <span>{{ date('M d, Y',strtotime($record->createdTime))}}</span>
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
                            <p class="sr-author"><a href="#"><span class="glyphicon glyphicon-user"></span> @lang('home.'.$rec->name)</a> </p>
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
</script>
@endsection