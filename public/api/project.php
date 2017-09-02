<?php 
require_once("../../includes/initialize.php");
if(!empty($_GET["projects"])&&isset($_GET["projects"])){
	if($_GET["projects"]===true||
	   $_GET["projects"]==='true'){
		$project = new Project();
		$project = Project::find_all();
		$outputArr = array();
		foreach($project as $project_data){
			$proj_obj = new stdClass();
			$proj_obj->id = $project_data->id;
			$proj_obj->project_name = $project_data->project_name;
			array_push($outputArr,$proj_obj);
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