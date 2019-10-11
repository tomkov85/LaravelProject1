@extends('main')

@section('content')
	<!-- Flash messages for Users -->
	@if (session('status'))
		<span  class="userFlashMessages alert @if(session('status') !== 'Advertisement deleted!') {{'alert-success'}} @else {{'alert-danger'}} @endif">
			{{ session('status') }}
		</span>
	@endif
	
	<!-- Navbar -->	
	@if($type != "all")
	{{$type}}
	<ul class='messageManagerMenu'>
		<li><a class="btn btn-success renton-SuccessBtn" href='/RentOn/public/createMessage/0'>new message</a></li>
		@if($type == 'receiver')<li class = "menuSelected"> @else <li> @endif <a href="/RentOn/public/manageMessages?type=inbox"  ><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-123-message-in.png"/> inbox</a></li>
		@if($type == 'sender')<li class = "menuSelected"> @else <li> @endif<a href="/RentOn/public/manageMessages?type=outbox" ><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-124-message-out.png"/> outbox</a></li>
		@if($type == 'bin')<li class = "menuSelected"> @else <li> @endif <a href="/RentOn/public/manageMessages?type=bin" ><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-17-bin.png"/> trash</a></li>
	</ul>
	@else
		<!-- Admin menu -->	
		<form class="form-horizontal searchForm" method="get" action="">
			<div class="form-group">
				<div id="searchField" class="col-sm-3">
					<select class="form-control" name="searchName">
						<option>sender</option>
						<option>reciever</option>
						<option value = 'messageTitle'>title</option>
					</select>
				</div>
				<input type='hidden' name='type' value='all'/>
		<div id="searchField" class="col-sm-7"><input type="search" class="form-control" name="searchVal" placeholder="" size='2'/></div><button id='searchFieldBtn' type="submit" class="btn btn-success" name = 'searchSubmit'><img alt="error" src="icons/glyphicons-28-search.png"/></button>
	</div>
	</form>
	@endif
	
	<!-- Datatable -->	
	<table class="table table-bordered messageManagerTable">
		<caption>Messages</caption>
		<thead>
			<tr><th>Sender</th><th>Receiver</th><th>Title</th><th>Date</th><th colspan='3'>Actions</th></tr>
		</thead>
		<tbody>
			@foreach($messages as $message)		
				<tr class='@if($message->newMessage){{"newMessage"}}@endif'><td>{{$message->sender}}</td><td>{{$message->receiver}}</td><td>{{$message->messageTitle}}</td><td>{{$message->created_at}}</td><td><a  href="/RentOn/public/showMessage/{{$message->id}}"><img class="userIcons eye" alt="error" src="/RentOn/public/icons/glyphicons-52-eye-open.png"/></a></td><td>@if($_GET['type'] != 'bin')<a  href="/RentOn/public/createMessage/{{$message->id}}">@else<a  href="/RentOn/public/replaceMessage/{{$message->id}}">@endif<img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-86-repeat.png"/></a></td><td><a  href="/RentOn/public/deleteMessage/{{$message->id}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-17-bin.png"/></a></td></tr>
			@endforeach
		</tbody>	
	</table>
	
	<!-- Pagination links -->	
	<div class='paginationContainer'>	
		{{$messages->appends(request()->except('page'))->onEachSide(5)->links()}}
	</div>
@endsection