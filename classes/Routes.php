<?php
class Routes {
	public $urls;
	public function Routes(){
		$this->urls = [ "" => "home.php",
					"home" => "home.php",
				 "contact" => "contact.php",
				 "signin" => "signin.php",
				 "signup" => "signup.php",
				 "actions/logout.php" => "actions/logout.php",
				 "users" => "users.php"

					];
	}

	
	public function getView($urlKey){
		
		if (is_numeric($this->getLastUri()) ){
			$id = $this->getLastUri();
			$urlKey = str_replace("/".$id,"",$urlKey);
			$view = $this->urls[$urlKey] . "?id=" . $id;
		}else{
			$view = $this->urls[$urlKey];
		}
		if ($view == null) return "404.php";
		return $view;
	}


	public function getCurrentUri() {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = trim($uri, '/');
		return $uri;
	}
	//TODO: FIX THIS FUNCTION. Return value is incorrect
	public function getLastUri() {
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = trim($uri, '/');
		$uri = explode("/",$uri);
		return $uri[sizeof($uri) - 1];
	}
}