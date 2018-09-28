@extends('main')

@section('content')

<span id="tshirtDesigner">
	<img src="{{"uploads/tshirts/".$tshirt->color.".jpg"}}" />
	@yield('img')
</span>

<table id ="tshirtDataTable">
		<form method="get" action="">
			<tr><td><ul class="list-inline">Colors: 
						<li><label class = "btn btn-default"><input type = "radio" class = "radio-btn-color" name = "color" value ="white" onclick="this.form.submit()" @if($tshirt->color == "white"){{{"checked"}}}@endif /></label></li>
						<li><label class = "btn btn-danger"><input type = "radio" class = "radio-btn-color" name = "color" value ="red" onclick="this.form.submit()" @if($tshirt->color == "red"){{{"checked"}}}@endif/></label></li>
						<li><label class = "btn btn-info"><input type = "radio" class = "radio-btn-color" name = "color" value ="blue" onclick="this.form.submit()" @if($tshirt->color == "blue"){{{"checked"}}}@endif /></label></li></tr>
			<tr><td><ul class="list-inline">Size: 
						<li><label class = "sizeLabel"><input type = "radio" class = "radio-btn-size" name = "size" value ="S" onclick="this.form.submit()" @if($tshirtSize == "S"){{{"checked"}}}@endif />S</label></li>
						<li><label class = "sizeLabel"><input type = "radio" class = "radio-btn-size" name = "size" value ="M" onclick="this.form.submit()" @if($tshirtSize == "M"){{{"checked"}}}@endif />M</label></li>
						<li><label class = "sizeLabel"><input type = "radio" class = "radio-btn-size" name = "size" value ="L" onclick="this.form.submit()" @if($tshirtSize == "L"){{{"checked"}}}@endif/>L</label></li>		
						<li><label class = "sizeLabel"><input type = "radio" class = "radio-btn-size" name = "size" value ="XL" onclick="this.form.submit()" @if($tshirtSize == "XL"){{{"checked"}}}@endif/>XL</label></li>	
		</form>
		@yield('form')
<table>

@endsection