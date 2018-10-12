@extends('main')

@section('content')

<h2>Our most popular t-shirts</h2>

<table>
	<tr>
	@foreach($popularPicsTable as $pics)
		<td class = "picsTableCell"><a href = "show/{{$pics->name}}?color=white&size=M"><img class = "picsTableImg" src="{{$pics->url}}" /><br>{{$pics->name}}</a><td>
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
			<td class = "picsTableCell"><a href = "ourTs?searchField=&searchTag={{$tag->tag}}"><img class = "picsTableImg" src="{{$tag->url}}" /><br>{{$tag->tag}}</a><td>
		@php
			if($tagNumber%4==0){echo '</tr>';}
		@endphp			
		@endforeach	
		</tr>
	
<table>

@endsection