@extends('main')

@section('content')

<h1>Congratulations, you finished the game</h1>

@include('pointsTable')
@include('getToplist')

<a class = "btn btn-info" href="restart">New Game</a>
<a class = "btn btn-info" href="newGame">New Player</a>
@endsection