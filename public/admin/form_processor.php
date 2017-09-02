<?php 
if(isset($_POST['submit'])&&!empty($_POST['submit'])){
	if(isset($_POST["project-name"])&&
	   !empty($_POST["project-name"])){
		$project = new Project();
		$project->project_name = $_POST["project-name"];
		$project->created = date("Y-n-j H:i:s");
		if($project->create()){
			$session->message("Successfully Added.");
		}	
	}elseif(isset($_POST['team-name'])&&
			isset($_POST['team-description'])&&
			!empty($_POST['team-name'])&&
			!empty($_POST['team-description'])){
		$team = new Team();
		$team->team_name = $_POST["team-name"];
		$team->team_description = $_POST["team-description"];
		$team->created = date("Y-n-j H:i:s");
		if($team->create()){
			$session->message("Successfully Added.");
		}
	}elseif(isset($_POST['member-team'])&&
			isset($_POST['member-role'])&&
			isset($_POST['member-position'])&&
			isset($_POST['member-username'])&&
			isset($_POST['member-email'])&&
			isset($_POST['member-password'])&&
			isset($_POST['member-role'])&&
			!empty($_POST['member-team'])&&
			!empty($_POST['member-role'])&&
			!empty($_POST['member-position'])&&
			!empty($_POST['member-username'])&&
			!empty($_POST['member-email'])&&
			!empty($_POST['member-password'])){
		
		$member = new Member();
		$member->position = (string) $_POST['member-position'];
		$member->email	  = (string) $_POST['member-email'];
		$member->username = (string) $_POST['member-username'];
		$member->password = (string) $_POST['member-password'];
		$member->role 	  = (int) $_POST['member-role'];
		$member->team_id  = (int) $_POST['member-team'];
		if($member->create()){
			$session->message("Successfully Added.");
		}	
	}elseif(isset($_POST['task-member-id'])&&
			isset($_POST['task-name'])&&
			isset($_POST['task-project'])&&
			isset($_POST['task-priority'])&&
			(
			 isset($_POST['task-duration-hr'])||
			 isset($_POST['task-duration-min'])||
			(isset($_POST['task-duedate'])&&
			 isset($_POST['task-duedate-time']))
			)
		   ){

		$task = new Task();
		$task->members_id =  (int) $_POST["task-member-id"];
		$task->project_id =   (int) $_POST["task-project"];
		$task->task_name  =	(string) $_POST['task-name'];
		$task->priority   =   (int) $_POST['task-priority'];
		
		if(!empty($_POST['task-duedate'])&&!empty($_POST['task-duedate-time'])){
			$task->task_due_date = $_POST['task-duedate']." ".$_POST['task-duedate-time'];
		}elseif(!empty($_POST['task-duration-hr'])||!empty($_POST['task-duration-min'])){
			$task->task_due_date_time($_POST['task-duration-hr'],$_POST['task-duration-min']);
		}	
		if($task->create()){
			$session->message("Successfully Added.");
		}	
	
	}elseif(!empty($_POST['member-delete'])&&
			isset($_POST['member-delete'])){
		$member = new Member();
		if($member->delete_by_username($_POST['member-delete'])){
			$session->message("Member: ".$_POST['member-delete']." succesfully deleted.");
		}
	}else{
		$session->message("Failed. Please verify your inputs.");
	}
	redirect_to("index.php");
}
?>