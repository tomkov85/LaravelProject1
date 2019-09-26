@extends('main')

@section('content')

<a class="btn mySuccessBtn" href='createAdv'>new advertisement</a>
<!-- Adv List -->
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
			<tr><td> @if($userAdv->Highlighted === 0) <a class="btn btn-success" href=''>highlight</a> @else Highlighted: {{ $userAdv->Highlighted }} @endif </td><td><a class="btn btn-info" href='editAdv/{{$userAdv->id}}'>update</a> <a class="btn btn-danger" href='deleteAdv/{{$userAdv->id}}'>delete</a></td></tr>			
		</tbody>	
	</table>

@endforeach
<div class='paginationContainer'>
	@if(count($userAdvs) >= 5)
		{{$userAdvs->appends(['page'=>$_GET['page']])->onEachSide(5)->links()}}
	@endif
</div>
@endsection

