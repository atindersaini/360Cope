<?php
  ini_set('display_errors',1);
  ob_start();
  include_once 'init.php';
  include_once 'functions.php';
  sec_session_start();
  function reportError(){
    $result = array(
      'error' => 1,
      'message' => 'Please try again. Can\'t fulfil you request.'
    );
    echo json_encode($result);
  }

  function wrongCall(){
   $result = array(
    'error' => 1,
    'message' => 'Please provide the required information'
   );
   echo json_encode($result);
  }
  $action = isset($_REQUEST['_op'])?$_REQUEST['_op']:'addUser';
  if($action == 'addUser'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname= $_POST['firstname'];
    $lastname= $_POST['lastname'];
    $contact = $_POST['contact'];
    $facility = $_POST['facility'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $duration = $_POST['duration'];
    $term = $_POST['term'];
    $alertTerm = $_POST['alertTerm'];
    $alertEmail = $_POST['alertEmail'];
    if(isset($duration,$term,$alertTerm,$alertEmail,$username,$email,$password,$firstname,$lastname,$contact,$facility,$address,$city,$zip,$state,$country)){
      $prep_stmt = "SELECT Id FROM members WHERE Email = ? LIMIT 1";
      $stmt = $mysqli->prepare($prep_stmt);
      if($stmt){
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1){
          $res =array(
            "error" => 1,
            "message" => "A user with this email address already exists",
          );
          echo json_encode($res);
          return;
        }
    }else{
      cant();return;
    }
    $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
    $password = hash('sha512', $password . $random_salt);
    if($insert_stmt = $mysqli->prepare("INSERT INTO members(Username, Email, Password, Salt) VALUES (?, ?, ?, ?)")){
      $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
      if(! $insert_stmt->execute()){cant();return;}
      $now = date("Y-m-d h:i:s");
      $renewDate = date('Y-m-d', strtotime("+".$duration." months"));
      $query = "insert into users(Facility,Address,City,Zip,State,Country,Email,Username,FirstName,LastName,Contact,Active,LastLogin,CreatedOn,RenewDate,Term,AlertTerm,AlertEmail,RoleId,AdminId,PackageId) values ('$facility','$address','$city','$zip','$state','$country','$email','$username','$firstname','$lastname','$contact',0,'0000-00-00 00:00:00','$now','$renewDate',$term,$alertTerm,'$alertEmail',2,0,1)";
      if($mysqli->query($query)){
        $res =array(
          "error" => 0,
          "message" => "Successfully Registered.",
        );
        $message="Hello,\r\n \r\n";
        $message.="Thank you for registering at Apron Inventory. Your account is created and must be activated before you can use it.\r\n \r\nTo activate the account click on the following link or copy-paste it in your browser:\r\n\r\n";
        $message.="http://219.91.205.9:8087/aprontrack/admin/verification.php?email=$email&code=$random_salt&activate=1";
        $message.="\r\n\r\nAfter activation you may login to http://xyz.com.";
        $to = $email;
        $subject = 'Account Activation at Apron Inventory';
        sendMail($to,$subject,$message);
        echo json_encode($res);
        return;
      }else{
        $query = "delete from members where Email = '".$email."'";
        $res = $mysqli->query($query);
        cant();return;
        echo json_encode($res);
      }  
    }
  }else{
    cant();return;
    echo json_encode($res);
  }
}

  if($action == 'getProfile'){
    if(!isset($_SESSION['userId'])){wrongCall();return;}
    $rquery = "SELECT * from `users` where 1=1 AND UserId=".$_SESSION['userId'];
    $res = mysqli_query($mysqli,$rquery);
    if(!$res){reportError();return;}
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
      array_push($data,$row);
    }
    $result = array( 
      'error'=>0,
      'user'=>$data, 
    );
    echo json_encode($result);
    return;
  }
  
  if($action == 'updateProfile'){
    if(!isset($_SESSION['userId'])){wrongCall();return;}
    $userId = $_SESSION['userId'];
    $firstname= $_POST['firstname'];
    $lastname= $_POST['lastname'];
    $contact = $_POST['contact'];
    $facility = $_POST['facility'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $term = $_POST['term'];
    $alertTerm = $_POST['alertTerm'];
    $alertEmail = $_POST['alertEmail'];
    if(isset($term,$alertTerm,$alertEmail,$firstname,$lastname,$contact,$facility,$address,$city,$zip,$state,$country)){
      $prep_stmt = "Update users set 
        Facility = '$facility',
        Address = '$address',
        City = '$city',
        Zip = '$zip',
        State = '$state',
        Country = '$country',
        FirstName = '$firstname',
        Lastname = '$lastname',
        Contact = '$contact',
        Term = $term,
        AlertTerm = $alertTerm,
        AlertEmail = '$alertEmail'
      Where UserId = '$userId'      
      ";
      $stmt = $mysqli->query($prep_stmt);
    $result = array( 
      'error'=>0,
      'message'=>'Data has been updated successfully', 
    );
    echo json_encode($result);
    return;
  }
}

if($action == 'resetPassword' || $action == 'lostPassword'){
  if(!isset($_REQUEST['ps'])){cant();return;}
  $password = $_REQUEST['ps'];
  if($action == 'resetPassword'){
    if(!isset($_SESSION['email']) || !isset($_REQUEST['os'])){cant();return;}
    $email = $_SESSION['email'];
    $oldPass = $_REQUEST['os'];
  }else{
    if(!isset($_REQUEST['email']) || !isset($_REQUEST['ls'])){cant();return;}
    $email=$_REQUEST['email'];
    $pass=$_REQUEST['ls'];
  }
    $query = "SELECT count(Id) from members WHERE Email = '".$email."' LIMIT 1";
    $userFound = mysqli_query($mysqli,$query);
    if(!$userFound){reportError();return;}
    $user = mysqli_fetch_row($userFound);
    $user = $user[0];
    if($user == 1){
      if($action == 'resetPassword'){
        $query = "SELECT Salt,Password from members WHERE Email = '".$email."' LIMIT 1";
        $res = mysqli_query($mysqli,$query);
        $data = array();
        while($row = mysqli_fetch_assoc($res)){
          array_push($data,$row);
        }
        $newPassword = hash('sha512', $oldPass . $data[0]['Salt']);
        if($data[0]['Password'] !== $newPassword){cant();return;}
      }
      $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
      $password = hash('sha512', $password . $random_salt);
      if($mysqli->query("Update members set Password = '$password' , Salt = '$random_salt' where Email = '$email'")){
        $res =array(
          "error" => 0,
          "message" => "Successfully Updated Password",
        );
        $message="Hello,\r\n \r\n";
        $message.="Password Changed Sucessfully";
        if($action == 'lostPassword'){
          $message.="New Password: ".$pass;
        }
        $to = $email;
        $subject = 'Password Changed Sucessfully';
        sendMail($to,$subject,$message);
        echo json_encode($res);
        return;
      }else{
        cant();return;
      }
    }else{
      cant();return;
    }
}
/**
if($action == 'addInternalUser'){
  if(!isset($_REQUEST['ps']) || !isset($_SESSION['email'])){cant();return;}
  $password = $_REQUEST['ps'];
  $email=$_REQUEST['email'];
  $pass=$_REQUEST['ls'];
  $adminId = $_REQUEST['adminId'];
  $query = "SELECT count(Id) from members WHERE Email = '".$email."' LIMIT 1";
  $userFound = mysqli_query($mysqli,$query);
  if(!$userFound){reportError();return;}
  $user = mysqli_fetch_row($userFound);
  if($user){
    $user = $user[0];
    if($user == 1){
      $res = array(
              "error" => 1,
              "message" => "User with this email id is already subscribed",
             );
      echo json_encode($res);
      return;
    }
  }
  $username= 'NA';
  $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
  $password = hash('sha512', $password . $random_salt);
  if($insert_stmt = $mysqli->prepare("INSERT INTO members(Username, Email, Password, Salt) VALUES (?, ?, ?, ?)")){
    $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
    if(! $insert_stmt->execute()){cant();return;}
    $now = date("Y-m-d h:i:s");
    if($mysqli->query("insert into users(Email,CreatedOn,Term,RoleId,AdminId,PackageId) values ('$email','$contact','0000-00-00 00:00:00','$now',6,2,1,1)")){
      $res =array(
        "error" => 0,
        "message" => "Successfully Registered.",
      );
      $message="Hello,\r\n \r\n";
      $message.="You have been registered on Apron Inventory. Your account is created. and must be activated before you can use it.\r\n \r\nTo activate the account click on the following link or copy-paste it in your browser:\r\n\r\n";
      $message.="http://meeknflair.com/verification.php?email=$email&code=$random_salt&activate=1";
      $message.="\r\n\r\nAfter activation you may login to http://xyz.com.";
      $to = $email;
      $subject = 'Account Activation at Apron Inventory';
      sendMail($to,$subject,$message);
      echo json_encode($res);
      return;
    }   
  }
      $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
    $password = hash('sha512', $password . $random_salt);
    if($mysqli->query("Update members set Password = '$password' , Salt = '$random_salt' where Email = '$email'")){
      $res =array(
        "error" => 0,
        "message" => "Successfully Updated Password",
      );
      $message="Hello,\r\n \r\n";
      $message.="Password Changed Sucessfully";
      if($action == 'lostPassword'){
        $message.="New Password: ".$pass;
      }
      $to = $email;
      $subject = 'Password Changed Sucessfully';
      sendMail($to,$subject,$message);
      echo json_encode($res);
      return;
    }else{
      cant();return;
    }
  }else{
    cant();return;
  }
}

**/

function cant(){
  $res =array(
    "error" => 1,
    "message" => "Cannot process your request.",
  );
  echo json_encode($res);
}