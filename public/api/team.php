<?php 
require_once("../../includes/initialize.php");
if(!empty($_GET["teams"])&&isset($_GET["teams"])){
	if($_GET["teams"]===true||
	   $_GET["teams"]==='true'){
		$team = new Team();
		$teams = Team::find_all();
		$outputArr = array();
		foreach($teams as $team_data){
			$team_obj = new stdClass();
			$team_obj->id = $team_data->id;
			$team_obj->name = $team_data->team_name;
			array_push($outputArr,$team_obj);
		}
		// returns a json object from an array of team obj -> id , name
		echo json_encode($outputArr);
	}else{
		echo "Error fetching data.";
	}
}else{
	echo "Error fetching data.";
}
?>