@extends('frontend.layouts.app')

@section('title', "$record->title")

@section('content')
<!--Read Articles-->
<section id="postNewJob">
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
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td class="active" width="150px">@lang('home.organiser')</td>
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
                        <td class="active">@lang('home.duration')</td>
                        <td>{{ JobCallMe::timeDuration($record->startDate,$record->endDate )}}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.cost')</td>
                        <td>{{ $record->currency.' '.number_format($record->cost)}}/-</td>
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
                        <td class="active">@lang('home.website')</td>
                        <td>{{ $record->website }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.social')</td>
                        <td>
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
                <h3>@lang('home.schedule')</h3>
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
                <h3><span style="padding-left:20px">@lang('home.details')</span></h3>
                <p>{!! $record->description !!}</p></td></tr></table>
                 <div class="ra-author-box">
                                <img src="{{ url('compnay-logo/'.$record->companyLogo) }}" class="img-circle" alt="{{ $record->companyName }}">
                                <div class="ra-author">
                                    <a href="{{ url('companies/company/'.$record->companyId) }}">{{ $record->companyName}}</a><br>
                                    <span>@if(app()->getLocale() == "kr")
														{{ date('Y-m-d',strtotime($record->createdTime))}}
													@else
														{{ date('M d, Y',strtotime($record->createdTime))}}
													@endif</span>
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
				      <div class="col-md-4 sp-item">
                        @if($rec->upskillImage != '')
                        <img class=" img-responsive sp-item" src="{{ url('upskill-images/'.$rec->upskillImage) }}" alt="" style="width: 180px;height:80px;">
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