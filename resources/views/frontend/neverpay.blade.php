@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<?php
$headerC = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
?>
<section id="company-box">
    <div class="container">
    <div class="col-md-10 company-box-left">
	<h3>Safety Tips for Safe Online Job Search in {{ JobCallMe::countryName(JobCallMe::getHomeCountry()) }}</h3>
    <h4>Employment Scams Warning - Tips for Safer Online Job Search </h4>
<span style="color:red">Very Important You Must Read</span><br>

Dear Valued Member,

Thank you for being a part of Jobcallme.com, Pakistan's leading jobs site.

Jobcallme.com is the only jobs site in Pakistan that contacts each employer to verify its status so that every job that is posted on our website is genuine and posted by authorized person only. We hope that you will understand that due to the limited resources it is not practically possible for us to conduct in-depth verification of each employer.

You are hereby advised to be careful about employment scams in which the job applicants are asked to pay some amount on one pretext or another along with job application.

As part of the job application process, recruiters/employers/agents should never ask you to pay fees for recruitment or processing services, such as training materials, interview fees, test fees, CV/resume improvements or administrative costs etc.

You are therefore advised to avoid applying for jobs where the role requires you to process payments via a personal bank account, cheque or transfer money by wire services such as Western Union or Moneygram.

Do you know what steps we take to ensure jobs quality at Jobcallme.com?

Jobcallme.com provides quick and easy registration for employers. However, we make sure that certain quality standards are met so that jobseekers can continue to benefit from our service.

Job quality is strictly controlled on Jobcallme.com and all activities on our website are monitored 24/7. We do NOT permit the following behavior on our site:

Providing incorrect or misleading account or contact details when registering All new employer accounts at Jobcallme.com are subjected to a review and verification process, before their jobs are made available on our website. If we find an employer account with incomplete or incorrect contact details we remove that account immediately.
Discriminatory language - racial, sexual, religious or age - We believe in equal employment opportunities for everyone, without any discrimination. Whenever we find a job containing discriminatory language/behavior towards applicants, we remove it immediately.
Requesting money or bank details from candidates, directly or indirectly (e.g. through 'Email Processing' or 'Work from Home' schemes) - We strongly discourage the jobs in which the employer request money from jobseekers. We have also added a warning message on the top of each job page which tells jobseekers not to make any payment to employers in any case, and if they find a job posting at Jobcallme.com and employer request money to process application, interview, test etc they should report it immediately to support@Jobcallme.com. Similarly, the job postings such as 'Email Processing' or 'Work from Home' are also not allowed at Jobcallme.com
Promoting business opportunities, network marketing or 'get-rich-quick' schemes - Job postings that seems to be promotion of business opportunities, network marketing or get rich quicker schemes are mostly fake and scam, therefore if we find any such job posting at Jobcallme.com we remove it immediately.
Jobcallme.com warmly welcomes responsible employer and wishes them success using our service.

Tips for making safe online job applications

We work hard to maintain the quality of jobs on Jobcallme.com, but we advise you to keep in mind the following advice when searching and applying for jobs at Jobcallme.com or any other job site:

Google and try to find out the basic information about the employer
There is no need to provide bank account details, personal financial information or make payment to any person or organization when applying for a job.
As part of the job application process, recruiters/employers/agents should never ask you to pay fees for recruitment or processing services, such as training materials, interview fees, test fees, CV/resume improvements or administrative costs etc.
Avoid applying for jobs where the role requires you to process payments via a personal bank account or transfer money by wire services such as Western Union or Moneygram.
Finally, if you see an opportunity which appears too good to be true, please let us know, so we can investigate further.
If you have any suspicions about jobs you see on Jobcallme.com, you can report them to our customer support team who will take immediate appropriate action.

Please note that Jobcallme.com strives hard to offer the best and safest possible customer experience for both jobseekers and employers, we seek your cooperation in this regard while disclaiming any loss/liability.

If you have any queries please don't hesitate to contact us at support@Jobcallme.com

Wishing you success using Jobcallme.com!
<br>
<br>
<span>
Thank you,<br>
Customer Care,<br>
Jobcallme.com
</span>
</span>


	</div>
        
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
</script>
@endsection