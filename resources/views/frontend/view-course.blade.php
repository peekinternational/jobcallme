@extends('frontend.layouts.app')

@section('title', "$record->title")
<?php $courrent=Request::url(); ?>
@section('content')
<!--Read Articles-->
<section id="postNewJob">
    <div id="app"></div>
    <div class="container">
        <div class="col-md-9">
            <div class="ld-left">
                @if($record->upskillImage != '')
                <div class="ld-thumbnail">
                    <img src="{{ url('upskill-images/'.$record->upskillImage)}}">
                </div>
                @endif
                <h3>{{ $record->title }} @lang('home.'.ucfirst($record->type)) - <!-- in --> @lang('home.'.JobCallMe::cityName($record->city)), @lang('home.'.JobCallMe::countryName($record->country))</h3>
                <div class="jd-share-btn">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}">
                        <i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}&title=&summary=&source=">
                        <i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}">
                        <i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}">
                        <i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                    </a>
					 <img src="{{asset('website/talksns.png')}}" onclick="OpenWindow('{{ rawurlencode($courrent) }}')" style="width: 25px !important;border-radius: 50px; cursor: pointer;">
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td class="active" width="100px">@lang('home.organiser')</td>
                        <td>{{ $record->organiser != '' ?  $record->organiser : JobCallMe::userName($record->userId) }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.startingon')</td>
                        <td>@if(app()->getLocale() == "kr")
						    {{ date('Y-m-d',strtotime($record->startDate))}}
						@else
						    {{ date('d F, Y',strtotime($record->startDate))}}
						@endif </td>
                    </tr>
					<tr>
                        <td class="active">@lang('home.edate')</td>
                        <td>@if(app()->getLocale() == "kr")
						    {{ date('Y-m-d',strtotime($record->endDate))}}
						@else
						    {{ date('d F, Y',strtotime($record->endDate))}}
						@endif  </td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.duration')</td>
                        <td>{{ JobCallMe::timeDuration($record->startDate,$record->endDate )}}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.cost')</td>
                        <td>
							@if($rec->accommodation == "Yes") {{ $record->currency.' '.number_format($record->cost)}} @else @if($record->accommodation == "on") @lang('home.free') @else @if($record->website)<a href="{!! $record->website !!}" target="_blank">@endif @lang('home.Contact person') @endif @endif
							
							<!-- {{ $record->currency.' '.number_format($record->cost)}} --></td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.contactperson')</td>
                        <td>{{ $record->contact }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.phone')</td>
                        <td>{{ $record->phone }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.mobile')</td>
                        <td>{{ $record->mobile }}</td>
                    </tr>
                    
                    <tr>
                        <td class="active">@lang('home.social')</td>
                        <td>
                            <div class="jd-share-btn">
                            <a  href="javascript: void(0)" onClick="window.open('https://www.facebook.com/dialog/share?app_id=377749349357447&display=page&href=https%3A%2F%2Fwww.jobcallme.com%2Flearn%2F<?php echo strtolower($record->type); ?>%2F<?php echo $record->skillId; ?>%2F&redirect_uri=https%3A%2F%2Fwww.jobcallme.com');return false;">
                            
                        <i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}&title=&summary=&source=">
                        <i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}">
                        <i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url={{ url('learn/'.strtolower($record->type).'/'.$record->skillId) }}">
                        <i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                    </a>
					<img src="{{asset('website/talksns.png')}}" onclick="OpenWindow('{{ rawurlencode($courrent) }}')" style="width: 25px !important;border-radius: 50px; cursor: pointer;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.postedon')</td>
                        <td>@if(app()->getLocale() == "kr")
						    {{ date('Y-m-d',strtotime($record->createdTime)) }}
						@else
						    {{ date('d F, Y',strtotime($record->createdTime)) }}
						@endif</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.venue')</td>
                        <td>{{ $record->address }} , @lang('home.'.JobCallMe::cityName($record->city))</td>
                    </tr>
                </table>

				<h4>@lang('home.website')</h4>
                <table class="table">
                   
                           <tr>
                               <th class="la-text"><a href="{!! $record->website !!}" target="_blank">{!! $record->website !!}</a></th>
                            
                           </tr>
                        
                </table>

				
				<h4>@lang('home.CostofDescription')</h4>
                <table class="table">
                   
                           <tr>
                               <th class="la-text">{!! nl2br($record->costdescription) !!}</th>
                            
                           </tr>
                        
                </table>
                <h4>@lang('home.schedule')</h4>
                <table class="table">
                    <?php
                    $opHour = @json_decode($record->timing,true);
                    $aArr = array('mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');
                    foreach($opHour as $i => $z){
                        if($z['from'] != '' || $z['to'] != ''){
                            echo '<tr>';
                                echo '<th>'.trans('home.'.$aArr[$i]).'</th>';
                                echo '<td>'.$z['from'].' - '.$z['to'].'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
				<table class="table">
					<tr>
					  <td>
                <h4><span style="padding-left:20px">@lang('home.details')</span></h4>
                <p>{!! $record->description !!}</p></td></tr></table>


				<table class="table">
					<tr>
					  <td>
                <h4><span style="padding-left:20px;padding-bottom:20px;">@lang('home.hoteldetails')</span></h4>     
				<div class="col-md-6" style="padding-top:10px">

					<ins class="bookingaff" data-aid="1595960" data-target_aid="1595960" data-prod="nsb" data-width="100%" data-height="auto" data-lang="ualng">
    <!-- Anything inside will go away once widget is loaded. -->
    <a href="//www.booking.com?aid=1595960">Booking.com</a>
</ins>
<script type="text/javascript">
    (function(d, sc, u) {
      var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];
      s.type = 'text/javascript';
      s.async = true;
      s.src = u + '?v=' + (+new Date());
      p.parentNode.insertBefore(s,p);
      })(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');
</script>

				</div>
				<div id="hellodear">
				@foreach($upskill_hotel as $uphotel)
					<?php
						$hotel_img = explode("H", $uphotel->ImageLocal);
						$hotel_linkurl = explode("?", $uphotel->HotelUrl);
						$hotel_url_link = $hotel_linkurl[0].'?aid=1595934;'.$hotel_linkurl[1];
					?>
					<div class="col-md-6" style="padding-top:10px;">
							<?php
							$is_file_exist = file_exists('upskill-images/H'.$hotel_img[1]);

						    if ($is_file_exist) {
							  $hotelLogo = url('upskill-images/H'.$hotel_img[1]);
						    }else{
							  $hotelLogo = url('upskill-images/hotel_Logo.jpg');
							}		
							?>
						
							<a href="{!! $hotel_url_link !!}" target="_blank"><img src="{{ $hotelLogo }}" style="width: 70px;height:auto !important;border-radius: 5px;"></a>
						
				
				&nbsp;&nbsp;<a href="{!! $hotel_url_link !!}" target="_blank">{!! $uphotel->HotelName !!}</a></div>
				@endforeach
				</div>
				</td></tr></table>

<div style="text-align:center;" id="hello"><div style="margin-bottom:-15px;color:#337ab7;">@lang('home.hotelpage')</div><?php echo $upskill_hotel->render(); ?></div>
				


<div class="row">
                    <div class="col-md-12">
                <div class="ra-author-box">
                    <form id="{{ $record->skillId }}">
                    <img src="{{ url('compnay-logo/'.$record->companyLogo) }}" class="img-circle" alt="{{ $record->companyName }}">
                    <div class="ra-author">
                        <a href="{{ url('companies/company/'.$record->companyId) }}">{{ $record->companyName}}</a><br>
                        <span>
                            @if(app()->getLocale() == "kr")
								{{ date('Y-m-d',strtotime($record->createdTime))}}
							@else
								{{ date('M d, Y',strtotime($record->createdTime))}}
							@endif
                        </span>
                        <span class="pull-right"><i class="like fa fa-heart <?php echo JOBCALLME::getUserLikes( $record->skillId,Session::get('jcmUser')->userId,'jcm_upskills' ) ?>"></i> <i class="total-likes"><?php echo JOBCALLME::getReadlikes($record->skillId,'jcm_upskills')?></i>
                        </span>
                    </div>
                    <input type="hidden" class="post_id" value="{{ $record->skillId }}">
                    <input type="hidden" class="userId" value="{{  Session::get('jcmUser')->userId }}">
                </form>
                </div>
</div>      
                </div>

                <div class="row">
                     <div class="col-md-12">
                        <hr>
                        <div class="review-header">
							<span class="bell">
								<i class="fa fa-bell fa-3x"></i>
								<span class="badge bell-badge">{{ count($comments) }}</span>
							</span>
							<span class="pull-right"><button onclick="changebtns(this)"  class="btn btn-primary" style="box-shadow: 0px 1px 13px rgba(0,0,0,0.5)">@lang('home.open review') <i class="fa fa-plus"></i> </button></span>
							
						</div>
                        <br>
                        <div id="show_reviews" style="display:none">
                        <div class="row">
                            <div class="" id="put-comments">
                                @foreach($comments as $comment)
                                <?php  if($comment->nickName == null){
                                        $username = $comment->firstName;
                                    }
                                    else{
                                    $username = $comment->nickName;
                                    } 

                                    if($comment->chatImage){
                                        $userimage = $comment->chatImage;
                                    }
                                    else{
										if($comment->profilePhoto){
											$userimage = $comment->profilePhoto;
										}
										else{
											$userimage = "profile-logo3-1.jpg";
										} 
									//$userimage = $comment->profileImage;
                                    } 

                                    ?>

                                <div class="row" id="{{$comment->comment_id}}">
                                    <div class="col-md-12">
                                        <div class="comment-area">
                                            <div class="col-md-1 col-xs-3">
                                                <img src="{{ url('profile-photos').'/'.$userimage }}" class="img-circle fullwidth" alt="{{ $comment->firstName }}" style="width:80%;">
                                               
                                            </div>
                                            <div class="col-md-9 col-xs-7 append-edit" style="padding:0;">
                                             <a href="{{url('account/employer/application/applicant/'.$comment->userId)}}">{{ $username }}</a> <span style="color: #999999;font-size: 10px;">{{ $comment->comment_date}}</span>
                                                <p style="padding: 5px;min-height: 50px;">{{ $comment->comment}}</p>

                                            </div>
                                            @if($comment->commenter_id == Session::get('jcmUser')->userId)
                                            <div class="col-md-2 col-xs-2" style="padding:0;">
                                                <div class="btns">
                                                <i class="fa fa-edit edit-comment-btn"></i>
                                                <i delcommentId="{{ $comment->comment_id}}" class="fa fa-trash del-comment-btn" aria-hidden="true"></i>
                                                    
                                                </div>
                                                <div class="btns-update" style="display: none">
                                                    <button commentId="{{ $comment->comment_id}}" class="btn btn-success update-comment-btn">@lang('home.reviewupdate')</button>
                                                    <button class="btn btn-danger cancel">@lang('home.Cancel')</button>
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
                                <?php 
                                  if(Session::get('jcmUser')->chatImage){
                                        $userimages = Session::get('jcmUser')->chatImage;
                                    }
                                    else{
										if(Session::get('jcmUser')->profilePhoto){
											$userimages = Session::get('jcmUser')->profilePhoto;
										}
										else{
											$userimages = "profile-logo3-1.jpg";
										} 
									//$userimages = Session::get('jcmUser')->profilePhoto;
                                    } 

                                    ?>
                                    <div class="comment-box">
                                        <div class="col-md-1 col-xs-3">
                                            <img src="{{ url('profile-photos').'/'.$userimages }}" class="img-circle fullwidth" alt="{{ Session::get('jcmUser')->firstName }}">
                                        </div>
                                        <div class="col-md-9 col-xs-9" style="padding:0px;">
                                            

											<div class="form-group">
                                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                            </div> 

											<p style="color: #999999;"><img src="/frontend-assets/images/video_icon2.png"> @lang('home.Need more dicuss, use Jobcallme live MultiㆍGroupㆍIndividual Video & Chat')&nbsp;<a href="/messages"><img src="/frontend-assets/images/video_icon.png">@lang('home.videochatlink')</a></p>
                                              
                                        </div>

                                        <div class="col-md-2 col-xs-offset-8" style="padding-top: 5px;"><button class="btn btn-success" id="comment-btn">@lang('home.reviewsubmit')</button></div>



                                    </div>    
                                </div>
                            </div>                
                                                    
                    </div>
                               
                                                    
                    </div>
                </div>
            </div>



			<div class="row">
                     <div class="col-md-12">
						
						<div style="position: relative;
                                    overflow: auto;
                                    padding: 10px 20px;
                                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                                    border: 1px solid #cccccc;
                                    margin-bottom: 20px;
                                    background: #ffffff;">
                   
			
					
						<input id="pac-input" class="controls" type="hidden" value="{!! $record->address !!}" >							
					
					  
                    <!-- google map code html -->
                    <div id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                    </div>
        
		
			</div>



             
        </div>
        <div class="col-md-3">
            <div class="ld-right">
			<h5 style="text-align:center">@lang('home.You Might Be Interested In')</h5>
			<div class="row">
				            @foreach($Qry as $rec)
                   
                      <div class="la-item">
				      <div class="col-md-4 suggestedreading-img-mbl">
                        @if($rec->upskillImage != '')
                        <!-- <img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 100%;height:auto !important;"> -->
						<img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 100%;height:35% !important;">
                        @else
                        <img src="{{ url('upskill-images/d-cover.jpg') }}" style="width: 180px;height:80px;">
                        @endif
						</div>
                        <div class="col-md-8" style="margin-top: 34px;">
                            <p> <a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}" class="la-title">{!! $rec->title !!}</a></p>
                            
                            <span>@lang('home.'.$rec->type)</span>
                            <p><i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($rec->startDate))}} <i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</p>
                            
                            <span><i class="fa fa-map-marker"></i> @lang('home.'.JobCallMe::cityName($rec->city)), @lang('home.'.JobCallMe::countryName($rec->country))</span>
                            
                       </div>
                   </div>
                
            @endforeach
                    </div>
            </div>
        </div>
    </div>
<script type="text/custom-template" id="edit">
    <div class="form-group">
        <textarea name="comment" id="comment-edit" class="form-control" rows="3"></textarea>
    </div>
</script>
</section>
<script src="{{ asset('js/app.js')}}"></script>
@endsection
@section('page-footer')
<script type="text/javascript">
/*comment code start*/
  $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        var page = $(this).attr('href').split('page=')[1];  
       //alert(page);
       getCource(page)
    });
     function getCource(page) {
         location.hash=page;
         
        $.ajax({
            url : jsUrl()+'/cource?page='+page,
            
        }).done(function (data) {
           console.log(data+"jjshfhsfasfasf");
		   $('#hellodear').html(data);
		   $('#hello').hide();
            
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }

function changebtns(current){
    if($(current).hasClass('btn-primary')){
        $(current).removeClass('btn-primary').addClass('btn-danger');
        $(current).html('@lang("home.close review") <i class="fa fa-minus"></i>');
        $('#show_reviews').show();
    }else{
        $(current).removeClass('btn-danger').addClass('btn-primary');
        $(current).html('@lang("home.open review") <i class="fa fa-plus"></i>');
         $('#show_reviews').hide();
    }
}
   function OpenWindow(url, windowName) {

   newwindow = window.open('https://www.talksns.com/sharer?url=' + encodeURIComponent(url.trim()), windowName, 'height=600,width=800');

   if (window.focus) {
      newwindow.focus();
   }
   return false;
}
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
               data:{table_name:"learn",comment:comment,post_id:{{ $record->skillId }},_token:jsCsrfToken(),commenter_id:commenter_id,type:"insert"},
               success:function(res){
                var obj = jQuery.parseJSON(res)
                $('#'+obj.comment_id).find('.comment-area').append(obj.temp);
                $('#comment').val('');
               }
           }) 

        }
    })
    $(document).on("click",".del-comment-btn",function(){
       var comment_id = $(this).attr('delcommentId');
        if (confirm("@lang('home.Are you sure to delete?')")) {
             $.ajax({
               url:jsUrl()+"/read/article/comment/save",
               type:"post",
               data:{table_name:"learn",post_id:{{ $record->skillId }},_token:jsCsrfToken(),comment_id:comment_id,type:"delete"},
               success:function(res){
                   
               }
            }) 
          } else {
              
        }
    })
    $(document).on("click",".update-comment-btn",function(){
         var comment_id = 0;
        var comment = $('#comment-edit').val();
        comment_id = $(this).attr('commentId');
        var current = $(this);
       
        $.ajax({
            url:jsUrl()+"/read/article/comment/save",
            type:"post",
            data:{table_name:"learn",comment:comment,post_id:{{ $record->skillId }},comment_id:comment_id,_token:jsCsrfToken(),type:'edit'},
            success:function(res){
                $(current).closest('.row').remove();
                var obj = jQuery.parseJSON(res)
                $('#'+obj.comment_id).find('.comment-area').append(obj.temp);
            }
        })
    })

/*comment js code end*/
//$('i.fa').hover(function () {
    //$(this).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    //function () {
        //$(this).removeClass('animated bounceIn');
    //});
//});
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
            data:{parent_table:"jcm_upskills",post_id:post_id,user_id:userId,_token:"{{ csrf_token() }}"},
            success:function(res){

            }
        });
    });
</script>


<script>
$(document).ready(function(){
 
});
  
 
    var addr=$('#pac-input').val();
        
   


      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
               var geocoder = new google.maps.Geocoder();
               var address = addr;
               var longitude="";
               var latitude="";
               var myLatLng="";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
        latitude = results[0].geometry.location.lat();
        longitude = results[0].geometry.location.lng();
         myLatLng={lat: latitude, lng: longitude}
    //alert(latitude);
     var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: latitude, lng: longitude},
          zoom: 16,
          mapTypeId: 'roadmap'
        });

  } 
   var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: addr
        });
});
     
      }
    
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1RaWWrKsEf2xeBjiZ5hk1gannqeFxMmw&libraries=places&callback=initAutocomplete" async defer></script>


@endsection