<?php 
date_default_timezone_set('Asia/Manila');

require_once("../../includes/initialize.php");
if(!empty($_GET["task-id"])
   &&isset($_GET["task-id"])
   &&($_GET["start_task"]==true)&&($_GET["get_past_due"])==true){
	$task_data = Task::find_by_id($_GET["task-id"]);
	if($task_data->datetime_started=="0000-00-00 00:00:00"){
		 $task_data->datetime_started = date("Y-m-j H:i:s");
	}
	$date1 = $task_data->datetime_started;
	$date2 = $task_data->task_due_date;
	$interval = dateDifference($date1,$date2,"%H:%i:%s");
	$task_data->task_duration = $interval;
	$task = new Task();
	foreach($task_data as $attr => $value){
		$task->$attr = $value;
	}
	$task->update();
	$task_obj = new stdClass();
	$task_obj->time = time_to_seconds($task->task_duration);
	$task_obj->past_due = $task->check_past_due($date2);
	echo json_encode($task_obj);
}elseif(isset($_GET["task-id"])&&
  	isset($_GET["status"])){

	if($_GET["set_to_finish"]){
		$id = (int)$_GET["task-id"];
		$task = Task::find_by_id($id);
		$task->status = (int)$_GET["status"];
		$task->datetime_finished = date("Y-m-j H:i:s");
		if($task->save()){
			echo "true";
		}else{
			echo "Error";
		}
	}
}
?>