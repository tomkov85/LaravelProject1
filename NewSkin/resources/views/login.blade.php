@extends('main')

@section('content')
<h2> Login </h2>
<form class = "form-inline" method = "Post" action ="">
	<div class = "form-group">
		<label>Email: </label>
		<input class="form-control" type = "email" name = "loginEmail" required />
		<label class="control-label" for = "loginPassword" >Password: </label>
		<input class="form-control" type = "password" name = "loginPassword" required />
		<button class = "btn btn-info" type = "submit">Login</button><a class = "btn btn-success" href = "registration">Registration</a>
	</div>
</form>

@endsection