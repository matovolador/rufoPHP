<?php
error_reporting(-1);

//Local:
define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/RufoPHP/public/");

//Server:
//define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");

//Site email:
define('SITE_EMAIL','noreply@example.com');

define("ABS_PATH",$_SERVER['DOCUMENT_ROOT']."/RufoPHP/");

include_once(ABS_PATH."classes/Routes.php");
include_once(ABS_PATH."classes/DB.php");
include_once(ABS_PATH."classes/Users.php");
?>