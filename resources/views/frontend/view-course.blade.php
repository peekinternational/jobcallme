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
                <h3>{{ $record->title.' '.ucfirst($record->type).' in '.JobCallMe::cityName($record->city).', '.JobCallMe::countryName($record->country) }}</h3>
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
                        <td class="active">@lang('home.organizer')</td>
                        <td>{{ $record->organiser != '' ?  $record->organiser : JobCallMe::userName($record->userId) }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.startingon')</td>
                        <td>{{ date('d F, Y',strtotime($record->startDate))}}</td>
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
                        <td>{{ date('d F, Y',strtotime($record->createdTime)) }}</td>
                    </tr>
                    <tr>
                        <td class="active">@lang('home.venue')</td>
                        <td>{{ $record->address }} , {{ JobCallMe::cityName($record->city) }}</td>
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
                                echo '<th>'.$aArr[$i].'</th>';
                                echo '<td>'.$z['from'].' - '.$z['to'].'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
                <h3>@lang('home.details')</h3>
                <p>{!! $record->description !!}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="ld-right">
			<h5 style="text-align:center">You Might Be Interested In</h5>
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
                            
                            <span><i class="fa fa-map-marker"></i> {{ JobCallMe::cityName($rec->city) }},{{ JobCallMe::countryName($rec->country) }}</span>
                            
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