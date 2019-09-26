@extends('main')

@section('content')
	 <!-- Datatable -->
	<table class="table table-striped table-bordered myTable">
		<thead>
		</thead>
		<tbody>
			<tr><td>Sender:  {{$sender}} </td></tr>
			<tr><td>Receiver: {{$receiver}}</td></tr>			
			<tr><td> Title:  {{$messageTitle}} </td></tr>			
			<tr><td><textarea id="messageTextArea" name="messageText">{{$messageText}}</textarea></td></tr>				
			<tr><td><a  href="/RentOn/public/createMessage/{{$messageId}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-86-repeat.png"/> reply</a></td></tr>			
		</tbody>	
	</table>

@endsection