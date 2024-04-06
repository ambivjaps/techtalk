<title> Videos | TechTalk </title>

<?php 
	require 'layouts/header.php';
	include_once 'includes/dbh.inc.php';

	$sql = "SELECT * FROM video ORDER BY v_id DESC";
	$result = mysqli_query($conn, $sql);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

	mysqli_close($conn);
?>

<div class="container my-5">

	<div class="row mt-3">
		<?php foreach($videos as $video): ?>
   			<div class="col-md-4 mb-4">
				<div class="youtube-player" data-id="<?php echo $video['v_url'] ?>"></div>
				<h3><?php echo $video['v_name']; ?></h3>
				<div class="tech-yr"><span class="badge bg-dark">By <?php echo $video['v_author']; ?></span></div>
				<hr>
				<p><?php echo $video['v_desc']; ?></p>
			</div>
		<?php endforeach; ?>
	</div>

</div>

<?php 
	require 'layouts/footer.php';
?>