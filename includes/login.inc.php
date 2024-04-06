<?php

session_start();

if(isset($_POST['login'])){
	include 'dbh.inc.php';

	$uid=mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd=mysqli_real_escape_string($conn, $_POST['pwd']);

	if (empty($uid) || empty($pwd)){
		header("Location: ../login.php?login=empty");
		exit();

	} else {
		$sql = "SELECT * FROM user WHERE u_user='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1){
			header("Location: ../login.php?login=error");
			exit();

		} else {

		if ($row = mysqli_fetch_assoc($result)){
		 	$hashedPwdCheck = password_verify($pwd, $row['u_pwd']);

		 	if ($hashedPwdCheck == false){
		 		header("Location: ../login.php?login=error");
		 		exit();

		 	} else if ($hashedPwdCheck == true) { 
				$_SESSION['u_id'] = $row['u_id'];
				$_SESSION['u_fname'] = $row['u_fname'];
				$_SESSION['u_lname'] = $row['u_lname'];
				$_SESSION['u_email'] = $row['u_email'];
				$_SESSION['u_user'] = $row['u_user'];
				header("Location: ../home.php");
				
				exit();
				}
			}
		}
	}
}

else {
	header("Location: ../login.php?login=error");
	exit();
}