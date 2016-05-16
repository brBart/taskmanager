
<<!DOCTYPE html>
<html>
<head>
	<title>Account Activation</title>
</head>
<body>

	<div>
		<span>Name : {{ $user->first_name }} {{ $user->last_name}}</span>		
		<span>You are invited, please click <a href="/account/activation/{{ $user->activation_code }}"></a> </span>
	</div>
</body>
</html>>




