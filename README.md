# rufoPHP
Small PHP Framework to act as a quick web project startup.
If you like this software, consider making a donation to this Bitcoin address: 1NWetH6goP78i3YT7V9f36kvwzNc2JNzNs


INSTALLATION:
1) You must configure your Apache2 server configuration for your site with the following contents:

<Directory /var/www/>
    AllowOverride All
</Directory>

2) Changing settings on `_config.php` file:
a - You must define `SITE_URL`
b - You must define MySQL settings: `DB_HOST`,`DB_NAME`,`DB_USER` and `DB_PASS`
c - Include all your classes in the `_config.php` file, like listed below the MySQL settings.
Here is the `_config.php` file by default:
```
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
```

LIMITATIONS: Because of the routing settings, POST type forms cannot have "action" set to " ". The way this framework handles POST forms, is by submiting the form to an "action file" inside the "actions" folder, and having that "action file" redirecting to whatever page you desire.
