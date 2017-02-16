<?php

class PDOdb {
	private $pdo = null;


	public function PDOdb(){
		$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
		$opt = array(
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$this->pdo = new PDO($dsn,DB_USER,DB_PASS, $opt);
	}

	public function request($sql,$type,$params=FALSE){
		if ($params == FALSE){
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			if ($type!="select") return true;
			$res = $stm->fetchAll();
			return $res;
		}else{
			$stm = $this->pdo->prepare($sql);
			$stm->execute($params);
			if ($type!="select") return true;
			$res = $stm->fetchAll();
			return $res;	
		}
		
	}


}

