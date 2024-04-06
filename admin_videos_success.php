<?php

	$v_name = $_POST['v_name'];
	$v_author = $_POST['v_author'];
	$v_desc = $_POST['v_desc'];
	$v_url = $_POST['v_url'];

	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

?>

		<div class="container my-5">

			<?php 
				if($conn->connect_error) {
					die('Connection Failed: '.$conn->connect_error);
				} else {
					$stmt = $conn->prepare("insert into video(v_name, v_author, v_desc, v_url)values(?, ?, ?, ?)");

					$stmt->bind_param("ssss", $v_name, $v_author, $v_desc, $v_url);
					echo "<div class='alert alert-success' role='alert'> Record added successfully! </div>";
					echo "<h2> Record Details: </h2>
						<hr>	
			 			<p> Video Name: $v_name </p>
						<p> Video Author: $v_author </p>
						<p> Video Description: $v_desc </p>
						<p> Video URL: $v_url </p>
						<hr>
						<i> You will be redirected shortly... </i>";
					echo '<meta http-equiv="refresh" content="3;url=admin_videos.php" />';
					$stmt->execute();
					$stmt->close();
					$conn->close();
				}
			?>

		</div>

<?php 
	require 'layouts/footer_admin.php';
?>