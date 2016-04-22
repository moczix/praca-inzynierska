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
	
	<button class="btn btn-primary" data-toggle="modal" data-target="#addJob">Dodaj Zadanie</button>
	<div style="width:100%; height:20px;"></div>
	
	<!--DODAJ Modal -->
<div class="modal fade" id="addJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Dodaj Zadanie</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'addJobForm')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError1"></span></center>
			  <div class="form-group">
				<label for="nameJobForm">Nazwa</label>
				<input type="text" class="form-control" id="nameJobForm" placeholder="Nazwa">
			  </div>
			<div class="form-group">
				<label for="textJobForm">Treść</label>
				<textarea class="form-control" id="textJobForm" rows="4"></textarea>

			  </div>
			  <div class="form-group">
				<label for="numberJobForm">Ilośc prób do wykonania</label>
				<input type="number" class="form-control" id="numberJobForm" placeholder="Ilośc prób pozytywnych prób do wykonania">
			  </div>
				<div class="form-group">
				<label for="dayJobForm">Przerwa po wykonaniu zadania</label>
				<input type="number" class="form-control" id="dayJobForm" placeholder="Dni">

				<input type="number" class="form-control" id="hourJobForm" placeholder="Godziny">

				<input type="number" class="form-control" id="minuteJobForm" placeholder="Minuty">
			  </div>
			
			<p><i>Pozostawienie wolnych pól w przerwie oznacza "bez przerwy", a w prób do wykonania "bez limitu"</i></p>
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary addNewJob">Dodaj</button>
      </div>
    </div>
  </div>
</div>


	<!--EDIT Modal -->
<div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
        <h4 class="modal-title" id="myModalLabel">Edytuj Zadanie</h4>
      </div>
      <div class="modal-body">
        
		{!! Form::open(array('role'=>'form', 'id'=>'editJobForm')) !!}
			<center><span style="color:#D8230F;font-weight:bold;" class="logError2"></span></center>
			  <div class="form-group">
				<label for="nameJobForm">Nazwa</label>
				<input type="text" class="form-control" id="nameJobForm" placeholder="Nazwa">
			  </div>
			<div class="form-group">
				<label for="textJobForm">Treść</label>
				<textarea class="form-control" id="textJobForm" rows="4"></textarea>
				
				<input type="hidden" id="jobDt">
			  </div>
			  <div class="form-group">
				<label for="numberJobForm">Ilośc prób pozytywnych prób do wykonania</label>
				<input type="number" class="form-control" id="numberJobForm" placeholder="Ilośc prób pozytywnych prób do wykonania">
			  </div>
				<div class="form-group">
				<label for="dayJobForm">Przerwa po wykonaniu zadania</label>
				<input type="number" class="form-control" id="dayJobForm" placeholder="Dni">

				<input type="number" class="form-control" id="hourJobForm" placeholder="Godziny">

				<input type="number" class="form-control" id="minuteJobForm" placeholder="Minuty">
			  </div>
			
			<p><i>Pozostawienie wolnych pól w przerwie oznacza "bez przerwy", a w prób do wykonania "bez limitu"</i></p>
		{!! Form::close() !!}
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="button" class="btn btn-primary editNewJob">Zapisz</button>
      </div>
    </div>
  </div>
</div>
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white; border-radius:5px;">
			
			
			
			
			<table class="table">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Nazwa</th>
				  <th>Historia</th>
				  <th>Status</th>
				  <th>Skasuj</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($jobs as $jb)
				<tr>
				  <td>{!! $Counter++ !!}</td>
				  <td>{!! $jb->name !!} <a href="#" class="editJob" data-job="{!! $jb->job_id !!}" data-name="{!! $jb->name !!}" data-text="{!! $jb->job !!}" data-attempt="{!! $jb->attempt !!}" data-break="{!! $jb->break !!}" data-toggle="modal" data-target="#editJob">Edytuj</a></td>
				  <th><a href="{!! url::to('admin/showHistory',array('id'=>$jb->job_id)) !!}">Pokaż</a></th>
				  <td>
				  	@if($jb->active)
						Aktywne
					@else
						Nieaktywne
					@endif
					
					<a href="{!! url::to('admin/changeJobStatus',array('id'=>$jb->job_id)) !!}">Zmień</a></td>
				  </td>
				  <td><a href="{!! url::to('admin/delJob',array('id'=>$jb->job_id)) !!}">Skasuj</a></td>
				</tr>
				@endforeach;

			  </tbody>
			</table>
			<div class="text-center">
				{!! $jobs->render(new \Illuminate\Pagination\BootstrapThreePresenter($jobs)) !!}
			</div>
		</div>
	</div>
	</div>
	
	
	<script>
	
	
$('.editJob').click(function(e){
	e.preventDefault();
	
	$('#editJobForm #nameJobForm').val($(this).data('name'));
	$('#editJobForm #textJobForm').val($(this).data('text'));
	$('#editJobForm #numberJobForm').val($(this).data('attempt'));
	var sec = $(this).data('break');
	var day = Math.floor(sec / 86400);

	var hour = Math.floor((sec % 86400) / 3600);

	var minute = Math.floor(((sec % 86400) % 3600) / 60);

	$('#editJobForm #jobDt').val($(this).data('job'));
	
	$('#editJobForm #dayJobForm').val(day);
	$('#editJobForm #hourJobForm').val(hour);
	$('#editJobForm #minuteJobForm').val(minute);
});	


$('.editNewJob').click(function(e){
$.post("{!! URL::to('/admin/editJob') !!}",
		{ 	_token : $('#editJobForm input[name=_token]').val(),
						name : $('#editJobForm #nameJobForm').val(),
						text : $('#editJobForm #textJobForm').val(),
						attempt : $('#editJobForm #numberJobForm').val(),
						breakDay : $('#editJobForm #dayJobForm').val(),
						breakHour : $('#editJobForm #hourJobForm').val(),
						breakMinute : $('#editJobForm #minuteJobForm').val(),
						jobDt : $('#editJobForm #jobDt').val()
						
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
	
	
$('.addNewJob').click(function(e){
$.post("{!! URL::to('/admin/addJob') !!}",
		{ 	_token : $('#addJobForm input[name=_token]').val(),
						name : $('#addJobForm #nameJobForm').val(),
						text : $('#addJobForm #textJobForm').val(),
						attempt : $('#addJobForm #numberJobForm').val(),
						breakDay : $('#addJobForm #dayJobForm').val(),
						breakHour : $('#addJobForm #hourJobForm').val(),
						breakMinute : $('#addJobForm #minuteJobForm').val(),
						
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