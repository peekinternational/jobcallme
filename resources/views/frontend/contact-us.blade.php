@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<?php
$headerC = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
?>
<section id="company-box">
    <div class="container">
        <div class="col-md-8 company-box-left">
            <h3>@lang('home.helpquery')</h3>
            <hr>
            <form class="contact-us-form" method="post" action="">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ csrf_field() }}
            	<div class="form-group">
            		<label>@lang('home.yourname')</label>
            		<input type="text" class="form-control" name="name" required="" value="{{ old('name') }}">
            	</div>
            	<div class="form-group">
            		<label>@lang('home.youremail')</label>
            		<input type="email" class="form-control" name="email" required="" value="{{ old('email') }}">
            	</div>
            	<div class="form-group">
            		<label>@lang('home.yourquery')</label>
            		<textarea class="form-control" name="query" style="resize: vertical;" placeholder="@lang('home.typequery')" rows="10" required="">{{ old('query') }}</textarea>
            	</div>
            	<div class="form-group">
            		<button class="btn btn-block btn-primary" type="submit" name="submit">@lang('home.submit')</button>
            	</div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="company-box-right">
                <h4>@lang('home.contactdetail')</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.phone')</strong></div>
                    <div class="col-md-9">{{ $headerC['phoneNumber'] }}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.email')</strong></div>
                    <div class="col-md-9"><a href="#">{{ $headerC['email'] }}</a> </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3"><strong>@lang('home.address')</strong></div>
                    <div class="col-md-9">
                        {{ $headerC['address'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection