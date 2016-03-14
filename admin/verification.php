<?php
include_once 'backend/init.php';
include_once 'backend/functions.php';
?>
<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verification</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-reset.css" rel="stylesheet">
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet">
	<link href="css/style-responsive.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container">
      <form accept-charset="UTF-8"  class="form-signin" accept-charset="UTF-8"    accept-charset="UTF-8"    id="register_form" action="#" method="post" name="login_form">
        <h2 class="form-signin-heading" style="text-align:center">Email Verification</h2>
        <div class="alert alert-warning" id="validation">
          Processing..Please wait for a moment.
        </div>
      </form>
    </div>
    <script src="include/js/jquery-2.0.3.min.js"></script>
    <script src="include/js/bootstrap.min.js"></script>
	<script type="text/JavaScript" src="include/js/init.js"></script>
	<script type="text/JavaScript" src="include/js/sha.js"></script>
	<script type="text/JavaScript" src="include/js/functions.js"></script>
	<script type="text/JavaScript" src="include/js/verification.js"></script> 
  </body>
</html>