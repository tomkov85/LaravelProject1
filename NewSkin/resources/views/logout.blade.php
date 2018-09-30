@extends('main')

@section('content')
<a class="nav-link text-success btn btn-outline-success" href="{{ route('logout') }}"
   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
    {{ csrf_field() }}
</form>
@endsection