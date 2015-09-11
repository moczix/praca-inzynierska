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
	<button class="btn btn-primary" data-toggle="modal" data-target="#addGroup">Dodaj Grupe</button>
	<div class="row">
	
	<div style="width:100%; height:20px;"></div>
	

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white; border-radius:5px;">
			
		
			
			<table class="table">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Nazwa</th>
				  <th>Użytkownicy</th>
				  <th>Akcja</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($groupList as $gr)
				<tr>
					<td>{!! $Counter++ !!}</td>
					<td>{!! $gr->name !!}</td>
					<td>{!! $gr->userCount  !!}</td>
					<td><a href="{!! URL::to('/admin/delGroup', array($gr->group_id)) !!}">Skasuj</a></td>
				</tr>
				
				@endforeach
			  </tbody>
			</table>
			
		</div>
	</div>
	</div>
	

		<!--DODAJ Modal -->
<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Dodaj Grupe</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'addGroupForm')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError1"></span></center>
			  <div class="form-group">
				<label for="groupForm">Nazwa Grupy</label>
				<input type="text" class="form-control" id="groupForm" placeholder="Nazwa Grupy">
			  </div>
			
			
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary addGroup">Dodaj</button>
      </div>
    </div>
  </div>
</div>		
	




	<script>

$('.addGroup').click(function(e){
$.post("{!! URL::to('/admin/addNewGroup') !!}",
		{ 	_token : $('#addGroupForm input[name=_token]').val(),
						groupName : $('#addGroupForm #groupForm').val()
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