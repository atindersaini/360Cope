<?php
  include 'header.php';
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
       Missing Aprons
      </header>
      <div class="panel-body">
        <div class="adv-table">
          <div class="clearfix">
            <div class="btn-group pull-right">
              <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i></button>
              <ul class="dropdown-menu pull-right">
                <li id="exportCSV"><a href="#">Export to Excel</a></li>
                <li id="print"><a href="#">Print Setup</a></li>
              </ul>
            </div>
          </div>
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center" width="5%"></th>
                <th class="center">Apron Id <i class="icon-barcode custom-large"></i></th>
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
<script src="include/js/report.js" type="text/javascript"></script>
<script src="include/js/mustache.js" type="text/javascript"></script>
<script src="include/js/jquery.mustache.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    loadData();
    init.flag = false;
  });
  
  function loadData(){
    var data = {};
    data['_op'] = 'list_apron';
    data['status'] = 'Missing';
    handler('backend/processing.php',data,listCallBack,'');
  }
  
  $(document).delegate("#print", "click", function(e) {
    if(init.flag == false){return;}
    window.location = 'print.php?status=Missing';
  });
  
  $('#exportCSV').click(function(e){
    e.preventDefault();
    if(init.flag == false){return;}
    window.location = 'backend/processing.php?_op=export_apron&status=Missing';
  });
  
</script>