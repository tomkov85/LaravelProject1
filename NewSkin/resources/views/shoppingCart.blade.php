@extends('main')

@section('content')

<table id = "shoppingCart-table" class = "table table-stripped table-hover shoppingCart-table">
	<caption><center>Your Shopping Cart<center></caption>
	<tr><th>Product</th><th>Color</th><th>Size</th><th>Prize</th><th>Number</th><th>Delete</th><tr>
	<form method = "POST" action = "order" >
	@foreach(session()->get('userOrderList') as $key => $items)
	<tr>
		<td><img class = "shoppingCart-Img" src="{{$items[3]}}"  alt="here is your picture"/><input type = "hidden" name = "{{'userOrderPics'.$key}}" value = "{{$items[3]}}" /></td><td><input class = "shoppingCart-small-cell" type = "text" name = "{{'userOrderColor'.$key}}" value = "{{$items[1]}}" readonly /></td>
		<td><input class = "shoppingCart-small-cell" type = "text" name = "{{'userOrderSize'.$key}}" value = "{{$items[2]}}" readonly /></td>
		<td><input class = "shoppingCart-small-cell" type = "number" name = "{{'userOrderPrize'.$key}}" value = "{{$items[0]}}" readonly /></td>
		<td><input class = "shoppingCart-small-cell" type = "number" value = "1"/></td> 
		<td class = "shoppingCart-small-cell" ><a class = "btn btn-danger shoppingCart-small-cell" href = "deleteOI?index={{$key}}">X</a></td>
	</tr>
	@endforeach
	</form>
	<tr><td></td><td></td><td>Sum:</td><td >{{session()->get('userOrderPrizeSum')}}</td><td></td><td></td></tr>
	</table>
	
	@endsection