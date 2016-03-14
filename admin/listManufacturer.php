<?php
  include 'header.php';
?>
<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Manufacturer
      </header>
      <div class="panel-body">
        <div class="adv-table">
          <table  class="display table table-striped" id="example">
            <thead>
              <tr>
                <th class="center" width="40%">
                  <input id="name" name="name" placeholder="Manufacturer" class="form-control">
                </th>
                <th class="center" width="40%">
                  <select id="status" name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                  </select>
                </th>
                <th class="center"><button class="btn btn-primary" id="addManufacturer" type="submit">Add</button></th>
                <th class="center"></th>
              </tr>
              <tr>
                <th class="center"><!--div id="limitLength" class="dataTables_length"><label>Show <select name="length" size="1" class="form-control" aria-controls="hidden-table-info"><option value="5" selected="selected">5</option><option value="10">10</option><option value="25">25</option></select></label></div--></th>
                <th class="center" width="30%" style="vertical-align:middle">
                  <input id="searchName" name="name" placeholder="Manufacturer" class="form-control">
                </th>
                <th class="center" width="30%" style="vertical-align:middle">
                  <select id="searchStatus" name="status" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                  </select>
                </th>
                <th class="center" style="vertical-align:middle"><button class="btn btn-primary" id="searchinit" type="submit">Search</button></th>
                <th class="center" style="vertical-align:middle"><button class="btn btn-primary" id="resetSearch" type="submit">Reset</button></th>
              </tr>
              <tr>
                <th class="center">Id</th>
                <th class="center">Name</th>
                <th class="center">Status</th>
                <th class="center"></th>
                <th class="center"></th>
                <th style="display: none;"></th>
              </tr>
            </thead>
            <tbody id="list">
            </tbody>
          </table>
        </div>
      </div>
      <!--div id="page">
        <div id="hidden-table-info_info" class="dataTables_info" style="padding-top:14px;">Showing ? to ? of ? entries</div>
        <div id="hidden-table-info_paginate" class="dataTables_paginate paging_two_button">
          <a id="hidden-table-info_previous" class="paginate_disabled_previous" role="button" tabindex="0" aria-controls="hidden-table-info">Previous</a>
          <a id="hidden-table-info_next" class="paginate_disabled_next" role="button" tabindex="0" aria-controls="hidden-table-info">Next</a>
        </div>
      </div-->
    </section>
  </div>
</div>
<?php
 include 'footer.php';
?>
<script src="include/js/configuration.js" type="text/javascript"></script>
<script src="include/js/mustache.js" type="text/javascript"></script>
<script src="include/js/jquery.mustache.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    delegate();
    resetSearch();
    loadData();

    $('#addManufacturer').click(function(e){
      e.preventDefault();
      var name = $('#name').val();
      var status = $('#status').val();
      if(!name || !status){
        updateModel(init.commonValidation);
        return;
      }
      var data = {};
      data['_op'] = 'add_manufacturer';
      data['name'] = name;
      data['status'] = status;
      handler('backend/processing.php',data,add,'');
    });

    $(document).delegate(".deleteManufacturer","click",function(e){
      e.preventDefault();
      var data = {};
      var tr = $(this).parents('tr');
      data['manufacturerId'] = tr.attr('id');
      $('#myModal2').modal('show');
      $.Mustache.load('template/updateManufacturer.mustache', function() {
        $('#modalBody').html('');
        $('#modalTittle').html('Are you sure you want to delete?');
        $('#modalFooter').html('<button data-dismiss="modal" class="btn btn-primary" type="button">Close</button><button class="btn btn-danger" type="button" id="deleteManufacturer"> Confirm</button>');
        $('#deleteManufacturer').click(function(e){
          e.preventDefault();
          data['_op'] = 'delete_manufacturer';
          handler('backend/processing.php',data,update,'');
        });
      });
    });
    
    $(document).delegate(".editManufacturer","click",function(e){
      e.preventDefault();
      var data = {};
      var tr = $(this).parents('tr');
      data['manufacturerId'] = tr.attr('id');
      data['name'] = $(this).attr('name');
      if($(this).attr('status') == 1){
        data['active'] = 1;
      }else{
        data['inactive'] = 1;
      }
      $('#myModal2').modal('show');
      $.Mustache.load('template/updateManufacturer.mustache', function() {
        $('#modalBody').html('');
        $('#modalBody').mustache('tpl',data);
        $('#modalTittle').html('Modify Manufacturer Information');
        $('#modalFooter').html('<button data-dismiss="modal" class="btn btn-primary" type="button">Close</button><button class="btn btn-danger" type="button" id="updateManufacturer"> Update</button>');
        $('#updateManufacturer').click(function(e){
          e.preventDefault();
          var name = $('#name').val();
          var manufacturerId = $('#manufacturerId').val();
          var status = $('#status').val();
          if(!name || !status){
            updateModel(init.commonValidation);
            return;
          }
          var data = {};
          data['_op'] = 'update_manufacturer';
          data['name'] = name;
          data['status'] = status;
          data['manufacturerId'] = manufacturerId;
          handler('backend/processing.php',data,update,'');
        });
      });
    });
  });
  
  function list(data){
    $('#hidden-table-info_next').removeClass('paginate_enabled_next').addClass('paginate_disabled_next');
    $('#hidden-table-info_previous').removeClass('paginate_enabled_previous').addClass('paginate_disabled_previous');
    var limit = parseInt(data.limit);
    var start = parseInt(data.start);
    var end = parseInt(data.end);
    var page = parseInt(data.page);
    var totalPages = parseInt(data.totalPages);
    var currentRows = parseInt(data.totalRowsFound);
    var totalRows = parseInt(data.totalRowsFound);
    if(totalRows > 0){
      var str = "Showing "+start+" to "+end+" of "+totalRows+" entries";
    }else{
      var str = "No Records has been added";
    }
    $('#list').html('');
    $.Mustache.load('template/manufacturer.mustache', function() {
      $('#list').mustache('tpl',data);
    }); 
    $('#hidden-table-info_info').html(str);
    $('#hidden-table-info_next').data({'page':page+1});
    $('#hidden-table-info_previous').data({'page':page-1});
    if(totalPages-1 > page){
      $('#hidden-table-info_next').removeClass('paginate_disabled_next').addClass('paginate_enabled_next');
    }
    if(page >= 1){
      $('#hidden-table-info_previous').removeClass('paginate_disabled_previous').addClass('paginate_enabled_previous');
    }
  }
  
  function loadData(limit,page){
    var data = {};
    var name = $('#searchName').val();
    var status = $('#searchStatus').val();
    if(!!name) data['name'] = name;
    if(!!status) data['status'] = status;
    data['_op'] = 'list_manufacturer';
    data['limit'] = limit;
    data['page'] = page;
    handler('backend/processing.php',data,list,'');
  }
</script>