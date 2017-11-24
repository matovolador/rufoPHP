<?php
require("../../_config.php");
session_start();
$admin = new Admin();
$params=[];
foreach ($_POST as $key => $value){
  $params[$key]=$value;
}
$res = $admin->login($params);
if (!$res){
  $_SESSION['messages']=['status'=>"error","message"=>"Invalid login."];
}else{
  unset($_SESSION['messages']);
}
header("Location: ".SITE_URL."admin/");
