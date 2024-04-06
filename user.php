<?php
	require 'layouts/header.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['u_id'])) {
		header("location: home.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$user_acc = "SELECT * FROM user WHERE u_id = $id";
		$result = mysqli_query($conn, $user_acc);
		$user_current = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>

<title> <?php echo $user_current['u_user']; ?> | TechTalk </title>
<style>
	.user-bio {
    margin-left: 16px;
}

	#edit {
		color: #fff;
		float: right;
		margin: 11px;
		font-size: 28px;
		cursor: pointer;
	}
</style>

<div class="container my-5">
	<div class="row mb-5">
	<?php
		$selection = "SELECT * FROM user WHERE u_id = '".$_SESSION['u_id']."'";
		
		$r = mysqli_query($conn, $selection);

		if(mysqli_num_rows($r) > 0) {
			while($row = mysqli_fetch_assoc($r)) {
		?>
		<div class="col-md-2">
	   		<img class="mb-3" width="100%" src="<?php echo $row['u_avatar']; ?>" alt="user profile picture" title="<?php echo $user_current['u_user']; ?>">
	   	</div>

	   	<div class="col-md-10">
			<div class="tech-head mb-3"><h1 align="left"><?php echo $row['u_user']; ?>
			<a href="user-edit.php"><i class="fas fa-edit" id="edit" data-toggle="tooltip" title="Edit Profile"></i></a></h1></div>
				<h6 class="user-bio">Full Name: <?php echo $row['u_fname']; ?> <?php echo $row['u_lname']; ?></h6>
				<h6 class="user-bio">E-mail Address: <?php echo $row['u_email']; ?></h6>
				<h6 class="user-bio">Member Since: <?php echo date('Y-m-d', strtotime($row['created_at']));?></h6>
				<hr>
				<p class="mb-4 user-bio"><?php echo $row['u_bio']; ?></p>
		</div>
		<?php }
		} ?>

	</div>

	<div class="tech-rev mb-3"> <h2> Recent reviews </h2> </div>
	<table id="datatable" class="table table-bordered sched-data">
						<thead>
							<tr>
							<th></th>
							<th>Product</th>
							<th>Rated</th>
							<th>Review</th>
							<th>Date & Time</th>
							</tr>
						</thead>

						<tbody>
						<?php
						$select = "SELECT * FROM rating
						LEFT JOIN product ON r_pid = p_id
						WHERE rating.r_uid ='".$_SESSION['u_id']."'";
						$query_run = $conn->query($select);

						if($query_run) {
						    $num_rows = 1;
							foreach($query_run as $row) {
						?>
						
							<tr id="<?php echo $row['r_id'] ?>">
							    <td><?php echo $num_rows++; ?></td>
								<td><?php echo $row['p_name']; ?></td>
								<td><?php echo $row['r_score'] ?></td>
								<td><?php echo $row['r_review'] ?></td>
								<td><?php echo $row['created_at'] ?></td>
							</tr>
						<?php } 
						} else {
							echo "User has not rated any products yet.";
						 } ?>
						</tbody>


					</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js" integrity="sha512-X7kCKQJMwapt5FCOl2+ilyuHJp+6ISxFTVrx+nkrhgplZozodT9taV2GuGHxBgKKpOJZ4je77OuPooJg9FJLvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ntegrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>

<?php 
	require 'layouts/footer.php';
?>