<?php

/*-----------------
 * IMPORTANT!!!
 * configure these settings for your own purpose
 */
define('DB_HOST', "localhost");
define('DB_NAME', "rufophp");
define('DB_USER', "root");
define('DB_PASS', "secret");

//------------------------------------------
    
class DB{
	private $link=null;
	private $sql="";
	private $error="";
	private $res = null;

    public function DB($connect=true){
		if ($connect){
			$this->connect();

		}
	}
            
	private function selDb(){
		if (!mysql_select_db(DB_NAME, $this->link))
            $this->error = mysql_error($this->link);	
	}

	public function connect(){
		$this->error="";
		if (!$this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASS))
			$this->error = mysql_error($this->link);
		else{
			$this->selDb();
		}
		
	}

	public function request($sql){
		$this->sql = $sql;
		$this->res = mysql_query($sql, $this->link);
		$this->error = mysql_error($this->link);
		if ($this->error <> ''){
			$this->error = "<br><i>&lt;$this->sql&gt;</i><br>".$this->error;
		}
		return $this->res;
	}
            
	public function lastRequest(){
		return $this->sql;
	}
	
	public function clearData(){ 
		$this->sql="";
		$this->error="";
		$this->res = null;
	}
	
	public function checkErrors(){
		//If this returns "", there are no errors logged.
		return $this->error;
	}

	public function disconnect(){
		@mysql_close($this->link);
		$this->link = null;
		$this->clearData();
	}
            
}
    
?>