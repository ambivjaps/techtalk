<title> Add a Slide | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}
?>

<div class="container my-5">

			<h2> Add a Slide </h2>
			<hr>

			<div class="form-group">

				<form method="POST" action="admin_slides_success.php">

				<div class="mb-3">
					<label for="form_name"> Slide Name: </label>
					<input type="text" class="form-control" id="s_title" name="s_title" placeholder="Enter Slide Name" required>
				</div>

				<div class="mb-3">
					<label for="form_type"> Slide Image: </label>
					<input type="text" class="form-control" id="s_img" name="s_img" placeholder="Enter Slide Image" required>
				</div>

				<div class="mb-3">
					<label for="form_image"> Slide Description: </label>
					<input type="text" class="form-control" id="s_desc" name="s_desc" placeholder="Enter Slide Description" required>
				</div>

				<div class="mb-3">
					<label for="form_desc"> Slide Link: </label>
					<input type="text" class="form-control" id="s_link" name="s_link" placeholder="Enter Slide Link" required>
				</div>

				<input class="btn btn-success mt-3" type="submit" id="login-btn" name="submit" value="Add Record" style="width:40%">

				</form>

			</div>
		</div>


<?php 
	require 'layouts/footer_admin.php';
?>