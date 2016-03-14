<?php
  include 'header.php';
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Aprons
      </header>
      <div class="panel-body">
        <div class="adv-table">
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center">Apron Id <i class="icon-barcode custom-large"></i></th>
                <th class="center">Department</th>
                <th class="center">Assigned To</th>
                <th class="center">Status</th>
                <th class="center">Next Inspection</th>
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
  
  function update(data){
    $('#myModal2').modal('hide');
    loadData();
  }
  
  function list(data){
    $.Mustache.load('template/barcode.mustache', function() {
      $('#list').html('');
      $('#list').mustache('tpl',data);
      delegateEvents();
    }); 
  }
  
  function loadData(limit,page){
    var data = {};
    data['_op'] = 'list_apron';
    handler('backend/processing.php',data,list,'');
  }
  
  function delegateEvents(){
    var oTable = $('#example').dataTable( {
      "iDisplayLength": init.limit,
      "aLengthMenu": [[2, 5, 10, -1], [2, 5, 10, "All"]],
      "aaSorting": [[1, 'asc']],
      "oSearch": {"sSearch": ""},
      "bRetrieve": true,
    });
        
    $(document).delegate(".editApron","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var str = "editApron.php?id="+id;
      window.location.href=str;
    });
  }
</script>