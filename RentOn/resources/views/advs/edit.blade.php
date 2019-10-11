@extends('main')

@section('content')	

 <!-- Upgrade form -->
<form method="post" action="">
	@csrf
	<table class="table table-striped table-bordered renton-Table">
	<caption><input type="text" name="advTitle" value='{{$adv->title}}'/></caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="2">Main picture: <input class="renton-Pics-InputField" type="file" name="advMainPics" /></td><td>Rent <input type="radio" class="renton-Advs-RadioBtn" name="advRS" value="1" @if($adv->rentOrSell) {{"checked='checked'"}} @endif /> Sell <input type="radio" class="renton-Advs-RadioBtn" name="advRS" value="0" @if(!$adv->rentOrSell) {{"checked='checked'"}} @endif /></td></tr>
			<tr><td>place:<input class="renton-input" type="text" name="advAddress" value='{{$adv->city}}'/></td></tr>
			<tr><tr><td rowspan="3" class='table-bordered'>More pictures: <input class="renton-Pics-InputField" type="file" name="advMorePics1"/><br><input class="renton-Pics-InputField" type="file" name="advMorePics2"/><br><input class="renton-Pics-InputField" type="file" name="advMorePics3"/><td>size: <input type="number" class="renton-input" name="advSize" value='{{$adv->size}}'/></td></tr>
			<tr><td>prize:<input class="renton-input" type="number" name="advPrize" value='{{$adv->prize}}'/></td></tr>
			<tr><td>heat:  <input class="renton-input" type="text" name="advHeatingSystem" value='{{$adv->heatingSystem}}'/></td></tr>
			<tr><td colspan="2"><textarea id="advTextArea" name="advText">{{$adv->advertisementText}}</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success">Update the advertisement</button>
</form>	

@endsection