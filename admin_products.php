<title> Products | TechTalk Admin </title>

<?php 
	require 'layouts/header_admin.php';
	include_once 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	$sql = "SELECT * FROM product ORDER BY p_id DESC";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
?>

<div class="container my-5">

	<h1> <i class="fas fa-microchip"></i> Product Records </h1>
		<hr>
		<a class="btn btn-primary" href="admin_products_add.php" role="button"> Add Product </a>
		<center>
			<table>
				<tr>
					<th> ID </th>
					<th> Title </th>
					<th> Image </th>
					<th> Description </th>
					<th> Year Released </th>
					<th> Created At </th>
					<th> Action </th>
				</tr>

		<?php foreach($products as $product): ?>

			<tr><td> <?php echo $product['p_id']; ?> </td>
			<td> <?php echo $product['p_name']; ?> </td>
			<td> <?php echo $product['p_image']; ?> </td>
			<td> <?php echo $product['p_desc']; ?> </td>
			<td> <?php echo $product['year_release']; ?> </td>
			<td> <?php echo $product['created_at']; ?> </td>
			<td> <a class="btn btn-primary" href="admin_products_view.php?id=<?php echo $product['p_id'] ?>" role="button"><i class="fas fa-eye"></i> View</a> </td></tr>

		<?php endforeach; ?>

		</table>
	</center>

</div>

<?php 
	require 'layouts/footer_admin.php';
?>