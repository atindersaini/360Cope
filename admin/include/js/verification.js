$(document).ready(function(){
  var hash= [];
  hash = getParameters();
  var code = hash.code;
  var email = hash.email;
  var activate = hash.activate;
  var data = {code:code,email:email,activate:activate,op:'verify'};
  handler('backend/process_verification.php',data,verify_callback,'validation');
});

function verify_callback(data){
  if(data.error == 0){
    updateStatusMsg('validation',init.verficationSuccess,'success');
    setTimeout(function(){
      window.location.href=init.host+"login.php"
    },2500);
  }else{
    updateStatusMsg('validation',data.message,'fail');
    fail(data.error);    
  }
}