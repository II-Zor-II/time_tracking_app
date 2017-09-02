<?php 
require_once(INCLUDES_DIR."/db_config.php");

class MySQLDatabase {
	
	private $connection;
	
	function __construct(){
		$this->open_connection();
	}
	public function open_connection(){
	$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if(mysqli_connect_errno()){
			die("Database connection failed: " .
			     mysqli_connect_error() .
			   " (" . mysqli_connect_errno() . ")" //Returns the last error code for the most recent MySQLi function call that can succeed or fail.
			);
		}
	}
	
	//function to close connection
	public function close_connection(){
		if(isset($this->connection)){
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}
	
	//function to send query to db
	public function query($sql){
		$result = mysqli_query($this->connection, $sql);
		$this->confirm_query($result);
		return $result;
	}
	/* create database agnostic function names that can be reused 
		by other databases
	*/
	
	//escape dangerous syntax to avoid mysql injection
	public function escape_value($string){
		$escaped_string = mysqli_real_escape_string($this->connection, $string);
		return $escaped_string;
	}
	
	//confirm if database query was successful
	private function confirm_query($result){
		if(!$result){
			die("Database query failed. ");
		}
	}
	
	//return an associative array from the result
	public function fetch_array($result_set){
		return mysqli_fetch_array($result_set);
	}
	
	//return number of rows from result
	public function num_rows($result_set){
		return mysqli_num_rows($result_set);
	}
	
	// function to acquire previous id inserted in the db.
	public function insert_id(){
		//return last id
		return mysqli_insert_id($this->connection);
	}
	
	public function affected_rows(){
		return mysqli_affected_rows($this->connection);
	}
	
}

$database = new MySQLDatabase(); // instantiate a new Database object
$db =& $database; // global object to be used for database connection
?>