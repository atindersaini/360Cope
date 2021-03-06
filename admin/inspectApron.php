<?php
  include 'header.php';
?>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
          Inspect Apron
        </header>
        <div class="row">
        <div class="col-lg-6">
          <div class="panel-body">
            <div class="adv-table">
              <table  class="display table table-striped" id="example">
                <tbody>
                  <tr>
                    <th align="right" class="center"><b>Apron Id <i class="icon-barcode custom-large"></i></b></th>
                    <th align="left" class="center"><span style="color:#000" id="apronId"></span></th>
                    <th align="right" class="center"><b>Department:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="department"></span></th>
                  </tr>
                  <tr>
                    <th align="right" class="center"><b>Assigned To:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="assignedTo"></span></th>
                    <th align="right" class="center"><b>Garment Type:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="garment"></span></th>
                  </tr>
                  <tr>
                    <th align="right" class="center"><b>Manufacturer:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="manufacturer"></span></th>
                    <th align="right" class="center"><b>Core Material:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="core"></span></th>
                  </tr>
                  <tr>
                    <th align="right" class="center"><b>Colour:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="colour"></span></th>
                    <th align="right" class="center"><b>Monogram:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="monogram"></span></th>
                  </tr>
                  <tr>
                    <th align="right" class="center"><b>Batch No:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="batchNo"></span></th>
                    <th align="right" class="center"><b>Article Code</b></th>
                    <th align="left" class="center"><span style="color:#000" id="articleCode"></span></th>
                  </tr>
                  <tr>
                    <th align="right" class="center"><b>Manufacturer Date:</b></th>
                    <th align="left" class="center"><span style="color:#000" id="manufacturerDate"></span></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel-body">
          <div class="adv-table">
            <table  class="display table table-striped" id="example2">
              <tbody>
                <tr>
                  <th width="10%" class="center"><b>Status</b></th>
                  <th  class="center">
                    <select  id="status" name="status" class="form-control">
                      <option value="">-- Select --</option>
                      <?php 
                        $rquery = "SELECT * FROM status";
                        $res = mysqli_query($mysqli,$rquery);
                        while($row = mysqli_fetch_assoc($res)){
                           echo '<option value="'.$row['Status'].'">'.$row['Status'].'</option>';
                        }
                      ?>
                    </select>
                  </th>
                  <th width="10%" class="center"><b>Condition</b></th>
                  <td>
                    <select  id="condition" name="condition" class="form-control">
                      <option value="">-- Select --</option>
                      <option value="Good">Good</option>
                      <option value="Bad">Bad</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th width="10%" class="center"><b>Pinholes</b></th>
                  <td>
                    <select  id="pinholes" name="pinholes" class="form-control">
                      <option value="">-- Select --</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <th width="10%" class="center"><b>Cracks</b></th>
                  <td>
                    <select  id="cracks" name="cracks" class="form-control">
                      <option value="">-- Select --</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th width="10%" class="center"><b>Stitching</b></th>
                  <td>
                    <select  id="stitching" name="stitching" class="form-control">
                      <option value="">-- Select --</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                  <th width="10%" class="center"><b>Buckle</b></th>
                  <td>
                    <select  id="buckle" name="buckle" class="form-control">
                      <option value="">-- Select --</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th  width="10%" class="center"><b>Note</b></th>
                  <th colspan="3" class="center"><textarea rows="5" cols="60" class="form-control" id="note"></textarea></th>
                </tr>
                <tr>
                  <th class="center"><button class="btn btn-primary" id="addInspect" type="submit">Add</button></th>
                  <th colspan="3"></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
      <div class="panel-body">
        <div class="adv-table">
          <table  class="display table table-striped" id="example2">
            <thead>
              <tr>
                <th class="center">Date</th>
                <th class="center">Status</th>
                <th class="center">Pinhole</th>
                <th class="center">Cracks</th>
                <th class="center">Stitching</th>
                <th class="center">Buckle</th>
                <th class="center">Condition</th>
                <th class="center">Note</th>
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
<script>

$(document).ready(function(){
  var data = {};
  data['apronId'] = window.location.search.slice(1).split('&')[0].split('=')[1];
  data['_op'] = 'list_apron';
  handler('backend/processing.php',data,retrieveAprons,'');
  loadInspect();
  $(document).delegate(".cancel","click", function(e){
    e.preventDefault();
    window.location.href="listAprons.php";
  });
  
  $(document).delegate("#addInspect","click", function(e){
    e.preventDefault();
    var apronId = $('#apronId').text();
    var status = $('#status').val();
    var note = $('#note').val();
    var pinholes = $('#pinholes').val();
    var cracks = $('#cracks').val();
    var stitching = $('#stitching').val();
    var buckle = $('#buckle').val();
    var condition = $('#condition').val();
    if(!status){
      updateModel(init.commonValidation);
      return;
    }
    var data = {'_op':'inspect_apron'};
    data['apronId'] = apronId;
    data['status'] = status;
    data['note'] = note;
    data['pinhole'] = pinholes;
    data['cracks'] = cracks;
    data['stitching'] = stitching;
    data['buckle'] = buckle;
    data['condition'] = condition;
    handler("backend/processing.php",data,inspectApron,'');
  });
});
function loadInspect(){
  var data ={};
  data['_op'] = 'list_inspect';
  data['apronId'] = window.location.search.slice(1).split('&')[0].split('=')[1];
  handler("backend/processing.php",data,listInspect,'');
}
function listInspect(data){
  $('#list').html('');
  $.Mustache.load('template/inspect.mustache', function() {
    $('#list').mustache('tpl',data);
  }); 
}
function retrieveAprons(data){
  if(!!data.apron){
    var data = data.apron[0];
    $('#apronId').text(data.ApronId);
    $('#department').text(data.Department);
    $('#assignedTo').text(data.AssignedTo);
    $('#manufacturer').text(data.Manufacturer);
    $('#garment').text(data.Garment);
    $('#core').text(data.Core);
    $('#colour').text(data.Colour);
    $('#monogram').text(data.Monogram);
    $('#manufacturerDate').text(data.ManufacturerDate);
    $('#batchNo').text(data.BatchNo);
    $('#articleCode').text(data.ArticleCode);
  }
}

function inspectApron(data){
  updateModel(data.message);
  loadInspect();
}
</script>