  function delegate(){
    $('#searchinit').click(function(e){
      e.preventDefault();
      var name = $('#searchName').val();
      var status = $('#searchStatus').val();
      loadData(init.limit2,0);
    });

    $('#resetSearch').click(function(e){
      e.preventDefault();
      resetSearch();
      loadData(init.limit2,0);
    });
    
    $('#limitLength').change(function(e){
      e.preventDefault();
      var length = $('#length').val();
      loadData(length,0);
    });

    $('#hidden-table-info_previous').click(function(e){
      e.preventDefault();
      if($(this).hasClass('paginate_enabled_previous')){
        var page = $(this).data('page');
        loadData(init.limit2,page);
      }
    });

    $('#hidden-table-info_next').click(function(e){
      e.preventDefault();
      if($(this).hasClass('paginate_enabled_next')){
        var page = $(this).data('page');
        loadData(init.limit2,page);
      }
    });
  }

  function resetSearch(){
    $('#searchName').val('');
    $('#searchStatus').val('');
  }

  function update(data){
    $('#myModal2').modal('hide');
    $('#myModal').modal('show');
    $('.msg').text(data.message);
    loadData(init.limit2,0);
  }
  
  function add(data){
    $('#name').val('');
    $('#myModal').modal('show');
    $('.msg').text(data.message);
    loadData(init.limit2,0);
  }