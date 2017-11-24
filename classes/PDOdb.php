<?php

class PDOdb {
	private $pdo = null;
	private $stm= null;
	function __construct($dbName = false){
		if (!$dbName){
			$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
		}else{
			$dsn = "mysql:host=".DB_HOST.";dbname=".$dbName.";charset=utf8";
		}
		$opt = array(
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$this->pdo = new PDO($dsn,DB_USER,DB_PASS, $opt);
	}

	public function request($sql,$type,$params=false,$oneRow=false){
		if ($params == FALSE){
			$this->stm = $this->pdo->prepare($sql);
			$this->stm->execute();
			if ($type!="select") return $this->affectedRows();
			if ($oneRow) {
				$res= $this->stm->fetch();
			}else{
				$res= $this->stm->fetchAll();
			}
			if (empty($res)) return false;
			return $res;



		}else{
			$this->stm = $this->pdo->prepare($sql);
			$this->stm->execute($params);
			if ($type!="select") return $this->affectedRows();
			if ($oneRow) {
				$res= $this->stm->fetch();
			}else{
				$res= $this->stm->fetchAll();
			}
			if (empty($res)) return false;
			return $res;
		}

	}

	public function affectedRows(){
		return $this->stm->rowCount();
	}


	public function sanitizeTableName($name){
		$tables = $this->showTables();
		if (in_array($name,$tables)) return $name;
		return false;

	}

	private function showTables(){
		$this->stm = $this->pdo->prepare('show tables');
		$this->stm->execute();
		$tableNames = $this->stm->fetchAll();
		return $this->getIndexedTables($tableNames);
	}

	private function getIndexedTables($array){
	    $arrayTemp = array();
	    for ($i=0;$i<count($array);$i++){
	    	foreach ($array[$i] as $key => $val) {
		        $arrayTemp[] = $val;
		    }
	    }
	    return $arrayTemp;
	}


}
