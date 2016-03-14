function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function getParameters(){
  var searchString = window.location.search.substring(1),
      params = searchString.split("&"),
      hash = {};

  if (searchString == "") return {};
  for (var i = 0; i < params.length; i++) {
    var val = params[i].split("=");
    hash[unescape(val[0])] = unescape(val[1]);
  }
  return hash;
}

function handler(url,data,callback,name){
	if(!name){name='';}
	if(!callback){ret();}
	if(!data){data={};}
	url = init.host+url;
  $.ajax({
		type: "POST",
		url: url,
		cache:false,
    data:data,
		dataType:"json",
    success: function(data){
      if(data.error == 2){
        fail(data.error);
        return;
      }
      callback(data);
    },
		error:function(data) {
			console.log(data);
      $('#myModal').modal('show');$('.msg').text(init.unHandledError);
		}	
	});
}

function ret(){
  $('#myModal').modal('show');$('.msg').text(init.loginRequest);
  window.location.href="login.php?logout=true";
  return;
}

function makeid(){
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for( var i=0; i < 8; i++ ){
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }
  return text;
}

function fail(error){
  return;
}

function updateModel(str){
  $('#myModal').modal('show');
  $('.msg').text(str);
}

function updateStatusMsg(id,str,status){
  var removeClasses = 'alert-warning alert-danger alert-success';
  switch(status){
    case 'success':
      str = init.success+''+str+''+init.closeDiv;
      $('#'+id).removeClass(removeClasses).addClass('alert-success');
      break;
    case 'fail':
      str = init.danger+''+str+''+init.closeDiv;
      $('#'+id).removeClass(removeClasses).addClass('alert-danger');
      break;
    case 'warning':
      $('#'+id).removeClass(removeClasses).addClass('alert-warning');
      break;
    default:
      break;
  }
  $('#'+id).html(str).show();
}