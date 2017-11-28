<?php

//TODO Adapt User to implement Model functions---
//TODO check if email already exists before creating new entry

class User extends Model {
	function __construct(){
		parent::__construct();
	}

	//$params["name"=>x,"pass"=>x,"email"=>x]
  public function createUser ($params){
      $name = $params["name"];
      $pass = Utils::passwordEncrypt($params["pass"]);
      $email = $params["email"];
			$res = $this->create("users",$params);
      return $res;
  }


  //$params["email"=>x,"pass"=>x]
  public function login($params){
      $email=$params["email"];
      $password=Utils::passwordEncrypt($params["pass"]);
			$res = $this->get("users",["email"=>$email,"password"=>$password]);
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
      $this->db->request("UPDATE users SET temp_password=?,password=? WHERE email='$email'","update",[$temp_password,$temp_password]);
      //TODO SEND EMAIL WITH temp_password
  }

  //TODO make func to log with randkey

  public function changePassword($pass){
      $pass = Utils::passwordEncrypt($pass);
      $id = $_SESSION['id'];
      $this->db->request("UPDATE users SET temp_password='',password=? WHERE id=?","update",[$pass,$id]);
  }


  public function randKey(){
      $randKey=Utils::getRandKey();
      $res=$this->request("SELECT * FROM users WHERE (password=$randKey OR temp_password=$randKey)","select");
      while(!empty($res)){
          $randKey=Utils::getRandKey();
          $res=$this->request("SELECT * FROM users WHERE (password=$randKey OR temp_password=$randKey)","select");
      }
      return $randKey;
  }



	public function validateUserName($name){
		$error = null;
		$res = $this->db->request("SELECT * FROM users WHERE username=?","select",[$name]);
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

		$res = $this->get("users",["email"=>$email]);
		if (!empty($res)){
			return ["error"=>1,"message"=>"That email is already taken."];
		}

		return true;
	}

	public function validatePassword($pass) {
			if (!Utils::passwordStrength($params['password'],2)) return ['error'=>1,'message'=>Utils::passwordStrengthMessage(2)];
	}

	public function resetPassword($email){
		$res = $this->get("users",["email"=>$email]);
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
			$res = $this->getAll("users");
      return $res;
    }

    public function getUserById($id){
			$res = $this->get("users",["id"=>$id]);
      return $res;
    }

}



?>
