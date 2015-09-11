 /*
var filesToUpload = null;

function handleFileSelect(event)
{
    var files = event.target.files || event.originalEvent.dataTransfer.files;
    // Itterate thru files (here I user Underscore.js function to do so).
    // Simply user 'for loop'.
    _.each(files, function(file) {
        filesToUpload.push(file);
    });
}


function handleFormSubmit(event)
{
	var formError = event.data.formerror;
	var formProgressBar = event.data.progressbar;
	var formProgressBarWidth = event.data.progressbarWidth;
	var formUrlAction = event.data.actionUrl;
    event.preventDefault();

    var form = this,
        formData = new FormData(form);  // This will take all the data from current form and turn then into FormData

    // Prevent multiple submisions
    if ($(form).data('loading') === true) {
        return;
    }
    $(form).data('loading', true);

    // Add selected files to FormData which will be sent
    if (filesToUpload) {
        _.each(filesToUpload, function(file){
            formData.append('cover[]', file);
        });        
    }

    $.ajax({
		  xhr: function()
		  {
			var xhr = new window.XMLHttpRequest();
			//Upload progress
			xhr.upload.addEventListener("progress", function(evt){
			  if (evt.lengthComputable) {
				var percentComplete = evt.loaded / evt.total * 100;
				//Do something with upload progress...
				$(''+formProgressBarWidth+'').css( "width", percentComplete+"%" );
				//$('#progressbar1Width').css( "width", percentComplete+"%" );
				//console.log(percentComplete);
			  }
			}, false);
			return xhr;
		  },
        type: "POST",
        url: ''+formUrlAction+'',
        data: formData,
        processData: false,
        contentType: false,
		beforeSend: function(){
			$(''+formError+'').html("");
			$(''+formProgressBar+'').show();
		},
        complete: function(xhr, status)
        {
			if(xhr.responseText != ""){
				$(''+formError+'').html(xhr.responseText);
				$(''+formProgressBar+'').hide();
				$(''+formProgressBarWidth+'').css( "width", "0%" );
			}else{
				location.reload();
			}
            $(form).data('loading', false);
        },
        dataType: 'json'
    });
}
*/

function firstJsonResponse(text){
	var obj = jQuery.parseJSON(text);
	return obj[Object.keys(obj)[0]];
}
