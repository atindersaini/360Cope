<?php
  include 'header.php';
?>
<!--state overview start-->
<div class="row state-overview">
  <?php if($_SESSION['isAdmin'] == 1){ ?>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol terques">
          <i class="icon-user"></i>
        </div>
        <div class="value">
          <h1 class="count">
            0
          </h1>
          <p>Users</p>
        </div>
      </section>
    </div>
  <?php } ?>
  <div class="col-lg-3 col-sm-6">
    <section class="panel">
      <div class="symbol yellow">
        <i class="icon-tags"></i>
      </div>
      <div class="value">
        <h1 class=" count2">
          0
        </h1>
        <p>Aprons Found</p>
      </div>
    </section>
  </div>
  <div class="col-lg-3 col-sm-6">
    <section class="panel">
      <div class="symbol red">
        <i class="icon-shopping-cart"></i>
      </div>
      <div class="value">
        <h1 class=" count3">
          0
        </h1>
        <p>Active Aprons</p>
      </div>
    </section>
  </div>
  <div class="col-lg-3 col-sm-6">
    <section class="panel">
      <div class="symbol blue">
          <i class="icon-bar-chart"></i>
      </div>
      <div class="value">
        <h1 class=" count4">
          0
        </h1>
        <p>Total Inspections Made</p>
      </div>
    </section>
  </div>
</div>
<!--state overview end-->
<div class="row">
  <?php if($_SESSION['isAdmin'] == 1){ ?>
  <div class="col-lg-12">
  <?php }else{ ?>
  <div class="col-lg-4">
  <?php } ?>
    <div class="border-head">
      <h3>Inventory Graph</h3>
    </div>
    <div class="custom-bar-chart" id="chartView"></div>
      <div class="panel">
        <div class="panel-body">
          <div class="bio-chart">
            <input class="knob" data-width="101" data-readOnly=true data-height="101" data-displayPrevious=true  data-thickness=".2" value="0" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
          </div>
          <div class="bio-desk">
            <h4 class="terques">Account Information</h4>
            <p>Started : <span id="creationDate"></span></p>
            <p>Deadline : <span id="renewDate"></span></p>
          </div>
        </div>
      </div>
    </div>
    <?php if($_SESSION['isAdmin'] != 1){ ?>
    <div class="col-lg-8">
      <section class="panel">
        <header class="panel-heading">
          Inventory Alert
        </header>
        <table id="example" class="table table-striped table-advance table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th class="hidden-phone">Last Inspection Date</th>
              <th>Next Inspection Date</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="list">
			<tr class="taC"><td colspan=5>No Notifications to display</td></tr>
		  </tbody>
        </table>
      </section>
    </div>
    <?php } ?>
</div>
<?php
 include 'footer.php';
?>
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="js/count.js"></script>
    <script src="include/js/mustache.js" type="text/javascript"></script>
    <script src="include/js/jquery.mustache.js" type="text/javascript"></script>
    <script>
      $(document).ready(function(){
        loadData();
        $('select.styled').customSelect();
        $(".knob").knob();
      });
            
      function list(data){
        countUp(data.usersFound);
        countUp2(data.apronsFound);
        countUp3(data.activeAprons);
        countUp4(data.inspections);
        if(data.apronsFound > 0){
          var Pass = Math.round(data.activeAprons/data.apronsFound * 100)+"%";
          var Damage = Math.round(data.damageAprons/data.apronsFound * 100)+"%";
          var Missing = Math.round(data.missingAprons/data.apronsFound * 100)+"%";
          var Replacing = Math.round(data.requestedAprons/data.apronsFound * 100)+"%";
          var OOS = Math.round(data.inactiveAprons/data.apronsFound * 100)+"%";
          var chart ={}
          chart['Pass'] = Pass;
          chart['Damage'] = Damage;
          chart['Missing'] = Missing;
          chart['Replacing'] = Replacing;
          chart['OOS'] = OOS;
          $.Mustache.load('template/chart.mustache', function() {
            $('#chartView').html('');
            $('#chartView').mustache('tplchart',chart);
          });
        }
        $('#creationDate').html(data.creationDate);
        $('#renewDate').html(data.renewDate);
        $('.knob').val(data.pastDays).trigger("change");
        for(i=0;i<data.apron.length;i++){
          switch(data.apron[i].Status){
            case 'In Service':
              data.apron[i]['InService']='InService';
              break;
            case 'Damage':
              data.apron[i]['Damage']='Damage';
              break;
            case 'Missing':
              data.apron[i]['Missing']='Missing';
              break;
            case 'Out of Service':
              data.apron[i]['OutofService']='OutofService';
              break;
            case 'Replacing':
              data.apron[i]['Requested']='Requested';
              break;
          }
        }
        $.Mustache.load('template/dashboard.mustache', function() {
          $('#list').html('');
          $('#list').mustache('tpl',data);
          delegateDashBoardEvents();
        }); 
      }
      
      function loadData(limit,page){
        var data = {};
        data['_op'] = 'dashboard';
        handler('backend/processing.php',data,list,'');
      }
      
      function delegateDashBoardEvents(){
        $(document).delegate(".editApron","click",function(e){
          e.preventDefault();
          var tr = $(this).parents('tr');
          var id = tr.attr('id');
          var str = "editApron.php?id="+id+"&userId=";
          window.location.href=str;
        });
        $('.tooltips').tooltip();
        if($(".custom-bar-chart")){
          $(".bar").each(function(){
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
              height: i
            }, 3000);
          });
        }
        $('.popovers').popover();
      }
    </script>
  </body>
</html>
