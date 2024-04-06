<title> Add a Product | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}
?>

<div class="container my-5">

			<h2> Add a Product </h2>
			<hr>

			<div class="form-group">

				<form method="POST" action="admin_products_success.php">

				<div class="mb-3">
					<label for="form_name"> Product Name: </label>
					<input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter Product Name" required>
				</div>

				<div class="mb-3">
					<label for="form_type"> Product Type: </label>
					<input type="text" class="form-control" id="p_type" name="p_type" placeholder="Enter Product Type" required>
				</div>

				<div class="mb-3">
					<label for="form_year"> Select a year: </label>
					<select class="form-select" id="p_year" name="p_year" style="width:40%">
					<?php
						for($num_yr=1984; $num_yr<=2021; $num_yr++) {
							echo "<option name='$num_yr'> $num_yr </option> <br>";
						}
					?>
					</select>
				</div>

				<div class="mb-3">
					<label for="form_image"> Product Image: </label>
					<input type="text" class="form-control" id="p_img" name="p_img" placeholder="Enter Product Image" required>
				</div>

				<div class="mb-3">
					<label for="form_desc"> Product Description: </label>
					<input type="text" class="form-control" id="p_desc" name="p_desc" placeholder="Enter Product Description" required>
				</div>

				<div class="mb-3">
					<label for="form_body" class="form-label">Product Body: </label>
					<textarea class="form-control" id="p_body" name="p_body" rows="8" placeholder="Enter Product Body" required></textarea>
				</div>

				<input class="btn btn-success mt-3" type="submit" id="login-btn" name="submit" value="Add Record" style="width:40%">

				</form>

			</div>
		</div>


<?php 
	require 'layouts/footer_admin.php';
?>