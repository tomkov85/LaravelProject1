@extends('main')

@section('content')

	
	<ul class='messageManagerMenu'>
		<li><a class="btn btn-success mySuccessBtn" href='/RentOn/public/createMessage/0'>new message</a></li>
		<li><a href="/RentOn/public/manageMessages?type=inbox"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-123-message-in.png"/> inbox</a></li>
		<li><a href="/RentOn/public/manageMessages?type=outbox"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-124-message-out.png"/> outbox</a></li>
		<li><a href="/RentOn/public/manageMessages?type=trash"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-17-bin.png"/> trash</a></li>
	</ul>
	
	<table class="table table-bordered messageManagerTable">
		<caption>Messages</caption>
		<thead>
			<tr><th>Sender</th><th>Receiver</th><th>Title</th><th>Date</th><th colspan='3'>Actions</th></tr>
		</thead>
		<tbody>
			@foreach($messages as $message)		
				<tr class='@if($message->newMessage){{"newMessage"}}@endif'><td>{{$message->sender}}</td><td>{{$message->receiver}}</td><td>{{$message->messageTitle}}</td><td>{{$message->created_at}}</td><td><a  href="/RentOn/public/showMessage/{{$message->id}}"><img class="userIcons eye" alt="error" src="/RentOn/public/icons/glyphicons-52-eye-open.png"/></a></td><td><a  href="/RentOn/public/createMessage/{{$message->id}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-86-repeat.png"/></a></td><td><a  href="/RentOn/public/deleteMessage/{{$message->id}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-17-bin.png"/></a></td></tr>
			@endforeach
		</tbody>	
	</table>
	
{{$messages->appends(10)->onEachSide(5)->links()}}

@endsection