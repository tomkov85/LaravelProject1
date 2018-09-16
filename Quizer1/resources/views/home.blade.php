@extends('main')

@section('content')

<div class="container">
  <h3>Welcome to my Quiz Game!</h3>
  <p>In this game, you'll get 10 question about informatics.<br>
	 There is only one good answer, so you can only sign one from the posibilies.<br>
	 You get 30 seconds for thinking, if you miss to sign you'll get 0 points.  
  </p>
  <a class = "btn btn-info" href="newGame">Let's start it!</a>
</div>

@endsection