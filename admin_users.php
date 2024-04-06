<title> Users | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	$sql = "SELECT * FROM user ORDER BY u_id DESC";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
?>

<div class="container my-5">

	<h1> <i class="fas fa-user"></i> User Records </h1>
		<hr>
		<center>
			<table>
				<tr>
					<th> ID </th>
					<th> Username </th>
					<th> Last Name </th>
					<th> First Name </th>
					<th> E-mail </th>
					<th> Avatar </th>
					<th> Date Joined </th>
					<th> Action </th>
				</tr>

		<?php foreach($users as $user): ?>

			<tr><td> <?php echo $user['u_id']; ?> </td>
			<td> <?php echo $user['u_user']; ?> </td>
			<td> <?php echo $user['u_lname']; ?> </td>
			<td> <?php echo $user['u_fname']; ?> </td>
			<td> <?php echo $user['u_email']; ?> </td>
			<td> <?php echo $user['u_avatar']; ?> </td>
			<td> <?php echo $user['created_at']; ?> </td>
			<td> <a class="btn btn-primary" href="admin_users_view.php?id=<?php echo $user['u_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>

		<?php endforeach; ?>

		</table>
	</center>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>