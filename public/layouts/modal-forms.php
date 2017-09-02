<!-- FORMS -->

<!-- Project Modal Form -->
<div class="modal fade" id="Project-form">
	<form class="modal-content" action="index.php" method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Add Project</h4>
	</div>
	<div class="modal-body">
		<label for="project-name">Project:</label><br>
		<input type="text" class="form-control" name="project-name" placeholder="Project Name"/>
	</div>
	<div class="modal-footer">
        <button type="cancel" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" />
     </div>
	</form>
</div>

<!-- Add Team Modal Form -->
<div class="modal fade" id="Team-form">
	<form class="modal-content" action="index.php" method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Add Team</h4>
	</div>
	<div class="modal-body">
		<label for="team-name">Team Name</label><br>
		<input type="text" class="form-control" name="team-name" placeholder="Team Name" /><br>
		<label for="team-description">Description</label><br>
		<textarea rows="5" name="team-description"></textarea>
	</div>
	<div class="modal-footer">
        <button type="cancel" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" />
     </div>
</form>
</div>

<!-- Add/Remove Member Modal Form -->
<div class="modal fade" id="Member-form">
	<form class="modal-content form-horizontal" action="index.php" method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Add/Remove Member</h4>
	</div>
	<div class="modal-body">
		<label for="member-team">Team</label>
		<select class="form-control" name="member-team">
			<option value="" disabled selected>Select Team</option>
		</select>
		<label for="member-role">Role</label>
		<select class="form-control" name="member-role">
			<option value="1">Director</option>
			<option value="2">Manager</option>
			<option value="3" selected>Member</option>
		</select><br>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="member-position">Position</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="member-position" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="member-username">Username</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="member-username" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="member-email">E-mail</label><br>
			<div class="col-sm-6">
				<input type="email" class="form-control" name="member-email" />
			</div>
		</div>
		
		<!-- password generator here-->
		<div class="form-group">
			<label class="col-sm-2 control-label" for="member-password">Password</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="member-password" />
			</div>
		</div>
		
		<hr>
		<div class="form-group">
			<label for="member-delete" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="member-delete" /><br>
			</div>
			<button class="btn btn-danger col-sm-2" id="Remove-member-btn" type="submit" form="Member-form" value="submit">Remove</button>
		</div>
	</div>
	<div class="modal-footer">
        <button type="cancel" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" />
     </div>
</form>
</div>


<!-- Add Task Modal Form -->
<div class="modal fade" id="Task-form">
	<form class="modal-content form-horizontal" action="index.php" method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<h4 class="modal-title">Add Task</h4>
	</div>
	<div class="modal-body">
		
		<div class="form-group">
			<input type="hidden" name="task-member-id"/>
			<label class="col-sm-2 control-label" for="task-name">Task Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="task-name" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="task-project">Select Project</label>
			<div class="col-sm-6">
				<select class="form-control" name="task-project">
					<option value="" disabled selected>Select Project</option>
			</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="task-description">Task Description</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="task-description" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="task-priority">Task Priority</label>
			<div class="col-sm-6">
				<select class="form-control" name="task-priority">
					<option value="0">Undecided</option>
					<option value="1">Low</option>
					<option value="2">Normal</option>
					<option value="3">High</option>
					<option value="4">Urgent</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="task-duration">Task Duration</label><br>
			<div class="col-sm-6">
				<strong>Hour</strong> <input type="number" min="0" max="24" name="task-duration-hr" value="0"/>
				<strong>Minute</strong> <input type="number" min="0" max="60" name="task-duration-min" value="0" />
			</div>
		</div>
		
		<div class="form-group">
		<label class="col-sm-2 control-label" for="task-duedate-group">Task Due Date</label>
			<input class="col-sm-1" type="checkbox" id="task-dd-checkbox" />
			<div class="col-sm-5">
				<input type="date" name="task-duedate" disabled/><br>
				<input type="time" name="task-duedate-time" disabled/>
			</div>
			
		</div>

	</div>
	<div class="modal-footer">
        <button type="cancel" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit" />
     </div>
</form>
</div>