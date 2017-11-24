<?php

class Admin extends Model{
  const SUPER_USER_FLAG = 0;
  function __construct(){
    parent::__construct();
  }

  public function superuser_create($params){
    $this->create("admins",$params);

  }

  public function superuser_exists(){
    $res = $this->db->request("SELECT * FROM admin WHERE permission_flag = ?","select",[self::SUPER_USER_FLAG],true);
    if (!$res) return false;
    return true;
  }




}
