@extends('main')

@section('content')	

	 <!-- Datatable -->	
	<table class="table table-striped table-bordered myTable">
	<caption>{{$adv->title}}</caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="5"><img alt="no pics" src="/RentOn/public/apartmentspics/{{$adv->advMainImage}}"></td><td>type: {{$adv->rentOrSell}}</td><td rowspan='5'>More Image:<img alt="no pics" class='advMoreImage' src="/RentOn/public/apartmentspics/{{$moreImage1}}"><br><img alt="no pics" class='advMoreImage' src="/RentOn/public/apartmentspics/{{$moreImage2}}"><br><img alt="no pics" class='advMoreImage' src="/RentOn/public/apartmentspics/{{$moreImage3}}"></td></tr>
			<tr><td>place: {{$adv->city}}</td></tr>
			<tr><td>size: {{$adv->size}}</td></tr>
			<tr><td>prize: {{$adv->prize}}</td></tr>
			<tr><td>heating type: {{$adv->heatingSystem}}</td></tr>
			<tr><td>{{$adv->advertisementText}}</td></tr>	
		</tbody>	
	</table>
	<a class="btn btn-success mySuccessBtn" href='/RentOn/public/createMessage/{{$adv->id}}'>Send a message to the owner</a>	


@endsection
