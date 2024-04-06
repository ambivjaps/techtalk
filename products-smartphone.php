<title> Product Reviews: Smartphone | TechTalk </title>

<?php
	require 'layouts/header.php';
	include 'includes/dbh.inc.php';

	$sql = "SELECT * FROM product WHERE p_type='Smartphone' ORDER BY p_id DESC";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
?>

<div class="container mt-4 mb-5">

	<div class='row mt-2'>
			<nav class='category-nav'>
				<ul class='nav nav-pills nav-fill'>
	   		 		<li class='nav-item'> <a class='nav-link' aria-current='page' href='products.php'> All </a> </li>
	       		 	<li class='nav-item'> <a class='nav-link active' href='products-smartphone.php'> Smartphone </a> </li>
	        		<li class='nav-item'> <a class='nav-link' href='products-gaming.php'> Gaming Console </a> </li>
	        		<li class='nav-item'> <a class='nav-link' href='products-accessory.php'> Accessory </a> </li>
	      		</ul><hr>
	   	 	</nav>

	   	<?php foreach($products as $product): ?>
	   		<div class="col-md-3 col-6 mb-5">
	   			<a href="products-item.php?id=<?php echo $product['p_id'] ?>">
	   				<img class="product mb-3" width="100%" src="<?php echo htmlspecialchars($product['p_image']); ?>">
	   			</a>
	   			
				<h2><?php echo htmlspecialchars($product['p_name']); ?></h2>
				<h6><?php echo htmlspecialchars($product['p_type']); ?></h6>

				<div class="tech-yr"><span class="badge bg-light text-dark"><?php echo htmlspecialchars($product['year_release']); ?></span></div>
				<hr>
				<p><?php echo htmlspecialchars($product['p_desc']); ?></p>
				
				<a class="btn btn-warning" href="products-item.php?id=<?php echo $product['p_id'] ?>" role="button">Read reviews</a>
			</div>	
		<?php endforeach; ?>
	</div>

</div>

<?php 
	require 'layouts/footer.php';
?>