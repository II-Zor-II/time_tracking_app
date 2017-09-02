<?php 
/*
status: 
 0 = not started/logged out
 1 = started/on-going with a task
 2 = stopped/logged-in
*/
require_once("../../includes/initialize.php");

if(isset($_GET['username'])&&isset($_GET['password'])){
	$username = $_GET['username'];
	$password = $_GET['password'];
	
	$found_user = Member::authenticate($username, $password);
	
	if($found_user){
		$found_user->daily_tracker_status=2;
		$found_user->save();
		echo "true,".$found_user->id;
	}else{
		echo "false";
	}
}

if(isset($_GET['id'])&&isset($_GET['logged_in'])){
	if($_GET['logged_in']){	
		$today_tracker = new Daily_Tracker();
		$today_tracker->member_id = (int)$_GET['id'];
		$today_tracker->date_from = date("Y-n-j");
		$today_tracker->date_to = date("Y-n-j",strtotime('tomorrow'));
		$today_tracker->status = (int) "2";
		$today_tracker->save();
		echo "true";
	}else{
		echo "false";
	}
}

if(isset($_GET['id'])&&isset($_GET['log_out'])){
	if($_GET['log_out']){
		$id = (int)$_GET["id"];
		$member = Member::find_by_id($id);
		$member->daily_tracker_status = 0;
		$member->save();
	}
}
?>


