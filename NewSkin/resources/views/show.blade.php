@extends('designMain')

@section('img')
	<img id = "tspics" src="{{$tshirtpics->url}}" />
@endsection

@section('form')
		<form method="get" action="sw">
			<tr><td><label>picture: <input type="text" value="{{$tshirtpics->name}}" name="picture" readonly /></td></tr>
			<tr><td><label>prize: <input type="number" value="{{$tshirt->prize+2000}}" name="prize" readonly /></td></tr>
			<tr><td><input type="hidden" name="tshirtColor" value="{{$tshirt->color}}"/></td></tr>
			<tr><td><input type="hidden" name="tshirtSize" value="{{$tshirtSize}}"/></td></tr>
			<tr><td><label>tagname: {{$tshirtpics->tag}}</label></td></tr>
			<tr><td><label>designer: {{$picsDesigner->name}}</label></td></tr>
			<tr><td><button onclick="this.form.submit()">Buy</button></td></tr>
		</form>
@endsection