$(document).ready(function(){
  $('#resetBtn').click(function(e){
    e.preventDefault();
    $('#loginValidation').html('').hide();
    $('#resetValidation').html('').hide();
    var email=$("#resetEmail").val();
    if(email=="" || !validateEmail(email)){
      var str = init.danger;
      str+= (email == "")? init.emailBlank : init.emailValidation;
      str+= init.closeDiv;
      updateStatusMsg('resetValidation',str,'warn');
      return false;
    }
    var ps = makeid();
    var ls = ps;
    ps = hex_sha512(ps);
    var data = {email:email,ps:ps,ls:ls,_op:'lostPassword'};
    handler('backend/process_register.php',data,reset_callback,'resetValidation');
  });
  
  $('#login_form').submit(function(e) {
		e.preventDefault();
    $('#loginValidation').hide();
		var email=$("#email").val();
		var password=$("#password").val();
    if(email=="" || !validateEmail(email)){
      var str = init.danger;
      str+= (email == "")? init.emailBlank : init.emailValidation;
      str+= init.closeDiv;
      updateStatusMsg('loginValidation',str,'warn');
      return false;
    }
		if(password==""){
      var str = init.danger+''+init.passwordBlank+''+init.closeDiv;
      updateStatusMsg('loginValidation',str,'warn');
      return false;
		}
    password = hex_sha512(password);
		var data = {email:email,password:password,'_op':'login'};
    handler('backend/process_login.php',data,login_callback,'loginValidation');
	});
});

function reset_callback(data){
  if(data.error == 0){
    $('#resetEmail').val('');
    $('#resetValidation').html('').hide();
    $('#resetModal').modal('hide');
    updateStatusMsg('loginValidation',init.resetSuccess,'success');
  }else{
    updateStatusMsg('resetValidation',data.message,'fail');
    fail(data.error);
  }
}

function login_callback(data){
  if(data.error == 0){
    updateStatusMsg('loginValidation',init.loginSuccess,'success');
    setTimeout(function(){
      window.location.href=init.host+"index.php"
    },2500);     
  }else{
    updateStatusMsg('loginValidation',data.message,'fail'); 
    fail(data.error);
  }
}