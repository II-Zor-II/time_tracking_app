<?php 
require_once("../../includes/initialize.php");

if(isset($_GET["id"])&&isset($_GET["check_daily_tracker_status"])){
	if($_GET["check_daily_tracker_status"]){
		$id = (int)$_GET["id"];
		$member = Member::find_by_id($id);
		$status = (int)$member->daily_tracker_status;
		echo json_encode($status);
	}else{
		echo "Failed";
	}
}

?>