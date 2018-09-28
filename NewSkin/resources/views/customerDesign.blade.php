@extends('designMain')

@section('img')
	<img id = "tspics" src="{{$custPicsSrc}}"  alt="here is your picture"/>
@endsection

@section('form')
		<form method = "post" action="" enctype="multipart/form-data">
			<tr><td><label>Your picture: <input type="file" class="form-control" name="imageUpload" onchange ="this.form.submit()"  /></td></tr>
		</form>
		<form method="get" action="order">
			<tr><td><label>prize: <input type="number" value="{{$tshirt->prize+2000}}" name="prize" readonly /></td></tr>
			<tr><td><input type="hidden" name="tshirtColor" value="{{$tshirt->color}}"/></td></tr>
			<tr><td><input type="hidden" name="tshirtSize" value="{{$tshirtSize}}"/></td></tr>
			<tr><td><button onclick="this.form.submit()">Buy</button></td></tr>
		</form>
@endsection