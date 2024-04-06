<title> Admin Login | TechTalk Admin </title>

<style>
	a {
	transition: all 0.2s ease;
	}

	.form-group {
		padding-right: 150px;
	}

	.form-group label {
		color: #FFA500;
	}

	#login {
	color: #f2f2f2;
	font-weight: 500;
	background-color: #a05801;
	border: #a05801 1px solid;
	transition: all 0.3s ease;
	}

	#login:hover {
		color: #FFA500;
		background-color: #333;
		border: #333 1px solid;
		transform: scale(0.95); 
	}
</style>

<?php 
	require 'layouts/header_admin.php';

	if(!empty($_SESSION['a_id'])) {
		header("location: admin_dashboard.php");
	}
?>

<div class="container my-5">

	<h2> Administrator Login </h2>
	<hr>

	<div class="form-group">

		<form method="POST" action="includes/login_admin.inc.php">

		<div class="mb-3">
			<label for="a_name"> Name: </label>
			<input type="text" class="form-control" id="uid" name="uid" placeholder="Enter your name." style="width:50%" required>
		</div>

		<div class="mb-3">
			<label for="a_pwd"> Password: </label>
			<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter your password." style="width:50%" required>
		</div>

		<input class="btn btn-success mt-3" type="submit" id="login" name="login" value="Login" style="width:30%">

		</form>

	</div>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>