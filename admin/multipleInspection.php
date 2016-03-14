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
        <div class="clearfix">
              <div class="btn-group pull-right">
                  <button class="btn btn-primary pull-left" id="addInspect" type="submit">Apply</button>
                  <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i></button>
                  <ul class="dropdown-menu pull-right">
                      <!--<li><a href="#">Print</a></li>
                      <li><a href="#">Save as PDF</a></li>-->
                      <li id="exportCSV"><a href="#">Export to Excel</a></li>
                      <li id="print"><a href="#">Print Setup</a></li>
                  </ul>
              </div>
              <div class="col-lg-4 pull-right">
                <!--<table  class="display table" id="example2">
                  <tbody>
                    <tr>
                      <th class="center"><b>Status</b></th>
                      <th class="center">-->
                        <select id="status" name="status" class="form-control">
                          <option value="">-- Select --</option>
                          <?php 
                            $rquery = "SELECT * FROM status where Status != 'Replacing'";
                            $res = mysqli_query($mysqli,$rquery);
                            while($row = mysqli_fetch_assoc($res)){
                               echo '<option value="'.$row['Status'].'">'.$row['Status'].'</option>';
                            }
                          ?>
                        </select>
                      <!--</th>
                    </tr>
                    <tr>
                      <th class="center">-->
                      <!--<th></th>
                    </tr>
                  </tbody>
                </table>-->
      		  </div>
              
          </div>
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th width="3%"></th>
                <th class="center" width="5%"></th>
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
  function fnFormatDetails(oTable,nTr,data)
  {
    var aData = oTable.fnGetData(nTr);
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td><b>Colour:</b></td><td>'+data.attr('colour')+'</td><td><b>Monogram:</b></td><td>'+data.attr('monogram')+'</td><td><b>Garment:</b></td><td>'+data.attr('garment')+'</td></tr>';
    sOut += '<tr><td><b>ManufacturerDate:</b></td><td>'+data.attr('manufacturerDate')+'</td><td><b>LastInspectionDate:</b></td><td>'+data.attr('lastInspectionDate')+'</td><td><b>Core:</b></td><td>'+data.attr('core')+'</td></tr>';
    sOut += '<tr><td><b>Manufacturer:</b></td><td>'+data.attr('manufacturer')+'</td><td><b>Batch No.</b></td><td>'+data.attr('batchNo')+'</td></tr>';
    sOut += '<tr><td><b>Article Code:</b></td><td>'+data.attr('articleCode')+'</td><td></td><td></td></tr>';
    sOut += '</table>';
    return sOut;
  }

  $(document).ready(function(){
    loadData();
  });
  
  function update(data){
    $('#myModal2').modal('hide');
    loadData();
  }
  
  function list(data){
    $.Mustache.load('template/multipleInspect.mustache', function() {
      $('#list').html('');
      $('#list').mustache('tpl',data);
      
      var nCloneTd = document.createElement( 'td' );
      nCloneTd.innerHTML = '<img class="addInfo" src="assets/advanced-datatable/examples/examples_support/details_open.png">';
      nCloneTd.className = "center";
      $('#example tbody tr').each(function(){
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[3]);
      });
      
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
		        "oLanguage":  {
                      "sSearch": "Search <i class='icon-barcode' style='vertical-align:middle;'></i>"
                    },
      "bRetrieve": true,
      "aoColumnDefs": [{ "bSortable": false, "aTargets": [0,1,7]}]
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
    
    $(document).delegate("#addInspect","click",function(e){
      e.preventDefault();
      var apronIds =[]; 
      $('.inspectStatus').each(function() {
       if($(this).prop('checked')){
        apronIds.push($(this).attr('id'));
       }
      });
      var data ={};
      data['_op'] = 'inspect_apron';
      data['apronId'] = apronIds.toString();
      data['status'] = $('#status').val();
      handler('backend/processing.php',data,multiple,'');
    });
    
    $('#exportCSV').click(function(e){
      e.preventDefault();
      window.location = 'backend/processing.php?_op=export_apron';
    });
  }
  function multiple(data){
    updateModel(data.message);
    if(!data.error){
      window.location = 'multipleInspection.php';
    }
  }
  $(document).delegate("#print", "click", function(e) {
    if(init.flag == false){return;}
    window.location = 'print.php';
  });
  </script>