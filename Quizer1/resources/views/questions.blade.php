@extends('main')

@section('content')

@include('pointsTable')

<div class="container">
  <span class = "col-sm-10">
  <table class="table table-bordered" id = "questionTable">
	<thead>
		<th colspan = '2'><center>{{$question->Question}}</center></th>
	</thead>
	  <tbody>
      <tr>
        <td class="info" onclick = "checkAnswer('1')" id = "1">{{$question->Answer1}}</td>
        <td class="success" onclick = "checkAnswer('2')" id = "2">{{$question->Answer2}}</td>
      </tr>
      <tr>
        <td class="active" onclick = "checkAnswer('3')" id = "3">{{$question->Answer3}}</td>
        <td class="warning" onclick = "checkAnswer('4')" id = "4">{{$question->Answer4}}</td>
      </tr>
    </tbody>
  </table>
  </span>
  <div class = "col-sm-1">
	Time	
	<form id = "myForm" method = "Get" action = "data">
		<input type = "number" name = "timer" id = "timer" readonly />
		<input type = "number" name = "answer" id = "answer" value = "0" readonly />
	</form>
  </div>
</div>
<a id = "message" class = ""></a>
<a id = "correctAnswer">{{$question->CorrectAnswer}}</a>
<script type = "text/javascript" src="js/questionPage.js"></script>
@endsection