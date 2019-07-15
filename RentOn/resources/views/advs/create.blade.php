@extends('main')

@section('content')	

<form method="POST" action="create">
	<table class="table table-striped table-bordered myTable">
	<caption><input type="text" name="advTitle" placeholder="Enter the title here"/></caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="2">Main picture: <input type="file" name="advMainPics"/></td><td>Rent<input type="radio" name="advRS" value="1"/>Sell<input type="radio" name="advRS" value="0"/></td></tr>
			<tr><td>place: <input type="text" name="advAddress"/></td></tr>
			<tr><td rowspan="3" class='table-bordered'>More pictures: <input type="file" name="advMorePics1"/><br><input type="file" name="advMorePics2"/><br><input type="file" name="advMorePics3"/><td>size: <input type="number" name="advSize"/></td></tr>
			<tr><td>prize: <input type="number" name="advPrize"/></td></tr>
			<tr><td>heating type: <input type="text" name="advHeatingSystem"/></td></tr>
			<tr><td colspan="2"><textarea id="advTextArea" name="advText">Enter the text here</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success mySuccessBtn">Create a new advertisement</button>
</form>	

@endsection