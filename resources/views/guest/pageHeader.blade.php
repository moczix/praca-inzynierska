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


      <ul class="nav navbar-nav navbar-right">
	  <!--
	<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Szukaj">
        </div>
        <button type="submit" class="btn btn-default">Szukaj</button>
    </form>
	-->
	@if(!$login)
        <li><a href="#" data-toggle="modal" data-target="#registerModal">Zarejestruj</a></li>
		<li><a href="#" data-toggle="modal" data-target="#loginModal">Zaloguj</a></li>
	@else
		@if($admin)
			<li><a href="{!! url::to('/admin/panel') !!}">Panel Admina</a></li>
		@else
			<li><a href="{!! url::to('user/panel') !!}">Panel Użytkownika</a></li>
		@endif
		<li><a href="{!! url::to('/logout') !!}">Wyloguj</a></li>
	@endif
      </ul>
    </div><!-- /.navbar-collapsessss -->
  </div><!-- /.container-fluid -->
</nav>


<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Logowanie</h4>
      </div>
      <div class="modal-body">
        	  {!! Form::open(array("role"=>"form", "id"=>"loginForm")) !!}
		<center><span style="color:#D8230F;font-weight:bold;" class="logError"></span></center>
	  <div class="form-group">
		<label for="username" class="sr-only">Nazwa użytkownika</label>
		<input type="text" name="username" class="form-control" id="username" placeholder="Nazwa użytkownika">
	  </div>

	  <div class="form-group">
		<label for="password"  class="sr-only">Hasło</label>
		<input type="password" name="password" class="form-control" id="password" placeholder="Hasło">
	  </div>
	  
	  {!! Form::close() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary loginbtn">Zaloguj</button>
      </div>
    </div>
  </div>
<script>
  	$(".loginbtn").click(function(event){
		$.post("{!! URL::to('/login') !!}",
			{ _token : $('#loginForm input[name=_token]').val(),
			username : $('#loginForm input[name=username]').val(),
			password : $('#loginForm input[name=password]').val()
			},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){
			$('.logError').html(firstJsonResponse(request.responseText));
		});
	});
</script>
</div>
<!-- LOGIN MODAL -->




<!-- REGISTER MODAL -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Rejestracja</h4>
      </div>
      <div class="modal-body">
	  {!! Form::open(array("role"=>"form", "id"=>"registerForm")) !!}
		<center><span style="color:#D8230F;font-weight:bold;" class="regError"></span></center>
		<center><span style="color:#0d980d;font-weight:bold;" class="regMsg"></span></center>
	  <div class="form-group">
		<label for="username" class="sr-only">Nazwa użytkownika</label>
		<input type="text" name="username" class="form-control" id="username" placeholder="Nazwa użytkownika">
	  </div>
	  <div class="form-group">
		<label for="email"  class="sr-only">Email</label>
		<input type="email" name="email" class="form-control" id="email" placeholder="Email">
	  </div>
	  
	  <div class="form-group">
		<label for="password1"  class="sr-only">Hasło</label>
		<input type="password" name="password1" class="form-control" id="password1" placeholder="Hasło">
	  </div>
	  
	  <div class="form-group">
		<label for="password2"  class="sr-only">Potwierdź Hasło</label>
		<input type="password" name="password2" class="form-control" id="password2" placeholder="Potwierdź Hasło">
	  </div>
	  
	  {!! Form::close() !!}
		
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary registerbtn">Zarejestruj</button>
      </div>
    </div>
  </div>
  
<script>
  	$(".registerbtn").click(function(event){
		$.post("{!! URL::to('/register') !!}",
			{ _token : $('#registerForm input[name=_token]').val(),
			username : $('#registerForm input[name=username]').val(),
			email : $('#registerForm input[name=email]').val(),
			password1 : $('#registerForm input[name=password1]').val(),
			password2 : $('#registerForm input[name=password2]').val()
			},		 
			function(data){
				if(data != ""){
					$('.regMsg').html(data);
					$('#registerForm input[name=username]').val("");
					$('#registerForm input[name=email]').val("");
					$('#registerForm input[name=password1]').val("");
					$('#registerForm input[name=password2]').val("");
				}
			}
		).error(function(request, status, error){
			$('.regError').html(firstJsonResponse(request.responseText));
		});
	});
</script>
  
  
</div>
<!-- REGISTER MODAL -->