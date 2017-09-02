<?php 
/*
status: 
 0 = not started
 1 = started/in-progress
 2 = paused
 3 = finished
*/

require_once(INCLUDES_DIR."\database.php");

class Task extends DatabaseObject{
	
	protected static $table_name = "tasks";
	protected static $db_fields = array(	
		'id', 'project_id', 'members_id', 'task_name',
		'priority','task_duration','task_due_date',
	    'datetime_started', 'datetime_finished', 'hours_spent','status');
	public $id;
	public $project_id;
	public $members_id;
	public $task_name;
	public $priority;
	public $task_duration;
	public $task_due_date;
	public $datetime_started;
	public $datetime_finished;
	public $hours_spent;
	public $status;
	
	public $errors = array();
	
	
	//function to add due date
	public function task_due_date_time($hours=0, $minutes=0){
		date_default_timezone_set('Asia/Manila');
		
		$now = date("Y-n-j H:i:s");
		$duedate = date("Y-n-j H:i:s",strtotime($now.' + '.$hours.' hours '.$minutes.' minutes'));
		$this->task_due_date = $duedate; 
		return $duedate;
	}
	
	//function to show readable priority
	public static function get_readable_priority($priority=""){
		if(!empty($priority)){
			switch($priority){
				case 0:
					return "Undecided";
				case 1:
					return "Low";
				case 2:
					return "Normal";
				case 3:
					return "High";
				case 4:
					return "Urgent";
				default:
					return "No valid readable format";
			}
		}else{
			return $priority;
		}
	}
	
	//function to check if over est time/due date
	// returns true if past due
	public function check_past_due($task_due_date){
		if(!empty($task_due_date)){
			$currentTime = date("Y-m-j H:i:s");
			if($currentTime > $task_due_date){
				return "true";
			}else{
				return "false";
			}
		}
	}
	
	public function get_readable_status($status){
		if(!empty($status)){
			switch($status){
				case 0:
					return "Not Started";
				case 1:
					return "In Progress";
				case 2:
					return "Paused";
				case 3:
					return "Finished";
				default:
					return "No valid readable format";
			}
		}else{
			return false;
		}
	}
	
	// Common Db Methods
	public static function count_all(){
		global $database;
		$sql = "SELECT COUNT(*) FROM ".self::$table_name;
		$result_set = $database->query($sql);
		$row=$database->fetch_array($result_set);
		return array_shift($row);
	}
	
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
	
}
?>