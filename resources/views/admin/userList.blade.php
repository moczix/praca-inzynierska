@include('admin.pageHeader')

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
	<button class="btn btn-primary" data-toggle="modal" data-target="#addUser">Dodaj Użytkownika</button>
	<br><br>
	<Center>
		<ul class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#allUsers" role="tab" data-toggle="tab">Wszyscy</a></li>
		  <li><a href="#activeUsers" role="tab" data-toggle="tab">Aktywni</a></li>
		  <li><a href="#noactiveUsers" role="tab" data-toggle="tab">Nieaktywni</a></li>
		</ul>
	</center>
	
	<div class="row">
	
	<div style="width:100%; height:20px;"></div>
	

	
	

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tab-content" style="background-color:white; border-radius:5px;">
			
		
			<div class="tab-pane active" id="allUsers">
				<table class="table">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Login</th>
					  <th>Email</th>
					  <th>Pokaż</th>
					  <th>Grupa</th>
					  <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach($usersList as $us)
					<tr>
						<td>{!! $userCounter++ !!}</td>
						<td>{!! $us->username !!}</td>
						<td>{!! $us->email !!}</td>
						<td><a href="{!! url::to('admin/showUser',array('id'=>$us->uuid)) !!}">Pokaż</a></td>
						<td>(
						@if($us->group['name'] != "")
							{!! $us->group['name'] !!}
						@else
							Brak
						@endif
						)
						
						 <a href="#" class="chooseGroup" data-user="{!! $us->uuid !!}" data-toggle="modal" data-target="#editGroup">Zmień</a></td>
						<td>
						@if($us->active)
							Aktywne
						@else
							Nieaktywne
						@endif
						
						<a href="{!! url::to('admin/changeStatus',array('id'=>$us->uuid)) !!}">Zmień</a></td>
					</tr>
					
					@endforeach
				  </tbody>
				</table>
				
			<div class="text-center">
				{!! $usersList->render(new \Illuminate\Pagination\BootstrapThreePresenter($usersList)) !!}
			</div>
				
				
			</div>
			
			 <div class="tab-pane" id="activeUsers">
			 
			 	<table class="table">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Login</th>
					  <th>Email</th>
					  <th>Pokaż</th>
					  <th>Grupa</th>
					  <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach($usersListActive as $za)
					<tr>
						<td>{!! $userACounter++ !!}</td>
						<td>{!! $za->username !!}</td>
						<td>{!! $za->email !!}</td>
						<td><a href="{!! url::to('admin/showUser',array('id'=>$za->uuid)) !!}">Pokaż</a></td>
						<td>(
						@if($za->group['name'] != "")
							{!! $za->group['name'] !!}
						@else
							Brak
						@endif
						)
						
						 <a href="#" class="chooseGroup" data-user="{!! $za->uuid !!}" data-toggle="modal" data-target="#editGroup">Zmień</a></td>
						<td>
						@if($za->active)
							Aktywne
						@else
							Nieaktywne
						@endif
						
						<a href="{!! url::to('admin/changeStatus',array('id'=>$za->uuid)) !!}">Zmień</a></td>
					</tr>
					
					@endforeach
				  </tbody>
				</table>
			<div class="text-center">
				{!! $usersListActive->render(new \Illuminate\Pagination\BootstrapThreePresenter($usersListActive)) !!}
			</div>
			 
			 
			 </div>
			  <div class="tab-pane" id="noactiveUsers">
			  
			  	<table class="table">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Login</th>
					  <th>Email</th>
					  <th>Pokaż</th>
					  <th>Grupa</th>
					  <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					@foreach($usersListNoActive as $zs)
					<tr>
						<td>{!! $userNCounter++ !!}</td>
						<td>{!! $zs->username !!}</td>
						<td>{!! $zs->email !!}</td>
						<td><a href="{!! url::to('admin/showUser',array('id'=>$zs->uuid)) !!}">Pokaż</a></td>
						<td>(
						@if($zs->group['name'] != "")
							{!! $zs->group['name'] !!}
						@else
							Brak
						@endif
						)
						
						 <a href="#" class="chooseGroup" data-user="{!! $zs->uuid !!}" data-toggle="modal" data-target="#editGroup">Zmień</a></td>
						<td>
						@if($zs->active)
							Aktywne
						@else
							Nieaktywne
						@endif
						
						<a href="{!! url::to('admin/changeStatus',array('id'=>$zs->uuid)) !!}">Zmień</a></td>
					</tr>
					
					@endforeach
				  </tbody>
				</table>
			  
			<div class="text-center">
				{!! $usersListNoActive->render(new \Illuminate\Pagination\BootstrapThreePresenter($usersListNoActive)) !!}
			</div>
			  
			  
			  </div>
			
			
		</div>
	</div>
	</div>

	
	<script>
	var user = 0;
		$('.chooseGroup').click(function(e){
			e.preventDefault();
			user = $(this).data('user');
		});
	
	</script>
	
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
	
	
	

		<!--DODAJ Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Dodaj Użytkownika</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'addUserForm')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError1"></span></center>
			  <div class="form-group">
				<label for="loginForm">Login</label>
				<input type="text" class="form-control" id="loginForm" placeholder="Podaj login">
				<label for="pswForm">Hasło</label>
				<input type="password" class="form-control" id="pswForm" placeholder="Podaj Hasło">
				<label for="psw2Form">Powtórz Hasło</label>
				<input type="password" class="form-control" id="psw2Form" placeholder="Podaj Hasło">
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary addUser">Dodaj</button>
      </div>
    </div>
  </div>
</div>		
	





	<script>
$('.editUser').click(function(e){
$.post("{!! URL::to('/admin/chooseGroup') !!}",
		{ 	_token : $('#EditUserForm input[name=_token]').val(),
						group : $('#EditUserForm #GroupSelect').val(),
						user : user
		},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){///
			$('.logError2').html(firstJsonResponse(request.responseText));
	});

});	
	
	
	//user
$('.addUser').click(function(e){
$.post("{!! URL::to('/admin/addNewUser') !!}",
		{ 	_token : $('#addUserForm input[name=_token]').val(),
						username : $('#addUserForm #loginForm').val(),
						password1 : $('#addUserForm #pswForm').val(),
						password2 : $('#addUserForm #psw2Form').val()
		},		 
			function(data){
				if(data == ""){
					location.reload();
				}
			}
		).error(function(request, status, error){///
			$('.logError1').html(firstJsonResponse(request.responseText));
	});

});	
	
	


</script>


</body>