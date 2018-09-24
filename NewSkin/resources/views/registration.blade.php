@extends('main')

@section('content')
<h2> Registration </h2>
<form class = "form-horizontal" method = "Post" action ="">
	<div class = "form-group col-sm-7">
		<label class="control-label">Name: </label>
		<input class="form-control" type = "text" name = "registrationName" pattern = "[^<>()?]{1,30}" title = "Please dont use special characters!" required />
	</div>
	<div class = "form-group col-sm-7">
		<label class="control-label">Email: </label>
		<input class="form-control" type = "email" name = "registrationEmail" required />
	</div>
	<div class = "form-group col-sm-7">
		<label class="control-label">Address: </label>
		<input class="form-control" type = "text" name = "registrationAddress" pattern = "[^<>()?]{1,30}" title = "Please dont use special characters!" />
	</div>
	<div class = "form-group col-sm-7">
		<label class="control-label">Telephone number: </label>
		<input class="form-control" type = "number" name = "registrationTelephone"/>
	</div>
	<div class = "form-group col-sm-7">	
	    <label class="control-label" for = "registrationPassword" >Password: </label>
		<input class="form-control" type = "password" name = "registrationPassword" required />		
	</div>
	<div class = "form-group col-sm-7">
		<button class = "btn btn-info" type = "submit">Registration</button>
	</div>
</form>

@endsection