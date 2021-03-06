  function listCallBack(data){
    if(!!data.apron && data.apron.length > 0) init.flag = true;
    $.Mustache.load('template/report.mustache', function(){
      $('#list').html('');
      $('#list').mustache('tpl',data);
      delegateEvents();
    }); 
  }
  
  function updateCallBack(data){
    $('#myModal2').modal('hide');
    loadData();
  }
    
  function delegateEvents(){
    var nCloneTd = document.createElement('td');
    nCloneTd.innerHTML = '<img class="addInfo" src="assets/advanced-datatable/examples/examples_support/details_open.png">';
    nCloneTd.className = "center";
    $('#example tbody tr').each(function(){
      this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
    });
    
    var oTable = $('#example').dataTable( {
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
    
    $(document).delegate('.addInfo','click', function(e){
      e.preventDefault();
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
        handler('backend/processing.php',data,updateCallBack,'');
      });
    });
    
    $(document).delegate(".editApron","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var str = "editApron.php?id="+id;
      window.location.href=str;
    });

    $(document).delegate(".inspectReport","click",function(e){
      e.preventDefault();
      var tr = $(this).parents('tr');
      var id = tr.attr('id');
      var str = "inspectReport.php?id="+id;
      window.location.href=str;
    });
  }
  
  function fnFormatDetails(oTable,nTr,data){
    var aData = oTable.fnGetData(nTr);
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td><b>Colour:</b></td><td>'+data.attr('colour')+'</td><td><b>Monogram:</b></td><td>'+data.attr('monogram')+'</td><td><b>Garment:</b></td><td>'+data.attr('garment')+'</td></tr>';
    sOut += '<tr><td><b>ManufacturerDate:</b></td><td>'+data.attr('manufacturerDate')+'</td><td><b>LastInspectionDate:</b></td><td>'+data.attr('lastInspectionDate')+'</td><td><b>Core:</b></td><td>'+data.attr('core')+'</td></tr>';
    sOut += '<tr><td><b>Manufacturer:</b></td><td>'+data.attr('manufacturer')+'</td><td><b>Batch No.</b></td><td>'+data.attr('batchNo')+'</td><td><b>Article Code:</b></td><td>'+data.attr('articleCode')+'</td></tr>';
    sOut += '</table>';
    return sOut;
  }