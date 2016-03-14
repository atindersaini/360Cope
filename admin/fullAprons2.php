<?php
  include 'header.php';
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
       Full Apron Inventory
      </header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix">
            <div class="btn-group pull-right">
              <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i></button>
              <ul class="dropdown-menu pull-right">
                <li id="exportCSV"><a href="#">Export to CSV</a></li>
                <li id="print"><a href="#">Print Setup</a></li>
              </ul>
            </div>
			<div>
				<select id="user_filter">
				</select>
				<button id="filterUsers" class="btn  btn-primary">Export</button>
			</div>
          </div>
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center" width="5%"></th>
                <th class="center">Apron Id <i class="icon-barcode custom-large"></i></th>
                <th class="center">User</th>
                <th class="center">Department</th>
                <th class="center">Assigned To</th>
                <th class="center">Status</th>
                <th class="center">Next Inspection</th>
                <th></th>
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
<script src="include/js/report2.js" type="text/javascript"></script>
<script src="include/js/mustache.js" type="text/javascript"></script>
<script src="include/js/jquery.mustache.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    loadData();
	var data = {};
    data['_op'] = 'show_active_users';
	handler('backend/processing.php',data,selectUsers,'');
    init.flag = false;
  });
  
  function loadData(){
    var data = {};
    data['_op'] = 'list_apron';
    handler('backend/processing.php',data,listCallBack,'');
  }
  
  function selectUsers(data){
	var str = '<option value="">Select User</option>';
	if(!!data && data.error == 0){
		var users = data.users;
		for(var i = 0;i < users.length;i++){
		  str+='<option value="'+users[i].UserId+'">'+users[i].Email+'</option>';
		}
	}
	$('#user_filter').html(str);
  }
  
  $(document).delegate("#print", "click", function(e) {
    if(init.flag == false){return;}
    window.location = 'print2.php';
  });
  
  $(document).delegate("#filterUsers", "click", function(e) {
    var userId = $('#user_filter').val();
	if(!!userId){
		if(init.flag == false){return;}
		window.location = 'backend/processing.php?_op=export_apron&userId='+userId;
	}
  });
  
  $('#exportCSV').click(function(e){
    e.preventDefault();
    if(init.flag == false){return;}
    window.location = 'backend/processing.php?_op=export_apron';
  });
  
</script>