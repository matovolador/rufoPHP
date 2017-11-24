<?php



class Admin extends Model{
  const SUPERUSER_FLAG = -1;
  function __construct(){
    parent::__construct();
  }

  public function create_superuser($params){
    if ($this->superuser_exists()) return ['error'=>1,'message'=>'A super user already exists.'];
    if ($params['password']!=$params['password_repeat']) return ['error'=>1,"message"=>"Passwords do not match."];
    if (!Utils::passwordStrength($params['password'],3)) return ['error'=>1,'message'=>Utils::passwordStrengthMessage(3)];
    if (!Utils::validateEmail($params['email'])) return ['error'=>1,"message"=>"Invalid email."];

    unset($params['password_repeat']);
    $params['permission_flag'] = self::SUPERUSER_FLAG;
    $params['password'] = Utils::encryptPassword($params['password']);

    $res = $this->create("admins",$params);
    return $res;
  }

  public function superuser_exists(){
    $res = $this->db->request("SELECT * FROM admins WHERE permission_flag = ?","select",[self::SUPERUSER_FLAG],true);
    if (!$res) return false;
    return true;
  }

  public function login($params){
    $params['password'] = Utils::encryptPassword($params["password"]);
    $res=$this->get("admins",$params);

    if ($res){
      session_start();
      foreach ($res as $key => $value){
          $_SESSION['admin'][$key]=$value;
      }

      return true;
    }else{
      return false;
    }
  }

  public function createAdmin($params){
    //TODO:
    # check if superuser exists
    # validate Email
    # validate password

  }




}
