<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$sql = "DELETE FROM user WHERE u_id = $delete_id";

		if(mysqli_query($conn, $sql)) {
			header('Location: admin_users.php');
		} else {
			echo 'Error: ' . mysqli_error($conn);
		}
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT * FROM user WHERE u_id = $id";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<title> Product: <?php echo $user['u_user']; ?> | TechTalk </title>

<div class="container my-5">

	<div class="row mb-5">

	<?php if($user): ?>
		<form class="mb-3" action="admin_users_view.php" method="POST">
			<input type="hidden" class="delete_id" name="delete_id" value="<?php echo $user['u_id']; ?>">
			<a class="btn btn-danger delete_btn" href="javascript:void(0)" type="submit" name="delete" role="button">Delete Record</a>
		</form> 

		<hr>

		<div class="col-md-2">
	   		<img class="mb-3" width="100%" src="<?php echo $user['u_avatar']; ?>" title="<?php echo $user['u_user']; ?>">
	   	</div>

	   	<div class="col-md-9">
			<h6>Name: <?php echo $user['u_user']; ?></h6>
			<h6>First Name: <?php echo $user['u_fname']; ?></h6>
			<h6>Last Name: <?php echo $user['u_lname']; ?></h6>
			<h6>E-mail Address: <?php echo $user['u_email']; ?></h6>
			<h6>Bio: <?php echo $user['u_bio']; ?></h6>
			<h6>Member Since: <?php echo $user['created_at']; ?></h6>
		</div>

	<?php else: ?>
		<h2> Oops.. User is unavailable. Please try again. </h2>
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
					url: "admin_users_view.php",
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