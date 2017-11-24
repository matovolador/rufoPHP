<?php
require("../../_config.php");
$params=[];
foreach ($_POST as $key => $value){
  $params[$key]=$value;
}

$admin = new Admin();
$res = $admin->create_superuser($params);

if ($res && !isset($res['error'])) {
    $msg = "Super User created!";
    $status = "success";
}else{
  $msg = $res['message'];
  $status = "error";
}
session_start();
$_SESSION['messages'] = ['status'=>$status,"message"=>$msg];

header("Location: ".SITE_URL."admin");
