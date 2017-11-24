<?php
class Model{
  protected $db;
  function __construct(){
    $this->db = new PDOdb();
  }

  public function get($table,$id){
    if (!$this->db->sanitizeTableName($table)) return false;
    $res = $this->db->request("SELECT * FROM ".$table." WHERE id = ?","select",[$id],true);
    return $res;
	}
  public function getAll($table,$orderDesc=false){
    if (!$this->db->sanitizeTableName($table)) return false;
    if ($orderDesc==false){
      $res = $this->db->request("SELECT * FROM ".$table." ","select");
    }else{
      $res = $this->db->request("SELECT * FROM ".$table." ORDER BY id DESC","select");
    }
    return $res;
  }
  public function create($table,$params){
    if (!$this->db->sanitizeTableName($table)) return false;
    $keys="";
    $values="";
    foreach ($params as $key => $value){
      $keys .= $key.",";
      $values="?,";
    }
    $keys = substr($keys,0,-1);
    $values = substr($values,0,-1);
    $res = $this->db->request("INSERT INTO ".$table." (".$keys.") VALUES (".$values.")","update",array_values($params));
    return $res;
  }
  public function delete($table,$id){
    if (!$this->db->sanitizeTableName($table)) return false;
    $res = $this->db->request("DELETE FROM ".$table." WHERE id=?","delete",[$id]);
    return $res;
  }
  public function set($table,$id,$params){
    if (!$this->db->sanitizeTableName($table)) return false;
    $updateString="";
    foreach ($params as $key => $value){
      $updateString = $key."=?,";
    }
    $updateString = substr($updateString,0,-1);
    $params[]=$id;
    $res = $this->db->request("UPDATE ".$table." SET ".$updateString." WHERE id=?","update",array_values($params));
    return $res;
  }

}
