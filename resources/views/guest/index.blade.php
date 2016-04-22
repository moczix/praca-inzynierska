@include('guest.pageHeader', ['login'=>$login, 'admin'=>$admin])

	@if(isset($goodMsg))
	<div class="alert alert-success alert-dismissable col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  {!! $goodMsg !!}
	</div>
	@endif
	@if(isset($badMsg))
	<div class="alert alert-danger alert-dismissable  col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  {!! $badMsg !!}
	</div>
	@endif


	<div class="container">
	<div class="row">
	
	@if(!$login)
			
		<p><center style="color:#b20a07;" class="error"></center></p>
	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background-color:white; border-radius:5px;">
			<h2><center>Logowanie</center></h2>
			
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
	  
<a href="#" data-toggle="modal" data-target="#forgetPsw">Zapomniałem Hasła</a><br>	  


<div class="modal fade" id="forgetPsw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Zmień Hasło</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'forgetPsw')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError3"></span></center>
			  <div class="form-group">
				<p>Na email otrzymasz nazwe użytkownika i nowe hasło</p>
				<label for="pswForm">Podaj Email</label>
				<input type="email" class="form-control" id="pswForm" placeholder="Podaj Email">
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary forgetPSW">Zapisz</button>
      </div>
    </div>
  </div>
</div>	

	  
	 
<button type="button" class="btn btn-primary loginbtn">Zaloguj</button>

		</div>	
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="background-color:white; border-radius:5px;">
			<h2><center>Rejestracja</center></h2>
			
		
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
	  
	  <div class="form-group">
		<label for="keyGroup"  class="sr-only">Klucz Grupy(Jeśli jest)</label>
		<input type="text" name="keyGroup" class="form-control" id="keyGroup" placeholder="Klucz Grupy(Jeśli jest)">
	  </div>
	 
	  {!! Form::close() !!}
		 <button type="button" class="btn btn-primary registerbtn">Zarejestruj</button>

			
		</div>	
		
	@endif
	</div>
	</div>

<script>

  	$(".forgetPSW").click(function(event){
		$.post("{!! URL::to('/forgetPSW') !!}",
			{ _token : $('#forgetPsw input[name=_token]').val(),
			email : $('#forgetPsw #pswForm').val()
			},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){
			$('.logError3').html(firstJsonResponse(request.responseText));
		});
	});



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
			$('.error').html(firstJsonResponse(request.responseText));
		});
	});
</script>	
	
	
<script>
  	$(".registerbtn").click(function(event){
		$.post("{!! URL::to('/register') !!}",
			{ _token : $('#registerForm input[name=_token]').val(),
			username : $('#registerForm input[name=username]').val(),
			email : $('#registerForm input[name=email]').val(),
			password1 : $('#registerForm input[name=password1]').val(),
			password2 : $('#registerForm input[name=password2]').val(),
			keyGroup  : $('#registerForm input[name=keyGroup]').val()
			},		 
			function(data){
				if(data != ""){
					$('.regMsg').html(data);
					$('#registerForm input[name=username]').val("");
					$('#registerForm input[name=email]').val("");
					$('#registerForm input[name=password1]').val("");
					$('#registerForm input[name=password2]').val("");
					$('#registerForm input[name=keyGroup]').val("");
				}
			}
		).error(function(request, status, error){
			$('.error').html(firstJsonResponse(request.responseText));
		});
	});
</script>


{!! HTML::script('resources/assets/js/ajaxFileForm.js') !!}

</body>