@extends('main')

@section('content')	

			
	<table class="table table-striped myTable">
	<caption>{{$adv->title}}</caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="5"><img alt="no pics" src=""></td><td>type: {{$adv->rentOrSell}}</td></tr>
			<tr><td>place: {{$adv->city}}</td></tr>
			<tr><td>size: {{$adv->size}}</td></tr>
			<tr><td>prize: {{$adv->prize}}</td></tr>
			<tr><td>heating type: {{$adv->heatingSystem}}</td></tr>
			<tr><td>{{$adv->advertisementText}}</td></tr>	
		</tbody>	
	</table>
	<a href="" class="btn btn-success">Send a message to the owner</a>	


@endsection
