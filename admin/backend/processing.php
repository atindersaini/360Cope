<?php

include_once 'init.php';
include_once 'functions.php';
sec_session_start();

if(!checkSession()){return;}
if($_SESSION['isAdmin'] == 1){
  $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';
}else{
  $userId = $_SESSION['userId'];
}

$action = (isset($_REQUEST['_op']))?$_REQUEST['_op']:'checkRequiredFields';
if($action == 'checkRequiredFields'){checkRequiredFields();return;}

$result = array(
    'error' => 1,
    'message' => 'Please provide the required parameters.'
  );
  
$limitQuery = "";
$limit = (isset($_REQUEST['limit']))?$_REQUEST['limit']:$init['defaultLimit'];
$page = (isset($_REQUEST['page']))?$_REQUEST['page']:0;
$start = $page*$limit;
$limitQuery = "LIMIT ".intval($start).", ".intval($limit);
  
$where = "";
$order = "";
$sortOrder = (isset($_REQUEST['sortOrder']))?$_REQUEST['sortOrder']:'asc';
if(isset($_REQUEST['sort'])){
  $order = "ORDER BY  ";
  $order .= "`".$_REQUEST['sort']."` ".$sortOrder.", ";
}

if($action == 'show_users' && $_SESSION['isAdmin'] == 1){
  $query = "SELECT * from users where 1=1 AND UserId != 1";
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}

  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
	$switchQuery = "SELECT Switch from users where UserId = 1";
	$switch = mysqli_query($mysqli,$switchQuery);
	if(!$switch){queryError();return;}
	$switch = mysqli_fetch_row($switch);
	$switch = $switch[0];
    $result = array('error'=>0, 'users'=>$data,'switch'=>$switch);
}

if($action == 'show_active_users' && $_SESSION['isAdmin'] == 1){
  $query = "Select * from users where UserId in (SELECT distinct(UserId) FROM apron) AND 1=1 AND UserId != 1";
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}

  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
	$switchQuery = "SELECT Switch from users where UserId = 1";
	$switch = mysqli_query($mysqli,$switchQuery);
	if(!$switch){queryError();return;}
	$switch = mysqli_fetch_row($switch);
	$switch = $switch[0];
    $result = array('error'=>0, 'users'=>$data,'switch'=>$switch);
}

if($action == 'update_renewDate' && $_SESSION['isAdmin'] == 1){
  if(!isset($_REQUEST['renewDate']) && !isset($_REQUEST['clientId'])){checkRequiredFields();return;}
  $query = "Update users set RenewDate = '".$_REQUEST['renewDate']."' where 1=1 AND UserId = ".$_REQUEST['clientId'];
  // echo $query;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>'User\'s renewal date has been Updated');
}

if($action == 'switch_window' && $_SESSION['isAdmin'] == 1){
  if(!isset($_REQUEST['switch'])){checkRequiredFields();return;}
  $query = "Update users set Switch = ".$_REQUEST['switch']." where 1=1 AND UserId = 1";
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>'Settings has been Updated');
}
if($action == 'export_users' && $_SESSION['isAdmin'] == 1){
  $query = "SELECT `UserId`, `Email`, `FirstName`, `Lastname`,`Facility`, `Address`, `City`, `Zip`, `State`, `Country`, `Contact`, `LastLogin`, `CreatedOn`, `RenewDate`, `Term`, `AlertTerm`, `AlertEmail` FROM `users`";
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}

  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  if(sizeOf($data) == 0){return null;}
  
  download_send_headers("data_export_" . date("Y-m-d") . ".csv");
  $array = $data;
  $df = fopen("php://output", 'w');
  fputcsv($df, array_keys($array[0]));
  foreach ($array as $fields) {
    fputcsv($df, array_values($fields));
  }
  fclose($df);
  die();
  return;
}
if($action == 'export_apron'){
  if($_SESSION['isAdmin'] != 1){
	 $where.=" and A.UserId = ".$userId;
  }
  if($_SESSION['isAdmin'] == 1 && isset($_REQUEST['userId'])){
	 $where.=" and A.UserId = ".$userId;
  }
  if(isset($_REQUEST['apronId'])){$where.=" and  ApronId = '".$_REQUEST['apronId']."'";}
  if(isset($_REQUEST['batchNo'])){$where.=" and  BatchNo = ".$_REQUEST['batchNo'];}
  if(isset($_REQUEST['articleCode'])){$where.=" and  ArticleCode = ".$_REQUEST['articleCode'];}
  if(isset($_REQUEST['department'])){$where.=" and  Department = ".$_REQUEST['department'];}
  if(isset($_REQUEST['assignedTo'])){$where.=" and  AssignedTo = ".$_REQUEST['assignedTo'];}
  if(isset($_REQUEST['manufacturer'])){$where.=" and  Manufacturer = '".$_REQUEST['manufacturer']."'";}
  if(isset($_REQUEST['garment'])){$where.=" and  Garment = '".$_REQUEST['garment']."'";}
  if(isset($_REQUEST['core'])){$where.=" and  Core = '".$_REQUEST['core']."'";}
  if(isset($_REQUEST['monogram'])){$where.=" and  Monogram = '".$_REQUEST['monogram']."'";}
  if(isset($_REQUEST['colour'])){$where.=" and  Colour = '".$_REQUEST['colour']."'";}
  if(isset($_REQUEST['manufacturerDate'])){$where.=" and  ManufacturerDate = '".$_REQUEST['manufacturerDate']."'";}
  if(isset($_REQUEST['lastInspectionDate'])){$where.=" and  LastInspectionDate = '".$_REQUEST['lastInspectionDate']."'";}
  if(isset($_REQUEST['status'])){$where.=" and  Status = '".$_REQUEST['status']."'";}
  if(isset($_REQUEST['active'])){$where.=" and  Active = ".$_REQUEST['active'];}
  $q1 = "SELECT A.ApronId,A.BatchNo,A.ArticleCode,A.Department,A.AssignedTo,A.Manufacturer,A.Garment,A.Core,A.Colour,A.Monogram,A.ManufacturerDate,A.LastInspectionDate,A.NextInspectionDate,A.Status ";
  if($_SESSION['isAdmin'] == 1){
    $q1.=" ,U.Email ";
  }
  $query = $q1." from apron A join users U on U.UserId = A.UserId where 1=1 ".$where." ".$order." ".$limitQuery;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}

  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  if(sizeOf($data) == 0){return null;}
  
  download_send_headers("data_export_" . date("Y-m-d") . ".csv");
  $array = $data;
  $df = fopen("php://output", 'w');
  fputcsv($df, array_keys($array[0]));
  foreach ($array as $fields) {
    fputcsv($df, array_values($fields));
  }
  fclose($df);
  die();
  return;
}
  
if($action == 'import_apron'){
  if(!isset($_REQUEST['files'])){checkRequiredFields();return;}
  $row = 1;
  $files = array();
	$uploaddir = '../upload/';
	foreach($_FILES as $file){
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name']))){
			$files[] = $uploaddir .$file['name'];
		  $sql = "REPLACE INTO `apron`(`UserId`,`ApronId`, `BatchNo`, `ArticleCode`, `Department`, `AssignedTo`, `Manufacturer`, `Garment`, `Core`, `Colour`, `Monogram`, `ManufacturerDate`, `LastInspectionDate`,`NextInspectionDate`, `Status`, `Active`) VALUES ";
      if(($handle = fopen($uploaddir .basename($file['name']), "r")) !== FALSE) {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
          $row++;
          if($row == 2 || !$data[0] || $data[0] == '') continue;
          $query = "Select UserId from apron where ApronId='".$data[0]."'";
          $res = mysqli_query($mysqli,$query);
          if($res->num_rows != 0){
            $Id = mysqli_fetch_row($res);
            $Id = $Id[0];
            if($Id != $userId) continue;          
          }
          $num = count($data);
          $sql .= "(".$userId.",";
          for ($c=0; $c < $num; $c++) {
            if($c == 10 || $c == 11 || $c == 12){
              $dateInput = explode('-',$data[$c]);
               $sql .= "'" . $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0] . "',";
            }else{
              $sql .= "'" . $data[$c] . "',";
            }
          }
          $sql .= "1),";
        }
        $sql = str_replace(",)",")",$sql);
        $sql = substr($sql,0,-1);
        $res = mysqli_query($mysqli,$sql);
        if(!$res){queryError();return;}
        fclose($handle);
      }
    }else{
      checkRequiredFields();return;
		}
	}
  $result = array('error'=>0, 'message'=>$init['addMsg'], 'records'=>$row-2);
}

// Add data

if($action == 'add_manufacturer'){
  if(!isset($_REQUEST['name'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))?$_REQUEST['status']:1; 
  $rquery = "INSERT INTO `manufacturer` (`ManufacturerId`,`Manufacturer`,`Active`,`UserId`) VALUES ( NULL
    ,'".$_REQUEST['name']."'
    ,'".$status."'
    ,".$_SESSION['userId']."
  )";
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $insertedId = $mysqli->insert_id;
  $result = array('error'=>0, 'message'=>$init['addMsg'], 'id'=>$insertedId);
}

if($action == 'add_garment'){
  if(!isset($_REQUEST['name'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))?$_REQUEST['status']:1; 
  $rquery = "INSERT INTO `garment` (`GarmentId`,`Garment`,`Active`,`UserId`) VALUES ( NULL
    ,'".$_REQUEST['name']."'
    ,'".$_REQUEST['status']."'
    ,".$_SESSION['userId']."
  )";
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $insertedId = $mysqli->insert_id;
  $result = array('error'=>0, 'message'=>$init['addMsg'], 'id'=>$insertedId);
}

if($action == 'add_core'){
  if(!isset($_REQUEST['name'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))?$_REQUEST['status']:1;
  $rquery = "INSERT INTO `core` (`CoreId`,`Core`,`Active`,`UserId`) VALUES ( NULL
    ,'".$_REQUEST['name']."'
    ,'".$_REQUEST['status']."'
    ,".$_SESSION['userId']."
  )";
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $insertedId = $mysqli->insert_id;
  $result = array('error'=>0, 'message'=>$init['addMsg'], 'id'=>$insertedId);
}  
 
//Update Data

if($action == 'update_core'){
  if(!isset($_REQUEST['name']) || !isset($_REQUEST['coreId'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))? ",`Active` = '".$_REQUEST['status']."'" : "";
  $rquery = "UPDATE `core` SET `Core` = '".$_REQUEST['name']."'".$status." WHERE `CoreId` = ".$_REQUEST['coreId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['updateMsg']);
}

if($action == 'update_manufacturer'){
  if(!isset($_REQUEST['name']) || !isset($_REQUEST['manufacturerId'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))? ",`Active` = '".$_REQUEST['status']."'" : "";
  $rquery = "UPDATE `manufacturer` SET `Manufacturer` = '".$_REQUEST['name']."'".$status." WHERE `ManufacturerId` = ".$_REQUEST['manufacturerId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['updateMsg']);
}

if($action == 'update_garment'){
  if(!isset($_REQUEST['name']) || !isset($_REQUEST['garmentId'])){checkRequiredFields();return;}
  $status = (isset($_REQUEST['status']))? ",`Active` = '".$_REQUEST['status']."'" : "";
	$rquery = "UPDATE `garment` SET `Garment` = '".$_REQUEST['name']."'".$status." WHERE `GarmentId` = ".$_REQUEST['garmentId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['updateMsg']);
}  

// Permanently Delete Data

if($action == 'delete_core'){
  if(!isset($_REQUEST['coreId'])){checkRequiredFields();return;}
  $rquery = "Delete from `core` WHERE `CoreId` = ".$_REQUEST['coreId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

if($action == 'delete_manufacturer'){
  if(!isset($_REQUEST['manufacturerId'])){checkRequiredFields();return;}
  $rquery = "Delete from `manufacturer` WHERE `ManufacturerId` = ".$_REQUEST['manufacturerId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

if($action == 'delete_garment'){
  if(!isset($_REQUEST['garmentId'])){checkRequiredFields();return;}
  $rquery = "Delete from `garment` WHERE `GarmentId` = ".$_REQUEST['garmentId']." and UserId = ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

//Delete or Restore data

if($action == 'status_core'){
  if(!isset($_REQUEST['status']) || !isset($_REQUEST['coreId'])){checkRequiredFields();return;}
  $rquery = "UPDATE `core` SET `Active` = '".$_REQUEST['status']."' WHERE `CoreId` = ".$_REQUEST['coreId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}
  
if($action == 'status_manufacturer'){
  if(!isset($_REQUEST['status']) || !isset($_REQUEST['manufacturerId'])){checkRequiredFields();return;}
  $rquery = "UPDATE `manufacturer` SET `Active` = '".$_REQUEST['status']."' WHERE `ManufacturerId` = ".$_REQUEST['manufacturerId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

if($action == 'status_garment'){
  if(!isset($_REQUEST['status']) || !isset($_REQUEST['garmentId'])){checkRequiredFields();return;}
	$rquery = "UPDATE `garment` SET `Active` = '".$_REQUEST['status']."' WHERE `GarmentId` = ".$_REQUEST['garmentId'];
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

if($action == 'list_manufacturer'){
  if(isset($_REQUEST['name'])){$where.=" and  Manufacturer LIKE '%".$_REQUEST['name']."%'";}
  if(isset($_REQUEST['manufacturerId'])){$where.=" and  ManufacturerId = ".$_REQUEST['manufacturerId'];}
  if(isset($_REQUEST['Active'])){$where.=" and  Active = ".$_REQUEST['active'];}
  $where.=" and UserId = ".$_SESSION['userId'];
  $rquery = "SELECT * from `manufacturer` where 1=1 ".$where." ".$order." ".$limitQuery;
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  $query = 'SELECT FOUND_ROWS()';
  $rowFound = mysqli_query($mysqli,$query);
  if(!$rowFound){queryError();return;}
  $rows=mysqli_fetch_row($rowFound);
  $rows = $rows[0];
  
  $query = "SELECT count(ManufacturerId) from `manufacturer` where 1=1 ".$where;
  $totalRowsFound = mysqli_query($mysqli,$query);
  if(!$totalRowsFound){queryError();return;}
  $total_rows = mysqli_fetch_row($totalRowsFound);
  $total_rows = $total_rows[0];
  
  $totalPages = ceil($total_rows/$limit);
  $end = $limit*($page+1);
  $end = ($total_rows < $end)?$total_rows:$end;
  $result = array( 
    'error'=>0,
    'start'=>$start+1,
    'end'=>$end,
    'page'=>$page,
    'totalPages'=>$totalPages,
    'rowFound'=>$rows,
    'totalRowsFound'=>$total_rows,
    'limit'=>$limit,
    'manufacturer'=>$data, 
  );
}

if($action == 'list_garment'){
  if(isset($_REQUEST['name'])){$where.=" and  Garment LIKE '%".$_REQUEST['name']."%'";}
  if(isset($_REQUEST['garmentId'])){$where.=" and  GarmentId = ".$_REQUEST['garmentId'];}
  if(isset($_REQUEST['status'])){$where.=" and  Active = ".$_REQUEST['status'];}
  $where.=" and UserId = ".$_SESSION['userId'];  
  $rquery = "SELECT * from `garment` where 1=1 ".$where." ".$order." ".$limitQuery;
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  $query = 'SELECT FOUND_ROWS()';
  $rowFound = mysqli_query($mysqli,$query);
  if(!$rowFound){queryError();return;}
  $rows=mysqli_fetch_row($rowFound);
  $rows = $rows[0];
  
  $query = "SELECT count(GarmentId) from `garment` where 1=1 ".$where;
  $totalRowsFound = mysqli_query($mysqli,$query);
  if(!$totalRowsFound){queryError();return;}
  $total_rows = mysqli_fetch_row($totalRowsFound);
  $total_rows = $total_rows[0];
  
  $totalPages = ceil($total_rows/$limit);
  $end = $limit*($page+1);
  $end = ($total_rows < $end)?$total_rows:$end;
  $result = array( 
    'error'=>0,
    'start'=>$start+1,
    'end'=>$end,
    'page'=>$page,
    'totalPages'=>$totalPages,
    'rowFound'=>$rows,
    'totalRowsFound'=>$total_rows,
    'limit'=>$limit,
    'garment'=>$data, 
  );
}

if($action == 'list_core'){
  if(isset($_REQUEST['name'])){$where.=" and  Core LIKE '%".$_REQUEST['name']."%'";}
  if(isset($_REQUEST['coreId'])){$where.=" and  CoreId = ".$_REQUEST['coreId'];}
  if(isset($_REQUEST['status'])){$where.=" and  Active = ".$_REQUEST['status'];}
  $where.=" and UserId = ".$_SESSION['userId'];
  $rquery = "SELECT * from `core` where 1=1 ".$where." ".$order." ".$limitQuery;
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  $query = 'SELECT FOUND_ROWS()';
  $rowFound = mysqli_query($mysqli,$query);
  if(!$rowFound){queryError();return;}
  $rows=mysqli_fetch_row($rowFound);
  $rows = $rows[0];
  
  $query = "SELECT count(CoreId) from `core` where 1=1 ".$where;
  $totalRowsFound = mysqli_query($mysqli,$query);
  if(!$totalRowsFound){queryError();return;}
  $total_rows = mysqli_fetch_row($totalRowsFound);
  $total_rows = $total_rows[0];
  
  $totalPages = ceil($total_rows/$limit);
  $end = $limit*($page+1);
  $end = ($total_rows < $end)?$total_rows:$end;
  $result = array( 
    'error'=>0,
    'start'=>$start+1,
    'end'=>$end,
    'page'=>$page,
    'totalPages'=>$totalPages,
    'rowFound'=>$rows,
    'totalRowsFound'=>$total_rows,
    'limit'=>$limit,
    'core'=>$data, 
  );
}

//Apron
if($action == 'add_apron'){
  if(!isset($_REQUEST['apronId']) || !isset($_REQUEST['articleCode']) || !isset($_REQUEST['batchNo']) || !isset($_REQUEST['department']) || !isset($_REQUEST['assignedTo']) || !isset($_REQUEST['manufacturer']) || !isset($_REQUEST['garment']) || !isset($_REQUEST['core']) || !isset($_REQUEST['colour']) || !isset($_REQUEST['monogram']) || !isset($_REQUEST['manufacturerDate'])){
    checkRequiredFields();return;
  }
  $apronId = $_REQUEST['apronId'];
  
  $query = "SELECT count(ApronId) from apron where 1=1 AND ApronId = '".$apronId."'";
  $rowsFound = mysqli_query($mysqli,$query);
  if(!$rowsFound){queryError();return;}
  $rows = mysqli_fetch_row($rowsFound);
  $rows = $rows[0];
  if($rows > 0){
    $result = array('error'=>1, 'message'=>'Apron with '.$apronId.' Id is already present in database');  
    echo json_encode($result);
    return;
  }
  
  $query = "SELECT Term from users where UserId= ".$userId;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $term = mysqli_fetch_row($res);
  $term = $term[0];
  
  $articleCode = $_REQUEST['articleCode'];
  $batchNo = $_REQUEST['batchNo'];
  $department = $_REQUEST['department'];
  $assignedTo = $_REQUEST['assignedTo'];
  $manufacturer = $_REQUEST['manufacturer'];
  $garment = $_REQUEST['garment'];
  $core = $_REQUEST['core'];
  $colour = $_REQUEST['colour'];
  $monogram = $_REQUEST['monogram'];
  $manufacturerDate = $_REQUEST['manufacturerDate'];
  $lastInspectionDate = (empty($_REQUEST['lastInspectionDate'])) ? NULL : $_REQUEST['lastInspectionDate'];
  $nextInspectionDate = date('Y-m-d', strtotime('+'.$term.' month', strtotime(date("Y-m-d"))));
  $status = (empty($_REQUEST['status'])) ? $init['defaultStatus'] : $_REQUEST['status'];
  $active = (empty($_REQUEST['active'])) ? 1 : $_REQUEST['active'];
  $rquery = "INSERT INTO `apron` (`ApronId`,`BatchNo`,`ArticleCode`,`UserId`,`Department`,`AssignedTo`,`Manufacturer`,`Garment`,`Core`,`Colour`,`Monogram`,`ManufacturerDate`,`NextInspectionDate`,`Active`,`Status`) VALUES (
    '$apronId'
    ,'$batchNo'
    ,'$articleCode'
    ,$userId
    ,'$department'
    ,'$assignedTo'
    ,'$manufacturer'
    ,'$garment'
    ,'$core'
    ,'$colour'
    ,'$monogram'
    ,'$manufacturerDate'
    ,'$nextInspectionDate'
    , $active
    ,'$status'
  )";
  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}
  
  $insertedId = $mysqli->insert_id;
  $result = array('error'=>0, 'message'=>$init['addMsg'], 'id'=>$insertedId);
}

if($action == 'list_apron'){
  if($_SESSION['isAdmin'] != 1){
	$where.=" and A.UserId = ".$userId;
  } else if(isset($_REQUEST['userId']) && $_SESSION['isAdmin'] == 1){
    $where.=" and A.UserId = ".$_REQUEST['userId'];
  }
  if(isset($_REQUEST['apronId'])){$where.=" and  ApronId = '".$_REQUEST['apronId']."'";}
  if(isset($_REQUEST['articleCode'])){$where.=" and  ArticleCode = '".$_REQUEST['articleCode']."'";}
  if(isset($_REQUEST['batchNo'])){$where.=" and  BatchNo = '".$_REQUEST['batchNo']."'";}
  if(isset($_REQUEST['department'])){$where.=" and  Department = ".$_REQUEST['department'];}
  if(isset($_REQUEST['assignedTo'])){$where.=" and  AssignedTo = ".$_REQUEST['assignedTo'];}
  if(isset($_REQUEST['manufacturer'])){$where.=" and  Manufacturer = '".$_REQUEST['manufacturer']."'";}
  if(isset($_REQUEST['garment'])){$where.=" and  Garment = '".$_REQUEST['garment']."'";}
  if(isset($_REQUEST['core'])){$where.=" and  Core = '".$_REQUEST['core']."'";}
  if(isset($_REQUEST['monogram'])){$where.=" and  Monogram = '".$_REQUEST['monogram']."'";}
  if(isset($_REQUEST['colour'])){$where.=" and  Colour = '".$_REQUEST['colour']."'";}
  if(isset($_REQUEST['manufacturerDate'])){$where.=" and  ManufacturerDate = '".$_REQUEST['manufacturerDate']."'";}
  if(isset($_REQUEST['lastInspectionDate'])){$where.=" and  LastInspectionDate = '".$_REQUEST['lastInspectionDate']."'";}
  if(isset($_REQUEST['status'])){$where.=" and  Status = '".$_REQUEST['status']."'";}
  if(isset($_REQUEST['active'])){$where.=" and  Active = ".$_REQUEST['active'];}
  
  $query = "SELECT A.*,U.Email from apron A join users U on U.UserId = A.UserId where 1=1 ".$where." ".$order." ".$limitQuery;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }

  $query = 'SELECT FOUND_ROWS()';
  $rowFound = mysqli_query($mysqli,$query);
  if(!$rowFound){queryError();return;}
  $rows=mysqli_fetch_row($rowFound);
  $rows = $rows[0];

  $query = "SELECT count(ApronId) from apron A where 1=1 ".$where;
  $totalRowsFound = mysqli_query($mysqli,$query);
  if(!$totalRowsFound){queryError();return;}
  $total_rows = mysqli_fetch_row($totalRowsFound);
  $total_rows = $total_rows[0];

  $totalPages = ceil($total_rows/$limit);
  $end = $limit*($page+1);
  $end = ($total_rows < $end)?$total_rows:$end;

  $result = array( 
    'error'=>0,
    'start'=>$start+1,
    'end'=>$end,
    'page'=>$page,
    'totalPages'=>$totalPages,
    'rowFound'=>$rows,
    'totalRowsFound'=>$total_rows,
    'limit'=>$limit,
    'apron'=>$data, 
  );
}

if($action == 'update_apron'){
  $str="";
  if(!isset($_REQUEST['apronId'])){checkRequiredFields();return;}
  if(isset($_REQUEST['batchNo']))$str.="BatchNo = '".$_REQUEST['batchNo']."',";
  if(isset($_REQUEST['articleCode']))$str.="ArticleCode = '".$_REQUEST['articleCode']."',";
  if(isset($_REQUEST['department']))$str.="Department = '".$_REQUEST['department']."',";
  if(isset($_REQUEST['assignedTo']))$str.="AssignedTo = '".$_REQUEST['assignedTo']."',";
  if(isset($_REQUEST['manufacturer']))$str.="Manufacturer = '".$_REQUEST['manufacturer']."',";
  if(isset($_REQUEST['garment']))$str.="Garment = '".$_REQUEST['garment']."',";
  if(isset($_REQUEST['core']))$str.="Core = '".$_REQUEST['core']."',";
  if(isset($_REQUEST['monogram']))$str.="Monogram = '".$_REQUEST['monogram']."',";
  if(isset($_REQUEST['colour']))$str.="Colour = '".$_REQUEST['colour']."',";
  if(isset($_REQUEST['manufacturerDate']))$str.="ManufacturerDate = '".$_REQUEST['manufacturerDate']."'";
  $query = "Update apron set ".$str." where ApronId = '".$_REQUEST['apronId']."' AND UserId = ".$userId;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['updateMsg']);
} 

if($action == 'delete_apron'){
  if(!isset($_REQUEST['apronId'])){checkRequiredFields();return;}
  $query = "Delete from apron where ApronId = '".$_REQUEST['apronId']."' AND UserId = ".$userId;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $result = array('error'=>0, 'message'=>$init['deleteMsg']);
}

// DashBoard  
if($action == 'dashboard'){
  if($_SESSION['isAdmin'] != 1){
    $where =" and A.UserId = ".$userId;
  }else{
    $where =" and A.UserId != 1";
  }
  $selectQuery = "SELECT A.*";
  $mainQuery = " from apron A join users U on U.UserId = A.UserId";
  $rQuery = $selectQuery." ".$mainQuery." where 1=1 ".$where." ".$order." ".$limitQuery;

  $res = mysqli_query($mysqli,$rQuery);
  if(!$res){queryError();return;}
  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }
  
  $rQuery = 'SELECT FOUND_ROWS()';
  $apronsFound = mysqli_query($mysqli,$rQuery);
  if(!$apronsFound){queryError();return;}
  $apronsFound = mysqli_fetch_row($apronsFound);
  $apronsFound = $apronsFound[0];
  
  $activeQuery = "SELECT count(ApronId) ".$mainQuery." where 1=1 AND A.Status = 'In Service' ".$where;
  $activeAprons = mysqli_query($mysqli,$activeQuery);
  if(!$activeAprons){queryError();return;}
  $activeAprons = mysqli_fetch_row($activeAprons);
  $activeAprons = $activeAprons[0];
  
  $requestedQuery = "SELECT count(ApronId) ".$mainQuery." where 1=1 AND A.Status = 'Replacing' ".$where;
  $requestedAprons = mysqli_query($mysqli,$requestedQuery);
  if(!$requestedAprons){queryError();return;}
  $requestedAprons = mysqli_fetch_row($requestedAprons);
  $requestedAprons = $requestedAprons[0];

  $missingQuery = "SELECT count(ApronId) ".$mainQuery." where 1=1 AND A.Status = 'Missing' ".$where;
  $missingAprons = mysqli_query($mysqli,$missingQuery);
  if(!$missingAprons){queryError();return;}
  $missingAprons = mysqli_fetch_row($missingAprons);
  $missingAprons = $missingAprons[0];

  $damageQuery = "SELECT count(ApronId) ".$mainQuery." where 1=1 AND A.Status = 'Damage' ".$where;
  $damageAprons = mysqli_query($mysqli,$damageQuery);
  if(!$damageAprons){queryError();return;}
  $damageAprons = mysqli_fetch_row($damageAprons);
  $damageAprons = $damageAprons[0];
  
  $inactiveQuery = "SELECT count(ApronId) ".$mainQuery." where 1=1 AND A.Status = 'Out of Service' ".$where;
  $inactiveAprons = mysqli_query($mysqli,$inactiveQuery);
  if(!$inactiveAprons){queryError();return;}
  $inactiveAprons = mysqli_fetch_row($inactiveAprons);
  $inactiveAprons = $inactiveAprons[0];
  
  $inspectQuery = "SELECT count(I.InspectId) from inspect I join apron A on A.ApronId = I.ApronId where 1=1 ".$where;
  $inspections = mysqli_query($mysqli,$inspectQuery);
  if(!$inspections){queryError();return;}
  $inspections = mysqli_fetch_row($inspections);
  $inspections = $inspections[0];
  
  $query = "SELECT count(*) from users";
  $userCount = mysqli_query($mysqli,$query);
  if(!$userCount){queryError();return;}
  $userCount = mysqli_fetch_row($userCount);
  $userCount = $userCount[0]-1;
  
  $query = "SELECT * from users where UserId= ".$_SESSION['userId'];
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $user = mysqli_fetch_assoc($res);
  $term = $user['Term'];
  $creationDate = $user['CreatedOn'];
  $renewDate = $user['RenewDate'];
  $alertTerm = $user['AlertTerm'];

  $notifyDate = date('Y-m-d', strtotime("+".$alertTerm." weeks"));
  $rQuery = $selectQuery." ".$mainQuery." where 1=1 ".$where." AND NextInspectionDate <= '".$notifyDate."' order by NextInspectionDate asc ".$limitQuery;
  $res = mysqli_query($mysqli,$rQuery);
  if(!$res){queryError();return;}
  $data2 = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data2,$row);
  }
  
  $start = strtotime(date("Y-m-d"));
  $end = strtotime($renewDate);
  $remainingDays = ceil(abs($end - $start) / 86400);
  $start = strtotime($creationDate);
  $end = strtotime($renewDate);
  $totalDays = ceil(abs($end - $start) / 86400);
  $creationDate = date("d M, Y", strtotime($creationDate));
  $renewDate = date("d M, Y", strtotime($renewDate));
  $days = $totalDays - $remainingDays;
  $days = round(($days/$totalDays *100),2);
  $result = array( 
    'error'=>0,
    'usersFound'=>$userCount,
    'apronsFound'=>$apronsFound,
    'activeAprons'=>$activeAprons,
    'inactiveAprons'=>$inactiveAprons,
    'requestedAprons'=>$requestedAprons,
    'missingAprons'=>$missingAprons,
    'damageAprons'=>$damageAprons,
    'inspections'=>$inspections,
    'creationDate'=>$creationDate,
    'renewDate'=>$renewDate,
    'pastDays'=>$days,
    'notifications'=>$data2,
    'apron'=>$data
  );
}

//Inspect
if($action == 'inspect_apron'){
  if(!isset($_REQUEST['apronId']) || !isset($_REQUEST['status'])){checkRequiredFields();return;}
  $query = "SELECT Term from users where UserId= ".$userId;
  $res = mysqli_query($mysqli,$query);
  if(!$res){queryError();return;}
  $term = mysqli_fetch_row($res);
  $term = $term[0];
  
  $date = date("Y.m.d");
  $nextDate = date('Y-m-d', strtotime('+'.$term.' month', strtotime(date("Y-m-d"))));
  
  $note = (isset($_REQUEST['note']))?$_REQUEST['note']:'';
  $_REQUEST['pinhole']       = isset($_REQUEST['pinhole']) ? $_REQUEST['pinhole'] : '';
  $_REQUEST['cracks']        = isset($_REQUEST['cracks']) ? $_REQUEST['cracks'] : '';
  $_REQUEST['stitching']     = isset($_REQUEST['stitching']) ? $_REQUEST['stitching'] : '';
  $_REQUEST['buckle']        = isset($_REQUEST['buckle']) ? $_REQUEST['buckle'] : '';
  $_REQUEST['condition']     = isset($_REQUEST['condition']) ? $_REQUEST['condition'] : '';
  $apronIds = explode(",", $_REQUEST['apronId']);
  for($i = 0; $i < sizeOf($apronIds); $i++){
    
    $query = "Update apron set Status='".$_REQUEST['status']."', LastInspectionDate = '".$date."',NextInspectionDate = '".$nextDate."' where ApronId IN ('".$apronIds[$i]."')";
    $res = mysqli_query($mysqli,$query);
    if(!$res){queryError();return;}

    $rquery = "INSERT INTO `inspect` (`InspectId`,`UserId`,`ApronId`,`Date`,`Status`,`Note`,`Pinhole`,`Cracks`,`Stitching`,`Buckle`,`Condition`) VALUES ( NULL
      ,'".$userId."'
      ,'".$apronIds[$i]."'
      ,'".$date."'
      ,'".$_REQUEST['status']."'
      ,'".$note."'
      ,'".$_REQUEST['pinhole']."'
      ,'".$_REQUEST['cracks']."'
      ,'".$_REQUEST['stitching']."'
      ,'".$_REQUEST['buckle']."'
      ,'".$_REQUEST['condition']."'
    )";
  
    $res = mysqli_query($mysqli,$rquery);
    if(!$res){queryError();return;}
  }
  if($_REQUEST['status'] == 'Replacing'){
    $msg = $_REQUEST['apronId']." apron id has been replaced.\n";
    $msg.= $_REQUEST['note'];
    sendMail('raju.solanki@kiranxray.com','Replace Aprons',$msg);
  }
  $result = array('error'=>0, 'message'=>$init['addMsg']);
}

if($action == 'list_inspect'){
  if(!isset($_REQUEST['apronId'])){checkRequiredFields();return;}
  $where =" and I.UserId = ".$userId;
  $where.=" and  I.ApronId = '".$_REQUEST['apronId']."'";
  $rquery = "SELECT I.* from `inspect` I where 1=1 ".$where." ".$order." ".$limitQuery;

  $res = mysqli_query($mysqli,$rquery);
  if(!$res){queryError();return;}

  $data = array();
  while($row = mysqli_fetch_assoc($res)){
    array_push($data,$row);
  }

  $result = array( 
    'error'=>0,
    'inspect'=>$data, 
  );
}

if($action == 'inquiry'){
  $str = "";
  $str.="Name: ".$_REQUEST['name']."\n";
  $str.="Subject: ".$_REQUEST['subject']."\n";
  $str.="Email: ".$_REQUEST['email']."\n";
  $str.="Message: ".$_REQUEST['message']."\n";
  sendMail('raju.solanki@kiranxray.com','Inquiry',$str);
  $result = array('error'=>0, 'message'=>'Inquiry has been sent successfully.');
}


echo json_encode($result);

?>