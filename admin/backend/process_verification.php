 <?php
  include_once 'init.php';
  include_once 'functions.php';

  $email = $_POST['email'];
  $code = $_POST['code'];
  $activate= $_POST['activate'];

  if(isset($code,$email,$activate)){
    $result = $mysqli->query("SELECT members.Email FROM members join users on users.Email=members.Email where users.Email='$email' AND members.Salt='$code'");
    if($result && mysqli_num_rows($result) == 1){
      if($mysqli->query("update users join members on users.Email=members.Email set users.Active=1 where users.Email='$email' AND members.Salt='$code'")){
        $res =array(
              "error" => 0,
              "message" => "Email verified successfully.",
            );
        echo json_encode($res);
        return;
      }
    }
  }
  $res =array(
          "error" => 1,
          "message" => "Cannot process your request.<br>Please try after sometime.",
        );
  echo json_encode($res);
  return;
?>