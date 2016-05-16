
<!DOCTYPE html>
<html>
<head>
	<title>Notifcation</title>
</head>
<body style='font-family: "Open Sans",Arial,sans-serif;'>
	<div>
		<p>Project : {{ $project_title }} </p>		
		<p>Task : {{ $task_title }} </p>		
		
		<p>Status : <a href="{{ $link }}">{{ $task_status }}</a> </p>		
		
		<div class="tm-comment-thread" id="comment-thread" style="max-width:600px;margin: 20px;background-color: #C6E9F4;">
		 
			@foreach($comments as $comment)
				<div style="margin:5px;width: 98%;min-height: 45px;border-bottom: 1px solid #0095E0;"> 
			      	<div class="row tm-comment-header" style="width: 100%;font-size: 11px;
				font-style: italic;" > 
			      		<span style=""> {{ $comment->user->first_name }}  commented on : {{ $comment['created_at'] }}</span> 
			      	</div>
	        	  <div style="width: 100%;" class="row tm-comment-body">{{ $comment['content'] }}</div>
	        	</div>
	        @endforeach
	        
	 	</div>

		<p> {{$user_name}}</p>
		<span> <img src="{{$user_photo}}"  width="160px;" height="100px;" /></span>
		<br>

		
	</div>
</body>
</html>




