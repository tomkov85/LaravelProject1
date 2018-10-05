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
				<a class="navbar-brand" href = "home">NewSkin</a>
			</div>
			<ul class = "nav navbar-nav">
				<li><a href = "custTs">customers tshirt</a></li>
				<li><a href = "ourTs">our tshirts</a></li>
				<li><a href = "delivery">delivery</a></li>
				<li><a href = "contact">contact us</a></li>
			</ul>
		
		<ul class="nav navbar-nav navbar-right">
		@if(session()->get('userOrderPrizeSum') != "" )
			<li><a href="shopppingCart"><img src = "/NewSkin/public/icons/glyphicons-203-shopping-cart.png"> Cart: {{session()->get('userOrderPrizeSum')}}</a></li>
		@endif
		@if(Auth::guest())
			<li><a href="{{ route('register') }}"><img src = "/NewSkin/public/icons/glyphicons-400-registration-mark.png"> Sign Up</a></li>
			<li><a href="{{ route('login') }}"><img src = "/NewSkin/public/icons/glyphicons-387-log-in.png"> Login</a></li>	
		@endif
		@if(Auth::check())
			<li class = "dropdown"><a class ="dropdown-toggle" data-toggle ="dropdown">{{Auth::user()->email}}<span class ='caret'></span></a>
				<ul class = "dropdown-menu">
					<li><a class = "btn btn-primary" href = "updateUser">modify data</a></li>
					<li><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
							{{ csrf_field() }}
							<input class = "btn btn-danger" type = "submit" value = "Logout"/>
						</form>
					</li>
				</ul>
			</li>
		@endif
		</ul>
		</div>
		</nav>
		
		@yield('content')
		
	<footer class = "navbar navbar-inverse navbar-fixed-bottom">
		<div>copyrigth Tom</div>
		<div>2018</div>		
	</footer>
	<script type = "text/javascript" src = "/NewSkin/public/js/NewSkin.js"></script>
    </body>
</html>
