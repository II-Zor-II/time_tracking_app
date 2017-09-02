<?php 
require_once(INCLUDES_DIR."\database.php");

class Member extends DatabaseObject{
	
	protected static $table_name = "members";
	protected static $db_fields = array('username', 'position', 
		'email', 'password', 'role', 'team_id', 'daily_tracker_status' );
	public $id;
	public $position;
	public $email;
	public $username;
	public $password;
	public $role;
	public $team_id;
	public $daily_tracker_status;
	
	public static function authenticate($username="", $password=""){
		global $database;
		
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
		
		$sql = "SELECT * FROM ".self::$table_name." ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";		
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false; 
	}
	// Common Db Methods
	private function has_attribute($attribute){
		$object_vars = $this->attributes(); // returns an assoc array w/ all attrib incl priv ones. as the kesy and their current values as the value
		
		return array_key_exists($attribute, $object_vars);
	}
	
	public function attributes(){
		//return get_object_vars($this);
	
		$attributes = array();
		foreach(self::$db_fields as $field){
		 if(property_exists($this, $field)){
			$attributes[$field] = $this->$field;
		 }
		}
		return $attributes;
	}
	
	//santize attributes that are coming from post and get methods
	protected function sanitized_attributes(){
		global $database;
		$clean_attributes = array();
		
		foreach($this->attributes() as $key => $value){
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create(){
		global $database;
		
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT  ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($database->query($sql)){
			$this->id = $database->insert_id();
			return true;
		}else{
			return false;
		}
	}
	
	public function update(){
		global $database;
		
		$attributes = $this->sanitized_attributes();
		$attributes_pairs = array();
		foreach($attributes as $key => $value){
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=". $database->escape_value($this->id);
		$database->query($sql);
		return($database->affected_rows() == 1)? true : false;
	}
	
	public function delete(){
		global $database;
		
		$sql = "DELETE FROM ".self::$table_name." ";
		$sql .= "WHERE id=".$database->escape_value($this->id);
		$sql .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows() == 1)? true : false;
	}
	
	public function delete_by_username($username){
		global $database;
		
		if(self::find_by_username($username)){
			$sql = "DELETE FROM ".self::$table_name." ";
			$sql .= "WHERE username='".$database->escape_value($username);
			$sql .= "' LIMIT 1";
			$database->query($sql);
			return ($database->affected_rows() == 1)? true : false;	
		}
	}
}

?>














