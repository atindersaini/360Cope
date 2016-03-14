<?php
  include 'header.php';
?>
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
           Print Multiple Bar Codes
        </header>
        <div class="panel-body">
          <div class="clearfix">
            <div>
              <select id="user_filter"></select>
              <button class="btn  btn-primary" id="filterUsers">Filter</button>
            </div>
          </div>
          <div class="row">
            <div id="printtmpl"  class="col-sm-12" style="text-align:center;">
              <style>
                  #printtmpl{
                   display:inline-block;
                  }
                  #printtmpl > div{
                     margin:30px;
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
    var data = {};
    data['_op'] = 'show_active_users';
    handler('backend/processing.php',data,selectUsers,'');
    $(document).delegate("#printBarcode", "click", function(e) {
      $("#printtmpl").printThis({importCSS:true});
    });
    $(document).delegate("#filterUsers", "click", function(e) {
      var userId = $('#user_filter').val();
      if(!!userId){
        if(init.flag == false){return;}
        window.location = 'barcode2.php?userId='+userId;
      }else{
        window.location = 'barcode2.php';
      }
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
  
  function selectUsers(data){
    var str = '<option value="">All Users</option>';
    if(!!data && data.error == 0){
      var users = data.users;
      for(var i = 0;i < users.length;i++){
        str+='<option value="'+users[i].UserId+'">'+users[i].Email+'</option>';
      }
    }
    $('#user_filter').html(str);
    var userId = decodeURIComponent(window.location.search.slice(1).split('&')[0].split('=')[1]);
    if(!!userId && userId != 'undefined') $('#user_filter').val(userId);
  }
  function loadData(){
    var data = {};
    var userId = decodeURIComponent(window.location.search.slice(1).split('&')[0].split('=')[1]);
    if(!!userId && userId != 'undefined') data['userId'] = userId;
    data['_op'] = 'list_apron';
    handler('backend/processing.php',data,list,'');
  }
</script>
