<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RentOn</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/RentOn.css">
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <script type="text/javascript" src="js/RentOn.js"></script>
	</head>
	<body>
		<nav class = "navbar">
			<div class = "navbar-header">
				<a class="navbar-brand" href = "/RentOn/public/">RentOn</a>
			</div>
			<ul class = "navbar-nav">			
				<li class='nav-item navLi'><a href = "/RentOn/public/search">buy/rent</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/login">sell</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/contact">contact us</a></li>
			</ul>
			<ul class="navbar-nav navbar-right navUl">
					<li class='nav-item navLi' ><a href="/RentOn/public/regist"><span><img alt="error" src="icons/glyphicons-400-registration-mark.png"/></span>Sign Up</a></li>
					<li class='nav-item navLi'><a href="/RentOn/public/login"><span><img alt="error" src="icons/glyphicons-387-log-in.png"/></span>Login</a></li>
			</ul>
		</nav>
		<div id="page-container">
		@yield('content')
		</div>
		<footer>
			<a> copyright Tom</a>
		</footer>
	</body>	
</html>
