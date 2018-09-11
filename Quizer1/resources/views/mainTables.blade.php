@extends('main')

@yield('title')

@section('content')
<div class="container">
  <span class = "col-sm-10">
  <table class="table table-bordered">
	<thead>
		<th><center>Player name</center></th>
		<th><center>Correst answers</center></th>
		<th><center>Time Sum</center></th>
	</thead>
    <tbody>
	  <tr>
        <td>{{$name}}</td>
		<td>{{$points}}</td>
		<td>{{$timeSum}}</td>
      </tr>
    </tbody>
  </table>
  </span>
</div>
@endsection

@yield('content1')