<?php
  include 'header.php';
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Users
      </header>
      <div class="panel-body">
        <div class="adv-table">
		  <div class="clearfix">
        <div id="downloadCSV" class="btn-group pull-left" style="cursor:pointer;font-weight:bold;">
          Download CSV File
        </div>
        <div class="btn-group pull-right">
				<label for="switch_window">Automatic Renew Users: </label>
				<select id="switch_window" style="margin-left: 10px;">
					<option value="1">ON</option>
					<option value="0">OFF</option>
				</select>
            </div>
          </div>
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center">User Id</th>
                <th class="center">Name</th>
                <th class="center">Email</th>
                <th class="center">Creation Date</th>
                <th class="center">Renewal Date</th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody id="list">
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</div>
<?php
 include 'footer.php';
?>
<script src="include/js/mustache.js" type="text/javascript"></script>
<script src="include/js/jquery.mustache.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
	loadData();
  });
  
  $(document).off('click','#downloadCSV').on('click','#downloadCSV',function(e){
    e.preventDefault();
    window.location = 'backend/processing.php?_op=export_users';
  });
  
  function update(data){
    updateModel(data.message);
    loadData();
  }

  function updateSwitch(data){
    updateModel(data.message);
  }
  
  function list(data){
	$.Mustache.load('template/users.mustache', function() {
      $('#list').html('');
      $('#list').mustache('tpl',data);
       delegateEvents();
	});
	$('#switch_window').val(data['switch']);
  }
  
  function loadData(limit,page){
    var data = {};
    data['_op'] = 'show_users';
    handler('backend/processing.php',data,list,'');
  }
  
  function delegateEvents(){
	$('.user').datepicker({language: 'en',format:"yyyy-mm-dd"});
	$(".datepicker ").css( "width", "220px" );
	$('#switch_window').change(function(){
		var data = {};
		data['_op'] = 'switch_window';
		data['switch'] = $('#switch_window').val();
		handler('backend/processing.php',data,updateSwitch,'');
	});
	var oTable = $('#example').dataTable( {
      "iDisplayLength": init.limit,
      "aLengthMenu": [[2, 5, 10, -1], [2, 5, 10, "All"]],
      "aaSorting": [[1, 'asc']],
      "oSearch": {"sSearch": ""},
      "bRetrieve": true,
      "aoColumnDefs": [{ "bSortable": false, "aTargets": [0,5]}]
    });
       
    $(document).delegate(".editUser","click",function(e){
		e.preventDefault();
		var userId = $(this).attr('userId');
		var renewDate = $('#date_'+userId).val();
		var data = {};
		data['clientId'] = userId;
		data['renewDate'] = renewDate;
		data['_op'] = 'update_renewDate';
		handler('backend/processing.php',data,update,'');
    });
  }
</script>