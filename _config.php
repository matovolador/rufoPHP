<?php
error_reporting(-1);

//Local:
define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/RufoPHP/");

//Server:
//define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");

//Site email:
define('SITE_EMAIL','noreply@example.com');

include_once(SITE_URL."classes/Routes.php");
include_once(SITE_URL."classes/DB.php");
include_once(SITE_URL."classes/Users.php");
?>