var OrderItemNumber = 1;

function incializeOrderItemNumber(key) {
	OrderItemNumber = parseInt(document.getElementById("orderItemNumberVisiable"+key).value);
}

function changeOrderItemNumber(key) {
	var newValue = parseInt(document.getElementById("orderItemNumberVisiable"+key).value);
	if(newValue < 1) {
		document.getElementById("orderItemNumberVisiable"+key).value = 1;
	} else {
		document.getElementById("orderPrizeSum").innerHTML = parseInt(document.getElementById("orderPrizeSum").innerHTML) + (newValue - OrderItemNumber) * (parseInt(document.getElementById("orderItemPrize"+key).value));
	}	
}
/*
<td><input id = "orderItemPrize" class = "shoppingCart-small-cell" type = "number" name = "{{'userOrderPrize'.$key}}" value = "{{$items[0]}}" readonly /></td>
		<td><input id = "orderItemNumberVisiable" class = "shoppingCart-small-cell" type = "number" value = "1" onchange = "changeOrderItemNumber() " /><input id = "orderItemNumberUnvisiable" type = "hidden" name = "{{'userOrderItemNumber'.$key}}" value = "{{$items[0]}}" readonly /></td> 
		<td class = "shoppingCart-small-cell" ><a class = "btn btn-danger shoppingCart-small-cell" href = "deleteOI?index={{$key}}">X</a></td>
	</tr>
	@endforeach
	</form>
	<tr><td></td><td></td><td>Sum:</td><td ><input id = "orderPrizeSum" type = "number" value = "{{session()->get('userOrderPrizeSum')}}" readonly /></td><td></td><td></td></tr>
	*/