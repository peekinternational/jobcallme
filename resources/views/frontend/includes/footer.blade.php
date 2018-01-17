<!--Footer-->
<footer id="footer">
    <div class="container">
        <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #9b9b36">@lang('home.catocc')</span></h5>
            <ul class="quick-links">
                @foreach(JobCallMe::getCategories() as $fCat)
                    <li><a href="{{ url('jobs?category='.$fCat->categoryId) }}"><span class="lh-eff34 c18-cyan-1"><span></span>{{ ucfirst($fCat->name) }}</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #8d7d8d">
@lang('home.hourwork')</span></h5>
            <ul class="quick-links">
                @foreach(JobCallMe::getJobShifts() as $fShift)
                    <li><a href="{{ url('jobs?shift='.$fShift->name) }}"><span class="lh-eff34 c18-cyan-3"><span></span>{{ ucfirst($fShift->name) }}</span></a></li>
                @endforeach
            </ul>
			<br>
				 <h5><span class="footer-title-box2"><a href="#" style="background-color: #428f7e">@lang('home.abouthead')</a></span></h5><br>
				 <h5><span class="footer-title-box2"><a href="#" style="background-color: #956f4f">
                               @lang('home.dispatchinformation')</a></span></h5>
         </div>

         <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #94a5a5">
                               @lang('home.jobcareer')</span></h5>
            <ul class="quick-links">
                @foreach(JobCallMe::getCareerLevel() as $career)
                    <li><a href="{{ url('jobs?career='.$career) }}"><span class="lh-eff34 c18-cyan-2"><span></span>{{ $career }}</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #4e6c7c">@lang('home.jobinformationtype')</span></h5>
            <ul class="quick-links">
                @foreach(JobCallMe::getJobType() as $fType)
                    <li><a href="{{ url('jobs?type='.$fType->name) }}"><span class="lh-eff34 c18-cyan-4"><span></span>{{ ucfirst($fType->name) }}</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #b0a48a">@lang('home.jobin') {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }}</span></h5>
            <ul class="quick-links">
                @foreach(JobCallMe::getHomeCities() as $loca)
                    <li><a href="{{ url('jobs?country='.JobCallMe::getHomeCountry().'&state='.$loca->state_id.'&city='.$loca->id )}}"><span class="lh-eff34 c18-cyan-5"><span></span>Jobs in {{ $loca->name }}</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-2">
            <h5><span class="footer-title-box" style="background-color: #717171">@lang('home.aboutus')</span></h5>
            <ul class="quick-links">
                <li><a href="{{ url('about') }}"><span class="lh-eff34 c18-cyan-6"><span></span>@lang('home.about')</span></a></li>
                <li><a href="{{ url('contact') }}"><span class="lh-eff34 c18-cyan-6"><span></span>@lang('home.contact')</span></a></li>
                <li><a href="{{ url('privacy-policy') }}"><span class="lh-eff34 c18-cyan-6"><span></span>Privacy Policy</span></a></li>
                <li><a href="{{ url('terms-conditions') }}"><span class="lh-eff34 c18-cyan-6"><span></span>Terms & Conditions</span></a></li>
                <li><a href="{{ url('account/register') }}"><span class="lh-eff34 c18-cyan-6"><span></span>Signup Now</span></a></li>
            </ul>
            <ul class="social-links">
                <li><a href="https://facebook.com"><i class="fa fa-facebook-square"></i> </a> </li>
                <li><a href="https://twitter.com"><i class="fa fa-twitter-square"></i> </a> </li>
                <li><a href="https://linkedin.com"><i class="fa fa-linkedin-square"></i> </a> </li>
            </ul>
        </div>
		
    </div>
	<div class="foot-links-hr"></div>
<!-- <section class="main-slide-foot"> -->
		<div class="foot-links">             
                <ul>
                    <li>고객센터 : 070-7770-0967 (평일 09:00 ~ 19:00 )  l FAX: 02-2058-0138  l Email: help@jobcallme.com</li>
                    <li>서울시 서초구 논현로 27길 39 2층(양재동, 천일빌딩) 잡콜미 l 대표 : 김성영 l 사업자등록번호 : 201-86-41011</li>
                    <li>통신판매업 신고번호 : 제2014-서울서초-1367호 l 직업정보제공사업 신고번호 : 제0000-00호</li> 
					<li>Copyrihgt &copy; 2017 Jobcallme Co.,Ltd.(RN 201-86-41011)</li>                
                </ul>				
         </div>
</footer>