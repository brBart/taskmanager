
<!DOCTYPE html>
<html>
<head>
	<title>Account Activation</title>
</head>
<body>
	<div>
		<span>Email : {{ $email }} </span>		
		<span>You are invited, please click <a href="{{ $url }}/account/activation/{{ $activation_code }}">here</a>. </span>
	</div>
</body>
</html>




