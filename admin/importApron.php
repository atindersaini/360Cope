<?php
 include 'header.php';
?>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
          Add Multiple Aprons
        </header>
        <div class="panel-body">
          <form accept-charset="UTF-8"  class="form-horizontal tasi-form" action="#" enctype="multipart/form-data" method="post">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Upload CSV File:</label>
              <div class="col-sm-10">
                  <input class="default" type="file" name="file_upload" id="file_upload" multiple>
                  <div style="padding-top:10px">
                    <span class="label label-danger">NOTE!</span>
                    <span>File extension must be .csv</span>
                  </div>
              </div>
            </div> 
            <button type="submit" class="btn btn-danger">Submit</button>
            <button type="button" id="download" class="btn btn-danger">Download Sample</button>
          </form>
        </div>
      </section>
    </div>
  </div>
<?php
 include 'footer.php';
?>
<script>
$(function(){
	var files;
	$('input[type=file]').on('change', prepareUpload);
	$('form').on('submit', uploadFiles);
  $('#download').click(function(e){
    e.preventDefault();
    window.location = 'sample.csv';
  });
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	function uploadFiles(event)
	{
		event.stopPropagation();
    event.preventDefault();
		var data = new FormData();
		if(files.length == 1){
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
            $('#myModal').modal('show');
            $('.msg').text(data.records+" records has been added");
            window.location.href="listAprons.php";
            return;
          }else{
            $('#myModal').modal('show');
            $('.msg').text(data.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          $('#myModal').modal('show');
          $('.msg').text('Can\'t process your request.Please try after some time.');
        }
      });
    }else{
      $('#myModal').modal('show');
      $('.msg').text('Please upload one file at a time');
      return;
    }
  }
});
</script>