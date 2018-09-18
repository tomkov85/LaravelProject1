@extends('main')

@section('content')

<h2>Our most popular t-shirts</h2>

<table>
	<tr>
	@foreach($popularPicsTable as $pics)
		<td><a href = "{{$pics->name}}?color=white&size=M"><img src="{{$pics->url}}" /><br>{{$pics->name}}</a><td>
	@endforeach
	</tr>
</table>

<h2>Our t-shirt tags</h2>
<table>
		@php
			$tagNumber = 0;
		@endphp		
		@foreach($tagTable as $tag)
		@php
			$tagNumber++;
			if($tagNumber%4==1){echo '<tr>';}
		@endphp	
			<td><a href = "{{$tag->name}}?color=white&size=M"><img src="{{$tag->url}}" /><br>{{$tag->tag}}</a><td>
		@php
			if($tagNumber%4==0){echo '</tr>';}
		@endphp			
		@endforeach	
		</tr>
	
<table>

@endsection