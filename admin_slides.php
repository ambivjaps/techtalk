<title> Slideshow | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	$sql = "SELECT * FROM slide ORDER BY s_id DESC";
	$result = mysqli_query($conn, $sql);
	$slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
?>

<div class="container my-5">

	<h1> <i class="fas fa-images"></i> Slideshow Records </h1>
		<hr>
		<a class="btn btn-primary" href="admin_slides_add.php" role="button"> Add Slide </a>
		<center>
			<table>
				<tr>
					<th> ID </th>
					<th> Title </th>
					<th> Image </th>
					<th> Description </th>
					<th> Link </th>
					<th> Created At </th>
					<th> Action </th>
				</tr>

		<?php foreach($slides as $slide): ?>

			<tr><td> <?php echo $slide['s_id']; ?> </td>
			<td> <?php echo $slide['s_title']; ?> </td>
			<td> <?php echo $slide['s_img']; ?> </td>
			<td> <?php echo $slide['s_desc']; ?> </td>
			<td> <?php echo $slide['s_link']; ?> </td>
			<td> <?php echo $slide['created_at']; ?> </td>
			<td> <a class="btn btn-primary" href="admin_slides_view.php?id=<?php echo $slide['s_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>

		<?php endforeach; ?>

		</table>
	</center>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>