<!DOCTYPE html>
<html lang="en">
<head>
  <title>QuizGame</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type = "text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type = "text/css" href="css/quizer1.css">
  <script type = "text/javascript" src="js/jQuery.js"></script>
  <script type = "text/javascript" src="js/bootstrap.js"></script>
</head>
<body>

<nav class="navbar" id = "headerNav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" id = "homeLink" onclick = "location.href = 'home'">Quizer</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a id = "newGameLink" onclick = "location.href = 'newGame'" >New Game</a></li>
	  <li class="active"><a id = "toplistLink" onclick = "location.href = 'toplist'" >Toplist</a></li>
	  <li class="active"><a id = "contactLink" onclick = "location.href = 'contact'" >Contact Us</a></li>
    </ul>
  </div>
</nav>
  
@yield('content')

<footer id = "footerNav">
     <a class="navbar-brand">copyright Tom 2018</a>
</footer>
</body>
</html>