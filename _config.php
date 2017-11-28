<?php

//Ennvironment. Set this var to "DEVELOPMENT" or "PRODUCTION"
$environment = "DEVELOPMENT";
//Debugging. Set to true or false
$debug = true;


date_default_timezone_set('UTC');

// DEFINE SITE_URL CONSTANT
if ($environment == "DEVELOPMENT"){
	define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/rufoPHP/");
}
if ($environment == "PRODUCTION"){
	define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");


}

if ($debug == true){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}else{
	error_reporting(E_ERROR);
}






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

# Class Autoloader:
spl_autoload_register(function ($class_name) {
    require("classes/".$class_name . '.php');
});
?>
