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

    $res = $this->create("admins",$params,"?,?,?,?");
    return $res;
  }

  public function superuser_exists(){
    $res = $this->get("admins",['permission_flag'=>self::SUPERUSER_FLAG],"permission_flag=?")
    if (!$res) return false;
    return true;
  }

  public function login($params){
    $params['password'] = Utils::encryptPassword($params["password"]);
    $res=$this->get("admins",$params, "username=? AND password=? LIMIT 1");

    if ($res){
      Auth::login($res,$params['username'],Admin::SUPERUSER_FLAG);

      return true;
    }else{
      return false;
    }
  }

  # @params must contain 'access_level'
  public function createAdmin($params){
    if (!superuser_exists()) return ["error"=>1,"message"=>"Superuser must be set first."];
    if ($params['password']!=$params['password_repeat']) return ['error'=>1,"message"=>"Passwords do not match."];
    if (!Utils::passwordStrength($params['password'],3)) return ['error'=>1,'message'=>Utils::passwordStrengthMessage(3)];
    if (!Utils::validateEmail($params['email'])) return ['error'=>1,"message"=>"Invalid email."];

    $res=$this->create("admins",$params,"?,?,?");
    return $res;


  }




}
