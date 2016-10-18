<?php
class Users {
	public $db;
	public function Users(){
		$this->db = new DB();
	}

	//$args["name"=>x,"pass"=>x,"email"=>x]
    public function create ($args){
        $name = $args["name"];
        $pass = md5($args["pass"]);
        $email = $args["email"];
        $res=$this->db->request("INSERT INTO users (name,password,email) VALUES ('$name','$pass','$email')");
        return $res;
    }
    
    //$args["name"=>x,"pass"=>x]
    public function loginName($args){
        $name=$args["name"];
        $pass=md5($args["pass"]);
        $res=$this->db->request("SELECT * FROM users WHERE (name = '$name' AND password = '$pass') LIMIT 1");
        if ($row=mysql_fetch_assoc($res)){
            login_end($row);
        }            
    }
    
    //$args["email"=>x,"pass"=>x]
    public function loginEmail($args){
        $email=$args["email"];
        $pass=md5($args["pass"]);
        $res=$this->db->request("SELECT * FROM users WHERE (email = '$email' AND password = '$pass') LIMIT 1");
        if ($row=mysql_fetch_assoc($res)){
            login_end($row);
        }
    }
    
    private function loginEnd($row){
        session_start();
        $_SESSION['name']=$row['name'];
        $_SESSION['id']=$row['id'];
        $_SESSION['email']=$row['email'];
        header("Location: ".SITE_URL);
    }
    
    public function logout(){
        if (isset($_SESSION)){
            unset($_SESSION);
            header("Location: ".SITE_URL);
        }
    }

    //$args["name"=>x,"pass"=>x,"email"=>x]  .. these variables are validated in "CONTROLS" so no validation is required here
    public function register($args){
        $name = $args["name"];
        $email = $args["email"];
        $pass = md5($args["pass"]);
        $this->db->request("INSERT INTO users (name,password,email) VALUES ('$name','$password','$email')");
        $id = $this->db->request("SELECT id FROM users WHERE name='$name' LIMIT 1");
        session_start();
        $_SESSION["name"]=$name;
        $_SESSION["id"]=$id;
        $_SESSION['email'];

    }
    public function setRandPass($email){
        $randPass=$this->randKey();
        $this->db->request("UPDATE users SET randPass='$randPass',password='$randPass' WHERE email='$email'");
        //TODO SEND EMAIL WITH randPass
    }

    //TODO make func to log with randkey

    public function changePassword($pass){
        $pass = md5($pass);
        $null = null;
        $id = $_SESSION['id'];
        $this->db->request("UPDATE users SET randPass='$null',password='$pass' WHERE id='$id'");
    }


    public function randKey(){
        $randKey=$this->getRandNum();
        $r=$this->request("SELECT * FROM users WHERE (password=$randKey OR randPass=$randKey)");
        while($row=mysql_fetch_assoc($r)){
            $randKey=$this->getRandNum();
            $r=$this->request("SELECT * FROM users WHERE (password=$randKey OR randPass=$randKey)");
        }
        return $randKey;
    }
        
    private function getRandKey($length=8){
        if($length>0){ 
            $rand_id="";
            for($i=1; $i<=$length; $i++){
               mt_srand((double)microtime() * 1000000);
               $num = mt_rand(1,36);
               $rand_id .= $this->randKeyAssoc($num);
            }
        }
        return $rand_id;
    }
    
    private function randKeyAssoc($num){
        // accepts 1 - 36
        switch($num){
            case "1":
                $rand_value = "a";
                break;
            case "2":
                $rand_value = "b";
                break;
            case "3":
                $rand_value = "c";
                break;
            case "4":
                $rand_value = "d";
                break;
            case "5":
                $rand_value = "e";
                break;
            case "6":
                $rand_value = "f";
                break;
            case "7":
                $rand_value = "g";
                break;
            case "8":
                $rand_value = "h";
                break;
            case "9":
                $rand_value = "i";
                break;
            case "10":
                $rand_value = "j";
                break;
            case "11":
                $rand_value = "k";
                break;
            case "12":
                $rand_value = "l";
                break;
            case "13":
                $rand_value = "m";
                break;
            case "14":
                $rand_value = "n";
                break;
            case "15":
                $rand_value = "o";
                break;
            case "16":
                $rand_value = "p";
                break;
            case "17":
                $rand_value = "q";
                break;
            case "18":
                $rand_value = "r";
                break;
            case "19":
                $rand_value = "s";
                break;
            case "20":
                $rand_value = "t";
                break;
            case "21":
                $rand_value = "u";
                break;
            case "22":
                $rand_value = "v";
                break;
            case "23":
                $rand_value = "w";
                break;
            case "24":
                $rand_value = "x";
                break;
            case "25":
                $rand_value = "y";
                break;
            case "26":
                $rand_value = "z";
                break;
            case "27":
                $rand_value = "0";
                break;
            case "28":
                $rand_value = "1";
                break;
            case "29":
                $rand_value = "2";
                break;
            case "30":
                $rand_value = "3";
                break;
            case "31":
                $rand_value = "4";
                break;
            case "32":
                $rand_value = "5";
                break;
            case "33":
                $rand_value = "6";
                break;
            case "34":
                $rand_value = "7";
                break;
            case "35":
                $rand_value = "8";
                break;
            case "36":
                $rand_value = "9";
                break;
        }
        return $rand_value;
    }

	public function validateUserName($name){
		$error = null;
		$res = $this->db->request("SELECT * FROM users WHERE name='$name'");
		if ($row = mysql_fetch_assoc($res)){
			$error = "That name is already taken.";
			return $error;
		}
        if (ctype_alnum($name)){
            if (strlen($name) <= 15 && strlen($name) >= 8){
                return $error;
            }else{
                $error="Name lenght must be between 8 and 15 characters.";
            }
        }else{
            $error="Name must be alphanumeric.";
            
        }
        return $error;
		
	}

	public function validateEmail($email){
		$error = null;

		$flag=filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($flag==false){
			$error = "Email not valid";
			return $error;
		}

		$res = $this->db->request("SELECT * FROM users WHERE email='$email'");
		if ($row = mysql_fetch_assoc($res)){
			$error = "That email is already taken.";
			return $error;
		}

		return $error;  //IF NULL, EMAIL IS VALID.
	}
	
	public function validatePassword($pass) {
	    $errors = null;

	    if (strlen($pass) < 8) {
	        $errors[] = "Password too short!";
	    }

	    if (!preg_match("#[0-9]+#", $pass)) {
	        $errors[] = "Password must include at least one number!";
	    }

	    if (!preg_match("#[a-zA-Z]+#", $pass)) {
	        $errors[] = "Password must include at least one letter!";
	    }     

	    return $errors;
	}

	public function resetPassword($email){
		$res = $this->db->request("SELECT * FROM users WHERE email = '$email'");
		if ($row=mysql_fetch_assoc($res)){
			$user = new User();
			$user->setRandPass($email);
			return true;
		}else{
			return false;
		}	
	}

	public function setNewPassword($pass){
		if (!checkSession()) return false;
		if (checkPassword($pass)){
			$user = new User();
			$user->changePassword($pass);
			return true;
		}else{
			return false;
		}
	}

	public function checkSession(){
		if (isset($_SESSION)) return true;
		return false;
	}

	public function getUsers(){
		$res = $this->db->request("SELECT * FROM users");
		return $res;
	}

}



?>