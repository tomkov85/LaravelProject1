@extends('main')

@section('content')	

<form method="post" action="">
	<table class="table table-striped myTable">
	<caption><input type="text" name="advTitle" placeholder="Enter the title here"/></caption>
		<thead>
		</thead>
		<tbody>
			<tr><td rowspan="5">Picture: <input type="file" name="advPics"/></td><td>Rent<input type="radio" name="advRS" value="1"/>Sell<input type="radio" name="advRS" value="2"/></td></tr>
			<tr><td>place: <input type="text" name="advAddress"/></td></tr>
			<tr><td>size: <input type="number" name="advSize"/></td></tr>
			<tr><td>prize: <input type="number" name="advPrize"/></td></tr>
			<tr><td>heating type: <input type="text" name="advHeatingSystem"/></td></tr>
			<tr><td colspan="2"><textarea id="advTextArea" name="advText">Enter the text here</textarea></td></tr>	
		</tbody>	
	</table>
	<button type="submit" class="btn btn-success">Create a new advertisement</button>
</form>	

@endsection