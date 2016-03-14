<?php
  include 'header.php';
?>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
           Add New Apron
        </header>
        <div class="panel-body">
          <form accept-charset="UTF-8"  class="form-horizontal tasi-form" action="#" method="post">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Apron Id <i class="icon-barcode custom-large"></i></label>
              <div class="col-sm-10">
                  <input class="form-control" name="apronId" id="apronId">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Article Code</label>
              <div class="col-sm-10">
                  <input class="form-control" name="articleCode" id="articleCode">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Batch No.</label>
              <div class="col-sm-10">
                  <input class="form-control" name="batchNo" id="batchNo">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Department</label>
              <div class="col-sm-10">
                  <input class="form-control" name="department" id="department">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Assigned To</label>
              <div class="col-sm-10">
                  <input class="form-control" name="assignedTo" id="assignedTo">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Manufacturer</label>
              <div class="col-sm-10">
                <select class="form-control" name="manufacturerId" id="manufacturerId">
                  <?php 
                    $rquery = "SELECT * FROM manufacturer where Active = 1 and UserId IN (".$_SESSION['userId'].",1)";
                    $res = mysqli_query($mysqli,$rquery);
                    while($row = mysqli_fetch_assoc($res)){
                       echo '<option value="'.$row['Manufacturer'].'">'.$row['Manufacturer'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Garment Type</label>
              <div class="col-sm-10">
                <select class="form-control" name="garmentId" id="garmentId">
                  <?php 
                    $rquery = "SELECT * FROM garment where Active = 1 and UserId IN (".$_SESSION['userId'].",1)";
                    $res = mysqli_query($mysqli,$rquery);
                    while($row = mysqli_fetch_assoc($res)){
                       echo '<option value="'.$row['Garment'].'">'.$row['Garment'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Core Material</label>
              <div class="col-sm-10">
                <select class="form-control" name="coreId" id="coreId">
                  <?php 
                    $rquery = "SELECT * FROM core where Active = 1 and UserId IN(".$_SESSION['userId'].",1)";
                    $res = mysqli_query($mysqli,$rquery);
                    while($row = mysqli_fetch_assoc($res)){
                      echo '<option value="'.$row['Core'].'">'.$row['Core'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Colour</label>
              <div class="col-sm-10">
                  <input class="form-control" name="colour" id="colour">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Monogram</label>
              <div class="col-sm-10">
                  <input class="form-control" name="monogram" id="monogram">
              </div>
            </div>
            
            <!--<div class="form-group">
                <label class="control-label col-md-3">Manufacture Date</label>
                <div data-date-format="yyyy-mm-dd" data-date="2014-01-01" class="col-md-3 col-xs-11">
                    <input class="form-control form-control-inline input-medium default-date-picker" name="manufacturerDate" id="manufacturerDate" size="16" type="text" value="" />
                    <span class="help-block">Select date</span>
                </div>
            </div>-->
            <div class="form-group">
              <label class="col-sm-2 control-label">Manufacture Date</label>
              <div class="col-sm-10">
                <input type="text" accept-charset="UTF-8"    name="manufacturerDate" id="manufacturerDate" value="" size="16" class="form-control datepicker">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1"><button type="button" class="btn btn-danger" id="add_apron">Submit</button></div>
              <div class="col-sm-1"><button type="button" class="btn btn-danger cancel">Cancel</button></div>
            </div>
          </form>
        </div>
      </section>
    </div>
  </div>
<?php
 include 'footer.php';
?>
<script>
$(document).ready(function(){
  $('#manufacturerDate').datepicker({language: 'en',format:"yyyy-mm-dd"});
  $(".datepicker ").css( "width", "220px" );
  $(document).delegate(".cancel","click", function(e){
    e.preventDefault();
    window.location.href="listAprons.php";
  });
  $("#add_apron").click(function(e){
    e.preventDefault();
    var apronId = $('#apronId').val();
    apronId = apronId.replace(/\s/g,'');
    var batchNo = $('#batchNo').val();
    var articleCode = $('#articleCode').val();
    var department = $('#department').val();
    var assignedTo = $('#assignedTo').val();
    var manufacturerId = $('#manufacturerId').val();
    var garmentId = $('#garmentId').val();
    var coreId = $('#coreId').val();
    var colour = $('#colour').val();
    var monogram = $('#monogram').val();
    var manufacturerDate = $('#manufacturerDate').val();
    if(!batchNo || !articleCode || !apronId || !department || !assignedTo || !manufacturerId || !garmentId || !coreId || !colour || !monogram || !manufacturerDate){
      updateModel(commonValidation);
      return;
    }    
    var data = {'_op':'add_apron'};
    data['apronId'] = apronId;
    data['batchNo'] = batchNo;
    data['articleCode'] = articleCode;
    data['department'] = department;
    data['assignedTo'] = assignedTo;
    data['manufacturer'] = manufacturerId;
    data['garment'] = garmentId;
    data['core'] = coreId;
    data['colour'] = colour;
    data['monogram'] = monogram;
    data['manufacturerDate'] = manufacturerDate
    handler("backend/processing.php",data,add_callback,'');
  });
});

function add_callback(data){
  updateModel(data.message);
  if(!data.error){
    window.location.href="listAprons.php";
  }
}
</script>
