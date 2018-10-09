<html>
	<body>
		<h2>New Skin</h2>
			<p>Hello {{$name}} !</p>
			<p>You 've ordered the following tshirts in our webshop</p>
			<table>
				<tr><th>name</th><th>color</th><th>size</th><th>prize</th><th>number</th></tr>
				@foreach($tsList as $ts)
				<tr><td>{{$ts['tsPics']}}</td><td>{{$ts['color']}}</td><td>{{$ts['size']}}</td><td>{{$ts['prize']}}</td><td>{{$ts['number']}}</td></tr>
				@endforeach
			</table>
		
	</body>
</html>