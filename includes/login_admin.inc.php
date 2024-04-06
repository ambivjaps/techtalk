<?php

session_start();

if(isset($_POST['login'])){
	include 'dbh.inc.php';

	$uid=mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd=mysqli_real_escape_string($conn, $_POST['pwd']);

	if (empty($uid) || empty($pwd)){
		header("Location: ../admin.php?login=empty");
		exit();

	} else {
		$sql = "SELECT * FROM admin WHERE a_user='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1){
			header("Location: ../admin.php?login=error");
			exit();

		} else {

		if ($row = mysqli_fetch_assoc($result)){
		 	$hashedPwdCheck = password_verify($pwd, $row['a_pwd']);

		 	if ($hashedPwdCheck == false){
		 		header("Location: ../admin.php?login=error");
		 		exit();

		 	} else if ($hashedPwdCheck == true) { 
				$_SESSION['a_id'] = $row['a_id'];
				$_SESSION['a_fname'] = $row['a_fname'];
				$_SESSION['a_lname'] = $row['a_lname'];
				$_SESSION['a_email'] = $row['a_email'];
				$_SESSION['a_user'] = $row['a_user'];
				header("Location: ../admin_dashboard.php");
				
				exit();
				}
			}
		}
	}
}

else {
	header("Location: ../admin.php?login=error");
	exit();
}