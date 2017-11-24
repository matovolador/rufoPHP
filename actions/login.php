<?php
require("../_config.php");
session_start();
$email = $_POST["email"];
$pass = $_POST["password"];
$users = new User();
$args=["email"=>$email,"pass"=>$pass];
$res=$users->login($args);

if ($res){
	$_SESSION['name']=$res['name'];
    $_SESSION['id']=$res['id'];
    $_SESSION['email']=$res['email'];
	header("Location: ".SITE_URL);
	exit();
}else{
	//header("Location :".SITE_URL."<enterbadloginview>");
	header("Location: ".SITE_URL."/signin");
    exit();

}



?>
