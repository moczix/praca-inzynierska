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
				  <td><a href="{!! url::to('admin/getDetailsHistory',array('id'=>$hs->log_id)) !!}" target="_blank">Pokaż</a></td> 
				  <td><a href="{!! url::to('admin/delHistory',array('id'=>$hs->log_id)) !!}">Skasuj</a></td>
				</tr>
				@endforeach;

			  </tbody>
			</table>

		</div>
	</div>
	</div>
	
	
	<script>
	//zastanow sie czy ma byc POST czy ma byc GET (wg mnie obojetne xD ale teoretycznie powinien byc get)
$('.showMeS').click(function(e){
	e.preventDefault();
	var ids = this.id;
	console.log("{!! URL::to('/admin/getDetailsHistory') !!}/"+ids);
	$.get( "{!! URL::to('/admin/getDetailsHistory') !!}/"+ids, function( data ) {
	  $('.hisDTL').html(data);
	});
});


	
	
	


</script>	
	
	



</body>