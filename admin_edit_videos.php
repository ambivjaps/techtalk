<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT * FROM video WHERE v_id = $id";
		$result = mysqli_query($conn, $sql);
		$vid = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>
<?php
if(isset($_POST['submit'])) {
    $VID = $vid['v_id'];

    $v_name = mysqli_real_escape_string($conn, $_POST['v_name']);
    $v_author = mysqli_real_escape_string($conn, $_POST['v_author']);
    $v_desc = mysqli_real_escape_string($conn, $_POST['v_desc']);
    $v_url = mysqli_real_escape_string($conn, $_POST['v_url']);

    $query = "UPDATE video SET v_name='$v_name',v_author='$v_author',v_desc='$v_desc',v_url='$v_url' WHERE v_id=$VID";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        ?>
        <script>
		    swal("Success!", "Video Record has been updated!", "success");
		</script>
		<?php
        $_SESSION['v_name'] = $_POST['v_name'];
        $_SESSION['v_author'] = $_POST['v_author'];
        $_SESSION['v_desc'] = $_POST['v_desc'];
        $_SESSION['v_url'] = $_POST['v_url'];
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
<title> Edit Video Data | TechTalk Admin </title>

<style>
    select {
        color: gray !important;
        font-size: 16px !important;
    }

    select option {
        color: black!important;
        font-size: 18px;
    }

    .edit_form {
        width: 50%;
        margin-left : 25%
    }

	.button-group {
        text-align: left;
        width: 65%;
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

<?php if($vid): ?>
<div class="container my-5">
	<h2> Edit Record Data </h2>
	<hr>

    <div class="form-group">
        <div class="row col-md-6 col-md-offset-3">
			<form action="admin_edit_videos.php?id=<?php echo $vid['v_id'] ?>" method="POST">
					<div class="mb-3">
						<label>Video Title</label>
							<input type="text" name="v_name" id="edit_vname" class="form-control" value="<?php echo $vid['v_name']; ?>" placeholder="<?php echo $vid['v_name']; ?>">
						</div>
					<div class="mb-3">
						<label>Author of Video</label>
						<input type="text" name="v_author" id="edit_vauthor" class="form-control" value="<?php echo $vid['v_author']; ?>" placeholder="<?php echo $vid['v_author']; ?>">
					</div>
					<div class="mb-3">
						<label>Video Description</label>
						<input type="text" name="v_desc" id="edit_vdesc" class="form-control" value="<?php echo $vid['v_desc']; ?>" placeholder="<?php echo $vid['v_desc']; ?>">
					</div>
					<div class="mb-3">
						<label>Video URL</label>
						<input type="text" name="v_url" id="edit_vurl" class="form-control" value="<?php echo $vid['v_url']; ?>" placeholder="<?php echo $vid['v_url']; ?>">
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