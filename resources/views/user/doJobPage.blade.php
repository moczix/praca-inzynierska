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
			
			<p><i>Przepisz poniższy tekst w pole, gdy skończysz pisac tekst zakończ klawiszem ENTER i przepisuj ponownie aż zakończysz liczbe prawidłowych prób</i></p>
				
				<b style="font-size:1.5em;" class="JobText">{!! $dane->job !!}</b>
				<div style="width:100%; height:20px; border-top:1px solid black;"></div>
			
				<center><b>Pozostało Prób do zakończenia: 
				@if($dane->attempt > 0)
					<span class="attemptLeft">{!! $dane->attempt !!}</span>
				@else
					Brak Limitu
				@endif
				
				</b></center>
			
			
				<div class="form-group">
					<label for="textJobForm">Pisz poniżej</label>
					<textarea class="form-control formInput" id="textJobForm" rows="4"></textarea>

				</div>
				<button class="btn btn-primary saveJob">Zakończ Zadanie</button>
				
		</div>
	</div>
	</div>
	
<script>

setInterval(function(){ backgroundTimer() },1);

var backgroundCounter = 0;



function backgroundTimer()
{
	backgroundCounter++;
}

var job = {};
job['job'] = '{!! $dane->job_id !!}';
job['name'] = '{!! $dane->name !!}';
job['text'] = '{!! $dane->job !!}';
job['attempt'] = [];
var finish = false;

var attempt = 0;
var attemptLeft = '{!! $dane->attempt !!}';
if(attemptLeft == 0)
{
	finish = true;
}

var lastKeyUp =0;
var dwelltime = 0;
var dwellTimeClick =0;



var lastHold =0;
var holdtime =0;
var holdtimeclick =0;


var beetween = [];
var allBetween = 0;

var lastKeyPress = 0;
var beetweenLastTime = 0;

$( ".formInput" ).keyup(function(e) {
	if(e.which != 13){
		if(dwellTimeClick == 1)
		{
			dwelltime += (backgroundCounter -  lastKeyUp);//czas wciskania(albo puszczania, od wcisniecia do puszczenia liczony)
			//$('.dwelltime').html(dwelltime);
			dwellTimeClick =0;
			
		//	$('.holdtime').html(holdtime);//czas trzymania:
			
		}

		/*
		//czas miedzy klawiszami to miedzy kayupem a keydownem
		beetweenLastTime = backgroundCounter;
		lastKeyUp = e.keyCode;
		*/
	}
})

$( ".formInput" ).keydown(function(e) {
	if(e.which != 13){
		if(dwellTimeClick == 0){
			dwellTimeClick = 1;
			lastKeyUp = backgroundCounter;
			lastHold = backgroundCounter;
		}else{
			holdtime = holdtime + (backgroundCounter - lastHold);
			lastHold = backgroundCounter;
		}
		/*
		if(e.keyCode != lastKeyUp)
		{
			
			beetween[String.fromCharCode(lastKeyUp)+'-'+String.fromCharCode(e.keyCode)] = backgroundCounter - beetweenLastTime;
			
			console.log(beetween);
		}
		*/
	}
});



$( ".formInput" ).keypress(function(e) {
	if(e.which != 13){
		if(lastKeyPress != 0)
		{
			var bleng = beetween.length;
			beetween[bleng] = {};
			allBetween += backgroundCounter - beetweenLastTime;
			beetween[bleng][String.fromCharCode(lastKeyPress)+'-'+String.fromCharCode(e.keyCode)] = backgroundCounter - beetweenLastTime;
			//console.log(beetween);
			
			//$('.jsonString').html(JSON.stringify(beetween));
			//console.log(JSON.stringify(beetween));
		}
		lastKeyPress = e.keyCode;
		//console.log(String.fromCharCode(lastKeyPress));
		beetweenLastTime = backgroundCounter;
		
		
		//$('.beetween').html(allBetween);

	}
});

$(".formInput").keyup(function (e) {
    if (e.keyCode == 13) {//ENTER
        
    }
});


$( ".formInput" ).keypress(function(e) {
	if(e.which == 13)
	{
		var check = false;
		if(attemptLeft - attempt > 0) check = true;
		if(attemptLeft == 0) check = true;
		
		if(check){	
			var val2 = 	$( ".formInput" ).val();	
			val2 = val2.replace(/(\r\n|\n|\r)/gm,"");
			if(val2 == $('.JobText').html())
			{
				
				$( ".formInput" ).val("");
				var cnt = job['attempt'].length;
				job['attempt'][cnt] = {};
				job['attempt'][cnt]['number'] = attempt++;
				job['attempt'][cnt]['holdTime'] = holdtime;
				job['attempt'][cnt]['keyupTime'] = dwelltime;
				job['attempt'][cnt]['result'] = beetween;
				lastKeyUp =0;
				dwelltime = 0;
				dwellTimeClick =0;
				lastHold =0;
				holdtime =0;
				holdtimeclick =0;
				beetween = [];
				allBetween = 0;
				lastKeyPress = 0;
				beetweenLastTime = 0;
				backgroundCounter = 0;
				
				if(attemptLeft > 0)
				{
					$('.attemptLeft').html(attemptLeft - attempt);
				}
				if(attemptLeft - attempt == 0)
				{
					finish = true;
				}
				
				//console.log(job);
			}
			else
			{
				lastKeyUp =0;
				dwelltime = 0;
				dwellTimeClick =0;
				lastHold =0;
				holdtime =0;
				holdtimeclick =0;
				beetween = [];
				allBetween = 0;
				lastKeyPress = 0;
				beetweenLastTime = 0;
				backgroundCounter = 0;
				$( ".formInput" ).val("");
			}	
		
		}
	}
});


$('.saveJob').click(function(e){
	if(finish)
	{
		$.post("{!! URL::to('/user/completeJob') !!}",
			{ 	_token : "{!! csrf_token() !!}",
							result : JSON.stringify(job),
							job : "{!! $dane->job_id !!}"
			},		 
				function(data){
					if(data == ""){
						window.location.href = "{!! URL::to('/user/panel') !!}";
					}
				}
			).error(function(request, status, error){///
				$('.logError2').html(firstJsonResponse(request.responseText));
		});
	}
});

</script>	

</body>