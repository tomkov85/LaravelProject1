@extends('main')

@section('content')
	<img class="contact-logo" alt="error" src="\RentOn\storage\app\RentonLogo\RentOnlogo.jpg"/>
	<h4>Email: {{$email}}</h4>
	<h4>Phone: {{$phone}}</h4>
	<h4>Address: {{$address}}</h4>
	<iframe src="https://www.google.com/maps/place/Budapest,+Budafoki+%C3%BAt+59,+1111/@47.4752456,19.0500552,17z/data=!3m1!4b1!4m5!3m4!1s0x4741ddadb9dc129b:0x31888be13219c43b!8m2!3d47.4752456!4d19.0522439"></iframe>
	<script> document.getElementsByTagName('a')[3].style.backgroundColor='#F09609';</script>
@endsection