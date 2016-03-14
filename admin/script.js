$(function(){
	var files;
	$('input[type=file]').on('change', prepareUpload);
	$('form').on('submit', uploadFiles);

	function prepareUpload(event)
	{
		files = event.target.files;
	}

	function uploadFiles(event)
	{
		event.stopPropagation();
    event.preventDefault();
		var data = new FormData();
		if(files.length){alert('Please upload one file at a time.');};
    $.each(files, function(key, value){
			data.append(key, value);
		});
    $.ajax({
      url: 'backend/processing.php?_op=import_apron&files',
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function(data, textStatus, jqXHR){
        if(data.error === 0){
          alert(data);
        }else{
          alert('ERRORS: ' + data.error);
        }
      },
      error: function(jqXHR, textStatus, errorThrown)
      {
        alert('ERRORS: ' + textStatus);
      }
    });
  }
});