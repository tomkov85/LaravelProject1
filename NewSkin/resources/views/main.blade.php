<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NewSkin</title>
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
		<link rel = "stylesheet" type = "text/css" href = "css/NewSkin.css">
		<script type = "text/javascript" src = "js/jQuery.js"></script>
		<script type = "text/javascript" src = "js/bootstrap.js"></script>
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
			<li><a href="register"><img src = "icons/glyphicons-400-registration-mark.png"> Sign Up</a></li>
			<li><a href="login"><img src = "icons/glyphicons-387-log-in.png"> Login</a></li>	
		</ul>
		</div>
		</nav>
		
		@yield('content')
		
	<footer class = "navbar navbar-inverse navbar-fixed-bottom">
		<div>copyrigth Tom</div>
		<div>2018</div>		
	</footer>
	<script type = "text/javascript" src = "js/NewSkin.js"></script>
    </body>
</html>
