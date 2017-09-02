<?php 
/*
	$task_obj = new stdClass();
	$task_obj->time = time_to_seconds($task->task_duration);
	$task_obj->past_due = $task->check_past_due();
*/
if(isset($_GET['email'])){
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	$outputArr = array();
	array_push($outputArr,$email);
	echo json_encode($outputArr);
}
?>