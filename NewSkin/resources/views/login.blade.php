@extends('main')

@section('content')
<h2> Login </h2>
<form class = "form-inline" method="GET" action="">
	<div class = "form-group">
		<label>Email: </label>
		<input class="form-control" type = "email" name = "loginEmail" required />
		<label class="control-label" for = "loginPassword" >Password: </label>
		<input class="form-control" type = "password" name = "loginPassword" required />
		<label>Your picture: <input type="file" class="form-control" name="imageUpload" onchange ="this.form.submit()"/>
		<button class = "btn btn-info" type = "submit">Login</button><a class = "btn btn-success" href = "registration">Registration</a>
	</div>
</form>

@endsection