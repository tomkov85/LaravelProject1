@extends('main')

@section('content')

<form class="form-horizontal" method="POST" action="">
<div class="form-group">
	<label class="control-label col-sm-2" for="email">Email:*</label>
	<div class=col-sm-5><input type="email" class="form-control" id="email" placeholder="Enter email" required /></div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="pwd">Password:*</label>
	<div class=col-sm-5><input type="password" class="form-control" id="pwd" placeholder="Enter password" required /></div>
</div>

@yield('adminContent')

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-info">Submit</button></div>
</div>
</form>

@endsection