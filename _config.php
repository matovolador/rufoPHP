<?php
//development:
error_reporting(-1);

//publishing:
//error_reporting(E_ERROR)

//Local:
define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/RufoPHP/");

//Server:
//define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");


/*-----------------
 * IMPORTANT!!!
 * configure these settings for your own purpose
 */
define('DB_HOST', "localhost");
define('DB_NAME', "rufophp");
define('DB_USER', "root");
define('DB_PASS', "secret");

//------------------------------------------



include_once("classes/Routes.php");
include_once("classes/PDOdb.php");
include_once("classes/Users.php");
?>