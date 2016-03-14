<?php
include_once 'init.php';
include_once 'functions.php';
sec_session_start();
 
if(isset($_POST['email'], $_POST['password'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $res = login($email, $password, $mysqli);
}else{
  $res = array(
          "error" => 1,
          "message" => "Your response is invalid",
        );
}
echo json_encode($res);

?>