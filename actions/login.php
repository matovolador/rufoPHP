<?php
include("../_config.php");
session_start();
$email = $_POST["email"];
$pass = $_POST["password"];
$users = new Users();
$args=["email"=>$email,"pass"=>$pass];
$res=$users->login($args);
echo $users->db->error();
if ($row = mysqli_fetch_assoc($res)){
	$_SESSION['name']=$row['name'];
    $_SESSION['id']=$row['id'];
    $_SESSION['email']=$row['email'];
    echo "YEAH";
	header("Location: ".SITE_URL);
}else{
	echo mysqli_fetch_assoc($res);
	echo "FUCK";
    header("Location :".SITE_URL."fuck");
    
		
}



?>