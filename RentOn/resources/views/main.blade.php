<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RentOn</title>
        <link rel="stylesheet" type="text/css" href="/RentOn/public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/RentOn/public/css/RentOn.css">
        <script type="text/javascript" src="/RentOn/public/js/bootstrap.js"></script>
        <script type="text/javascript" src="/RentOn/public/js/jQuery.js"></script>
        <script type="text/javascript" src="/RentOn/public/js/RentOn.js"></script>
	</head>
	<body>
		<nav class = "navbar">
			<div class = "navbar-header">
				<a class="navbar-brand" href = "/RentOn/public/"><img class="logo" alt="error" src="\RentOn\storage\app\myLogo\RentOnlogo.jpg"/></a>
			</div>
			<ul class = "navbar-nav navUl">			
				<li class='nav-item navLi'><a href = "/RentOn/public/search?searchLoc=&order=&prize=&searchSizeMin=">buy/rent</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/login">sell</a></li>
				<li class='nav-item navLi'><a href = "/RentOn/public/contact">contact us</a></li>
			</ul>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			
			 <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto navbar-right navUl">
                        <!-- Authentication Links -->
                        @guest
                            <li class='nav-item navLi'>
                                <a class="nav-link" href="{{ route('login') }}"><img alt="error" src="/RentOn/public/icons/glyphicons-387-log-in.png"/>{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item navLi">
                                    <a class="nav-link" href="{{ route('register') }}"><span><img alt="error" src="/RentOn/public/icons/glyphicons-400-registration-mark.png"/>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown navLi">
                                <a id="collapse-btn1" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img alt="error" src="/RentOn/public/icons/glyphicons-4-user.png"/> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div  id='collapse1' class="dropdown-menu dropdown-menu-right myDropdownMenu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/RentOn/public/manageMessages?type=inbox"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-128-message-flag.png"/> Messages </a> 
									<br>
									<a class="dropdown-item" href="/RentOn/public/editAccount"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-137-cogwheel.png"/> Data modification </a> 
									<br>
									<a class="dropdown-item" href="/RentOn/public/getAllAdvs?page=1"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-30-notes-2.png"/> Advertisements </a>
									<br>
									@if(Auth::user()->name == "myAdmin")
									<a class="dropdown-item" href="/RentOn/public/editAccountAll"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-4-user.png"/> Users </a>			
									<br>
									<a class="dropdown-item" href="/RentOn/public/shopSettings"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-375-claw-hammer.png"/> Shop Settings </a>			
									<br>
									<a class="dropdown-item" href="/RentOn/public/manageAllMessages?type=all"><img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-128-message-flag.png"/> All Messages </a> 
									<br>
									@endif
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <img class="userIcons" alt="error" src="/RentOn/public/icons/glyphicons-388-log-out.png"/> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
									
									                                                            
                                </div>
                            </li>
                        @endguest
                    </ul>
				</div>
		</nav>
		<div id="page-container">
		@yield('content')
		</div>
		<footer>
			<a> copyright Tom</a>
		</footer>
	</body>	
</html>
