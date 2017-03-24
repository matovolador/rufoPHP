<?php
class Routes {
	public $urls;
	public function Routes(){
		$this->urls = [ "" => "home.php",
					"home" => "home.php",
				 "contact" => "contact.php",
				 "signin" => "signin.php",
				 "signup" => "signup.php",
				 "users" => "users.php"

					];
	}

	
	public function getView($urlKey){
		$vars = $this->getVars();
		$urlKey=str_replace(".php","",$urlKey);
		if ($vars){
			$urlKey=str_replace($vars, "", $urlKey);
			$view = $this->urls[$urlKey];
			if ($view == null) return "404.php";
			return $view.$vars;
		}
		if (is_numeric($this->getLastUri()) ){
			$id = $this->getLastUri();
			$urlKey = str_replace("/".$id,"",$urlKey);
			$view = $this->urls[$urlKey];
			if ($view == null) return "404.php";
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

	public function getVars(){
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if ($pos = strpos($uri,"?")){
			$vars = substr($uri,$pos,strlen($uri));
			return $vars;
		}else{
			return false;
		}
	}
}