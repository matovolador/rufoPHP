<?php

//TODO Adapt User to implement Model functions---
//TODO check if email already exists before creating new entry

class User extends Model {
	function __construct(){
		parent::__construct();
	}

	//$params["name"=>x,"pass"=>x,"email"=>x]
  public function createUser ($params){
      $name = $params["username"];
      $pass = Utils::encryptPassword($params["pass"]);
      $email = $params["email"];
			$params = ["username"=>$name,"password"=>$pass,"email"=>$email];
			$res = $this->create("users",$params,"?,?,?");
      return $res;
  }


  //$params["email"=>x,"pass"=>x]
  public function login($params){
      $email=$params["email"];
      $password=Utils::encryptPassword($params["pass"]);
			$res = $this->get("users",["email"=>$email,"password"=>$password],"WHERE email=? AND password=? LIMIT 1");
			if ($res){
				Auth::login($res,$params['username'],0);
			}
			return $res;

  }

	public function logout(){
		$res = Auth::logout(["identity_token"=>$_SESSION['identity_token'],"access_level"=>$_SESSION['access_level']]);
		return $res;
	}


  public function setTempPassword($email){
      $temp_password=$this->randKey();
			$res=$this->set("users",["temp_password"=>$temp_password,"password"=>$temp_password],"SET temp_password=?, password=?",["email"=>$email],"WHERE email=?");

      //TODO SEND EMAIL WITH temp_password
  }

  //TODO make func to log with randkey

  public function changePassword($pass){
      $pass = Utils::encryptPassword($pass);
      $id = $_SESSION['id'];
			$res=$this->set("users",["password"=>$pass],"SET temp_password='',password=?",['id'=>$id],"WHERE id=?");
  }


  public function randKey(){
      $randKey=Utils::getRandKey();
			$res=$this->get("users",['password'=>$randKey,"temp_password"=>$randKey],"WHERE (password=? OR temp_password=?)");
      while(!empty($res)){
          $randKey=Utils::getRandKey();
          $res=$this->get("users",['password'=>$randKey,"temp_password"=>$randKey],"WHERE (password=? OR temp_password=?)");
      }
      return $randKey;
  }



	public function validateUserName($name){
		$error = null;
		$res = $this->get("users",["username"=>$username], "WHERE username=? LIMIT 1");
		if (!empty($res)){
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
		$flag=Utils::validateEmail($email);
		if ($flag==false){
			return ["error"=>1,"message"=>"Email not valid"];
		}

		$res = $this->get("users",["email"=>$email], "WHERE email=? LIMIT 1");
		if (!empty($res)){
			return ["error"=>1,"message"=>"That email is already taken."];
		}

		return true;
	}

	public function validatePassword($pass) {
			if (!Utils::passwordStrength($params['password'],2)) return ['error'=>1,'message'=>Utils::passwordStrengthMessage(2)];
	}

	public function resetPassword($email){
		$res = $this->get("users",["email"=>$email], "WHERE email=? LIMIT 1");
		if (!empty($res)){
			$this->setTempPassword($email);
			return true;
		}else{
			return false;
		}
	}

	public function setNewPassword($pass){
		if (checkPassword($pass)){
			$this->changePassword($pass);
			return true;
		}else{
			return false;
		}
	}


	public function getUsers(){
		$res = $this->get("users");
    return $res;
  }

  public function getUserById($id){
		$res = $this->get("users",["id"=>$id],"WHERE id=? LIMIT 1");
    return $res;
  }

}



?>
