$(document).ready(function(){
	$("#terms").change(function(){
    var checked = $("#terms").prop('checked');
    if(checked){
      $('.form-signin .checkbox').css('color','#797979');
    }else{
      $('.form-signin .checkbox').css('color','#B6B6B6');
    }
  });
  
  $('#register_form').submit(function(e) {
		e.preventDefault();
		$('#registerValidation').hide();
		var username='NA';
    var email=$("#email").val();
		var password=$("#password").val();
		var repassword=$("#repassword").val();
		var term=$("#term").val();
		var duration=$("#duration").val();
		var alertTerm=$("#alertTerm").val();
		var alertEmail=$("#alertEmail").val();
		var firstname=$("#firstname").val();
		var lastname=$("#lastname").val();
		var contact=$("#contact").val();
		var facility=$("#facility").val();
		var address=$("#address").val();
		var city=$("#city").val();
		var zip=$("#zip").val();
		var state=$("#state").val();
		var country=$("#country").val();
		var validation = 'registerValidation';
    if(duration =="" || term== "" || alertTerm == "" || address=="" || city=="" || zip=="" || state=="" || country=="" || email=="" || password=="" || firstname=="" || lastname=="" || contact==""){
			updateStatusMsg(validation,init.commonValidation,'warn');
      return false;
		}
    if(password.length < 6){
      updateStatusMsg(validation,init.passwordValidation,'warn');
			return false;
    }
    if(password !== repassword){
      updateStatusMsg(validation,init.passwordMatch,'warn');
			return false;
    }
    if(!validateEmail(email)){
			updateStatusMsg(validation,init.emailValidation,'warn');
			return false;
		}
    password = hex_sha512(password);
    var checked = $("#terms").prop('checked');
    if(!checked){
      updateStatusMsg(validation,init.terms,'warn');
      return false;
    }
    var data = {duration:duration,term:term,alertTerm:alertTerm,alertEmail:alertEmail,email:email,password:password,username:username,firstname:firstname,lastname:lastname,contact:contact,op:'register',facility:facility,address:address,city:city,zip:zip,state:state,country:country};
    handler('backend/process_register.php',data,register_callback,validation);
	});
});

function register_callback(data){
  if(data.error == 0){
    updateStatusMsg('registerValidation',init.emailSent,'success');
    setTimeout(function(){
      window.location.href=init.host+"login.php"
    },2500);
  }else{
    updateStatusMsg('registerValidation',data.message,'fail'); 
    fail(data.error);
  }
}