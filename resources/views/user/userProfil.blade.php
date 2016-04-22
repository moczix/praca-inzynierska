@include('user.pageHeader')

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
	
	<div style="width:100%; height:20px;"></div>
	
	<!--SHOW Modal -->
<div class="modal fade" id="showMe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Szczegóły Zadania</h4>
      </div>
      <div class="modal-body">
        
			<pre>
			<span class="hisDTL"></span>
			</pre>

		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white; border-radius:5px;">
			<h3><center>Użytkownik</center></h3>
			<table class="table">
				<tr>
					<th>Nazwa</th>
					<td>{!! $user[0]['username'] !!}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{!! $user[0]['email'] !!}
					
					<a href="#" class="changeEmail" data-user="{!! $user[0]['uuid'] !!}" data-current="{!! $user[0]['email'] !!}" data-toggle="modal" data-target="#changeEmail">Zmień</a>
					</td>

				</tr>
				<tr>
					<th>Hasło</th>
					<td>
					@if($user[0]['adminCreated'])
						{!! $user[0]['showPassword'] !!}
						<a href="#" class="changePassword" data-user="{!! $user[0]['uuid'] !!}" data-current="{!! $user[0]['showPassword'] !!}" data-toggle="modal" data-target="#changePsw">Zmień</a>
					@else
						(Ustawione przez użytkownika)
						<a href="#" class="changePassword" data-user="{!! $user[0]['uuid'] !!}" data-current="<i>Ustawione przez usera</i>" data-toggle="modal" data-target="#changePsw">Zmień</a>
					
					@endif
					
					
					</td>
				</tr>
				<tr>
					<th>Grupa</th>
					<td>
					(
					@if($user[0]['group']['name'] != "")
						{!! $user[0]['group']['name'] !!}
					@else
						Brak
					@endif
					)
					</td>
				</tr>
			
				<tr>
					<th>Płeć</th>
					<td>
<div class="radio">
  <label>
    <input type="radio" name="gender" id="gender" value="1" 
		@if($settings->gender == 1)
		checked
		@endif
	>
	
    Męższczyzna
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="gender" id="gender" value="2"
		@if($settings->gender == 2)
		checked
		@endif
	>
    Kobieta
  </label>
</div>
					</td>
				</tr>
			
			
				<tr>
					<th>Praworęczny / Leworęczny</th>
					<td>
<div class="radio">
  <label>
    <input type="radio" name="hand" id="hand" value="1"
		@if($settings->hand == 1)
		checked
		@endif
	>
    Praworęczny
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="hand" id="hand" value="2"
		@if($settings->hand == 2)
		checked
		@endif
	>
    lewyręczny
  </label>
</div>
					</td>
				</tr>
			
				<tr>
					<th>Urządzenie</th>
					<td>
<div class="radio">
  <label>
    <input type="radio" name="device" id="device" value="1"
		@if($settings->device == 1)
		checked
		@endif
	>
    Komputer
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="device" id="device" value="2"
		@if($settings->device == 2)
		checked
		@endif
	>
    Laptop
  </label>
</div>
					</td>
				</tr>
				
				<tr>
					<th>Klawiatura</th>
					<td>
<div class="radio">
  <label>
    <input type="radio" name="keyboard" id="keyboard" value="1"
		@if($settings->keyboard == 1)
		checked
		@endif
	>
    Fizyczna
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="keyboard" id="keyboard" value="2"
		@if($settings->keyboard == 2)
		checked
		@endif
	>
    Dotykowa
  </label>
</div>
					</td>
				</tr>
				
				<tr>
					<th>Data urodzenia</th>
					<td>
						<div class="form-group">
							<input type="text" class="form-control" id="birth" placeholder="dd/mm/yyyy" value="{!! $settings->birthString !!}">
						</div>
					</td>
				</tr>
			
			
			</table>
		<b><span style="color:#b20a07;" class="settingsError"></span><br></b>
		<button class="btn btn-primary saveSettings">Zapisz Ustawienia</button>
			
		</div>
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white; border-radius:5px;">
			
			
			<h3><center>Zadania</center></h3>
			
			<table class="table">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Użytkownik</th>
				  <th>Data</th>
				  <th>Pokaż</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($history as $hs)
				<tr>
				  <td>{!! $Counter++ !!}</td>
				  <td>{!! $hs->user->username !!}</td>
				  <td>{!! date('Y-m-d H:i:s',$hs->date) !!}</td>
				  <td><a href="{!! url::to('user/getDetailsHistory',array('id'=>$hs->log_id)) !!}" target="_blank" >Pokaż</a></td>
				</tr>
				@endforeach;

			  </tbody>
			</table>
			<div class="text-center">
				{!! $history->render(new \Illuminate\Pagination\BootstrapThreePresenter($history)) !!}
			</div>
		</div>
	</div>
	</div>
	
	
	
<!--EDIT Modal -->
<div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Zmień Grupe</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'EditUserForm')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError2"></span></center>
			  <div class="form-group">
				{!! Form::select('GroupSelect', $groupSelectOption,null, array("class"=>"form-control", "id"=>"GroupSelect")) !!}
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary editUser">Zmień</button>
      </div>
    </div>
  </div>
</div>	
	
	
<!--EDIT Modal HASLO-->
<div class="modal fade" id="changePsw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Zmień Hasło</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'changePsw')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError3"></span></center>
			<B>obecne hasło: <span class="currentPsw">TEST22</Span></B><BR>
			  <div class="form-group">
				
				<label for="pswForm">Hasło</label>
				<input type="password" class="form-control" id="pswForm" placeholder="Podaj Hasło">
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary savePSW">Zapisz</button>
      </div>
    </div>
  </div>
</div>	


<!--EDIT Modal EMAIL-->
<div class="modal fade" id="changeEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Zmień Email</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'changeEmail')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError4"></span></center>
			<B>obecny email: <span class="currentEmail">TEST22</Span></B><BR>
			  <div class="form-group">
				
				<label for="pswForm">Email</label>
				<input type="email" class="form-control" id="emailForm" placeholder="Podaj Hasło">
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary saveEmail">Zapisz</button>
      </div>
    </div>
  </div>
</div>
	
	
	<script>
		var user = 0;
		var user2 = 0;
		
		
		$('.changePassword').click(function(e){
			e.preventDefault();
			user2 = $(this).data('user');
			$('.currentPsw').html($(this).data('current'));
		});
		
		$('.changeEmail').click(function(e){
			e.preventDefault();
			user2 = $(this).data('user');
			$('.currentEmail').html($(this).data('current'));
		});
		
	//zastanow sie czy ma byc POST czy ma byc GET (wg mnie obojetne xD ale teoretycznie powinien byc get)
$('.showMeS').click(function(e){
	e.preventDefault();
	var ids = this.id;
	console.log("{!! URL::to('/user/getDetailsHistory') !!}/"+ids);
	$.get( "{!! URL::to('/user/getDetailsHistory') !!}/"+ids, function( data ) {
	  $('.hisDTL').html(data);
	});
});



$('.saveSettings').click(function(e)
{
	var token = $('#changePsw input[name=_token]').val();
	var hand = $('#hand:checked').val();
	
	var keyboard = $('#keyboard:checked').val();
	var device = $('#device:checked').val();
	var gender = $('#gender:checked').val();
	
	var birth = $('#birth').val();
	if(typeof hand != "undefined" && typeof keyboard != "undefined" && typeof device != "undefined" && typeof gender != "undefined" && birth != "" )
	{
			$.post("{!! URL::to('/user/changeSettings') !!}",
					{ 	_token : token,
									hand : hand,
									keyboard : keyboard,
									device: device,
									birth: birth,
									gender: gender
									
					},		 
						function(data){
							if(data == ""){
								location.reload();
							}
						}
					).error(function(request, status, error){///
						$('.settingsError').html(firstJsonResponse(request.responseText));
				});
	}
	else
	{
		$('.settingsError').html("Zaznacz opcje i uzupełnij datę urodzenia");
	}
	
});
	
	
$('.savePSW').click(function(e){
$.post("{!! URL::to('/user/changePSW') !!}",
		{ 	_token : $('#changePsw input[name=_token]').val(),
						psw : $('#changePsw #pswForm').val(),
						user : user2
		},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){///
			$('.logError3').html(firstJsonResponse(request.responseText));
	});

});	



$('.saveEmail').click(function(e){
$.post("{!! URL::to('/user/changeEmail') !!}",
		{ 	_token : $('#changeEmail input[name=_token]').val(),
						email : $('#changeEmail #emailForm').val(),
						user : user2
		},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){///
			$('.logError4').html(firstJsonResponse(request.responseText));
	});

});//

</script>	
	
	



</body>