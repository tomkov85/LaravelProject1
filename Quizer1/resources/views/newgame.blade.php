@extends('main')

@section('content')

<div class="container">
  <h3>New Game</h3>
  <p>Please give your name and press start!</p>
  <form class="form-inline" action="new" method = "GET">
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="name" pattern = "[^<>(){}?!']{2,20}" required /> *
  </div>
  <button type="submit" class="btn btn-info">Start</button>
  </form>
  <p>* Please dont use special characters, and your name length must be under 20</p>
</div>

@endsection