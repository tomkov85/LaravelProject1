@extends('main')

@section('content')

<form class="form-horizontal" method="GET" action="">
	<div class="form-group">
		<label class="control-label col-sm-2" for="location">Location:</label>
		<div class="col-sm-5"><input type="text" class="form-control col-sm-12" name="searchLoc" placeholder="Enter Location"/></div>
		<button type="submit" class="btn btn-info">Search</button>
		<a id="collapse-btn">more detail</a>		
	</div>
	<div id="collapse">
	<div class="form-group">
		<label class="control-label col-sm-2" for="rent">Rent</label><div class="col-sm-1"><input type="radio" name="sellOrRent" value="1"/></div>
		<label class="control-label col-sm-1" for="sell">Sell</label><div class="col-sm-1"><input type="radio" name="sellOrRent" value="0"/></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="size">Size: </label>
		<div class="col-sm-2"><input type="number" class="form-control" name="searchSizeMin"/></div><div class="col-sm-2"><input type="number" class="form-control" name="searchSizeMax"/></div>
	</div>
	</div>
</form>
@foreach($in as $i)
	<table class="table table-striped myTable">
	<caption>{{$i->title}}</caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="4"><img alt="no pics" src=""></td><td>type: {{$i->rentOrSell}}</td></tr>
			<tr><td>place: {{$i->city}}</td></tr>
			<tr><td>size: {{$i->size}}</td></tr>
			<tr><td>prize: {{$i->prize}}</td></tr>			
		</tbody>	
	</table>

@endforeach
@if(count($in)===0)
	<a class='alert-info'> Sorry, there is no such an appartmant </a>
@endif

@endsection