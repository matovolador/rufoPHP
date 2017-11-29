<?php
class Model{
  protected $db;
  function __construct(){
    $this->db = new PDOdb();
  }
  public function get($table,$params=false,$where_clause=false){
    $res = $this->db->request("SELECT * FROM ".$table." ".$where_clause." ","select",array_values($params),true);
    return $res;
	}
  public function getAll($table,$orderDesc=false){
    if ($orderDesc==false){
      $res = $this->db->request("SELECT * FROM ".$table." ","select");
    }else{
      $res = $this->db->request("SELECT * FROM ".$table." ORDER BY id DESC","select");
    }
    return $res;
  }
  public function create($table,$params){
    $keys="";
    $values="";
    foreach ($params as $key => $value){
      $values.="?,";
    }
    $keys = substr($keys,0,-1);
    $values = substr($values,0,-1);
    $res = $this->db->request("INSERT INTO ".$table." (".$request.") VALUES (".$values.")","insert",array_values($params));
    return $res;
  }
  public function delete($table,$params,$where_clause){
    $res = $this->db->request("DELETE FROM ".$table." ".$where_clause." ","delete",array_values($params));
    return $res;
  }
  public function set($table,$params,$set_clause,$where_clause=false,$where_params=false){
    $res = $this->db->request("UPDATE ".$table." ".$set_string." ".$where_clause." ","update",array_merge(array_values($params),array_values($where_params)));
    return $res;
  }
}
