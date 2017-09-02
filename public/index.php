<?php 
require_once("..\includes\initialize.php");
?>

<?php 

if($session->is_logged_in()){
	if($session->get_privilege()==1){
		if(!empty($_SESSION['user_id'])&&isset($_SESSION['user_id'])){
			redirect_to("admin/index.php?id=".$_SESSION['user_id']);
		}else
			redirect_to("admin/index.php");
	}else{
		if(!empty($_SESSION['user_id'])&&isset($_SESSION['user_id'])){
			redirect_to("employee/index.php?id=".$_SESSION['user_id']);
		}else
			redirect_to("employee/index.php");
	}
}


if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	//check db if user + pw exist
	$found_user = Member::authenticate($username, $password);
	
	if($found_user){
		$session->login($found_user);
		if($found_user->role==1){
			redirect_to("admin/index.php?id=".$found_user->id);
		}else{
			redirect_to("employee/index.php?id=".$found_user->id);
		}
	}else{
		$message = "USERNAME/PASSWORD combination incorrect.";
	}
} else {
	$username = "";
	$password = "";
}

?>

<?php
include_layout_template("header.php");
?>
<div class="container-fluid">
	<form class="login" action="index.php" method="POST">
	<p>Username:
		<input type="text" placeholder="" value="" name="username" />
	</p>
	<p>Password:
		<input type="password" placeholder="" value="" name="password"/>
	</p>
		<hr>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
		<a href="" class="btn btn-info">Create Account</a>
	</form>
</div>
<?php 
	include_layout_template("footer.php");
?>