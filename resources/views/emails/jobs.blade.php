<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
<body>
  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#f3f3f3" style="min-width:100%">
  <tbody><tr>
  <td></td>
  </tr>
  <td align="center" valign="top">
  <table cellpadding="0" cellspacing="0" width="500" bgcolor="#ffffff" style="border-top:1px solid #c2c2c2;border-bottom:1px solid #c2c2c2;border-left:1px solid #c2c2c2;border-right:1px solid #c2c2c2;">
  <tbody><tr>
  <td align="center" valign="middle" height="75" style="padding-left:8.5%;padding-right:8.5%;padding-top:10px">
    <a href="http://www.jobcallme.com">
  <img src="https://www.jobcallme.com/website/logo.png" alt="JobCallMe" title="JobCallMe"  style="border:none" class="CToWUd">
  </a>
  <span style="color:#4E27BA;">
  <h1 style="margin:5px;">JobCallMe</h1>
  </span>
  </a>
  </td>
  </tr>
  <tr>
  <td style="padding-left:8.5%;padding-right:8.5%;padding-bottom:20px">
  <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="min-width:100%">
  <tbody><tr>
  <td align="center" valign="top" style="padding-bottom:10px;font-size:20px;line-height:1.3">
  <span style="color:#0d0d0d;font-size:20px;font-weight:bold">
  @lang('home.'.JobCallMe::categoryTitle($getCat))
  </span>
  </td>
  </tr>
  </tbody></table>
</td>
</tr>
<tr>
<td>
<hr style="height:1px;background-color:#7f7f7f;border:none;margin:0">
</td>
</tr>
  @foreach($jobs as $users)
  <?php
  $companylogo=url('compnay-logo/default-logo');
  if ($users->companyLogo!="") {
      $companylogo=url('compnay-logo/'.$users->companyLogo);
  }
   ?>
   <tr>
   <td style="padding-left:8.5%;padding-right:8.5%;padding-top:20px;padding-bottom:20px">
   <table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="min-width:100%">
   <tbody><tr>
   <td align="center" valign="top" style="padding-bottom:30px;font-size:20px;line-height:1.3">
   <span style="font-size:18px">
   </span>
   </td>
   </tr>
   </tbody></table>
   <table cellspacing="0" cellpadding="0" width="100%" style="min-width:100%">
   <tbody><tr>
   <td align="left" valign="top" width="50" style="padding-right:20px">
   <table border="0" cellpadding="0" cellspacing="0" width="50" style="min-width:50px;max-width:50px">
   <tbody><tr>
   <td align="center" valign="bottom" style="line-height:0;font-size:0" width="50" height="50">
   <img src="{{asset('compnay-logo/'.$users->companyLogo)" alt="Company-Logo" style="border-top:1px solid #4B4B4B;border-left:1px solid #4B4B4B;border-right:1px solid #4B4B4B;width:50px; height:60px;">
   </td>
   </tr>
   <tr>
   <td align="center" valign="middle" height="20" width="50" style="color: #0caa41;font-size:14px;border:1px solid #0caa41;border-bottom:1px solid #0caa41;border-right:1px solid #0caa41;border-radius:2px;color:#0caa41;white-space:nowrap">
   3.5&nbsp;&#9733;
   </td>
   </tr>
   </tbody></table>
   </td>
   <td align="left" valign="top" width="90%">

   <a style="font-size:20px;color:#1861bf; text-decoration:none;" href="{{ url('jobs/'.$users->jobId)}}">{{$users->title}}</a>
   <br><span>{{$users->companyName}}</span>
   <br><span style="color:">@lang('home.'.JobCallMe::cityName($users->city))</span>
   </a>
   </td>
   </tr>
   <tr>
   <td colspan="2">
   </td>
   </tr>
   </tbody></table>
   </td>
   </tr>
   <tr>
   <td>
   <hr style="height:1px;background-color:#7f7f7f;border:none;margin-top:20px;">
   </td>
   </tr>
@endforeach
<tr>
<td style="padding-left:8.5%;padding-right:8.5%;padding-top:20px;padding-bottom:20px">
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" style="min-width:100%">
<tbody><tr>
  <td style="text-align:center;">
    <a href="https://www.jobcallme.com/jobs">
<button type="button" name="button" style="background-color: #4CAF50; border-radius: 15px;color: white;text-align:center;padding: 20px 70px;font-size: 16px;">See All Posted Jobs</button>
  </a>
</td>
</tr>
</tbody></table>
<tr>
<td>
<hr style="height:1px;background-color:#7f7f7f;border:none;margin-top:20px;">
</td>
</tr>
<tr>
    <td>
<div class="" style="float:left;">
  <img src="https://www.jobcallme.com/compnay-logo/1514990780-699854.jpg" alt="" style="vertical-align: middle;width: 120px;height: 120px; margin-left:40px;border-radius: 50%;">
</div>
<div class="" style="margin-top:30px; font-size:18px;">
  <span style="margin-left: 10px;">Apply to the job with one click by</span>
    <br><span style="margin-left: 10px;"> completing your profile</span>
</div>
  </td>
</tr>
<tr>
  <td style="text-align:center;">
    <a href="https://www.jobcallme.com/account/jobseeker/resume">
<button type="button" name="button" style="background-color: #3596D8; border-radius: 15px;color: white;text-align:center;padding: 20px 70px;font-size: 16px; margin-top:15px;">Complete Your Profile</button>
  </a>
</td>
</tr>
<tr>
  <td>
<table cellspacing="0" cellpadding="0" width="100%" style="min-width:100%">
<tbody><tr>
<td align="left" valign="top" width="50" style="padding-right:20px">
<table border="0" cellpadding="0" cellspacing="0" width="50" style="min-width:50px;max-width:50px">
<tbody><tr>
<td align="center" valign="bottom" style="line-height:0;font-size:0" width="50" height="50">
<tr>
<td colspan="2"></td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style="background-color:#404040;padding-top:25px;padding-bottom:25px;padding-left:8.5%;padding-right:8.5%">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="min-width:100%">
<tbody><tr>
<td style="font-family:Lato,Arial,Helvetica,sans-serif;font-size:10px;color:#ffffff;line-height:18px;margin:0;margin-top:0px;margin-bottom:0px;text-align:center">
<span style="color:#ffffff">
This message was sent to <a href="" style="color:#ffffff" target="_blank">cafecapsuleone@gmail.com</a>.
</span>
<br>
<span style="color:#ffffff">
JobCallMe &nbsp;|&nbsp; <a href="" style="color:#ffffff;">Nonhyun-Ro 27 Gil 39 Seo Cho-Gu, Seoul, Korea 06745</a>
</span>
<br>
<span style="color:#ffffff">
Copyright© 2017 JobCallMe Co.,Ltd (RN 201-86-41011)
</span>
<br>
<a href="http://www.jobcallme.com" style="color:#ffffff" target="_blank" data-saferedirecturl="">www.JobCallMe.com</a>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
<td></td>
</tr>
<tr>
<td></td>
</tr>
</tbody></table>
</body>
</html>
