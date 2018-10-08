@extends('main')

@section('content')

<table id = "shoppingCart-table" class = "table table-stripped table-hover shoppingCart-table">
	<caption><center>Your Shopping Cart<center></caption>
	<tr><th>Product</th><th>Color</th><th>Size</th><th>Prize</th><th>Number</th><th>Delete</th><tr>
	<form method = "POST" action = "order" >
	@foreach(session()->get('userOrderList') as $key => $items)
	<tr>
		<td><img class = "shoppingCart-Img" src="{{$items['tsPics']}}"  alt="here is your picture"/></td><td><input class = "shoppingCart-small-cell" type = "text" name = "{{'userOrderColor'.$key}}" value = "{{$items['color']}}" readonly /></td>
		<td><input class = "shoppingCart-small-cell" type = "text" name = "{{'userOrderSize'.$key}}" value = "{{$items['size']}}" readonly /></td>
		<td><input id = "{{'orderItemPrize'.$key}}" class = "shoppingCart-small-cell" type = "number" name = "{{'userOrderPrize'.$key}}" value = "{{$items['prize']}}" readonly /></td>
		<td><input id = "{{'orderItemNumberVisiable'.$key}}" onfocus = "incializeOrderItemNumber({{$key}})" onblur = "changeOrderItemNumber({{$key}})" class = "shoppingCart-small-cell" type = "number" name = "{{'userOrderItemNumber'.$key}}" value = "{{$items['number']}}"/></td> 
		<td class = "shoppingCart-small-cell" ><a class = "btn btn-danger shoppingCart-small-cell" href = "deleteOI?index={{$key}}">X</a></td>
	</tr>
	@endforeach
	<tr><td></td><td>
		</td><td>Sum:</td><td id = "orderPrizeSum" >{{session()->get('userOrderPrizeSum')}}</td>
		<td><input id = "orderSubmitButton" class = "btn btn-success" type = "submit" value = "Purchase"/></td>
		<td><input type = "hidden" name = "orderItemNumberIndex" value = "{{count(session()->get('userOrderList'))}}"/></td>
	</tr>
	</table>
	
	
	</form>
	@endsection