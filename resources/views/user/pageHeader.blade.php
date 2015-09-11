<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>
		SRZK
	</title>
	
	 <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> 
	 
	
	<link rel="stylesheet" href="https://bootswatch.com/simplex/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
	{!! HTML::style('resources/assets/css/main.css') !!}
	
	{!! HTML::script('resources/assets/js/ajaxFileForm.js') !!}
	</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Grupowanie "marki" i przycisku rozwijania mobilnego menu -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Rozwiń nawigację</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{!! URL::to('/')!!}">SRZK</a>
    </div>
 
    <!-- Grupowanie elementów menu w celu lepszego wyświetlania na urządzeniach moblinych -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
		<li  class="{!! Request::is('user/panel') ? 'active' : '' !!}"><a href="{!! url::to('user/panel') !!}">Zadania</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
	  <!--
	<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Szukaj">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
    </form>
	-->
			<li><a href="{!! url::to('/logout') !!}">Wyloguj</a></li>
      </ul>
    </div><!-- /.navbar-collapsessss -->
  </div><!-- /.container-fluid -->
</nav>





