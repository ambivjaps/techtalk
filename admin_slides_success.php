<?php

	$s_title = $_POST['s_title'];
	$s_img = $_POST['s_img'];
	$s_desc = $_POST['s_desc'];
	$s_link = $_POST['s_link'];

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
					$stmt = $conn->prepare("insert into slide(s_title, s_img, s_desc, s_link)values(?, ?, ?, ?)");

					$stmt->bind_param("ssss", $s_title, $s_img, $s_desc, $s_link);
					echo "<div class='alert alert-success' role='alert'> Record added successfully! </div>";
					echo "<h2> Record Details: </h2>
						<hr>	
			 			<p> Slide Title: $s_title </p>
						<p> Slide Image: $s_img </p>
						<p> Slide Description: $s_desc </p>
						<p> Slide Link: $s_link </p>
						<hr>
						<i> You will be redirected shortly... </i>";
					echo '<meta http-equiv="refresh" content="3;url=admin_slides.php" />';
					$stmt->execute();
					$stmt->close();
					$conn->close();
				}
			?>

		</div>

<?php 
	require 'layouts/footer_admin.php';
?>