<?php

define('DB_NAME', 'apron');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define("SECURE", FALSE);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$init = array(
  'defaultStatus' => 'In Service',
  'defaultLimit' => 100000,
  'addMsg' => 'Data has been added successfully',
  'updateMsg' => 'Data has been updated successfully',
  'deleteMsg' => 'Data has been deleted successfully',
  'notifyDays' => 5,
  'notifyLimit' => 7
);

?>