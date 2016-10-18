<?php
class Routes {
	public $urls;
	public function Routes(){
		$this->urls = [ "" => "home.php",
					"home" => "home.php",
				 "contact" => "contact.php",
				 "signin" => "signin.php",
				 "signup" => "signup.php",
				 "users" => "users/users.php",
				 "users/edit" => "users/edit.php"
					];
	}

	
	public function getView($urlKey){
		//TODO HANDLE URL/MOREURL/EXTRAURL
		$view = $this->urls[$urlKey];
		if ($view == null) return "404.php";
		return $view;
	}


	function getCurrentUri() {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = trim($uri, '/');
		return $uri;
	}
}