@extends('main')

@section('content')

<a class="btn btn-success" href='create'>new advertisement</a>


@foreach($userAdvs as $userAdv)
	<table class="table table-striped myTable">
	<caption>{{$userAdv->title}}</caption>
		<tbody>
			<tr><td rowspan="4"><img alt="no pics" src="apartmentspics\{{$userAdv->advImage}}" width="200px"></td>
				<td>type: @if($userAdv->rentOrSell === "1") rent @else sell @endif</td></tr>
			<tr><td>place: {{$userAdv->city}}</td></tr>
			<tr><td>size: {{$userAdv->size}}</td></tr>
			<tr><td>prize: {{$userAdv->prize}}</td></tr>
			<tr><td><a class="btn btn-info" href='edit/{{$userAdv->id}}'>update</a></td><td><a class="btn btn-danger" href='delete/{{$userAdv->id}}'>delete</a></td></tr>			
		</tbody>	
	</table>

@endforeach
	@if(!empty($_GET['page']))
		{{$userAdvs->appends(['page'=>$_GET['page']])->onEachSide(5)->links()}}
	@endif
@endsection

