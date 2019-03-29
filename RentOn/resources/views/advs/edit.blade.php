@extends('main')

@section('content')	

<form method="post" action="">
	@csrf
	<table class="table table-striped myTable">
	<caption><input type="text" name="advTitle" value='{{$adv->title}}'/></caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="5">Picture: <input type="file" name="advPics"/></td><td>Rent<input type="radio" name="advRS" value="1"/>Sell<input type="radio" name="advRS" value="2"/></td></tr>
			<tr><td>place: <input type="text" name="advAddress" value='{{$adv->city}}'/></td></tr>
			<tr><td>size: <input type="number" name="advSize" value='{{$adv->size}}'/></td></tr>
			<tr><td>prize: <input type="number" name="advPrize" value='{{$adv->prize}}'/></td></tr>
			<tr><td>heating type: <input type="text" name="advHeatingSystem" value='{{$adv->heatingSystem}}'/></td></tr>
			<tr><td colspan="2"><textarea id="advTextArea" name="advText">{{$adv->advertisementText}}</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success">Update the advertisement</button>
</form>	

@endsection