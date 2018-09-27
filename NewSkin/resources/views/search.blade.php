@extends('main')

@section('content')
<form class = "form-inline">
	<div class = "form-group">
		<label>Search by name</label>
		<input class="form-control" name = "searchField" type = "search" pattern = "[^<>()?]{1,30}" title = "Please dont use special characters!">
	</div>
	<div class = "form-group">
		<label>Categories</label>
		<select name = "searchTag" id = "tagSelect">
		<option>All</option>
			@foreach($tagTable as $tag)
				<option value = "{{$tag->tag}}">{{$tag->tag}}</option>
			@endforeach
		</select>
	</div>
	<button class="btn btn-primary" type="submit" id = "mainSearchButton"><img src = "icons/glyphicons-28-search.png" /></button>
</form>
@if(!empty($_GET['searchTag']) & $popularPics)
<h2>Sorry, no match for {{$_GET['searchField']}} in {{$_GET['searchTag']}} tag</h2>
@endif

@if($popularPics)
<h2>Our most popular t-shirts</h2>
@endif
<table>
		@php
			$searchResultNumber = 0;
		@endphp		
		@foreach($searchTable as $searchResult)
		@php
			$searchResultNumber++;
			if($searchResultNumber%4==1){echo '<tr>';}
		@endphp	
			<td><a href = "{{$searchResult->name}}?color=white&size=M"><img src="{{$searchResult->url}}" /><br>{{$searchResult->name}}</a><td>
		@php
			if($searchResultNumber%4==0){echo '</tr>';}
		@endphp			
		@endforeach	
		</tr>
	
<table>

@endsection