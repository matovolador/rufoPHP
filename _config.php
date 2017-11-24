<?php

//Ennvironment. Set this var to "pub" or "dev"
$env = "dev";

date_default_timezone_set('UTC');

//Development
if ($env == "dev"){
	define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/rufoPHP/");
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}
//Production
if ($env == "pub"){
	error_reporting(E_ERROR);
	define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/");
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
