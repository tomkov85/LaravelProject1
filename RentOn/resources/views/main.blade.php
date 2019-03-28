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
				<li class='nav-item navLi'><a href = "/RentOn/public/search?searchLoc=b&order=prize&searchSizeMin=">buy/rent</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/login">sell</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/contact">contact us</a></li>
			</ul>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			
			 <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto navbar-right navUl">
                        <!-- Authentication Links -->
                        @guest
                            <li class='nav-item navLi'>
                                <a class="nav-link" href="{{ route('login') }}"><img alt="error" src="icons/glyphicons-387-log-in.png"/>{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item navLi">
                                    <a class="nav-link" href="{{ route('register') }}"><span><img alt="error" src="icons/glyphicons-400-registration-mark.png"/>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown navLi">
                                <a id="collapse-btn1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img alt="error" src="icons/glyphicons-4-user.png"/>{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div  id='collapse1' class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <img alt="error" src="icons/glyphicons-388-log-out.png"/>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
				</div>
			<!--
			@if(!Auth::check())
			<ul class="navbar-nav navbar-right navUl">
					<li class='nav-item navLi' ><a href="/RentOn/public/register"><span><img alt="error" src="icons/glyphicons-400-registration-mark.png"/></span>Sign Up</a></li>
					<li class='nav-item navLi'><a href="/RentOn/public/login"><span><img alt="error" src="icons/glyphicons-387-log-in.png"/></span>Login</a></li>
			</ul>
			@endif
			@if(Auth::check())
			<ul class="navbar-nav navbar-right navUl">
					<li class='nav-item navLi' ><a href="/RentOn/public/regist"><span><img alt="error" src="icons/glyphicons-400-registration-mark.png"/></span>{{Auth::user()->name}}</a></li>
					<li class='nav-item navLi'><a href="/RentOn/public/login"><span><img alt="error" src="icons/glyphicons-387-log-in.png"/></span>Logout</a></li>
			</ul>
			@endif-->
		</nav>
		<div id="page-container">
		@yield('content')
		</div>
		<footer>
			<a> copyright Tom</a>
		</footer>
	</body>	
</html>
