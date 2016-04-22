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
	




	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:white; border-radius:5px;">
			
			
			
			
			<table class="table">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Nazwa</th>
				  <th>Status</th>
				  <th>Wykonaj</th>
				</tr>
			  </thead>
			  <tbody>
				@foreach($jobAv as $ja)
				<tr>
				  <td>{!! $Counter++ !!}</td>
				  <td>{!! $ja['name'] !!}</td>
				  <td>
					@if($ja['active'])
						Aktywne
					@else
						Nieaktywne
					@endif
				  
				  </td>
				  <td>
				  	@if($ja['active'])
						<a href="{!! url::to('user/doJob', array('id'=>$ja['job_id'])) !!}">Wykonaj</a>
					@else
						Niedostêpne
					@endif
				  
				  </td>
				</tr>
				@endforeach

			  </tbody>
			</table>
		</div>
	</div>
	</div>
	
	

</body>