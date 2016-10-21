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
	private $error="";

    public function DB($connect=true){
		if ($connect){
			$this->connect();

		}
	}

	public function connect(){
		$this->error="";
		$this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()){
			$this->error = "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	public function request($sql){
		$res = mysqli_query($this->link,$sql);
		$this->error = mysqli_error($this->link);
		if ($this->error <> ''){
			$this->error = "<br><i>&lt;$this->sql&gt;</i><br>".$this->error;
		}
		return $res;
	}
            
	public function disconnect(){
		mysqli_close($this->link);
		$this->link = null;
	}
            
    public function error(){
    	return $this->error;
    }
}
    
?>