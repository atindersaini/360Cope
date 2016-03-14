<?php
  include 'header.php';
?>
<div id="printtmpl" class="row"></div>
<?php
 include 'footer.php';
?>
<script src="include/js/mustache.js" type="text/javascript"></script>
<script src="include/js/jquery.mustache.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    loadData();
    $(document ).delegate("#print", "click", function(e) {
      $("#printtmpl").printThis({importCSS:true});
    });
  });
  function list(data){
    $.Mustache.load('template/printTemplate.mustache', function() {
      $('#printtmpl').html('');
      $('#printtmpl').mustache('tplprint',data);
    }); 
  }
  function loadData(limit,page){
    var data = {};
    var status = decodeURIComponent(window.location.search.slice(1).split('&')[0].split('=')[1]);
    if(!!status && status!== 'undefined') data['status'] = status;
    data['_op'] = 'list_apron';
    handler('backend/processing.php',data,list,'');
  }
</script>
