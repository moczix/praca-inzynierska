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
					<td>{!! $user[0]['email'] !!}</td>
				</tr>
				<tr>
					<th>Hasło</th>
					<td>
					@if($user[0]['adminCreated'])
						{!! $user[0]['showPassword'] !!}
						<a href="#" class="changePassword" data-user="{!! $user[0]['uuid'] !!}" data-current="{!! $user[0]['showPassword'] !!}" data-toggle="modal" data-target="#changePsw">Zmień</a>
					@else
						(Ustawione przez użytkownika)
					@endif
					
					
					</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>
					@if($user[0]['active'])
						Aktywne
					@else
						Nieaktywne
					@endif
					<a href="{!! url::to('admin/changeStatus',array('id'=>$user[0]['uuid'])) !!}">Zmień</a></td>
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
					<a href="#" class="chooseGroup" data-user="{!! $user[0]['uuid'] !!}" data-toggle="modal" data-target="#editGroup">Zmień</a>
					</td>
				</tr>
			
			</table>
			
			
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
				  <th>Skasuj</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($history as $hs)
				<tr>
				  <td>{!! $Counter++ !!}</td>
				  <td>{!! $hs->user->username !!}</td>
				  <td>{!! date('Y-m-d H:i:s',$hs->date) !!}</td>
				  <td><a href="#" class="showMeS" id="{!! $hs->log_id !!}" data-toggle="modal" data-target="#showMe">Pokaż</a></td>
				  <td><a href="{!! url::to('admin/delHistory',array('id'=>$hs->log_id)) !!}">Skasuj</a></td>
				</tr>
				@endforeach;

			  </tbody>
			</table>
			
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
	
	
	<script>
		var user = 0;
		var user2 = 0;
		
		
		$('.changePassword').click(function(e){
			e.preventDefault();
			user2 = $(this).data('user');
			$('.currentPsw').html($(this).data('current'));
		});
		
		$('.chooseGroup').click(function(e){
			e.preventDefault();
			user = $(this).data('user');
		});
	//zastanow sie czy ma byc POST czy ma byc GET (wg mnie obojetne xD ale teoretycznie powinien byc get)
$('.showMeS').click(function(e){
	e.preventDefault();
	var ids = this.id;
	console.log("{!! URL::to('/admin/getDetailsHistory') !!}/"+ids);
	$.get( "{!! URL::to('/admin/getDetailsHistory') !!}/"+ids, function( data ) {
	  $('.hisDTL').html(data);
	});
});


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
	
	
$('.savePSW').click(function(e){
$.post("{!! URL::to('/admin/changePSW') !!}",
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

</script>	
	
	



</body>