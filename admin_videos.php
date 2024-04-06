<title> Videos | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	$sql = "SELECT * FROM video ORDER BY v_id DESC";
	$result = mysqli_query($conn, $sql);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
?>

<div class="container my-5">

	<h1> <i class="fas fa-play"></i> Video Records </h1>
		<hr>
		<a class="btn btn-primary" href="admin_videos_add.php" role="button"> Add Video </a>
		<center>
			<table>
				<tr>
					<th> ID </th>
					<th> Title </th>
					<th> Author </th>
					<th> Description </th>
					<th> URL </th>
					<th> Created At </th>
					<th> Action </th>
				</tr>

		<?php foreach($videos as $video): ?>

			<tr><td> <?php echo $video['v_id']; ?> </td>
			<td> <?php echo $video['v_name']; ?> </td>
			<td> <?php echo $video['v_author']; ?> </td>
			<td> <?php echo $video['v_desc']; ?> </td>
			<td> <?php echo $video['v_url']; ?> </td>
			<td> <?php echo $video['created_at']; ?> </td>
			<td> <a class="btn btn-primary" href="admin_videos_view.php?id=<?php echo $video['v_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>

		<?php endforeach; ?>

		</table>
	</center>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>