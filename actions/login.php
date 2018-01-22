<?php
require("../_config.php");
session_start();
$email = $_POST["email"];
$pass = $_POST["password"];
$users = new User();
$args=["email"=>$email,"pass"=>$pass];
$res=$users->login($args);

if ($res){
	header("Location: ".SITE_URL);
	exit();
}else{
	//header("Location :".SITE_URL."<enterbadloginview>");
	header("Location: ".SITE_URL."signin");
    exit();

}
?>
