@extends('adminMain')

@section('adminContent')

<form class="form-horizontal" method="POST" action="">
<div class="form-group">
	<label class="control-label col-sm-2" for="name">Name:*</label>
	<div class=col-sm-5><input type="text" class="form-control" id="name" placeholder="Enter name" required /></div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="phone">Phone:</label>
	<div class=col-sm-5><input type="phone" class="form-control" id="phone" placeholder="Enter phone"></div>
</div>

@endsection