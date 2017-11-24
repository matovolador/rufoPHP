<?php
require("../../_config.php");
session_start();

foreach ($_SESSION as $key=>$value){
	unset($_SESSION[$key]);
}

unset($_SESSION['superuser']);
header("Location: ".SITE_URL."admin/");
exit();
