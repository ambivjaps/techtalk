<?php
	require 'layouts/header_admin.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['a_id'])) {
		header("location: admin.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$sql = "SELECT * FROM product WHERE p_id = $id";
		$result = mysqli_query($conn, $sql);
		$prod = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>
<?php
if(isset($_POST['submit'])) {
    $PID = $prod['p_id'];

    $p_name = mysqli_real_escape_string($conn, $_POST['p_name']);
    $p_brand = mysqli_real_escape_string($conn, $_POST['p_brand']);
    $p_type = $_POST['p_type'];
    $year_release = $_POST['year_release'];
    $p_desc = mysqli_real_escape_string($conn, $_POST['p_desc']);
    $p_body = mysqli_real_escape_string($conn, $_POST['p_body']);

    $query = "UPDATE product SET p_name='$p_name',p_brand='$p_brand',p_type='$p_type',year_release='$year_release',p_desc='$p_desc',p_body='$p_body'
    WHERE p_id=$PID";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        ?>
        <script>
		    swal("Success!", "Product Record has been updated!", "success");
		</script>
		<?php
        $_SESSION['p_name'] = $_POST['p_name'];
        $_SESSION['p_brand'] = $_POST['p_brand'];
        $_SESSION['p_type'] = $_POST['p_type'];
        $_SESSION['year_release'] = $_POST['year_release'];
        $_SESSION['p_desc'] = $_POST['p_desc'];
        $_SESSION['p_body'] = $_POST['p_body'];
        mysqli_close($conn);
    } else {
        ?>
        <script>
		    swal("Error.", "Error occurred while submitting form.", "error");
		</script>
		<?php
    }
}
?>
<title> Edit Product Data | TechTalk Admin </title>

<style>
    select {
        color: gray !important;
        font-size: 16px !important;
    }

    select option {
        color: black!important;
        font-size: 18px;
    }

    .edit_form {
        width: 50%;
        margin-left : 25%
    }

	.button-group {
        text-align: left;
        width: 70%;
	}

	.btn {
		background-color: #B36200;
		border: none;
	}

	.btn:hover,
	.btn:focus {
		background-color: #252525;
		border: none;
	}
</style>

<?php if($prod): ?>

<div class="container my-5">
    <h2> Edit Record Data </h2>
	<hr>

    <div class="form-group">
        <div class="row col-md-6 col-md-offset-3">
        <form action="admin_edit_product.php?id=<?php echo $prod['p_id'] ?>" method="POST">
                <div class="mb-3">
                    <label>Product Name</label>
                        <input type="text" name="p_name" id="edit_pname" class="form-control" value="<?php echo $prod['p_name']; ?>" placeholder="<?php echo $prod['p_name']; ?>">
                </div>
                <div class="mb-3">
                    <label>Product Brand</label>
                    <input type="text" name="p_brand" id="edit_pbrand" class="form-control" value="<?php echo $prod['p_brand']; ?>" placeholder="<?php echo $prod['p_brand']; ?>">
                </div>
                <div class="mb-3">
                    <label>Product Type</label>
                        <select class="form-select form-select-lg mb-3" id="edit_ptype" name="p_type" aria-label=".form-select-lg example">
                        <option selected value="<?php echo $prod['p_type']; ?>">Type</option>
                        <option value="Smartphone">Smartphone</option>
                        <option value="Gaming Console">Gaming Console</option>
                        <option value="Accessory">Accessory</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label>Year Release</label>
                    <input type="text" name="year_release" onkeypress='validate(event)' value="<?php echo $prod['year_release']; ?>"maxlength="4" id="edit_prelease" class="form-control" placeholder="<?php echo $prod['year_release']; ?>">
                </div>
                <div class="mb-3">
                    <label>Product Description</label>
                    <input type="text" name="p_desc" id="edit_pdesc" class="form-control" value="<?php echo $prod['p_desc']; ?>" placeholder="<?php echo $prod['p_desc']; ?>">
                </div>
                <div class="mb-3">
                    <label>Product Body</label>
                    <input type="text" name="p_body" class="form-control" id="edit_pbody" value="<?php echo $prod['p_body']; ?>" placeholder="<?php echo $prod['p_body']; ?>">
                </div>
                <div class="button-group">
                    <input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit" style="width:30%">
                    <input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:30%">
                </div>
        </form>
        </div>
    </div>

    <?php else: ?>
		<h2> Oops.. An error occurred. Please try again. </h2>
	<?php endif ?>
</div>


<?php 
	require 'layouts/footer_admin.php';
?>