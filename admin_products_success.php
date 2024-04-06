<?php

	$p_name = $_POST['p_name'];
	$p_type = $_POST['p_type'];
	$p_body = $_POST['p_body'];
	$year_release = $_POST['p_year'];
	$p_image = $_POST['p_img'];
	$p_desc = $_POST['p_desc'];

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
					$stmt = $conn->prepare("insert into product(p_name, p_type, year_release, p_image, p_body, p_desc)values(?, ?, ?, ?, ?, ?)");

					$stmt->bind_param("ssisss", $p_name, $p_type, $year_release, $p_image, $p_body, $p_desc);
					echo "<div class='alert alert-success' role='alert'> Record added successfully! </div>";
					echo "<h2> Record Details: </h2>
						<hr>	
			 			<p> Product Name: $p_name </p>
						<p> Product Type: $p_type </p>
						<p> Year Released: $year_release </p>
						<p> Product Image: $p_image </p>
						<p> Product Body: $p_body </p>
						<p> Product Description: $p_desc </p>
						<hr>
						<i> You will be redirected shortly... </i>";
					echo '<meta http-equiv="refresh" content="3;url=admin_products.php" />';
					$stmt->execute();
					$stmt->close();
					$conn->close();
				}
			?>

		</div>

<?php 
	require 'layouts/footer_admin.php';
?>