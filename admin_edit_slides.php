<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT * FROM slide WHERE s_id = $id";
		$result = mysqli_query($conn, $sql);
		$slide = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>
<?php
if(isset($_POST['submit'])) {
    $SID = $slide['s_id'];

    $s_title = mysqli_real_escape_string($conn, $_POST['s_title']);
    $s_desc = mysqli_real_escape_string($conn, $_POST['s_desc']);
    $s_link = mysqli_real_escape_string($conn, $_POST['s_link']);

    $query = "UPDATE slide SET s_title='$s_title',s_desc='$s_desc',s_link='$s_link' WHERE s_id=$SID";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        ?>
        <script>
		    swal("Success!", "Slide Record has been updated!", "success");
		</script>
		<?php
        $_SESSION['s_title'] = $_POST['s_title'];
        $_SESSION['s_desc'] = $_POST['s_desc'];
        $_SESSION['s_link'] = $_POST['s_link'];
        mysqli_close($conn);
    } else {
        ?>
        <script>
		    swal("Error.", "Error occurred while submitting form.", "error");
		</script>
		<?php
    }
}
?>
<title> Edit Slide Data | TechTalk Admin </title>

<style>
    .edit_form {
        width: 64%;
    }

	.button-group {
        text-align: left;
	}

	.btn {
		background-color: #B36200;
		border: none;
	}

	.btn:hover,
	.btn:focus {
		background-color: #252525;
		border: none;
	}
</style>

<?php if($slide): ?>
<div class="container my-5">
	<h2> Edit Record Data </h2>
	<hr>

    <div class="form-group">
        <div class="row col-md-6 col-md-offset-3">
			<form action="admin_edit_slides.php?id=<?php echo $slide['s_id'] ?>" method="POST" class="edit_form">
					<div class="mb-3">
						<label>Slide Title</label>
							<input type="text" name="s_title" id="edit_stitle" class="form-control" value="<?php echo $slide['s_title']; ?>" placeholder="<?php echo $slide['s_title']; ?>">
						</div>
					<div class="mb-3">
						<label>Slide Description</label>
						<input type="text" name="s_desc" id="edit_sdesc" class="form-control" value="<?php echo $slide['s_desc']; ?>" placeholder="<?php echo $slide['s_desc']; ?>">
					</div>
					<div class="mb-3">
						<label>Slide Link</label>
						<input type="text" name="s_link" id="edit_slink" class="form-control" value="<?php echo $slide['s_link']; ?>" placeholder="<?php echo $slide['s_link']; ?>">
					</div>
					<div class="button-group">
						<input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit" style="width:30%">
						<input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:30%">
					</div>
			</form>
		</div>
	</div>

<?php else: ?>
		<h2> Oops.. An error occurred. Please try again. </h2>
	<?php endif ?>
</div>

<?php 
	require 'layouts/footer_admin.php';
?>