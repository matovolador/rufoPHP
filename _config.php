<?php
#Local:
define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/RufoPHP/");
error_reporting(-1);


#Server:
//error_reporting(E_ERROR);
//define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");


/*-----------------
 * DATABASE SETTINGS:
 * IMPORTANT!!!
 * configure these settings for your own purpose
 */
define('DB_HOST', "localhost");
define('DB_NAME', "rufophp");
define('DB_USER', "root");
define('DB_PASS', "secret");

//------------------------------------------

# INCLUDE ALL YOUR CLASSES HERE:
include_once("classes/Routes.php");
include_once("classes/PDOdb.php");
include_once("classes/Users.php");
include_once("classes/CallAPI.php");
?>
