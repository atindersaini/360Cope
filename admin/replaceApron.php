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
          <div class="form-group">
              <div class="col-sm-12">
                  <input id="note" name="note" class="form-control" placeholder="Note"><br>
                  <button type="button" class="btn btn-primary" id="replaceMultiple">Replace Checked Aprons</button>
              </div>
          </div>
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center" width="5%"></th>
                <th class="center" >Apron Id <i class="icon-barcode custom-large"></i></th>
                <th class="center" >Department</th>
                <th class="center" >Assigned To</th>
                <th class="center" >Status</th>
                <th class="center" >Next Inspection</th>
                <th class="center" width="10%"></th>
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
    $.Mustache.load('template/replace.mustache', function() {
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
    var oTable = $('#example').dataTable({
      "iDisplayLength": init.limit,
      "aLengthMenu": [[2, 5, 10, -1], [2, 5, 10, "All"]],
      "aaSorting": [[1, 'asc']],
      "oSearch": {"sSearch": ""},
		        "oLanguage":  {
                      "sSearch": "Search <i class='icon-barcode' style='vertical-align:middle;'></i>"
                    },
      "bRetrieve": true,
      "aoColumnDefs": [{ "bSortable": false, "aTargets": [0,6]}]
    });
    
    $(document).delegate('.addInfo','click', function(){
      var nTr = $(this).parents('tr')[0];
      var data = $(this).parents('tr'); 
      if(oTable.fnIsOpen(nTr))
      {
        this.src = "assets/advanced-datatable/examples/examples_support/details_open.png";
        oTable.fnClose(nTr);
      }else{
        this.src = "assets/advanced-datatable/examples/examples_support/details_close.png";
        oTable.fnOpen(nTr,fnFormatDetails(oTable, nTr,data),'details' );
      }
    });
    
    $(document).delegate(".deleteApron","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var data = {};
      data['apronId'] = tr.attr('id');
      $('#myModal2').modal('show');
      $('#modalBody').html('');
      $('#modalTittle').html('Are you sure you want to delete?');
      $('#modalFooter').html('<button data-dismiss="modal" class="btn btn-primary" type="button">Close</button><button class="btn btn-danger" type="button" id="deleteApron"> Confirm</button>');
      $('#deleteApron').click(function(e){
        e.preventDefault();
        data['_op'] = 'delete_apron';
        handler('backend/processing.php',data,update,'');
      });
    });
    
    $(document).delegate(".editApron","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var str = "editApron.php?id="+id;
      window.location.href=str;
    });

    $(document).delegate(".inspectApron","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var str = "inspectApron.php?id="+id;
      window.location.href=str;
    });

    $(document).delegate("#replaceMultiple","click",function(e){
      e.preventDefault();
      var apronIds =[]; 
      $('.replace').each(function() {
       if($(this).prop('checked')){
        apronIds.push($(this).attr('id'));
       }
      });
      var data ={};
      data['_op'] = 'inspect_apron';
      data['apronId'] = apronIds.toString();
      data['note'] = $('#note').val();
      data['status'] = 'Replacing';
      handler('backend/processing.php',data,multiple,'');
    });
    
    $(document).delegate(".replaceApron","click",function(e){
      var apronIds =[]; 
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var data ={};
      data['_op'] = 'inspect_apron';
      data['apronId'] = id;
      data['note'] = $('#note').val();
      data['status'] = 'Replacing';
      handler('backend/processing.php',data,multiple,'');
    });
  }
  function multiple(data){
    $('#note').val('');
    updateModel(data.message);
    if(!data.error){
      loadData();
    }
  }
</script>