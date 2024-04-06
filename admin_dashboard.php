<title> Dashboard | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}
?>

<div class="container my-5">

	<?php
			if (isset($_SESSION['u_id'])){
				echo "<h2> Good day, administrator ".$_SESSION['a_fname']." ".$_SESSION['a_lname']."! </h2>";
				echo "<h4 class=mb-5> What would you like to do? </h4>";
			} else {
				echo "";
			}
	?>

	<hr>

	<div class="row">
		<div class="col-md-4 mt-3">
			<a class="btn btn-danger btn-lg" href="admin_products" role="button" style="width: 100%; height: 80px;">
				<i class="fas fa-microchip"></i> Products</a>
		</div>

		<div class="col-md-4 mt-3">
			<a class="btn btn-secondary btn-lg" href="admin_videos" role="button" style="width: 100%; height: 80px">
				<i class="fas fa-play"></i> Videos</a>
		</div>

		<div class="col-md-4 mt-3">
			<a class="btn btn-success btn-lg" href="admin_slides" role="button" style="width: 100%; height: 80px">
				<i class="fas fa-images"></i> Slideshow</a>
		</div>

		<div class="col-md-4 mt-3">
			<a class="btn btn-primary btn-lg" href="admin_users" role="button" style="width: 100%; height: 80px">
				<i class="fas fa-user"></i> Users</a>
		</div>
	</div>

	<hr>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>