<?php
include_once 'init.php';
 
function sec_session_start(){
  $session_name = 'appron_id';
  $secure = SECURE;
  $httponly = true;
  if (ini_set('session.use_only_cookies', 1) === FALSE) {
    header("Location: 500.html");
    exit();
  }
  $cookieParams = session_get_cookie_params();
  session_set_cookie_params($cookieParams["lifetime"],$cookieParams["path"],$cookieParams["domain"],$secure,$httponly);
  session_name($session_name);
  session_start();
  session_regenerate_id();
}

function login($email, $password, $mysqli){
  if($stmt = $mysqli->prepare("SELECT members.Id, members.Username, members.Password, members.Salt,users.Active,users.LastLogin, users.RenewDate FROM members join users on users.Email=members.Email WHERE members.Email = ? LIMIT 1")){
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $db_password, $salt, $active, $lastlogin, $renewDate);
    $stmt->fetch();
 
    $password = hash('sha512', $password . $salt);
    if($stmt->num_rows == 1){
      if(checkbrute($user_id, $mysqli) == true){
        $res = array(
          "error" => 1,
          "message" => "Your account got locked due to multiple invalid attempts",
        );
        return $res;
      }else{
        if($db_password == $password){
          if(!$active){
            if($lastlogin == '0000-00-00 00:00:00'){
              $res = array(
                "error" => 1,
                "message" => "Please verify your email address",
              );
              return $res;
            }
            $res = array(
              "error" => 1,
              "message" => "Your account is not Active",
            );
            return $res;
          }
		  $today = date("Y-m-d");
		  if($renewDate < $today){
			$switchQuery = "SELECT Switch from users where UserId = 1";
			$switch = mysqli_query($mysqli,$switchQuery);
			if(!$switch){queryError();return;}
			$switch = mysqli_fetch_row($switch);
			$switch = $switch[0];
			if($switch){
				$nextRenewDate = date('Y-m-d', strtotime('+1 year', strtotime($renewDate)));
				$query = "Update users set RenewDate = '".$nextRenewDate."' where 1=1 AND Email = '".$email."'";
				$res = mysqli_query($mysqli,$query);
				if(!$res){queryError();return;}
			}else{
				$res = array(
				  "error" => 1,
				  "message" => "Your account got expired. Please renew it asap.",
				);
				return $res;
			}
		  }
          $_SESSION['email'] = $email;
          $query = "SELECT * from users where Email='".$email."'";
          $res = mysqli_query($mysqli,$query);
          if(!$res){queryError();return;}
          $user = mysqli_fetch_assoc($res);
          $_SESSION['name'] = $user['FirstName']." ".$user['Lastname'];
          $user_id = preg_replace("/[^0-9]+/", "", $user['UserId']);
          $_SESSION['userId'] = $user_id;
          $_SESSION['isAdmin'] = $user['AdminId'];
          $user_browser = $_SERVER['HTTP_USER_AGENT'];
          $_SESSION['login_string'] = hash('sha512',$password . $user_browser);
          $now = date("Y-m-d h:i:s");
          $mysqli->query("update users set LastLogin='$now' where Email='$email'");
          $res = array(
            "error" => 0,
            "message" => "Successfully Authenticated",
          );
          return $res;
        }else{
          $now = time();
          $mysqli->query("INSERT INTO login_attempts(User_id, Time) VALUES ('$user_id', '$now')");
          $res = array(
              "error" => 1,
              "message" => "Invalid combination of email & password",
            );
          return $res;
        }
      }
    }else{
      $res = array(
        "error" => 1,
        "message" => "Account with provided email-id is not registered",
      );
      return $res;
    }
  }
}

function checkbrute($user_id, $mysqli) {
  $now = time();
  $valid_attempts = $now - (2 * 60 * 60);
  if($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE User_id = ? AND Time > '$valid_attempts'")) {
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 5){
      return true;
    }else{
      return false;
    }
  }
}

function login_check($mysqli){
  if(isset($_SESSION['user_id'],$_SESSION['email'],$_SESSION['login_string'])){
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];
    $login_string = $_SESSION['login_string'];
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    if($stmt = $mysqli->prepare("SELECT Password FROM members WHERE Id = ? LIMIT 1")) {
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows == 1){
        $stmt->bind_result($password);
        $stmt->fetch();
        $login_check = hash('sha512', $password . $user_browser);
        if($login_check == $login_string){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }
  }else{
    return false;
  }
}

function esc_url($url){
  if ('' == $url){
    return $url;
  }
  $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
  $strip = array('%0d', '%0a', '%0D', '%0A');
  $url = (string) $url;
  $count = 1;
  while ($count){
    $url = str_replace($strip, '', $url, $count);
  }
  $url = str_replace(';//', '://', $url);
  $url = htmlentities($url);
  $url = str_replace('&amp;', '&#038;', $url);
  $url = str_replace("'", '&#039;', $url);

  if($url[0] !== '/'){
    return '';
  }else{
    return $url;
  }
}

function sendMail($to,$subject,$message){
  $headers = 'From: noreply@kiranxray.com' . "\r\n" .
    'Cc: raju.solanki@kiranxray.com' . "\r\n";
    'Reply-To: noreply@kiranxray.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  mail($to, $subject, $message, $headers);
}

function queryError(){
  $result = array(
    'error' => 1,
    'message' => 'Can\'t process you request. Please try after some time.'
  );
  echo json_encode($result);
}

function checkRequiredFields(){
  $result = array(
    'error' => 1,
    'message' => 'Please provide the required parameters.'
  );
  echo json_encode($result);
}

function checkSession(){
  if(!isset($_SESSION['userId']) || !isset($_SESSION['email'])){
    $result = array(
      'error' => 2,
      'message' => 'Please log in the system.'
    );
    echo json_encode($result);
    return false;
  }
  return true;
}

function download_send_headers($filename) {
  $now = gmdate("D, d M Y H:i:s");
  header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
  header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
  header("Last-Modified: {$now} GMT");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename={$filename}");
  header("Content-Transfer-Encoding: binary");
}

?>