<?php
include_once 'backend/init.php';
include_once 'backend/functions.php';
sec_session_start();
if (login_check($mysqli) == true) {
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
  <title>Registration</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-reset.css" rel="stylesheet">
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form accept-charset="UTF-8"  class="form-signin" accept-charset="UTF-8"    accept-charset="UTF-8"    id="register_form" action="#" method="post" name="login_form">
        <h2 class="form-signin-heading">registration now</h2>
        <div class="login-wrap">
            <p> Enter your account details below</p>
            <input type="text" accept-charset="UTF-8"    class="form-control" name="email" id="email" placeholder="Email" autofocus>
            <input type="password" class="form-control" placeholder="Password" id="password">
            <input type="password" class="form-control" placeholder="Re-type Password" id="repassword">
            <input type="hidden" class="form-control" placeholder="Package(in months)" id="duration" value="12">
            <input type="text" accept-charset="UTF-8"    class="form-control" placeholder="Inspection Period(in months)" id="term">
            <input type="text" accept-charset="UTF-8"    class="form-control" placeholder="Inspection Alert before(in weeks)" id="alertTerm">
            <input type="text" accept-charset="UTF-8"    class="form-control" placeholder="Enter the emails for the alert" id="alertEmail">
            <p>Enter your personal details below</p>
            <input type="text" accept-charset="UTF-8"    name="firstname" id="firstname" class="form-control" placeholder="First Name" autofocus>
            <input type="text" accept-charset="UTF-8"    name="lastname" id="lastname" class="form-control" placeholder="Last Name" autofocus>
            <input type="text" accept-charset="UTF-8"    name="contact" id="contact" class="form-control" placeholder="Contact No" autofocus>
            <input type="text" accept-charset="UTF-8"    name="facility" id="facility" class="form-control" placeholder="Facility" autofocus>
            <input type="text" accept-charset="UTF-8"    name="address" id="address" class="form-control" placeholder="Address" autofocus>
            <input type="text" accept-charset="UTF-8"    name="city" id="city" class="form-control" placeholder="Town/City" autofocus>
            <input type="text" accept-charset="UTF-8"    name="zip" id="zip" class="form-control" placeholder="Zip Code/Postal Code" autofocus>
            <input type="text" accept-charset="UTF-8"    name="state" id="state" class="form-control" placeholder="State/Province" autofocus>
            <input type="text" accept-charset="UTF-8"    name="country" id="country" class="form-control" placeholder="Country" autofocus>
            <label class="checkbox">
                <input type="checkbox" id="terms" value="agree this condition"> I agree to the Terms of Service and Privacy Policy
            </label>
            <div class="alert alert-warning" style="display:none;margin-top:20px" id="registerValidation"></div>
            <input class="btn btn-lg btn-login btn-block" value="Sign Up" name="signup" type="submit">

          <div class="registration">
            Already Registered.
            <a class="" href="login.php">
              Login
            </a>
          </div>
        </div>
      </form>
    </div>
    <script src="include/js/jquery-2.0.3.min.js"></script>
    <script src="include/js/bootstrap.min.js"></script>
		<script type="text/JavaScript" src="include/js/init.js"></script>
		<script type="text/JavaScript" src="include/js/sha.js"></script>
    <script type="text/JavaScript" src="include/js/functions.js"></script>
		<script type="text/JavaScript" src="include/js/register.js"></script>
  </body>
</html>
