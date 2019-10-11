@extends('main')

 @section('content')
	<h2 id = "welcomeMessage">Welcome at RentOn, on your appartman advertising homepage</h2>
	<!-- Flash messages for Users -->
	@if (session('status'))
		<span  class="userFlashMessages alert @if(session('status') !== 'Advertisement deleted!') {{'alert-success'}} @else {{'alert-danger'}} @endif">
			{{ session('status') }}
		</span>
	@endif
	
	 <!-- Datatable -->
	<h4 id= "topSells">Top sells</h4>
	@foreach($advs as $adv)
		<span class="topAdvs">
			<a href='showAdv/{{$adv->id}}'><div><img alt="no pics" src="apartmentspics\{{$adv->advMainImage}}" width="100px"/></div>
			{{$adv->title}}</a>
		</span>
	@endforeach
	
 @endsection

 

