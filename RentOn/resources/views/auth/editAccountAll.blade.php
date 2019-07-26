@extends('main')

@section('content')
	<form class="form-horizontal" method="get" action="">
			<div class="form-group">
				<div id="searchField" class="col-sm-4">
					<select class="form-control" name="searchName">
						<option>name</option>
						<option>email</option>
						<option>address</option>
					</select>
				</div>
				<input type='hidden' name='type' value='all'/>
		<div id="searchField" class="col-sm-4"><input type="search" class="form-control" name="searchVal" placeholder="" size='2'/></div><button id='searchFieldBtn' type="submit" class="btn btn-info" name = 'searchSubmit'><img alt="error" src="icons/glyphicons-28-search.png"/></button>
	</div>
	</form>
	
	<table class="table table-bordered messageManagerTable">
		<caption>Users</caption>
		<thead>
			<tr><th>name</th><th>email</th><th>address</th><th>phone</th><th>professional</th><th>created_at</th><th>updated_at</th><th colspan='2'>Actions</th></tr>
		</thead>
		<tbody>
			@foreach($users as $user)		
				<tr><td>{{$user->name}}</td><td>{{$user->email}}</td><td>{{$user->address}}</td><td>{{$user->phone}}</td><td>{{$user->professional}}</td><td>{{$user->created_at}}</td><td>{{$user->updated_at}}</td><td><a  href="/RentOn/public/editAccount/{{$user->id}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-137-cogwheel.png"/></a></td><td><a  href="/RentOn/public/deleteAccount/{{$user->id}}"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-17-bin.png"/></a></td></tr>
			@endforeach
		</tbody>	
	</table>
	
	{{$users->appends(request()->except('page'))->onEachSide(5)->links()}}

@endsection