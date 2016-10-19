<?php
include("../_config.php");
$name = $_POST['name'];
$email = $_POST["email"];
$pass = md5($_POST["password"]);

$users = new Users();
$flag = $users->validateUserName($name);
$flag2 = $users->validateEmail($email);
$flag3 = $users->validatePassword($pass);

if ($flag == null and $flag2 == null and $flag3 == null){
	$users->create(["name"=> $name,"email"=> $email,"pass" => $pass]);
	header("Location: ".SITE_URL);
}else{
	echo "Errors: ". $flag ." - " . $flag2 . " - " . $flag3;
	//TODO HANDLE ERRORS VIEW:
	//header("Location: ......");
}

?>