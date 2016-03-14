<?php
include_once 'backend/init.php';
include_once 'backend/functions.php';
sec_session_start();
if(login_check($mysqli) == true){
 $logged = 'in';
} else {
 $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keyword" content="">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Admin</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-reset.css" rel="stylesheet">
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>
<body class="login-body">
  <div class="container">
  <form accept-charset="UTF-8"  class="form-signin" action="#" id="login_form">
    <h2 class="form-signin-heading">sign in now</h2>
    <div class="login-wrap">
      <input type="text" accept-charset="UTF-8"    class="form-control" id="email" placeholder="Email" autofocus>
      <input type="password" class="form-control" id="password" placeholder="Password">
      <label class="checkbox">
        <span class="pull-right">
          <a data-toggle="modal" href="#resetModal"> Forgot Password?</a>
        </span>
      </label>
      <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
      <div class="registration">
        Don't have an account yet?
        <a class="" href="registration.php">
          Create an account
        </a>
      </div>
    </div>
    <div class="alert alert-warning"  style="display:none" id="loginValidation"></div>
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="resetModal" class="modal fade">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Forgot Password ?</h4>
                </div>
                <div class="modal-body">
                    <p>Enter your e-mail address below to reset your password.</p>
                    <input type="text" accept-charset="UTF-8"    name="email" id="resetEmail" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                    <div class="alert alert-warning"  style="display:none" id="resetValidation"></div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                    <button class="btn btn-primary" type="button" id="resetBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
  </form>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/JavaScript" src="include/js/init.js"></script> 
  <script type="text/JavaScript" src="include/js/sha.js"></script> 
  <script type="text/JavaScript" src="include/js/functions.js"></script> 
  <script type="text/JavaScript" src="include/js/login.js"></script> 
</body>
</html>
