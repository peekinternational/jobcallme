		@extends('frontend.layouts.app')

		@section('title', 'Career Tab')

		@section('content')
		
		<section id="company-box">
			<div class="container">
			<div class="row">

			<div class="col-md-12 follow-companies6" style="background:#57768a;color:#fff;margin-top:50px;margin-bottom:20px;">
                    <h3 style="margin-left: 15px"><img src="{{ url('website/talksnslogo.png') }}">@lang('home.Facebook Careers Tab')</h3>
				</div>



				<div class="col-md-12 company-box-left">
				<span><b>@lang('home.facebookcareerstab')</b></span>
				<br>
				<br>

				<span style="font-size: 13px;">@lang("home.Facebook Careers Tab  page for your organization. Careers Tab to it and let Jobseekers find your jobs through social media!") 

               </span>
				<br>
				<br>

				<br>

				   <button type="submit" class="btn btn-primary"><a href="https://www.talksns.com/" style="color:white" target="_blank" >TalkSNS 채용공고 소셜 미디어 공유 탭</a></button>

				</div>
			   
				 
			</div>
		</section>
		@endsection
		@section('page-footer')
		<script type="text/javascript">
		</script>
		@endsection