<!DOCTYPE html>
<html lang='en'>
<head>
	<title>Jobs Notification</title>
</head>
<body>
	<h1 style="text-align: center">@lang('home.Latest jobs Mail')</h1>
@foreach($jobs as $job)
	<h4><a href="https://www.jobcallme.com/jobs/{{$job->jobId}}">{{$job->title}}</a></h4>
	   
@endforeach

</body>
</html>