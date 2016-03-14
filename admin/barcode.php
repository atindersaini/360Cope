<?php
  include 'header.php';
?>
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
           Print Multiple Bar Codes
        </header>
        <div class="panel-body">
          <div class="row">
            <div id="printtmpl"  class="col-sm-12" style="text-align:center;">
              <style>
                  #printtmpl{
                   display:inline-block;
                  }
                  #printtmpl > div{
                     margin:24px;
                     float:left;
                     display:inline-block;
                  }
              </style>
            </div>
            <div class="row">
              <div class="col-sm-12" style="text-align:center;"><button type="button" class="btn btn-danger" id="printBarcode">Print</button></div>
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
    $(document).delegate("#printBarcode", "click", function(e) {
      $("#printtmpl").printThis({importCSS:true});
    });
  });
  function list(data){
    var str = '';
    for(var i = 0; i < data.apron.length; i++){
      str+="<div id='apron_"+data.apron[i].ApronId+"'></div>";
    }
    $('#printtmpl').append(str);
    for(var i = 0; i < data.apron.length; i++){
      $("#apron_"+data.apron[i].ApronId).barcode(data.apron[i].ApronId, "code128",{barWidth:2, barHeight:30});
    }
  }
  function loadData(limit,page){
    var data = {};
    // var status = decodeURIComponent(window.location.search.slice(1).split('&')[0].split('=')[1]);
    // if(!!status && status!== 'undefined') data['status'] = status;
    data['_op'] = 'list_apron';
    handler('backend/processing.php',data,list,'');
  }
</script>
