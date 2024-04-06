<title> Home | TechTalk </title>

<?php
	require 'layouts/header.php';
	include_once 'includes/dbh.inc.php';

	/* carousel */
	$carousel = "SELECT * FROM slide ORDER BY s_id LIMIT 5";
	$result = mysqli_query($conn, $carousel);
	$slides = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

	/* featured product */
	$feature_prod = "SELECT * FROM product ORDER BY p_id DESC LIMIT 4";
	$result = mysqli_query($conn, $feature_prod);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

	/* featured video */
	$feature_vid = "SELECT * FROM video ORDER BY v_id DESC LIMIT 3";
	$result = mysqli_query($conn, $feature_vid);
	$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

	mysqli_close($conn);
?>

	<div id="techtalk-slide" class="carousel slide" data-bs-ride="carousel">
  		<ol class="carousel-indicators">
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="1" aria-label="Slide 2"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="2" aria-label="Slide 3"></button>
    		<button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#techtalk-slide" data-bs-slide-to="4" aria-label="Slide 5"></button>
  		</ol>

		<div class="carousel-inner">
     		<?php $loop=0; foreach ($slides as $slide): ?>

  			<?php 
  				if ($loop==0) {
  					$status = "active"; 
  				} else { 
  					$status = ""; 
  				} 
  			?> 

		<div class='carousel-item <?php echo $status; ?>'>
		      	<img class="d-block w-100" src="<?php echo $slide['s_img']; ?>" title="<?php echo $slide['s_desc']; ?>">
		</div>

  		<?php $loop++; endforeach ?>
  		</div>
  
			<button class="carousel-control-prev" data-bs-target="#techtalk-slide" type="button" data-bs-slide="prev">
    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    		<span class="visually-hidden"></span>
  		</button>
  
  		<button class="carousel-control-next" data-bs-target="#techtalk-slide" type="button" data-bs-slide="next">
    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
    		<span class="visually-hidden"></span>
  		</button>
	</div>

	<div class="container my-5">

		<?php
			if (isset($_SESSION['u_id'])){
				echo "<h2> Welcome, ".$_SESSION['u_fname']." ".$_SESSION['u_lname']."! </h2>";
				echo "<h4 class=mb-5> Let's start rating some tech! </h4>";
			} else {
				echo "";
			}
		?>

		<div class="tech-head mt-3 mb-4"> <h3> Latest Products </h3> </div>

		<div class="row mt-3">
			<?php foreach($products as $product): ?>
	   			<div class="col-md-3 col-6 mb-5">
	   				<a href="products-item.php?id=<?php echo $product['p_id'] ?>">
	   				<img class="product mb-3" width="100%" src="<?php echo $product['p_image']; ?>">
	   				</a>

					<h2><?php echo $product['p_name']; ?></h2>
					<h6><?php echo $product['p_type']; ?></h6>

					<div class="tech-yr"><span class="badge bg-light text-dark"><?php echo $product['year_release']; ?></span></div>
					<hr>
					<p><?php echo $product['p_desc']; ?></p>
				
					<a class="btn btn-warning" href="products-item.php?id=<?php echo $product['p_id'] ?>" role="button">Read reviews</a>
				</div>
				
			<?php endforeach; ?>
		</div>

		<div class="tech-head mt-3"> <h3> Latest Tech Videos </h3> </div>

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