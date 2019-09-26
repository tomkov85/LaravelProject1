@extends('main')

@section('content')	

 <!-- Create form -->
<form method="POST" action="/RentOn/public/createMessage">
	<table class="table table-striped table-bordered messageTable">
	<thead>
		</thead>
		<tbody>
			<tr><td>Sender: <input type='text' name='sender' value='{{$user}}'/>		 
			<tr><td>Reciever:
			 <input type='text' name='reciever' @if($mod != 0)
			 value='{{$userEmail}}'@endif
			/>
			</td></tr>			
			<tr><td> Title:
			<input type='text' name='messageTitle' @if($mod != 0)
			 value='{{$advTitle}}'@endif
			/>
			</td></tr>				
			<tr><td><textarea id="messageTextArea" name="messageText">Enter your message here</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success mySuccessBtn">send message</button>
</form>	


@endsection

