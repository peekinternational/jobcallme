@extends('frontend.layouts.app')

@section('title','Job Seeker')

@section('inner-header')
@include('frontend.includes.jobseeker-nav')
@endsection

@section('content')
<section id="relate-to-job" style="margin-bottom:50px">
  <div class="container">
    <div class="row">
      <!--RTJ- Left start-->
      <div class="col-md-7">
        <div class="follow-companies2" style="background:#57768a;color:#fff;">
          <!-- <ul class="nav nav-tabs"> -->
            <ul class="nav jobseeker-mbl-nav">
              <li class="active col-md-3 col-xs-7">
                <a href="#rtj_tab_suggested" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-info-circle"></i><span style="font-size:13px"> @lang('home.suggested')</span></a>
              </li>
              <li class="col-md-3 col-xs-5">
                <a href="#rtj_tab_saved" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-heart"></i><span style="font-size:13px"> @lang('home.savedjobs')</span> </a>
              </li>
              <li class="col-md-3 col-xs-7">
                <a href="#rtj_tab_application" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-file-text"></i><span style="font-size:13px"> @lang('home.APPLICATION_DASH')</span> </a>
              </li>
              <li class="col-md-3 col-xs-5">
                <a href="#rtj_tab_interview" data-toggle="tab" style="background:#57768a;color:#fff;"><i class="fa fa-calendar"></i><span style="font-size:13px"> @lang('home.interviews')</span> </a>
              </li>
            </ul>
          </div>
          <div class="rtj-box">
            <div class="tab-content">
              <div class="tab-pane active" id="rtj_tab_suggested">
                @if(count($suggested) > 0)
                @foreach($suggested as $sgJob)
                <?php
//print_r($company);exit;
                $cLogo = url('compnay-logo/default-logo.jpg');
                if($sgJob->companyLogo != ''){
                  $cLogo = url('compnay-logo/'.$sgJob->companyLogo);
                }
                ?>
                <div class="col-md-12 rtj-item" id="suggested-{{ $sgJob->jobId }}">
                  <img src="{{ $cLogo }}" style="width: 55px;">
                  <div class="rtj-details">
                    <p><strong><a href="{{ url('jobs/'.$sgJob->jobId) }}">{!! $sgJob->title !!}</a></strong></p>
                    <p>{!! $sgJob->companyName !!}</p>
                    <p>@lang('home.'.JobCallMe::cityName($sgJob->city)), @lang('home.'.JobCallMe::countryName($sgJob->country))</p>
                    <span class="rtj-action">
                      <a href="{{ url('jobs/apply/'.$sgJob->jobId) }}" title="@lang('home.Apply')">
                        <i class="fa fa-paper-plane"></i>
                      </a>&nbsp;
                      @if(in_array($sgJob->jobId, $savedJobArr))
                      <a href="javascript:;" onclick="saveJob({{ $sgJob->jobId }},this)" class="" style="margin-left: 10px;"><i class="fa fa-heart"></i></a>
                      @else
                      <a href="javascript:;" onclick="saveJob({{ $sgJob->jobId }},this)" class="" style="margin-left: 10px;"><i class="fa fa-heart"></i></a>
                      @endif
                    </span>
                  </div>
                </div>
                @endforeach
                @endif
                <div class="col-md-12">
                  <a href="{{ url('jobs') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
                </div>
              </div>
              <div class="tab-pane" id="rtj_tab_saved">
                @if(count($savedJobs) > 0)
                @foreach($savedJobs as $sJob)
                <?php 
                $cLogo = url('compnay-logo/default-logo.jpg');
                if($sJob->companyLogo != ''){
                  $cLogo = url('compnay-logo/'.$sJob->companyLogo);
                }
                ?>
                <div class="col-md-12 rtj-item" id="saved-{{ $sJob->jobId }}">
                  <img src="{{ $cLogo }}" style="width: 50px">
                  <div class="rtj-details">
                    <p><strong><a href="{{ url('jobs/'.$sJob->jobId) }}">{!! $sJob->title !!}</a></strong></p>
                    <p>{!! $sJob->companyName !!}</p>
                    <p>@lang('home.'.JobCallMe::cityName($sJob->city)), @lang('home.'.JobCallMe::countryName($sJob->country))</p>
                    <span class="rtj-action">
                      <a href="{{ url('jobs/apply/'.$sJob->jobId) }}" title="@lang('home.Apply')">
                        <i class="fa fa-paper-plane"></i>
                      </a>&nbsp;
                      <a href="javascript:;" onclick="removeJob({{ $sJob->jobId }})" title="Remove" class="application-remove">
                        <i class="fa fa-remove"></i>
                      </a>
                    </span>
                  </div>
                </div>
                @endforeach
                @else
                <p>@lang('home.Nosavedjobs')</p>
                @endif
              </div>
              <div class="tab-pane" id="rtj_tab_application">
                @if(count($application) > 0)
                @foreach($application as $appl)
                <?php 
                $cLogo = url('compnay-logo/default-logo.jpg');
                if($appl->companyLogo != ''){
                  $cLogo = url('compnay-logo/'.$appl->companyLogo);
                }
                ?>
                <div class="col-md-12 rtj-item" id="app-{{ $sJob->appl }}">
                  <img src="{{ $cLogo }}" style="width: 50px">
                  <div class="rtj-details">
                    <p><strong><a href="{{ url('jobs/'.$appl->jobId) }}">{!! $appl->title !!}</a></strong></p>
                    <p>{!! $appl->companyName !!}</p>
                    <p>@lang('home.'.JobCallMe::cityName($appl->city)), @lang('home.'.JobCallMe::countryName($appl->country))</p>
                    <span class="rtj-action">
                      <a href="javascript:;" title="Applied On">
                        {{ date('M d Y, h:i A',strtotime($appl->applyTime))}}
                      </a>
                    </span>
                  </div>
                </div>
                @endforeach
                @else
                <p>@lang('home.Nojobapplications')</p>
                @endif
              </div>
              <div class="tab-pane" id="rtj_tab_interview">
                @if(count($interview) > 0)
                @foreach($interview as $interv)
                
                <?php 
                $user=Session::get('jcmUser');
                $cLogo = url('compnay-logo/default-logo.jpg');
                if($interv->companyLogo != ''){
                  $cLogo = url('compnay-logo/'.$interv->companyLogo);
                }
                $getInterview = JobCallMe::getJobInterview($interv->jobId,$user->userId);
                $interviewUrl = url('account/jobseeker/interview/'.$getInterview->interviewId);
                ?>
                <div class="col-md-12 rtj-item">
                  <img src="{{ $cLogo }}" style="width: 50px">
                  <div class="rtj-details">
                    <p><strong><a href="{{ $interviewUrl }}">{!! $interv->title !!}</a></strong></p>
                    <p>{!! $interv->companyName !!}</p>
                    <p>@lang('home.'.JobCallMe::cityName($interv->city)), @lang('home.'.JobCallMe::countryName($interv->country))</p>
                    <span class="rtj-action">
                      <a href="javascript:;" title="Applied On">
                        {{ date('M d Y, h:i A',strtotime($interv->applyTime))}}
                      </a>
                    </span>
                  </div>
                </div>
                @endforeach
                @else
                <p>@lang('home.Nojobapplications')</p>
                @endif
              </div>
            </div>
          </div>
        </div>
        <!--RTJ- Left end-->


        <div class="col-md-5">		
          <div class="follow-companies2" style="background:#8a9fa0;color:#fff;">
            <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</span></a>
            <h4>@lang('home.ImproveCompetitiveAdvantage')</h4>	
          </div>
          <div class="suggested-reading">

            @foreach($lear_record as $rec)
            <?php
            $pImage = url('profile-photos/profile-logo.jpg');
            if($rec->upskillImage != '' && $rec->upskillImage != NULL){
              $pImage = url('upskill-images/'.$rec->upskillImage);
            }
            ?>
            <div class="col-md-12 sr-item">
              <div class="col-md-5 col-xs-12">
                <div class="suggestedreading-img-mbl">
                  <img src="{{ $pImage }}" style="width: 100%">
                </div>
              </div>
              <div class="col-md-7 col-xs-12">
                <div class="sr-details">
                  <p class="sr-title"><a href="{{ url('learn/'.strtolower($rec->type).'/'.$rec->skillId) }}">{!! $rec->title !!} </a> </p>
                  <span>@lang('home.'.$rec->type)</span><br>
                  <span style="font-size: 10px;"><i class="fa fa-calendar"></i> {{ date('Y-m-d',strtotime($rec->startDate))}}<br> <i class="fa fa-clock-o"></i> {{ JobCallMe::timeDuration($rec->startDate,$rec->endDate,'min')}}</span>
                  <br>
                  <span><i class="fa fa-map-marker"></i> @lang('home.'.JobCallMe::cityName($rec->city)), @lang('home.'.JobCallMe::countryName($rec->country))</span>
                </div>
              </div>
            </div>
            @endforeach

            <div class="col-md-12">
              <a href="{{ url('learn') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
            </div>
          </div>



          <div class="follow-companies2" style="background:#57768a;color:#fff;">
            <h4>@lang('home.companiesfollow')</h4>
          </div>
          <div class="follow-companies">
            <!-- <a href="{{ url('account/upskill/add') }}" class="pull-right"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</a> -->

            <div class="row">
              @foreach($companies as $comp)
              <?php
//print_r($company);exit;
              $cLogo = url('compnay-logo/default-logo.jpg');
              if($comp->companyLogo != ''){
                $cLogo = url('compnay-logo/'.$comp->companyLogo);
              }
              ?>
              <div class="col-md-3 col-xs-6 sp-item">

                <div class="companies-mbl-view">
                  <img src="{{ $cLogo }}" style="width:100%;">
                </div>

                <p style="height:42px"><a href="{{ url('companies/company/'.$comp->companyId) }}">{!! $comp->companyName !!}</a></p>

                @if(in_array($comp->companyId,$followArr))
                <a href="javascript:;" onclick="followCompany({{ $comp->companyId }},this)" class="btn btn-success btn-xs">@lang('home.following')</a>
                @else
                <a href="javascript:;" onclick="followCompany({{ $comp->companyId }},this)" class="btn btn-primary btn-xs">@lang('home.follow')</a>
                @endif
                <br>
                <hr>
                <p></p>
              </div>
              @endforeach
              <hr>
              <div class="col-md-12">
                <a href="{{ url('companies') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
              </div>
            </div>
          </div>



          <div class="follow-companies2" style="background:#605e63;color:#fff;">
            <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.write')</span></a>
            <h4>@lang('home.suggestedreading')</h4>
          </div>
          <div class="suggested-reading">

            @foreach($read_record as $rec)
            <?php
            $pImage = url('profile-photos/profile-logo.jpg');
            if($rec->wIcon != '' && $rec->wIcon != NULL){
              $pImage = url('article-images/'.$rec->wIcon);
            }
            ?>
            <div class="col-md-12 sr-item">
              <div class="col-md-5 col-xs-12">
                <div class="suggestedreading-img-mbl">
                  <img src="{{ $pImage }}" style="width: 100%;">
                </div>
              </div>
              <div class="col-md-7 col-xs-12">
                <div class="sr-details">
                  <p class="sr-title"><a href="{{ url('read/article/'.$rec->writingId) }}" style="text-overflow: ellipsis;">{!! $rec->title !!} </a> </p>
                  <p class="sr-author"><a href="#"><span class="glyphicon glyphicon-user"></span> @lang('home.read_writer') <span style="color:#337ab7">{{ $rec->firstName.' '.$rec->lastName }}</span></a> </p>
                </div>
              </div>
            </div>
            @endforeach

            <div class="col-md-12">
              <a href="{{ url('read') }}" class="pull-right" style="padding-top: 5px">@lang('home.viewall')</a>
            </div>
          </div>










        </div>
      </div>
    </section>
    @endsection
    @section('page-footer')
    <script type="text/javascript">
      function saveJob(jobId,obj){
        if($(obj).hasClass('btn-default')){
          var type = 'save';
        }else{
          var type = 'remove';
        }
        $.ajax({
          url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type,
          success: function(response){
            if($.trim(response) == 'redirect'){
              window.location.href = "{{ url('account/login?next='.Request::route()->uri) }}";
            }else if($.trim(response) == 'done'){
              if($(obj).hasClass('btn-default')){
                $(obj).removeClass('btn-default');
                $(obj).addClass('btn-success');
                $(obj).html('<i class="fa fa-heart"></i>');
              }else{
                $(obj).removeClass('btn-success');
                $(obj).addClass('btn-default');
                $(obj).html('<i class="fa fa-heart"></i>');
              }
            }
          }
        })
      }
      function appendtoken(){
        $('#fpi_content form input[type="hidden"]').remove();
        $('#fpi_content form').append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
      };
      function removeJob(jobId){
        var type = 'remove';
        $('#saved-'+jobId).remove();
        $.ajax({ url: "{{ url('account/jobseeker/job/action') }}?jobId="+jobId+"&type="+type });
      }
      function followCompany(companyId,obj){
        if($(obj).hasClass('btn-primary')){
          var type = 'follow';
        }else{
          var type = 'remove';
        }
        if($(obj).hasClass('btn-primary')){
          $(obj).removeClass('btn-primary');
          $(obj).addClass('btn-success');
          $(obj).text('@lang("home.following")');
        }else{
          $(obj).removeClass('btn-success');
          $(obj).addClass('btn-primary');
          $(obj).text('@lang("home.follow")');
        }
        $.ajax({
          url: "{{ url('account/jobseeker/company/action') }}?companyId="+companyId+"&type="+type,
          success: function(response){
            if($.trim(response) == 'redirect'){
              window.location.href = "{{ url('account/login?next=companies/company/'.Request()->segment(3)) }}";
            }else if($.trim(response) == 'done'){
            }
          }
        })
      }
    </script>
    @endsection