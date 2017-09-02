<?php 
require_once("../../includes/initialize.php");
/*
	$task_data = Task::find_by_id($_GET["task-id"]);
	if($task_data->datetime_started=="0000-00-00 00:00:00"){
		 $task_data->datetime_started = date("Y-n-j H:i:s");
	}
	$date1 = $task_data->datetime_started;
	$date2 = $task_data->task_due_date;
	$interval = dateDifference($date1,$date2,"%H:%i:%s");
	$task_data->task_duration = $interval;
	$task = new Task();
	foreach($task_data as $attr => $value){
		$task->$attr = $value;
	}
	
		$team = new Team();
		$team->team_name = $_POST["team-name"];
		$team->team_description = $_POST["team-description"];
		$team->created = date("Y-n-j H:i:s");
*/
date_default_timezone_set('Asia/Manila');
/*	$task_data = Task::find_by_id(19);
	if($task_data->datetime_started=="0000-00-00 00:00:00"){
		 $task_data->datetime_started = date("Y-n-j H:i:s");
	}
	$date1 = $task_data->datetime_started;
	$date2 = $task_data->task_due_date;
	$interval = dateDifference($date1,$date2,"%H:%i:%s");
	$task_data->task_duration = $interval;
	$task = new Task();
	foreach($task_data as $attr => $value){
		$task->$attr = $value;
	}

			$currentTime = date("Y-n-j H:i:s");
			echo $currentTime."<br>";
			echo $task->task_due_date."<br>";
			if($currentTime < $task->task_due_date){
				echo "true";
			}else{
				echo "false";
			}*/


	$member = Member::find_by_id(5);
//	$member2 = new Member($member);
	$member->daily_tracker_status = 2;
	$member->save();
?>