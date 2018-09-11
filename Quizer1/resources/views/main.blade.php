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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Quizer</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home">Home</a></li>
    </ul>
  </div>
</nav>
  
@yield('content')

<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="row">
	<div class = "col-sm-4">
	</div>
    <div class = "col-sm-4">
      <a class="navbar-brand">copyright me 2018</a>
    </div>
  </div>
</nav>
</body>
</html>