# rufoPHP
Small PHP Framework to act as a quick web project startup.
If you like this software, consider making a donation to this Bitcoin address: 1NWetH6goP78i3YT7V9f36kvwzNc2JNzNs


INSTALLATION:
1) You must configure your Apache2 server configuration for your site with the following contents:
```
# domain: example.com
# public: /var/www/html/example.com/public_html/

<VirtualHost *:80>
  # Admin email, Server Name (domain name), and any aliases
  ServerAdmin webmaster@example.com
  ServerName  example.com
  ServerAlias www.example.com

  # Index file and Document Root (where the public files are located)
  DirectoryIndex index.html index.php
  DocumentRoot /var/www/html/example.com/public_html
  # Log file locations
  LogLevel warn
  ErrorLog  /var/www/html/example.com/log/error.log
  CustomLog /var/www/html/example.com/log/access.log combined

<Directory />
    Options FollowSymLinks
    AllowOverride All
</Directory>
<Directory /var/www/example.com/public_html/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Order allow,deny
    allow from all
</Directory>
RewriteEngine on
RewriteCond %{SERVER_NAME} =example.com [OR]
RewriteCond %{SERVER_NAME} =www.example.com
RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
```

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