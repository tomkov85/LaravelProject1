@extends('main')

@section('content')	

 <!-- Upgrade form -->
<form method="post" action="">
	@csrf
	<table class="table table-striped table-bordered myTable">
	<caption><input type="text" name="advTitle" value='{{$adv->title}}'/></caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="2">Picture: <input type="file" name="advMainPics" /></td><td>Rent <input type="radio" name="advRS" value="1" @if($adv->rentOrSell) {{"checked='checked'"}} @endif /> Sell <input type="radio" name="advRS" value="0" @if(!$adv->rentOrSell) {{"checked='checked'"}} @endif /></td></tr>
			<tr><td>place: <input type="text" name="advAddress" value='{{$adv->city}}'/></td></tr>
			<tr><tr><td rowspan="3" class='table-bordered'>More pictures: <input type="file" name="advMorePics1"/><br><input type="file" name="advMorePics2"/><br><input type="file" name="advMorePics3"/><td>size: <input type="number" name="advSize" value='{{$adv->size}}'/></td></tr>
			<tr><td>prize: <input type="number" name="advPrize" value='{{$adv->prize}}'/></td></tr>
			<tr><td>heating type: <input type="text" name="advHeatingSystem" value='{{$adv->heatingSystem}}'/></td></tr>
			<tr><td colspan="2"><textarea id="advTextArea" name="advText">{{$adv->advertisementText}}</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success">Update the advertisement</button>
</form>	

@endsection