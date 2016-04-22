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
	


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 testJob" style="background-color:white; border-radius:5px; ">
			
			<p><i>Przepisz poniższy tekst w pole, gdy skończysz pisac tekst zakończ klawiszem ENTER. Jest to tekst testowy w celu ustawienia ustawień</i></p>
				
				<b style="font-size:1.5em;" class="JobTextTEST">test</b>
				<div style="width:100%; height:20px; border-top:1px solid black;"></div>
						
			
				<div class="form-group">
					<label for="textJobForm">Pisz poniżej</label>
					<textarea class="form-control formInputTest" id="textJobForm" rows="4"></textarea>

				</div>
				
		</div>

	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 normalJob" style="background-color:white; border-radius:5px; display:none;">
			
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
				@if($dane->attempt == 0)
				<button class="btn btn-primary saveJob">Zakończ Zadanie</button>
				@endif
		</div>
	</div>
	</div>
	
	
<script>

var shiftKey = false;
var altKey = false;
var CapsLock = false;

var start = 0;


var limit = '{!! $dane->attempt !!}';
	



var job = {};
job['job'] = '{!! $dane->job_id !!}';
job['name'] = '{!! $dane->name !!}';
job['text'] = '{!! $dane->job !!}';
job['attempt'] = {
	'correct':[],
	'incorrect':[],
	'improve': []
};


var jobFinish = 'correct';

var finish = false;



var attempt = 0;
var attemptLeft = '{!! $dane->attempt !!}';
if(attemptLeft == 0)
{
	finish = true;
}


var data = [];


var asciiAlt = {
	"65":"ą",
	"90":"ż",
	"88":"ź",
	"69":"ę",
	"79":"ó",
	"76":"ł",
	"67":"ć",
	"78":"ń",
	"83":"ś"	
}

var asciiShift  = {
	"219": "{",
	"221":"}",
	"220":"|",
	"186":":",
	"222":'"',
	"188":"<",
	"190":">",
	"191":"?",
	"189":"_",
	"187":"+",
	"48":")",
	"49":"!",
	"50":"@",
	"51":"#",
	"52":"$",
	"53":"%",
	"54":"^",
	"55":"&",
	"56":"*",
	"57":"(",
	"58":")",
	"192":"~",
	"16":"SHIFT"
}

var ascii = {
	"219": "[",
	"221":"]",
	"220":"\\",
	"186":";",
	"222":"'",
	"188":",",
	"190":".",
	"191":"/",
	"189":"-",
	"187":"+",
	"96":0,
	"97":1,
	"98":2,
	"99":3,
	"100":4,
	"101":5,
	"102":6,
	"103":7,
	"104":8,
	"105":9,
	"110":",",
	"107":"+",
	"109":"-",
	"106":"*",
	"111":"/",
	"192":"`",
	"8":"BACKSPACE",
	"13":"ENTER",
	"20":"CAPSLOCK",
	"17":"ALT",
	"18":"ALT",
	"32":"SPACE",
	"16":"SHIFT"
	
	
};


var currentLock = {};





$('.formInputTest').keypress(function(e){
	if(e.which == 13)
	{
		if($('.formInputTest').val().toLowerCase() == $('.JobTextTEST').html().toLowerCase())
		{
			$('.testJob').hide();
			$('.normalJob').show();
			$( ".formInput" ).focus();
			start = 1;
		}
	}
	else
	{
		if (String.fromCharCode(e.keyCode) == String.fromCharCode(e.keyCode).toUpperCase()) {
			CapsLock = true;
		}
		else
		{
			CapsLock = false;
		}
	}
});









function getChar(number)
{
	if((number >=65 && number <= 90) || (number >=48 && number <= 57))//a - z
	{
		var chars = String.fromCharCode(number).trim();
		if($.isNumeric(chars))
		{//shifta uzyc!
			if(shiftKey)
			{
				if(typeof asciiShift[number] != "undefined")
				{
					return asciiShift[number];
				}
			}
			else
			{
				return chars;
			}		
		}
		else
		{
			if(altKey)
			{
				if(typeof asciiAlt[number] != "undefined")
				{
					chars =  asciiAlt[number];
				}
			}
			
			if(CapsLock && shiftKey)
			{
				return chars.toLowerCase();
			}
			else if(!CapsLock && !shiftKey)
			{
				return chars.toLowerCase();
			}
			else if(CapsLock && !shiftKey)
			{
				return chars.toUpperCase();
			}
			else
			{
				return chars.toUpperCase();
			}
		}
	}
	else
	{
		if(shiftKey)
		{
			return asciiShift[number];
		}
		else
		{
			if(typeof ascii[number] != "undefined")
			{
				return ascii[number];
			}
		}
	}

}


$( ".formInput" ).keydown(function(e) {
if(e.keyCode == 18) e.keyCode = 17;
	if(start == 2)
	{
		if(e.keyCode == 20)
		{
			CapsLock = (CapsLock == true)? false : true;
		}
		if(e.keyCode == 16)
		{
			if(shiftKey == false) shiftKey = true;
		}
		if(e.keyCode == 17)
		{
			if(altKey == false) altKey = true;
		}
		
		
			var key = getChar(e.keyCode);
			
			if(typeof currentLock[e.keyCode] == "undefined" || currentLock[e.keyCode] == 0)
			{
				data[data.length] = [Date.now(),key,'keydown'];
				
				currentLock[e.keyCode] = 1;
			}
	}
});





$(".formInput").keyup(function (e) {
if(e.keyCode == 18) e.keyCode = 17;
	if(start == 2)
	{
		if(e.keyCode == 16)
		{
			if(shiftKey == true) shiftKey = false;
		}
		if(e.keyCode == 17)
		{
			if(altKey == true) altKey = false;
		}
		
			if(e.keyCode == 18) e.keyCode = 17;
			if(currentLock[e.keyCode] == 1)
			{
				var key = getChar(e.keyCode);
				data[data.length] = [Date.now(),key,'keyup'];
				currentLock[e.keyCode] = 0;
			}
		
		if(e.keyCode == 8)
		{
			jobFinish = "improve";
		}
		
		if(e.keyCode == 13)
		{
			var val2 = 	$( ".formInput" ).val();	
			val2 = val2.replace(/(\r\n|\n|\r)/gm,"");
			if(val2 != $('.JobText').html())
			{
				jobFinish = 'incorrect';
			}

			job['attempt'][jobFinish][job['attempt'][jobFinish].length] = data;
			data = [];
			attempt++;
			jobFinish = 'correct';
			$('.attemptLeft').html(attemptLeft - attempt);
			$( ".formInput" ).val("");
			if(attemptLeft - attempt <= 0)
			{
				if(limit > 0)
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
			}
		}
	}
	if(start == 1) start = 2;
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