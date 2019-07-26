@extends('main')

@section('content')

@if(Auth::user()->name == "myAdmin")
	<form class="form-horizontal" method="get" action="">
			<div class="form-group">
				<div id="searchField" class="col-sm-4">
					<select class="form-control" name="searchName">
						<option>city</option>
						<option>address</option>
						<option>title</option>
					</select>
				</div>
				<input type='hidden' name='type' value='all'/>
		<div id="searchField" class="col-sm-4"><input type="search" class="form-control" name="searchVal" placeholder="" size='2'/></div><button id='searchFieldBtn' type="submit" class="btn btn-info" name = 'searchSubmit'><img alt="error" src="icons/glyphicons-28-search.png"/></button>
	</div>
	</form>
@else 
	<a class="btn btn-success mySuccessBtn" href='createAdv'>new advertisement</a>
@endif

@foreach($userAdvs as $userAdv)
	<table class="table table-striped table-bordered myTable">
	<caption><a href='showAdv/{{$userAdv->id}}'>{{$userAdv->title}}</a></caption>
		<tbody>
			<tr><td rowspan="5"><img alt="no pics" src="apartmentspics\{{$userAdv->advMainImage}}" width="200px"></td>
				<td>type: @if($userAdv->rentOrSell === 1) rent @else sell @endif</td></tr>
			<tr><td>place: {{$userAdv->city}}</td></tr>
			<tr><td>size: {{$userAdv->size}}</td></tr>
			<tr><td>prize: {{$userAdv->prize}}</td></tr>
			<tr><td>views: {{$userAdv->views}}</td></tr>
			<tr><td> @if($userAdv->Highlighted === 0) <a class="btn btn-info" href=''>highlight</a> @else Highlighted: {{ $userAdv->Highlighted }} @endif </td><td><a class="btn btn-info" href='editAdv/{{$userAdv->id}}'>update</a> <a class="btn btn-danger" href='deleteAdv/{{$userAdv->id}}'>delete</a></td></tr>			
		</tbody>	
	</table>

@endforeach
<div class='paginationContainer'>
	@if(count($userAdvs) >= 5)
		{{$userAdvs->appends(['page'=>$_GET['page']])->onEachSide(5)->links()}}
	@endif
</div>
@endsection

