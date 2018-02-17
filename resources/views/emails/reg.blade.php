<!DOCTYPE html>
<html>
<head>
	<title>Verification</title>
</head>
<body>
<h1>Welcome {{$Name}}</h1>
<a href="{{ url('verifyUser/'.$id)}}">Click to verify</a>
</body>
</html>