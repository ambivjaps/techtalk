<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$admin_acc = "SELECT * FROM admin WHERE a_id = $id";
		$result = mysqli_query($conn, $admin_acc);
		$admin_current = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<title> Admin Profile: <?php echo $admin_current['a_user']; ?> | TechTalk </title>

<div class="container my-5">
	<div class="row mb-5">
	<?php if($admin_current): ?>
		<div class="col-md-2">
	   		<img class="mb-3" width="100%" src="<?php echo $admin_current['a_avatar']; ?>" title="<?php echo $admin_current['a_user']; ?>">
	   	</div>

	   	<div class="col-md-10">
			<div class="tech-head mb-3"><h1 align="left">Admin Profile: <?php echo $admin_current['a_user']; ?></h1></div>
			<h6>Full Name: <?php echo $admin_current['a_fname']; ?> <?php echo $admin_current['a_lname']; ?></h6>
			<h6>E-mail Address: <?php echo $admin_current['a_email']; ?></h6>
			<h6>Member Since: <?php echo $admin_current['created_at']; ?></h6>
			<hr>
			<p class="mb-4"><?php echo $admin_current['a_bio']; ?></p>
		</div>

	<?php else: ?>
		<h2> Oops.. User is unavailable. Please try again. </h2>
	<?php endif ?>

	</div>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>