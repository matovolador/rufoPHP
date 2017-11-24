# rufoPHP v0.9.0
Small PHP Framework to act as a quick web project startup.
This software is released under the MIT license.
If you like this software, consider making a donation to this Bitcoin address: 1NWetH6goP78i3YT7V9f36kvwzNc2JNzNs

FEATURES:
1) routing
2) migrations (Phinx. "phixdocs.txt" file is provided to you as a quick instruction manual created by me).
3) Model class with get, set and other common functions.
4) PDO database connection
5) Bootstrap + JQuery Front end

INSTALLATION:
0) This framework is meant to be used with Apache2 server.
0.1) Developed under PHP 7.0.22
1) Customize your apache configurations (for routing purposes)
a - You must configure your Apache2 server configuration for your site with the following contents ( /etc/apache2/apache2.conf):
```
<Directory /var/www/>
    AllowOverride All
</Directory>
```
b - Add Rewrite Engine module to your enabled modules in apache:
`$ a2enmod rewrite`
`$ systemctl restart apache2`

2) Changing settings on `_config.php` file:
a - You must define `SITE_URL`
b - You must define MySQL settings: `DB_HOST`,`DB_NAME`,`DB_USER` and `DB_PASS`
c - Include all your classes in the `_config.php` file.


*** LIMITATIONS: Because of the routing settings, POST type forms cannot have "action" set to " ". The way this framework handles POST forms, is by submitting the form to an "action file" inside the "actions" folder, and having that "action file" redirecting to whatever page you desire.


--VENDORS:
Latest version of this software includes Phinx from https://github.com/cakephp/phinx
