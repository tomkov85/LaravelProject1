@extends('main')

@section('content')

<table class = "table table-stripped table-bordered table-hover shoppingCart-table">
	<caption><center>Your Shopping Cart<center></caption>
	<tr><th>Product</th><th>Color</th><th>Size</th><th>Prize</th><th>Number</th><th>Delete</th><tr>
	
	@foreach(session()->get('userOrderList') as $items)
	<tr><td>name</td><td>{{$items[1]}}</td><td>{{$items[2]}}</td><td>{{$items[0]}}</td><td class = "shoppingCart-number-cell"><input class = "shoppingCart-number-cell" type = "number" value = "1"></td><td><button class = "btn btn-danger">X</button></td><tr>
	@endforeach
	
	<tr><td></td><td></td><td></td><td>Sum:</td><td>{{session()->get('userOrderPrizeSum')}}</td></tr>
	</table>
	
	@endsection