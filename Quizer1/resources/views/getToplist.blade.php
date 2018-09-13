<h2>Toplist</h2>
<div class="container">
  <span class = "col-sm-10">
  <table class="table table-striped">
	<thead>
		<th><center>Rank</center></th>
		<th><center>Player name</center></th>
		<th><center>Correst answers</center></th>
		<th><center>Time Sum</center></th>
	</thead>
    <tbody>
		@php $rank = 0; @endphp
		@foreach($toplist as $toplistrow)
			<tr>
				<td>@php $rank++; echo $rank @endphp</td>
				<td>{{$toplistrow->username}}</td>
				<td>{{$toplistrow->points}}</td>
				<td>{{$toplistrow->timeSum}}</td>
			</tr>
		@endforeach
	</tbody>
	</table>
	</span>
	</div>