<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$sql = "DELETE FROM video WHERE v_id = $delete_id";

		if(mysqli_query($conn, $sql)) {
			header('Location: admin_videos.php');
		} else {
			echo 'Error: ' . mysqli_error($conn);
		}
	}

	if(isset($_POST['edit'])) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT * FROM video WHERE v_id = $id";
		$result = mysqli_query($conn, $sql);
		$video = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<title> Video: <?php echo $video['v_name']; ?> | TechTalk </title>

<div class="container my-5">

	<div class="row mb-5">
	<?php if($video): ?>

		<form class="mb-3" action="admin_videos_view.php" method="POST">
			<a class="btn btn-success edit_btn" href="admin_edit_videos.php?id=<?php echo $video['v_id'] ?>" type="submit" name="edit" role="button">Edit Record</a>
			<input type="hidden" class="delete_id" name="delete_id" value="<?php echo $video['v_id']; ?>">
			<a class="btn btn-danger delete_btn" href="javascript:void(0)" type="submit" name="delete" role="button">Delete Record</a>
		</form> 

		<hr>

		<div class="col-md-4">
			<div class="youtube-player" data-id="<?php echo $video['v_url'] ?>"></div>
		</div>

	   	<div class="col-md-8">	
			<h6>Title: <?php echo $video['v_name']; ?></h6>
			<h6>Author: <?php echo $video['v_author']; ?></h6>
			<h6>Description: <?php echo $video['v_desc']; ?></h6>
			<h6>URL: <?php echo $video['v_url']; ?></h6>
			<h6>Created At: <?php echo $video['created_at']; ?></h6>
		</div>

	<?php else: ?>
		<h2> Oops.. Video is unavailable. Please try again. </h2>
	<?php endif ?>

	</div>

</div>
<script>
	$(document).ready(function() {
		$('.delete_btn').click(function(e) {
		e.preventDefault();

		var deleteId = $(this).closest("form").find('.delete_id').val();

		swal({
			title: "Are you sure?",
			text: "Once this record is deleted, it cannot be undone.",
			icon: "warning",
			type: "warning",
			showCancelButton: true,
			showConfirmButton: true,
			confirmButtonColor: '#E64942',
			confirmButtonText: "Yes, I'm sure",
			cancelButtonText: 'Cancel',
			dangerMode: true,
			}, function () {
				$.ajax({
					type:"POST",
					url: "admin_videos_view.php",
					data: {
						"delete": 1,
						"delete_id": deleteId,
					},
					dataType: "dataType",
					success: function(response) {
						swal("Record deleted successfully.", {
							icon: "success",
						}).then((result)=> {
							location.reload();
						});
					}
				});
			});
	});
});
</script>

<?php 
	require 'layouts/footer_admin.php';
?>