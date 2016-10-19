<?php
include("../_config.php");
$email = $_POST["email"];
$pass = md5($_POST["password"]);


//TODO perform login actions using UsersControl

header("Location: ".SITE_URL);


?>