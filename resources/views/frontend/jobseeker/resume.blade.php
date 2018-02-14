@extends('frontend.layouts.app')

@section('title','Job Seeker')

@section('content')
<?php
$userImage = url('profile-photos/profile-logo.jpg');
if($user->profilePhoto != ''){
    $userImage = url('profile-photos/'.$user->profilePhoto);
}
?>
<section id="myResume">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-9">
                    <!--Personal Info Start-->
                    <section class="personal-info-section" id="personal-information">
                        <a class="btn btn-primary edit-btn" title="Edit Personal Information" onclick="$('#personal-information').hide();$('#personal-information-edit').fadeIn()">
                            <i class="fa fa-edit"></i>
                        </a>
                        <div class="row">
                            <div class="col-md-3 personal-info-left">
                                <div class="re-img-box">
                                    <img src="{{ $userImage }}" class="img-circle">
                                    <div class="re-img-toolkit">
                                        <div class="re-file-btn">
                                            @lang('home.change') <i class="fa fa-camera"></i>
                                            <input type="file" class="upload profile-pic" name="image" />
                                        </div>
                                        <!-- <span id="remove-re-image">Remove <i class="fa fa-remove"></i></span> -->
                                    </div>
                                </div>
                                <h3 class="hidden-md hidden-lg" style="font-weight: 600">{{ $user->firstName.' '.$user->lastName }}</h3>
                                <p class="user-sns">
                                    <a href="{{ $meta->twitter }}"><i class="fa fa-twitter-square"></i></a>
                                    <a href="{{ $meta->linkedin }}"><i class="fa fa-linkedin-square"></i></a>
                                    <a href="{{ $meta->facebook }}"><i class="fa fa-facebook-square"></i></a>
                                </p>
                                <p><span class="pi-title">@lang('home.email'):</span> {{ $user->email }}</p>
                                <p><span class="pi-title">@lang('home.mobile'):</span> {{ $user->phoneNumber }}</p>
                                <p><span class="pi-title">@lang('home.cnic'):</span> {{ $meta->cnicNumber }}</p>
                                <p><span class="pi-title">@lang('home.address'):</span> {!! $meta->address.' ,'.JobCallMe::cityName($user->city).' ,'.JobCallMe::countryName($user->country) !!}</p>
                             </div>
                            <div class="col-md-9 personal-info-right">
                                <h3 class="hidden-sm hidden-xs">{{ $user->firstName.' '.$user->lastName }}</h3>
                                <p><span class="pi-title">@lang('home.fathername'):</span> {{ $meta->fatherName }}</p>
                                <p><span class="pi-title">@lang('home.age'):</span> {{ JobCallMe::timeInYear($meta->dateOfBirth) }}, <span class="pi-title">Gender:</span>{{ $meta->gender }},<span class="pi-title">Status:</span>{{ $meta->maritalStatus }}</p>
                                <p><span class="pi-title">@lang('home.education'):</span> {{ $meta->education }}</p>
                                <p><span class="pi-title">@lang('home.experiance'):</span> {{ $meta->experiance }}</p>
                                <p><span class="pi-title">@lang('home.industry'):</span> {{ JobCallMe::categoryTitle($meta->industry) }}</p>
                                <p><span class="pi-title">@lang('home.currentsalary'):</span> {{ number_format($meta->currentSalary != '' ? $meta->currentSalary : '0',2).' '.$meta->currency }}</p>
								<p><span class="pi-title">@lang('home.expectedsalary'):</span> {{ number_format($meta->expectedSalary  != '' ? $meta->expectedSalary  : '0',2).' '.$meta->currency }}</p>
                                <div class="professional-summary">
                                    <h4>@lang('home.p_summary')</h4>
                                    <p>{!! $user->about !!}</p>
                                    <p><span class="pi-title">@lang('home.furtherexpertise')</span></p>
                                    <ul style="margin-left: 50px;padding-left: 0;">
                                        @if($meta->expertise != '')
                                            @foreach(@explode(',',$meta->expertise) as $exper)
                                                <li>{!! $exper !!}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="personal-info-section" id="personal-information-edit" style="display: none;">
                        <h4><i class="fa fa-edit r-icon bg-primary"></i>@lang('home.editpersonalinfo')</h4>
                        <form action="" method="post" class="form-horizontal form-personal-info">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="metaId" value="{{ $meta->metaId }}">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.name')</label>
                                <div class="col-md-6">
                                    <div class="col-md-6 f-name" style="margin-bottom: 5px;padding-left: 0;">
                                        <input type="text" class="form-control input-sm" name="firstName" value="{{ $user->firstName }}">
                                    </div>
                                    <div class="col-md-6 l-name" style="margin-bottom: 5px;padding-right: 0;">
                                        <input type="text" class="form-control input-sm" name="lastName" value="{{ $user->lastName }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.fathername')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="fatherName" value="{{ $meta->fatherName }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.cnic')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="cnicNumber" value="{{ $meta->cnicNumber }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.gender')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="gender">
                                        <option value="Male" {{ $meta->gender == 'Male' ? 'selected="selected"' : '' }}>@lang('home.male')</option>
                                        <option value="Female" {{ $meta->gender == 'Female' ? 'selected="selected"' : '' }}>@lang('home.female')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.maritalstatus')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="maritalStatus">
                                        <option value="Single" {{ $meta->maritalStatus == 'Single' ? 'selected="selected"' : '' }}>@lang('home.single')</option>
                                        <option value="Engaged" {{ $meta->maritalStatus == 'Engaged' ? 'selected="selected"' : '' }}>@lang('home.engaged')</option>
                                        <option value="Married" {{ $meta->maritalStatus == 'Married' ? 'selected="selected"' : '' }}>@lang('home.married')</option>
                                        <option value="Widowed" {{ $meta->maritalStatus == 'Widowed' ? 'selected="selected"' : '' }}>@lang('home.widowed')</option>
                                        <option value="Divorced" {{ $meta->maritalStatus == 'Divorced' ? 'selected="selected"' : '' }}>@lang('home.divorced')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.datebirth')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm date-picker" name="dateOfBirth" value="{{ $meta->dateOfBirth }}" onkeypress="return false">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.email')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.phonenumber')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="phoneNumber" value="{{ $user->phoneNumber }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.address')</label>
                                <div class="col-md-6">
                                    <textarea class="form-control input-sm" name="address">{{ $meta->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-country" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->id }}" {{ $user->country == $cntry->id ? 'selected="selected"' : '' }}>{{ $cntry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.state')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-state" name="state" data-state="{{ $user->state }}"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.city')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2 job-city" name="city" data-city="{{ $user->city }}"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.experiancelevel')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="experiance">
                                        @foreach(JobCallMe::getExperienceLevel() as $el)
                                            <option value="{{ $el }}" {{ $meta->experiance == $el ? 'selected="selected"' : '' }}>{{ $el }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.education')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="education" value="{{ $meta->education }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.industry')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="industry">
                                        @foreach(JobCallMe::getCategories() as $cat)
                                            <option value="{{ $cat->categoryId }}" {{ $meta->industry == $cat->categoryId ? 'selected="selected"' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.currentsalary')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="currentSalary" value="{{ $meta->currentSalary }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.expectedsalary')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="expectedSalary" value="{{ $meta->expectedSalary }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.currency')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="currency">
                                        @foreach(JobCallMe::siteCurrency() as $currency)
                                            <option value="{{ $currency }}" {{ $meta->currency == $currency ? 'selected="selected"' : '' }}>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.expertise')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="expertise" value="{{ $meta->expertise }}">
                                    <p class="help-block">Enter comma seperated expertise</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.p_summary')</label>
                                <div class="col-md-6">
                                    <textarea class="form-control input-sm" name="about">{{ $user->about }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">Facebook</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="facebook" value="{{ $meta->facebook }}">
                                    <p class="help-block">https://facebook.com/user</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">Linkedin</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="linkedin" value="{{ $meta->linkedin }}">
                                    <p class="help-block">https://linkedin.com/user</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">Twitter</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="twitter" value="{{ $meta->twitter }}">
                                    <p class="help-block">https://twitter.com/user</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">Website/Blog</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="website" value="{{ $meta->website }}">
                                    <p class="help-block">https://example.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="cancelProfile()">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Personal Info End-->

                    <!--Academic Section Start-->
                    <section class="resume-box" id="academic">
                        <a class="btn btn-primary r-add-btn" onclick="addAcademic()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.academic')</h4>
                        <?php //print_r($resume); ?>
                        <ul class="resume-details">
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
                                            <p class="rd-location">{!! ucfirst($academic->country) !!}</p>
                                            <p class="rd-grade">Grade/GPA : {!! $academic->grade !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="academic-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addacademic')</c></h4>
                        <form class="form-horizontal form-academic" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.degreelevel')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="degreeLevel">
                                        <option value="High School">@lang('home.highschool')</option>
                                        <option value="Intermediate">@lang('home.intermediate')</option>
                                        <option value="Bachelor">@lang('home.bachelor')</option>
                                        <option value="Master">@lang('home.master')</option>
                                        <option value="PhD">@lang('home.PhD')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.degree')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="degree">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.completiondate')</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control input-sm date-picker" name="completionDate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">Grade/GPA</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="grade">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.institution')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="institution">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->name }}" {{ $user->country == $cntry->id ? 'selected="selected"' : '' }}>{{ ucfirst($cntry->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.details')</label>
                                <div class="col-md-6">
                                    <textarea class="form-control input-sm" name="details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Academic Section End-->

                    <!--Certification Section Start-->
                    <section class="resume-box" id="certification">
                        <a class="btn btn-primary r-add-btn" onclick="addCertification()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.certification')</h4>
                        <ul class="resume-details">
                            @if(count($resume['certification']) > 0)
                                @foreach($resume['certification'] as $resumeId => $certification)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getCertification('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-date">{!! date('M, Y',strtotime($certification->completionDate)) !!}</p>
                                            <p class="rd-title">{!! $certification->certificate !!}</p>
                                            <p class="rd-organization">{!! $certification->institution !!}</p>
                                            <p class="rd-location">{!! ucfirst($certification->country) !!}</p>
                                            <p class="rd-grade">Score : {!! $certification->score !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="certification-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addcertification')</c></h4>
                        <form class="form-horizontal form-certification" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.certification')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="certificate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.completiondate')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm date-picker" name="completionDate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.score')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="score">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.institution')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="institution">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->name }}" {{ $user->country == $cntry->id ? 'selected="selected"' : '' }}>{{ ucfirst($cntry->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.details')</label>
                                <div class="col-md-6">
                                    <textarea class="form-control input-sm" name="details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#certification').fadeIn();$('#certification-edit').hide();$('html, body').animate({scrollTop:$('#certification').position().top}, 700);">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Certification Section End-->

                    <!--Experience Section Start-->
                    <section class="resume-box" id="experience">
                        <a class="btn btn-primary r-add-btn" onclick="addExperience()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  @lang('home.experiences')</h4>
                        <ul class="resume-details">
                            @if(count($resume['experience']) > 0)
                                @foreach($resume['experience'] as $resumeId => $experience)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getExperience('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-date">{!! date('M, Y',strtotime($experience->startDate)) !!} - {{ $experience->currently == 'yes' ? 'Currently Working' : date('M, Y',strtotime($experience->endDate)) }}</p>
                                            <p class="rd-title">{!! $experience->jobTitle !!}</p>
                                            <p class="rd-organization">{!! $experience->organization !!}</p>
                                            <p class="rd-location">{!! ucfirst($experience->country) !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="experience-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
                        <form class="form-horizontal form-experience" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.jobtitle')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="jobTitle">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.organization')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="organization">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.sdate')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm date-picker" name="startDate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.edate')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm date-picker" name="endDate">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <div class="cntr">
                                        <input id="Currently" type="checkbox" class="cbx-field" name="currently" value="yes">
                                        <label class="cbx" for="Currently"></label>
                                        <label class="lbl" for="Currently">@lang('home.currentlyworking')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="country">
                                        @foreach(JobCallMe::getJobCountries() as $cntry)
                                            <option value="{{ $cntry->name }}" {{ $user->country == $cntry->id ? 'selected="selected"' : '' }}>{{ ucfirst($cntry->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.details')</label>
                                <div class="col-md-6">
                                    <textarea class="form-control input-sm" name="details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#experience').fadeIn();$('#experience-edit').hide();$('html, body').animate({scrollTop:$('#experience').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Experience Section End-->

                    <!--Skills Section Start-->
                    <section class="resume-box" id="skills">
                        <a class="btn btn-primary r-add-btn" onclick="addSkills()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.skills')</h4>
                        <ul class="resume-details">
                            @if(count($resume['skills']) > 0)
                                @foreach($resume['skills'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getSkills('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->skill !!}</p>
                                            <p class="rd-location">{!! $skills->level !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="skills-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
                        <form class="form-horizontal form-skills" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.skill')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="skill">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.level')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="level">
                                        <option value="Beginner">@lang('home.beginner')</option>
                                        <option value="Intermediate">@lang('home.intermediate')</option>
                                        <option value="Expert">@lang('home.expert')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#skills').fadeIn();$('#skills-edit').hide();$('html, body').animate({scrollTop:$('#skills').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
					<!---Project -->
					   <section class="resume-box" id="ski">
                        <a class="btn btn-primary r-add-btn" onclick="addProject()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.project')</h4>
                        <ul class="resume-details">
                            @if(count($resume['project']) > 0)
                                @foreach($resume['project'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getProject('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->type !!})</span></p>
											<p class="rd-location"> {!! $skills->startmonth !!} {!! $skills->startyear !!} - {!! $skills->endmonth !!} {!! $skills->endyear !!}</p>
											<p class="rd-location"> As {!! $skills->position !!} - {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
											
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="ski-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.project')</c></h4>
                        <form class="form-horizontal form-ski" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.title')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="title">
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.position')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="position">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.type')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="type">
                                        <option value="@lang('home.academic')">@lang('home.academic')</option>
                                        <option value="@lang('home.academicsearch')">@lang('home.academicsearch')</option>
                                        <option value="@lang('home.professional')">@lang('home.professional')</option>
										<option value="@lang('home.professionalsearch')">@lang('home.professionalsearch')</option>
										
                                    </select>
                                </div>
                            </div>
							 
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.occupation')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="occupation">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.organization')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="organization">
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.startyear')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="syear" name="startyear">
                                       
										
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.startmonth')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="smonth" name="startmonth">
									<option value=''>Select Month</option>
										<option value='Jan'>Jan</option>
										<option value='Feb'>Feb</option>
										<option value='Mar'>Mar</option>
										<option value='Apr'>Apr</option>
										<option value='May'>May</option>
										<option value='Jun'>Jun</option>
										<option value='Jul'>Jul</option>
										<option value='Aug'>Aug</option>
										<option value='Sep'>Sep</option>
										<option value='Oct'>Oct</option>
										<option value='Nov'>Nov</option>
										<option value='Dec'>Dec</option>
                                       
										
                                    </select>
                                </div>
                            </div>
							    <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.endyear')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="eyear" name="endyear">
                                       
										
                                    </select>
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.endmonth')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="emonth" name="endmonth">
									<option value=''>Select Month</option>
										<option value='Jan'>Jan</option>
										<option value='Feb'>Feb</option>
										<option value='Mar'>Mar</option>
										<option value='Apr'>Apr</option>
										<option value='May'>May</option>
										<option value='Jun'>Jun</option>
										<option value='Jul'>Jul</option>
										<option value='Aug'>Aug</option>
										<option value='Sep'>Sep</option>
										<option value='Oct'>Oct</option>
										<option value='Nov'>Nov</option>
										<option value='Dec'>Dec</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                            <label class="control-label col-sm-3 text-right">@lang('home.details')</label>
                            <div class="col-md-6">
                                <textarea name="detail" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#ski').fadeIn();$('#ski-edit').hide();$('html, body').animate({scrollTop:$('#ski').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Project Section End-->
					
					<!---Project -->
					   <section class="resume-box" id="sk">
                        <a class="btn btn-primary r-add-btn" onclick="addLanguage()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.language')</h4>
                        <ul class="resume-details">
                            @if(count($resume['language']) > 0)
                                @foreach($resume['language'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getLanguage('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->language !!}</p>
											<p class="rd-location"> ({!! $skills->level !!})</p>
											
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="sk-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.language')</c></h4>
                        <form class="form-horizontal form-sk" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
							
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.language')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="language">
                                          <option value="Afrikanns">Afrikanns</option>
										  <option value="Albanian">Albanian</option>
										  <option value="Arabic">Arabic</option>
										  <option value="Armenian">Armenian</option>
										  <option value="Basque">Basque</option>
										  <option value="Bengali">Bengali</option>
										  <option value="Bulgarian">Bulgarian</option>
										  <option value="Catalan">Catalan</option>
										  <option value="Cambodian">Cambodian</option>
										  <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
										  <option value="Croation">Croation</option>
										  <option value="Czech">Czech</option>
										  <option value="Danish">Danish</option>
										  <option value="Dutch">Dutch</option>
										  <option value="English">English</option>
										  <option value="Estonian">Estonian</option>
										  <option value="Fiji">Fiji</option>
										  <option value="Finnish">Finnish</option>
										  <option value="French">French</option>
										  <option value="Georgian">Georgian</option>
										  <option value="German">German</option>
										  <option value="Greek">Greek</option>
										  <option value="Gujarati">Gujarati</option>
										  <option value="Hebrew">Hebrew</option>
										  <option value="Hindi">Hindi</option>
										  <option value="Hungarian">Hungarian</option>
										  <option value="Icelandic">Icelandic</option>
										  <option value="Indonesian">Indonesian</option>
										  <option value="Irish">Irish</option>
										  <option value="Italian">Italian</option>
										  <option value="Japanese">Japanese</option>
										  <option value="Javanese">Javanese</option>
										  <option value="Korean">Korean</option>
										  <option value="Latin">Latin</option>
										  <option value="Latvian">Latvian</option>
										  <option value="Lithuanian">Lithuanian</option>
										  <option value="Macedonian">Macedonian</option>
										  <option value="Malay">Malay</option>
										  <option value="Malayalam">Malayalam</option>
										  <option value="Maltese">Maltese</option>
										  <option value="Maori">Maori</option>
										  <option value="Marathi">Marathi</option>
										  <option value="Mongolian">Mongolian</option>
										  <option value="Nepali">Nepali</option>
										  <option value="Norwegian">Norwegian</option>
										  <option value="Persian">Persian</option>
										  <option value="Polish">Polish</option>
										  <option value="Portuguese">Portuguese</option>
										  <option value="Punjabi">Punjabi</option>
										  <option value="Quechua">Quechua</option>
										  <option value="Romanian">Romanian</option>
										  <option value="Russian">Russian</option>
										  <option value="Samoan">Samoan</option>
										  <option value="Serbian">Serbian</option>
										  <option value="Slovak">Slovak</option>
										  <option value="Slovenian">Slovenian</option>
										  <option value="Spanish">Spanish</option>
										  <option value="Swahili">Swahili</option>
										  <option value="Swedish ">Swedish </option>
										  <option value="Tamil">Tamil</option>
										  <option value="Tatar">Tatar</option>
										  <option value="Telugu">Telugu</option>
										  <option value="Thai">Thai</option>
										  <option value="Tibetan">Tibetan</option>
										  <option value="Tonga">Tonga</option>
										  <option value="Turkish">Turkish</option>
										  <option value="Ukranian">Ukranian</option>
										  <option value="Urdu">Urdu</option>
										  <option value="Uzbek">Uzbek</option>
										  <option value="Vietnamese">Vietnamese</option>
										  <option value="Welsh">Welsh</option>
										  <option value="Xhosa">Xhosa</option>
										
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.proficiencylevel')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="level">
									<option value="@lang('home.Basic - Familiar')">@lang('home.Basic - Familiar')</option>
                                        <option value="@lang('home.Conversational - Limited')">@lang('home.Conversational - Limited')</option>
                                        <option value="@lang('home.Conversational')">@lang('home.Conversational')</option>
										<option value="@lang('home.Conversational - Advanced')">@lang('home.Conversational - Advanced')</option>
										<option value="@lang('home.Fluent - Wide Knowledge')">@lang('home.Fluent - Wide Knowledge')</option>
										<option value="@lang('home.Fluent - Full Knowledge')">@lang('home.Fluent - Full Knowledge')</option>

										
                                    </select>
                                </div>
                            </div>
							 
							 
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#sk').fadeIn();$('#sk-edit').hide();$('html, body').animate({scrollTop:$('#sk').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
					       <section class="resume-box" id="skill">
                        <a class="btn btn-primary r-add-btn" onclick="addSkill()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.references')</h4>
                        <ul class="resume-details">
                            @if(count($resume['reference']) > 0)
                                @foreach($resume['reference'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getSkill('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->name !!}</p>
											<p class="rd-location"> Job Title: {!! $skills->jobtitle !!}</p>
											<p class="rd-location">Organization: {!! $skills->organization !!}</p>
                                           <p class="rd-location">Phone Number : {!! $skills->phone !!}</p>
										   <p class="rd-location">Email : {!! $skills->email !!}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="skill-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.addexperience')</c></h4>
                        <form class="form-horizontal form-skill" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.name')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="name">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.jobtitle')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="jobtitle">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.organization')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="organization">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.phone')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="phone">
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.email')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#skill').fadeIn();$('#skill-edit').hide();$('html, body').animate({scrollTop:$('#skill').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
					<!---Publication -->
					   <section class="resume-box" id="skil">
                        <a class="btn btn-primary r-add-btn" onclick="addSkil()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.publication')</h4>
                        <ul class="resume-details">
                            @if(count($resume['publish']) > 0)
                                @foreach($resume['publish'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getSkil('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->title !!}<span class="rd-location" >({!! $skills->pu_type !!})</span></p>
											<p class="rd-location"> {!! $skills->month !!}-{!! $skills->year !!}</p>
											<p class="rd-location"> Author: {!! $skills->author !!}</p>
											<p class="rd-location">Publisher: {!! $skills->publisher !!}</p>
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="skil-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.publication')</c></h4>
                        <form class="form-horizontal form-skil" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.type')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="pu_type">
                                        <option value="@lang('home.book')">@lang('home.book')</option>
                                        <option value="@lang('home.bookchapter')">@lang('home.bookchapter')</option>
                                        <option value="@lang('home.Peer-reviewed')">@lang('home.Peer-reviewed')</option>
										<option value="@lang('home.Non-peer-reviewed')">@lang('home.Non-peer-reviewed')</option>
										<option value="@lang('home.Report')">@lang('home.Report')</option>
										<option value="@lang('home.Patents')">@lang('home.Patents')</option>
                                    </select>
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.title')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="title">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.Author')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="author">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.publisher')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="publisher">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.year')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="year">
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.month')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="month">
                                </div>
                            </div>
							<div class="form-group">
                            <label class="control-label col-sm-3 text-right">@lang('home.details')</label>
                            <div class="col-md-6">
                                <textarea name="detail" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#skil').fadeIn();$('#skil-edit').hide();$('html, body').animate({scrollTop:$('#skil').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
					
					 <section class="resume-box" id="s">
                        <a class="btn btn-primary r-add-btn" onclick="addAward()"><i class="fa fa-plus"></i> </a>
                        <h4><i class="fa fa-book r-icon bg-primary"></i> @lang('home.award')</h4>
                        <ul class="resume-details">
                            @if(count($resume['award']) > 0)
                                @foreach($resume['award'] as $resumeId => $skills)
                                    <li id="resume-{{ $resumeId }}">
                                        <div class="col-md-12">
                                            <span class="pull-right li-option">
                                                <a href="javascript:;" title="Edit" onclick="getAward('{{ $resumeId }}')">
                                                    <i class="fa fa-pencil"></i>
                                                </a>&nbsp;
                                                <a href="javascript:;" title="Delete" onclick="deleteElement('{{ $resumeId }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>&nbsp;
                                            </span>
                                            <p class="rd-title">{!! $skills->title !!}</p>
											<p class="rd-location"> {!! $skills->type !!},{!! $skills->startmonth !!} {!! $skills->startyear !!}</p>
											<p class="rd-location"> {!! $skills->occupation !!} at {!! $skills->organization !!}</p>
											
                                           <p class="rd-location">{!! $skills->detail !!}</p>
										  
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </section>
                    <section class="resume-box" id="s-edit" style="display: none;">
                        <h4><i class="fa fa-book r-icon bg-primary"></i>  <c>@lang('home.award')</c></h4>
                        <form class="form-horizontal form-s" method="post" action="">
                            <input type="hidden" name="_token" value="">
                            <input type="hidden" name="resumeId" value="">
                            <div class="form-group error-group" style="display: none;">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6"><div class="alert alert-danger"></div></div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.title')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="title">
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.type')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" name="type">
                                        <option value="@lang('home.academic')">@lang('home.academic')</option>
                                        <option value="@lang('home.professional')">@lang('home.professional')</option>
										<option value="@lang('home.Extracurricular')">@lang('home.Extracurricular')</option>
										
                                    </select>
                                </div>
                            </div>
							 
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.occupation')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="occupation">
                                </div>
                            </div>
							 <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.organization')</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control input-sm" name="organization">
                                </div>
                            </div>
							  <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.year')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="years" name="startyear">
                                       
										
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 text-right">@lang('home.month')</label>
                                <div class="col-md-6">
                                    <select class="form-control input-sm select2" id="smonth" name="startmonth">
									<option value=''>Select Month</option>
										<option value='Jan'>Jan</option>
										<option value='Feb'>Feb</option>
										<option value='Mar'>Mar</option>
										<option value='Apr'>Apr</option>
										<option value='May'>May</option>
										<option value='Jun'>Jun</option>
										<option value='Jul'>Jul</option>
										<option value='Aug'>Aug</option>
										<option value='Sep'>Sep</option>
										<option value='Oct'>Oct</option>
										<option value='Nov'>Nov</option>
										<option value='Dec'>Dec</option>
                                       
										
                                    </select>
                                </div>
                            </div>
							 
							<div class="form-group">
                            <label class="control-label col-sm-3 text-right">@lang('home.details')</label>
                            <div class="col-md-6">
                                <textarea name="detail" class="form-control tex-editor"></textarea>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 text-right">&nbsp;</label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit" name="save">@lang('home.save')</button>
                                    <button class="btn btn-default" type="button" onclick="$('#s').fadeIn();$('#s-edit').hide();$('html, body').animate({scrollTop:$('#s').position().top}, 700);">@lang('home.cancel')</button>
                                </div>
                            </div>
                        </form>
                    </section>
                    <!--Project Section End-->
                </div>
                <div class="col-md-3">
                    <div class="resume-listing-section hidden-sm hidden-xs">
                        <h4>@lang('home.resumesections')</h4>
                        <hr>
                        <ul class="rls" style="padding-left: 0;">
                            <li>
                                <a id="#" onclick="$('#personal-information').fadeIn();$('#personal-information-edit').hide();">@lang('home.personalinformation')</a> 
                                <a id="#" onclick="$('#personal-information').hide();$('#personal-information-edit').fadeIn()"><i class="fa fa-edit pull-right"></i> </a> 
                            </li>
                            <li>
                                <a id="#" onclick="$('#academic').fadeIn();$('#academic-edit').hide();$('html, body').animate({scrollTop:$('#academic').position().top}, 700);">@lang('home.academic')</a> 
                                <a id="#" onclick="addAcademic();$('html, body').animate({scrollTop:$('#academic-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
                            <li>
                                <a id="#" onclick="$('#certification').fadeIn();$('#certification-edit').hide();$('html, body').animate({scrollTop:$('#certification').position().top}, 700);">@lang('home.certifications')</a> 
                                <a id="#" onclick="addCertification();$('html, body').animate({scrollTop:$('#certification-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
                            <li>
                                <a id="#" onclick="$('#experience').fadeIn();$('#experience-edit').hide();$('html, body').animate({scrollTop:$('#experience').position().top}, 700);">@lang('home.experiences')</a> 
                                <a id="#" onclick="addExperience();$('html, body').animate({scrollTop:$('#experience-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
                            <li>
                                <a id="#" onclick="$('#skills').fadeIn();$('#skills-edit').hide();$('html, body').animate({scrollTop:$('#skills').position().top}, 700);">@lang('home.skills')</a> 
                                <a id="#" onclick="addSkills();$('html, body').animate({scrollTop:$('#skills-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
							<li>
                                <a id="#" onclick="$('#skill').fadeIn();$('#skill-edit').hide();$('html, body').animate({scrollTop:$('#skill').position().top}, 700);">@lang('home.references')</a> 
                                <a id="#" onclick="addSkill();$('html, body').animate({scrollTop:$('#skill-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
							<li>
                                <a id="#" onclick="$('#skil').fadeIn();$('#skil-edit').hide();$('html, body').animate({scrollTop:$('#skil').position().top}, 700);">@lang('home.publication')</a> 
                                <a id="#" onclick="addSkil();$('html, body').animate({scrollTop:$('#skil-edit').position().top}, 700);"><i class="fa fa-plus pull-right"></i> </a> 
                            </li>
                        </ul>
                    </div>
                    <div class="download-resume">
                        <a href="cv" class="btn btn-primary btn-block ">@lang('home.DOWNLOADRESUME')</a>
                    </div>
					 <!--privacy-->
                <div id="privacy-show" class="ja-content-item mc-item resume-listing-section" style="">
                    <form class="form-horizontal privacy-form" method="post" action="">
                        <input type="hidden" name="_token" value="">
                        <h4>@lang('home.privacysettings')</h4>
                        <div class="col-md-12">
                            <p style="margin-top: 4px">
                                <input type="checkbox" id="profile-visible" class="switch-field" name="profile" {{ $privacy->profile != 'No' ? 'checked=""' : '' }}>
                                <label for="profile-visible" class="switch-label"></label> <span>@lang('home.profilevisible')</span>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 4px">
                                <input type="checkbox" id="image-visible" class="switch-field" name="profileImage" {{ $privacy->profileImage != 'No' ? 'checked=""' : '' }}>
                                <label for="image-visible" class="switch-label"></label> <span>@lang('home.picturevisible')</span>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 4px">
                                <input type="checkbox" id="academic-visible" class="switch-field" name="academic" {{ $privacy->academic != 'No' ? 'checked=""' : '' }}>
                                <label for="academic-visible" class="switch-label"></label> <span>@lang('home.academicvisible')</span>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 4px">
                                <input type="checkbox" id="experience-visible" class="switch-field" name="experience" {{ $privacy->experience != 'No' ? 'checked=""' : '' }}>
                                <label for="experience-visible" class="switch-label"></label> <span>@lang('home.experiencevisible')</span>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 4px">
                                <input type="checkbox" id="skills-visible" class="switch-field" name="skills" {{ $privacy->skills != 'No' ? 'checked=""' : '' }}>
                                <label for="skills-visible" class="switch-label"></label> <span>@lang('home.skillsvisible')</span>
                            </p>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
.edit-btn{z-index: 5;}
.li-option{display: none;}
.li-option a{color: #cccccc;text-decoration: none;}
.li-option a:hover{color: #286090;}
.resume-details li:hover .li-option{display:block;}
textarea.form-control{resize: vertical;}
.personal-info-left p {font-size: 12px;}
@media screen and (max-width: 992px){
    .f-name, .l-name{padding-left: 15px !important;padding-right: 15px !important;}
}
</style>
<script type="text/javascript">

var pageToken = '{{ csrf_token() }}';
$(document).ready(function(){
    getStates($('.job-country option:selected:selected').val());
    //$('.date-picker').datepicker({format:'yyyy-mm-dd'});
})
function cancelProfile(){
    $('#personal-information').fadeIn();
    $('#personal-information-edit').hide();
    $('html, body').animate({scrollTop:$('#personal-information').position().top}, 700);
}
$('.job-country').on('change',function(){
    var countryId = $(this).val();
    getStates(countryId)
})
function getStates(countryId){
    if(countryId == 0){
        var newOption = new Option('Select State', '0', true, false);
        $(".job-state").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-state') }}/"+countryId,
        success: function(response){
            var currentState = $('.job-state').attr('data-state');
            var obj = $.parseJSON(response);
            $(".job-state").html('');
            var newOption = new Option('Select State', '0', true, false);
            $(".job-state").append(newOption);
            $.each(obj,function(i,k){
                var vOption = k.id == currentState ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-state").append(newOption);
            })
            $(".job-state").trigger('change');
        }
    })
}
$('.job-state').on('change',function(){
    var stateId = $(this).val();
    getCities(stateId)
})
function getCities(stateId){
    if(stateId == 0){
        var newOption = new Option('Select City', '0', true, false);
        $(".job-city").append(newOption).trigger('change');
        return false;
    }
    $.ajax({
        url: "{{ url('account/get-city') }}/"+stateId,
        success: function(response){
            var currentCity = $('.job-city').attr('data-city');
            var obj = $.parseJSON(response);
            $(".job-city").html('').trigger('change');
            var newOption = new Option('Select City', '0', true, false);
            $(".job-city").append(newOption).trigger('change');
            $.each(obj,function(i,k){
                var vOption = k.id == currentCity ? true : false;
                var newOption = new Option(k.name, k.id, true, vOption);
                $(".job-city").append(newOption).trigger('change');
            })
        }
    })
}
$('form.form-personal-info').submit(function(e){
    $('.form-personal-info input[name="_token"]').val(pageToken);
    $('.form-personal-info button[name="save"]').prop('disabled',true);
    $('.form-personal-info .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-personal-info').serialize(),
        url: "{{ url('account/jobseeker/resume/personal/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-personal-info .error-group').show();
                $('.form-personal-info .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#personal-information-edit').position().top}, 1000);
                $('.form-personal-info button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-personal-info .error-group').show();
            $('.form-personal-info .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-personal-info button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#personal-information-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function firstCapital(myString){
    firstChar = myString.substring( 0, 1 );
    firstChar = firstChar.toUpperCase();
    tail = myString.substring( 1 );
    return firstChar + tail;
}
function addAcademic(){
    $('.form-academic input').val('');
    $('#academic-edit h4 c').text('@lang('home.addacademics')');
    $('#academic').hide();
    $('#academic-edit').fadeIn();
}
$('form.form-academic').submit(function(e){
    $('.form-academic input[name="_token"]').val(pageToken);
    $('.form-academic button[name="save"]').prop('disabled',true);
    $('.form-academic .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-academic').serialize(),
        url: "{{ url('account/jobseeker/resume/academic/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-academic .error-group').show();
                $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
                $('.form-academic button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-academic .error-group').show();
            $('.form-academic .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-academic button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#academic-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getAcademic(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-academic input[name="resumeId"]').val(resumeId);
            $('.form-academic select[name="degreeLevel"]').val(obj.degreeLevel).trigger('change');
            $('.form-academic input[name="degree"]').val(obj.degree);
            $('.form-academic input[name="completionDate"]').val(obj.completionDate);
            $('.form-academic input[name="grade"]').val(obj.grade);
            $('.form-academic input[name="institution"]').val(obj.institution);
            $('.form-academic select[name="country"]').val(obj.country).trigger('change');
            $('.form-academic textarea[name="details"]').val(obj.details);
            $('#academic-edit h4 c').text('Edit Academics');
            $('#academic').hide();
            $('#academic-edit').fadeIn();
        }
    })
}
function deleteElement(resumeId){
    if(confirm('Are you sure to delete this?')){
        $.ajax({
            url: "{{ url('account/jobseeker/resume/delete') }}/"+resumeId,
            success: function(response){
                $('#resume-'+resumeId).remove();
            }
        })
    }
}
function addCertification(){
    $('.form-certification input').val('');
    $('#certification-edit h4 c').text('Add Certificate');
    $('#certification').hide();
    $('#certification-edit').fadeIn();
}
$('form.form-certification').submit(function(e){
    $('.form-certification input[name="_token"]').val(pageToken);
    $('.form-certification button[name="save"]').prop('disabled',true);
    $('.form-certification .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-certification').serialize(),
        url: "{{ url('account/jobseeker/resume/certification/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-certification .error-group').show();
                $('.form-certification .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#certification-edit').position().top}, 1000);
                $('.form-certification button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-certification .error-group').show();
            $('.form-certification .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-certification button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#certification-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getCertification(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-certification input[name="resumeId"]').val(resumeId);
            $('.form-certification input[name="certificate"]').val(obj.certificate);
            $('.form-certification input[name="completionDate"]').val(obj.completionDate);
            $('.form-certification input[name="score"]').val(obj.score);
            $('.form-certification input[name="institution"]').val(obj.institution);
            $('.form-certification select[name="country"]').val(obj.country).trigger('change');
            $('.form-certification textarea[name="details"]').val(obj.details);
            $('#certification-edit h4 c').text('Edit Certificate');
            $('#certification').hide();
            $('#certification-edit').fadeIn();
        }
    })
}
function addExperience(){
    $('.form-experience input').val('');
    $('.form-experience input[name="currently"]').val('yes');
    $('#experience-edit h4 c').text('Add Experience');
    $('#experience').hide();
    $('#experience-edit').fadeIn();
}
$('form.form-experience').submit(function(e){
    $('.form-experience input[name="_token"]').val(pageToken);
    $('.form-experience button[name="save"]').prop('disabled',true);
    $('.form-experience .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-experience').serialize(),
        url: "{{ url('account/jobseeker/resume/experience/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-experience .error-group').show();
                $('.form-experience .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#experience-edit').position().top}, 1000);
                $('.form-experience button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-experience .error-group').show();
            $('.form-experience .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-experience button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#experience-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getExperience(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-experience input[name="resumeId"]').val(resumeId);
            $('.form-experience input[name="jobTitle"]').val(obj.jobTitle);
            $('.form-experience input[name="organization"]').val(obj.organization);
            $('.form-experience input[name="startDate"]').val(obj.startDate);
            $('.form-experience input[name="currently"]').prop('checked',true);
            $('.form-experience input[name="endDate"]').val('');
            if(obj.currently == 'no'){
                $('.form-experience input[name="endDate"]').val(obj.endDate);
                $('.form-experience input[name="currently"]').prop('checked',false);
            }            
            $('.form-experience select[name="country"]').val(obj.country).trigger('change');
            $('.form-experience textarea[name="details"]').val(obj.details);
            $('#experience-edit h4 c').text('Edit Experience');
            $('#experience').hide();
            $('#experience-edit').fadeIn();
        }
    })
}
function addSkills(){
    $('.form-skills input').val('');
    $('#skills-edit h4 c').text('Add Skill');
    $('#skills').hide();
    $('#skills-edit').fadeIn();
}
$('form.form-skills').submit(function(e){
    $('.form-skills input[name="_token"]').val(pageToken);
    $('.form-skills button[name="save"]').prop('disabled',true);
    $('.form-skills .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-skills').serialize(),
        url: "{{ url('account/jobseeker/resume/skills/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-skills .error-group').show();
                $('.form-skills .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#skills-edit').position().top}, 1000);
                $('.form-skills button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-skills .error-group').show();
            $('.form-skills .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-skills button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#skills-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getSkills(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-skills input[name="resumeId"]').val(resumeId);
            $('.form-skills input[name="skill"]').val(obj.skill);
            $('.form-skills select[name="level"]').val(obj.level).trigger('change');
            $('#skills-edit h4 c').text('Edit Skill');
            $('#skills').hide();
            $('#skills-edit').fadeIn();
        }
    })
}
//
function addSkill(){
    $('.form-skill input').val('');
    $('#skill-edit h4 c').text('Add Reference');
    $('#skill').hide();
    $('#skill-edit').fadeIn();
}
$('form.form-skill').submit(function(e){
    $('.form-skill input[name="_token"]').val(pageToken);
    $('.form-skill button[name="save"]').prop('disabled',true);
    $('.form-skill .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-skill').serialize(),
        url: "{{ url('account/jobseeker/resume/refer/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-skill .error-group').show();
                $('.form-skill .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#skill-edit').position().top}, 1000);
                $('.form-skill button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-skill .error-group').show();
            $('.form-skill .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-skill button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#skill-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getSkill(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-skill input[name="resumeId"]').val(resumeId);
            $('.form-skill input[name="name"]').val(obj.name);
            $('.form-skill input[name="jobtitle"]').val(obj.jobtitle);
			$('.form-skill input[name="organization"]').val(obj.organization);
            $('.form-skill input[name="phone"]').val(obj.phone);
			$('.form-skill input[name="email"]').val(obj.email);
            $('#skill-edit h4 c').text('Edit Reference');
            $('#skill').hide();
            $('#skill-edit').fadeIn();
        }
    })
}
//
//
function addSkil(){
    $('.form-skil input').val('');
    $('#skil-edit h4 c').text('Add Publisher');
    $('#skil').hide();
    $('#skil-edit').fadeIn();
}
$('form.form-skil').submit(function(e){
    $('.form-skil input[name="_token"]').val(pageToken);
    $('.form-skil button[name="save"]').prop('disabled',true);
    $('.form-skil .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-skil').serialize(),
        url: "{{ url('account/jobseeker/resume/publish/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-skil .error-group').show();
                $('.form-skil .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#skil-edit').position().top}, 1000);
                $('.form-skil button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-skill .error-group').show();
            $('.form-skill .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-skill button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#skil-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getSkil(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-skil input[name="resumeId"]').val(resumeId);
            $('.form-skil select[name="pu_type"]').val(obj.pu_type).trigger('change');
            $('.form-skil input[name="title"]').val(obj.title);
			$('.form-skil input[name="author"]').val(obj.author);
			$('.form-skil input[name="publisher"]').val(obj.publisher);
            $('.form-skil input[name="year"]').val(obj.year);
			$('.form-skil input[name="month"]').val(obj.month);
			$('.form-skil textarea[name="detail"]').val(obj.detail);
            $('#skil-edit h4 c').text('Edit Publisher');
            $('#skil').hide();
            $('#skil-edit').fadeIn();
        }
    })
}
//

//
function addProject(){
    $('.form-ski input').val('');
    $('#ski-edit h4 c').text('Add Project');
    $('#ski').hide();
    $('#ski-edit').fadeIn();
}
$('form.form-ski').submit(function(e){
    $('.form-ski input[name="_token"]').val(pageToken);
    $('.form-ski button[name="save"]').prop('disabled',true);
    $('.form-ski .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-ski').serialize(),
        url: "{{ url('account/jobseeker/resume/project/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-ski .error-group').show();
                $('.form-ski .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
                $('.form-ski button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-ski .error-group').show();
            $('.form-ski .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-ski button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getProject(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-ski input[name="resumeId"]').val(resumeId);
			$('.form-ski input[name="title"]').val(obj.title);
			$('.form-ski input[name="position"]').val(obj.position);
            $('.form-ski select[name="type"]').val(obj.type).trigger('change');
			$('.form-ski input[name="occupation"]').val(obj.occupation);
			$('.form-ski input[name="organization"]').val(obj.organization);
			$('.form-ski select[name="startyear"]').val(obj.startyear).trigger('change');
            $('.form-ski select[name="startmonth"]').val(obj.startmonth).trigger('change');
			$('.form-ski select[name="endyear"]').val(obj.endyear).trigger('change');
			$('.form-ski select[name="endmonth"]').val(obj.endmonth).trigger('change');
			$('.form-ski textarea[name="detail"]').val(obj.detail);
            $('#ski-edit h4 c').text('Edit Project');
            $('#ski').hide();
            $('#ski-edit').fadeIn();
        }
    })
}
//
function addLanguage(){
    $('.form-sk input').val('');
    $('#sk-edit h4 c').text('Add Language');
    $('#sk').hide();
    $('#sk-edit').fadeIn();
}
$('form.form-sk').submit(function(e){
    $('.form-sk input[name="_token"]').val(pageToken);
    $('.form-sk button[name="save"]').prop('disabled',true);
    $('.form-sk .error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-sk').serialize(),
        url: "{{ url('account/jobseeker/resume/language/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-sk .error-group').show();
                $('.form-sk .error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#sk-edit').position().top}, 1000);
                $('.form-sk button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-sk .error-group').show();
            $('.form-sk .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-sk button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#ski-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getLanguage(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-sk input[name="resumeId"]').val(resumeId);
			$('.form-sk select[name="language"]').val(obj.language).trigger('change');
			$('.form-sk select[name="level"]').val(obj.level).trigger('change');
			
            $('#sk-edit h4 c').text('Edit Award');
            $('#sk').hide();
            $('#sk-edit').fadeIn();
        }
    })
}
//
//
function addAward(){
    $('.form-s input').val('');
    $('#s-edit h4 c').text('Add Language');
    $('#s').hide();
    $('#s-edit').fadeIn();
}
$('form.form-s').submit(function(e){
    $('.form-s input[name="_token"]').val(pageToken);
    $('.form-s button[name="save"]').prop('disabled',true);
    $('.form-s.error-group').hide();
    $.ajax({
        type: 'post',
        data: $('.form-s').serialize(),
        url: "{{ url('account/jobseeker/resume/award/save') }}",
        success: function(response){
            if($.trim(response) != '1'){
                $('.form-s.error-group').show();
                $('.form-s.error-group .col-md-6 .alert-danger').html('<ul><li>'+response+'</li></ul>');
                $('html, body').animate({scrollTop:$('#sk-edit').position().top}, 1000);
                $('.form-s button[name="save"]').prop('disabled',false);
            }else{
                window.location.href = "{{ url('account/jobseeker/resume') }}";
            }
            Pace.stop;
        },
        error: function(data){
            var errors = data.responseJSON;
            var vErrors = '';
            $.each(errors, function(i,k){
                vErrors += '<li>'+k+'</li>';
            })
            $('.form-s .error-group').show();
            $('.form-s .error-group .col-md-6 .alert-danger').html('<ul>'+vErrors+'</ul>');
            $('.form-s button[name="save"]').prop('disabled',false);
            Pace.stop;
            $('html, body').animate({scrollTop:$('#s-edit').position().top}, 1000);
        }
    })
    e.preventDefault();
})
function getAward(resumeId){
    $.ajax({
        url: "{{ url('account/jobseeker/resume/get') }}/"+resumeId,
        success: function(response){
            var obj = $.parseJSON(response);
            $('.form-s input[name="resumeId"]').val(resumeId);
			$('.form-s input[name="title"]').val(obj.title);
            $('.form-s select[name="type"]').val(obj.type).trigger('change');
			$('.form-s input[name="occupation"]').val(obj.occupation);
			$('.form-s input[name="organization"]').val(obj.organization);
			$('.form-s select[name="startyear"]').val(obj.startyear).trigger('change');
            $('.form-s select[name="startmonth"]').val(obj.startmonth).trigger('change');
			
            $('#s-edit h4 c').text('Edit Language');
            $('#s').hide();
            $('#s-edit').fadeIn();
        }
    })
}
//
$('.profile-pic').on('change',function(){
    var formData = new FormData();
    formData.append('profilePicture', $(this)[0].files[0]);
    formData.append('_token', pageToken);

    $.ajax({
        url : "{{ url('account/jobseeker/profile/picture') }}",
        type : 'POST',
        data : formData,
        processData: false,
        contentType: false,
        timeout: 30000000,
        success : function(response) {
            if($.trim(response) != '1'){
                $('img.img-circle').attr('src',response);
            }else{
                alert('Following format allowed (PNG/JPG/JPEG)');
            }
        }
    });
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
$('.privacy-form input[type="checkbox"]').click(function(){
    $('.privacy-form input[name="_token"]').val(pageToken);
    $.ajax({
        type: 'post',
        data: $('.privacy-form').serialize(),
        url: "{{ url('account/privacy/save') }}",
        success: function(response){
        }
    })
})

var start = 1950;
var end = new Date().getFullYear();
var options = "";
for(var year = end ; year >=start; year--){
  options += "<option value="+year+">"+ year +"</option>";
}
document.getElementById("syear").innerHTML = options;
//

var estart = 1950;
var eend = new Date().getFullYear();
var eoptions = "";
for(var eyear = eend ; eyear >=estart; eyear--){
  eoptions += "<option value="+eyear+">"+ eyear +"</option>";
}
document.getElementById("eyear").innerHTML = eoptions;
//

var starts = 1950;
var ends = new Date().getFullYear();
var option = "";
for(var years = ends ; years >=starts; years--){
  option += "<option value="+years+">"+ years +"</option>";
}
document.getElementById("years").innerHTML = option;

</script>
@endsection