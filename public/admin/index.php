<?php 

require_once("../../includes/initialize.php");
//If user is not logged in, redirect to main index.
if(!$session->is_logged_in()||$session->get_privilege()!=1){
	if(!empty($_SESSION['user_id'])&&isset($_SESSION['user_id'])){
		redirect_to("../index.php?id=".$_SESSION['user_id']);
	}else
		redirect_to("../index.php");
}

date_default_timezone_set('Asia/Manila');

require_once("form_processor.php");
?>


<?php 
include_layout_template("admin-header.php");

?>
<nav>
	<ul class="nav nav-pills">
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Project-form">
				Add Project
			</button>		
		</li>
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Team-form">
				Add Team
			</button>
		</li>			
		<li>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Member-form">
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
<div class="container-fluid main" >
	<div class="row task-data-header">
		<div class="col-xs-3">
			<div class="col-xs-1">#</div>
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
	<?php 
		$page = !empty($_GET['page'])?$_GET['page'] : 1;	
		$per_page = (int)2;			
		$total_count = 	Task::count_all();
		$pagination = new Pagination($page,$per_page,$total_count);
		// find records for this page
		$sql = "SELECT * FROM tasks ";
		$sql .= "LIMIT {$per_page} ";
		$sql .= "OFFSET {$pagination->offset()}";
		$tasks = Task::find_by_sql($sql);
		//$tasks =  Task::find_all();
		foreach($tasks as $task): 
	?>
	<div class="row task-data">
		<div class="col-xs-3">
			<div class="col-xs-1"><?php echo htmlentities($task->members_id); ?></div>
			<div class="col-xs-2"><?php echo Task::get_readable_priority($task->priority); ?></div>
			<div class="col-xs-8"><?php echo htmlentities($task->task_name); ?></div>
		</div>
		<div class="col-xs-3">
			<div class="col-xs-7">
			<?php echo htmlentities($task->task_due_date); ?> <br>
			</div>
			<div class="col-xs-5">
			<?php echo htmlentities($task->task_duration); ?> 
			<!-- to be ajaxed -->EST <br>
			<!-- to be ajaxed --></div>
		</div>
		<div class="col-xs-3">
<!--			<div class="col-xs-9">Progress:0.00%<br>
			<meter></meter></div>
			<div class="col-xs-3"><?php //echo htmlentities($task->task_duration); ?></div>-->
		</div>
		<div class="col-xs-3">
			<!--<div class="col-xs-9">member-one: Member 'member-one' has added a note to this task <br> 
				May 04, 2017 10:49 pm <span><i class="fa fa-calendar" aria-hidden="true"></i></span>
			</div>-->
			<!-- <div class="col-xs-3"><button class="btn btn-success">A</button></div> -->
		</div>
		<hr>
		<strong>Total Hours 00:00:37</strong>
		<hr>
	</div>
	<?php endforeach; ?>
<div class="pagination" style="clear:both;">
<?php 
	if($pagination->total_pages()>1){
		if($pagination->has_previous_page()){
			echo "<a href=\"index.php?id={$session->user_id}&page=";
			echo $pagination->previous_page();
			echo "\" class=\"btn btn-primary\">&laquo; Previous</a>";
		}
		
		for($i=1; $i <= $pagination->total_pages(); $i++){
			echo "<a href=\"index.php?id={$session->user_id}&page={$i}";
			echo "\" class=\"btn btn-primary\" >{$i}</a>";
		}
		
		if($pagination->has_next_page()){
			echo "<a href=\"index.php?id={$session->user_id}&page=";
			echo $pagination->next_page();
			echo "\" class=\"btn btn-primary\">&Next &raquo;</a>";
		}
	}
	
?>	
</div>
		
	<!-- display Members -->
	<div class="row member-data-row">
		<table class="members-table">
			<tr>
				<th>ID</th>
				<th>Member</th>
				<th>Position</th>
				<th>Tasks</th>
			</tr>
<?php 
		$members =  Member::find_all();
		foreach($members as $member): 
?>
			<tr class="clickable" data-member-id="<?php echo htmlentities($member->id); ?>">
				<td><?php echo htmlentities($member->id); ?></td>
				<td><?php echo htmlentities($member->username); ?></td>
				<td><?php echo htmlentities($member->position); ?></td>
				<td><button class="btn btn-info">View</button></td>
			</tr>
<?php endforeach; ?>
		</table>
	</div>
</div>
<?php 
	include_layout_template("modal-forms.php");
?>


<?php 
	include_layout_template("admin-footer.php");
?>