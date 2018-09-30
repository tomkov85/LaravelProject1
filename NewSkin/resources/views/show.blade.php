@extends('designMain')

@section('img')
	<img id = "tspics" src="{{$tshirtpics->url}}" />
@endsection

@section('form')
		<form method="get" action="addToShoppingCart">
			<tr><td><label>picture: {{$tshirtpics->name}}</label></td></tr>
			<tr><td><label>prize: <input type="number" value="{{$tshirt->prize+2000}}" name="prize" readonly /></td></tr>
			<tr><td><input type="hidden" name="tshirtColor" value="{{$tshirt->color}}"/></td></tr>
			<tr><td><input type="hidden" name="tshirtSize" value="{{$tshirtSize}}"/></td></tr>
			<tr><td><input type="hidden" name="tshirtPics" value="{{$tshirtpics->url}}"/></td></tr>
			<tr><td><label>tagname: {{$tshirtpics->tag}}</label></td></tr>
			<tr><td><label>designer: {{$tshirtpics->designer}}</label></td></tr>
			<tr><td><button onclick="this.form.submit()">Buy</button></td></tr>
		</form>
@endsection