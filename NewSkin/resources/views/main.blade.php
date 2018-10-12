<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NewSkin</title>
		<link rel = "stylesheet" type = "text/css" href = "/NewSkin/public/css/bootstrap.css">
		<link rel = "stylesheet" type = "text/css" href = "/NewSkin/public/css/NewSkin.css">
		<script type = "text/javascript" src = "/NewSkin/public/js/jQuery.js"></script>
		<script type = "text/javascript" src = "/NewSkin/public/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class = "navbar navbar-inverse">
		<div class = "container-fluid">
			<div class = "navbar-header">
				<a class="navbar-brand" href = "/NewSkin/public/home">NewSkin</a>
			</div>
			<ul class = "nav navbar-nav">
				<li><a href = "/NewSkin/public/custTs">your pics</a></li>
				<li><a href = "/NewSkin/public/ourTs?searchField=&searchTag=">our samples</a></li>
				<li><a href = "/NewSkin/public/delivery">delivery</a></li>
				<li><a href = "contact">contact us</a></li>
			</ul>
		
		<ul class="nav navbar-nav navbar-right">
		@if(session()->get('userOrderPrizeSum') != "" )
			<li><a href="/NewSkin/public/shopppingCart"><img src = "/NewSkin/public/icons/glyphicons-203-shopping-cart.png"> Cart: {{session()->get('userOrderPrizeSum')}}</a></li>
		@endif
		@if(Auth::guest())
			<li><a href="{{ route('register') }}"><img src = "/NewSkin/public/icons/glyphicons-400-registration-mark.png"> Sign Up</a></li>
			<li><a href="{{ route('login') }}"><img src = "/NewSkin/public/icons/glyphicons-387-log-in.png"> Login</a></li>	
		@endif
		@if(Auth::check())
			<li class = "dropdown"><a class ="dropdown-toggle" data-toggle ="dropdown">{{Auth::user()->email}}<span class ='caret'></span></a>
				<ul class = "dropdown-menu">
					<li></li>
					<li><a href = "updateUser">Modify datas</a></li>
					<li><a href = "{{ route('logout') }}">Logout</a></li>
				</ul>
			</li>
		@endif
		</ul>
		</div>
		</nav>
		
		@yield('content')

	<footer class = "navbar navbar-inverse navbar-fixed-bottom">
		<div>&#169 copyrigth Tom</div>
		<div>2018</div>		
	</footer>
	<script type = "text/javascript" src = "/NewSkin/public/js/NewSkin.js"></script>
    </body>
</html>
