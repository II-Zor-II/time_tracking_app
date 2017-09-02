<?php 

require_once("../../includes/initialize.php");
//If user is not logged in, redirect to main index.
if(!$session->is_logged_in()||$session->get_privilege()==1){
	if(!empty($_SESSION['user_id'])&&isset($_SESSION['user_id'])){
		redirect_to("../index.php?id=".$_SESSION['user_id']);
	}else
		redirect_to("../index.php");
}
?>

<?php
include_layout_template("employee-header.php");
?>
<nav>
	<ul class="nav nav-pills">
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Project-form" disabled>
				Add Project
			</button>		
		</li>
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Team-form" disabled>
				Add Team
			</button>
		</li>			
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Member-form" disabled>
				Add/Remove Member
			</button>
		</li>
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Task-form" disabled>
				Add Task
			</button>
		</li>
		<li><a href="../logout.php">Logout</a></li>
	</ul>
</nav>
<?php 
echo "<h1>".$session->message."</h1>";
?>
<hr>
<div class="container-fluid main" data-member-id="<?php echo isset($_GET['id'])? $_GET['id'] : ""; ?>">
	<div class="row task-data-header">
		<div class="col-xs-3">		
			<div class="col-xs-2"><strong>O</strong></div>
			<div class="col-xs-8">Action</div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-7">EST</div>
			<div class="col-xs-5">Timeline</div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-9">Tracker</div>
			<div class="col-xs-3">Status</div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-9">Progress</div>
			<div class="col-xs-3">Collabs</div>
		</div>
	</div>
	<!-- display DATA -->
	<?php $tasks =  Task::find_all_by_id($_GET['id']);
		foreach($tasks as $task): 
	?>
	<div class="row task-data">
		<div class="col-xs-3">			
			<div class="col-xs-2"><?php echo Task::get_readable_priority($task->priority); ?></div>
			<div class="col-xs-8"><?php echo htmlentities($task->task_name); ?></div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-7">
			<?php echo htmlentities($task->task_due_date); ?> <br>
			</div>
			<div class="col-xs-5">
			<?php echo htmlentities($task->task_duration); ?>
			EST <br>
			<!-- to be ajaxed --></div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-9">
			<span name="<?php echo htmlentities($task->id); ?>-percentage">Progress:0.00%</span>
			<br>
			<meter name="<?php echo htmlentities($task->id); ?>"></meter></div>
			<div class="col-xs-3"><button class="btn btn-primary start-task-btn" data-task-id="<?php echo htmlentities($task->id); ?>" data-task-status="<?php echo htmlentities($task->status); ?>">start</button>
			<button class="btn btn-success finished-task-btn" data-task-id="<?php echo htmlentities($task->id); ?>" data-task-status="<?php echo htmlentities($task->status); ?>">finish</button></div>
		</div>
		<div class="col-xs-3">
			<!--<div class="col-xs-9">member-one: Member 'member-one' has added a note to this task <br> 
				May 04, 2017 10:49 pm <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
			</div>
			<div class="col-xs-3"><button class="btn btn-success">A</button></div>-->
		</div>
		<hr>
		<!--<strong>Total Hours 00:00:37</strong>-->
		<hr>
	</div>
	<?php endforeach; ?>
</div>
<?php 
include_layout_template("employee-footer.php");
?>