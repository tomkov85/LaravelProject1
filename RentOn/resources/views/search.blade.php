@extends('main')

@section('content')

<form class="form-horizontal" method="GET" action="">
	<div class="form-group">
		<label class="control-label col-sm-2" for="location">Location:</label>
		<div id="searchField" class="col-sm-4"><input type="search" class="form-control" name="searchLoc" placeholder="Enter Location" size='2'/></div><button id='searchFieldBtn' type="submit" class="btn btn-info" name = 'searchSubmit'><img alt="error" src="icons/glyphicons-28-search.png"/></button>
		
		<a id="collapse-btnS">more detail</a>	
	</div>	
	<div id="collapses">
	<div class="form-group">
		<label class="control-label col-sm-2" for="rent">Rent</label><div class="col-sm-1"><input type="radio" name="rentOrSell" value="1"/></div>
		<label class="control-label col-sm-1" for="sell">Sell</label><div class="col-sm-1"><input type="radio" name="rentOrSell" value="2"/></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="size">Size: </label>
		<div class="col-sm-2"><input type="number" class="form-control" name="searchSizeMin"/></div><div class="col-sm-2"><input type="number" class="form-control" name="searchSizeMax"/></div>
	</div>
	</div>
		@if(count($in)===0)
			<div class='alert alert-danger'> Sorry, there is no such an appartmant </div>
		@endif
		@if(count($in)>0)
		<div class="form-group col-sm-4 tableSetts">
			<label>Order By:</label>
				<select class="form-control" onchange="this.form.submit()" name="order">
					<option value="prize">prize</option>					
					<option value="size" @if($order==='size') {{"selected"}} @endif>size</option>
			</select>
		</div>
		<div class="form-group col-sm-4 tableSetts">
			<label>Page limit:</label>
				<select class="form-control" onchange="this.form.submit()" name="pageLimit">
					<option value="2">2</option>
					<option value="5" @if($pageLimit==='5') {{"selected"}} @endif>5</option>
			</select>
		</div>
		<div class="form-group col-sm-5 tableSetts">
			<div class='alert alert-success'> find {{$finds}}
			@if($cfm !== 0)
				, current:{{$cf.'-'.$cfm}}
			@endif
			</div>
		</div>
		@endif
</form>
<br>
<br>
@foreach($in as $i)
	<table class="table table-striped myTable">
	<caption>{{$i->title}}</caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="5"><img alt="no pics" src="apartmentspics\{{$i->advImage}}" width="200px"></td><td>type: {{$i->rentOrSell}}</td></tr>
			<tr><td>place: {{$i->city}}</td></tr>
			<tr><td>size: {{$i->size}}</td></tr>
			<tr><td>prize: {{$i->prize}}</td></tr>
			<tr><td><a href='show/{{$i->id}}'>more</a></td></tr>			
		</tbody>	
	</table>

@endforeach

</div>
<div>
<center>{{$in->appends($linkArray)->onEachSide(5)->links()}}</center>
@endsection

<!--["searchLoc" => $_GET['searchLoc'],"rentOrSell" => $_GET['rentOrSell'],"searchSizeMin" => $_GET['searchSizeMax'],"searchSizeMax" => $_GET['searchSizeMin'],-->