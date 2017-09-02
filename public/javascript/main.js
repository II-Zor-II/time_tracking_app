$(document).ready(function(){
	var teams, projects, sec=0, daily_tracker_status = 0;
	
	
	$("button[data-task-status='3']").hide();
	
	
	if(daily_tracker_status==0){
		$(".start-task-btn, .finished-task-btn").prop("disabled",true);
	}

	//ajax for checking if logged-in using daily tracker
	$.ajax({
		url: "../api/member.php?id="+$(".container-fluid").data("memberId")+"&check_daily_tracker_status=true"	
	})
	.done(function(data){
		/*
		status: 
		 0 = not started/logged out
		 1 = started/on-going with a task
		 2 = stopped/logged-in
		*/
		daily_tracker_status = data;
		if(daily_tracker_status==2){
			$(".start-task-btn, .finished-task-btn").prop("disabled",false);
		}
	});
	
	// ajax call for rendering team selection
	$.ajax({
		url: "../api/team.php?teams=true"	
	})
	.done(function(data){
		teams = JSON.parse(data);
		teams.forEach(function(teamData){
			$("select[name='member-team']")
				.append("<option value='"+teamData.id+"'>" +teamData.name+"</option>");
		});
	});
	// ajax call for rendering project selection
	$.ajax({
		url: "../api/project.php?projects=true"	
	})
	.done(function(data){
		projects = JSON.parse(data);
		projects.forEach(function(projectsData){
			$("select[name='task-project']")
				.append("<option value='"+projectsData.id+"'>" +projectsData.project_name+"</option>");
		});
	});
	//dynamic duedate function
	$("#task-dd-checkbox").change(function(){
		var taskDurHr = $("input[name='task-duration-hr']");
		var taskDurMin = $("input[name='task-duration-min']");
		var taskDueDate = $("input[name='task-duedate']");
		var taskDueDateTime = $("input[name='task-duedate-time']");
		/* Clear Values */
		taskDurHr.val('');
		taskDurMin.val('');
		taskDueDate.val('');
		taskDueDateTime.val('');
		/*toggle disable*/
		taskDurHr.prop('disabled', (i, v) => !v);
		taskDurMin.prop('disabled', (i, v) => !v);
		taskDueDate.prop('disabled', (i, v) => !v);
		taskDueDateTime.prop('disabled', (i, v) => !v);
		
	});
	
	//removes disabled from not clicked row on member table
	$(".members-table .clickable").click(function(){
		$(".members-table .clickable").removeClass("clicked-member");
		$.when($(this).addClass("clicked-member"));
		$("button[data-target='#Task-form']").prop("disabled", false); 
	});

	// sets the member-id value on a hidden input in the task form
	$("button[data-target='#Task-form']").click(function(){
		
		var memberId = $(".members-table .clicked-member").data("memberId");
		$("input[name='task-member-id']").val(memberId);
	});
	$(".start-task-btn").click(function(){
		
		$(".start-task-btn").removeClass("started");
		$(this).addClass("started");
		$(this).next().addClass("started");
		var unstartedTaskButtons = $(".start-task-btn:not(.started)"); 	
		var disableFinishButtons = $(".start-task-btn:not(.started)").next();
		unstartedTaskButtons.prop('disabled', (i, v) => !v);
		disableFinishButtons.prop('disabled', (i, v) => !v);
		var taskId = $(this).data("taskId");
		$.ajax({
			url: "../api/task.php?task-id="+taskId+"&start_task=true&get_past_due=true"	
		})
		.done(function(data){
			console.log(data);
			data = JSON.parse(data);
			$("meter[name='"+taskId+"']").attr("max",data.time);
			var startMeterProgress = setInterval(function(){
				sec++;
				$("meter[name='"+taskId+"']").val(sec);
				$("span[name='"+taskId+"-percentage']").text(function(){
					var progressStatus;
					if(data.past_due=='true'){
						//console.log(data.past_due);
						$("meter[name='"+taskId+"']").val(data.time);
						progressStatus = "Past Due:";	
						clearInterval(startMeterProgress);
					}else{
						progressStatus = "Progress:";
					}
					
					return progressStatus+time_to_percentage(data.time,sec)+"%";
				});
			},1000);
			
		});
	});

	
	$(".finished-task-btn").click(function(){
		/*
		status: 
		 0 = not started
		 1 = started/in-progress
		 2 = paused
		 3 = finished
		*/
		var taskId = $(this).prev().data("taskId");
		console.log(taskId);
		$.ajax({
		url: "../api/task.php?task-id="+taskId+"&status="+3+"&set_to_finish=true"	
		})
		.done(function(data){
			console.log(data);
			location.reload(true);
		});
		
	});
	
	
});

function time_to_percentage(max,val){
	var percentage = parseFloat(Math.round((val/max) * 100)).toFixed(2);
	return percentage;
}

