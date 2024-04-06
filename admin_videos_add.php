<title> Add a Slide | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}
?>

<div class="container my-5">

			<h2> Add a Video </h2>
			<hr>

			<div class="form-group">

				<form method="POST" action="admin_videos_success.php">

				<div class="mb-3">
					<label for="form_name"> Video Name: </label>
					<input type="text" class="form-control" id="v_name" name="v_name" placeholder="Enter Video Name" required>
				</div>

				<div class="mb-3">
					<label for="form_type"> Video Author: </label>
					<input type="text" class="form-control" id="v_author" name="v_author" placeholder="Enter Video Author" required>
				</div>

				<div class="mb-3">
					<label for="form_image"> Video Description: </label>
					<input type="text" class="form-control" id="v_desc" name="v_desc" placeholder="Enter Video Description" required>
				</div>

				<div class="mb-3">
					<label for="form_desc"> Video URL: </label>
					<input type="text" class="form-control" id="v_url" name="v_url" placeholder="Enter Video URL" required>
				</div>

				<input class="btn btn-success mt-3" type="submit" id="login-btn" name="submit" value="Add Record" style="width:40%">

				</form>

			</div>
		</div>


<?php 
	require 'layouts/footer_admin.php';
?>