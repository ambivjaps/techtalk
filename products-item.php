<?php
	require 'layouts/header.php';
	include 'includes/dbh.inc.php';

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$item = "SELECT * FROM product WHERE p_id = $id";
		$result = mysqli_query($conn, $item);
		$prod = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>
<?php
include 'includes/rating.inc.php';
$rating = new Rating();
if(isset($_POST['submit'])) {
	if(!isset($_SESSION['u_id'])) {
		?>
		<script>
		swal("Not Logged In.", "You need an account in order to leave a review.", "error");
		</script>
		<?php
	} else {

		$r_score = $_POST['r_score'];
		$r_review = $_POST['r_review'];
		$r_pid = $_POST['current_id'];
		$r_uid = $_SESSION['u_id'];

		$rating->createRating($r_score,$r_review,$r_pid,$r_uid);
			?>
			<script>
				swal("Success!", "Your review has been published!", "success");
			</script>
			<?php
	}
}
?>
<title> Product: <?php echo $prod['p_name']; ?> | TechTalk </title>
<style>
	.card {
		background-color: transparent;
	}

	.progress-label-left,
	.progress-label-right {
		display: inline-block;
	}

	.card .main_star {
		color: #777;
	}

	.form-group {
		margin-top: 2%;
		margin-left: 1%;
		padding: 10px;
		width: 550px;
		border: 1px solid #888;
		border-radius: 3px;
		-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
	}
	.form-group .stars input {
		display: none;
	}

	.stars label {
		font-size: 34px;
		color: #444;
		padding: 5px;
		float: right;
		transition: all 0.2s ease;
	}

	input:not(:checked) ~ label:hover,
	input:not(:checked) ~ label:hover ~ label {
		color: #fd4;
	}

	input:checked ~ label {
		color: #fd4;
	}

	input#rate-5:checked ~ label {
		color: #fe7;
		text-shadow: 0 0 20px #952;
	}

	textarea {
		margin: 5px;
		border: none;
		outline: none;
		resize: none;
	}

	.textarea_style {
		margin: 5px;
		margin-top: 10px;
		width: auto;
		height: auto;
		padding: 10px;
		font-size: 16px;
	}

	.textarea_style:hover {
		-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
	}

	.textarea_style:focus {
		-moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		-webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
		box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.03);
	}

	.textarea_style::-webkit-scrollbar {
		width: 3px;
	}

	.button-group {
		margin-left: 24px;
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

	#r_date {
		float: right;
		display: inline-block;
		height: 2px;
	}

	#tech-rev-spacing {
		padding-bottom: 25px;
	}

	#tech-review {
		background-color: #222;
		padding: 16px;
	}

	#star_icon {
		font-size: 22px;
		margin: 6px;
		color: #B36200;
	}
</style>

<div class="container my-5">
	<div class="row mb-5">
	<?php if($prod): ?>
		<div class="col-md-3">
	   		<img class="mb-3" width="100%" src="<?php echo $prod['p_image']; ?>" title="<?php echo $prod['p_name']; ?>">
	   	</div>

	   	<div class="col-md-9">
			<div class="tech-head mb-3"><h1 align="left"><?php echo $prod['p_name']; ?></h1></div>

			<h3><?php echo $prod['p_brand']; ?></h3>
			<h4><?php echo $prod['p_type']; ?></h4>
				
			<div class="tech-yr"><span class="badge bg-light text-dark"><?php echo $prod['year_release']; ?></span></div>
			<hr>
			<p><?php echo $prod['p_body']; ?></p>

			
		</div>

		<hr>
		<div class="card">
    		<div class="card-body">
    			<div class="row" id="rev-avg">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-2 mb-2">
							<?php $select = $conn->query("SELECT r_id FROM rating");
							$numR = $select->num_rows;

							$revAmt = $conn->query("SELECT r_id FROM rating WHERE rating.r_pid = '".$prod['p_id']."'");
							$amount = $revAmt->num_rows;

							$sum = $conn->query("SELECT SUM(r_score) AS total FROM rating WHERE rating.r_pid = '".$prod['p_id']."'");
							$rData = $sum->fetch_array();
							$total = $rData['total'];

							$avg = round(2.333333333 *($total / $numR), 1);?>
    						<b><span id="average_rating"><?php echo $avg; ?></span> / 5<i class="fas fa-star fa-xs" id="star_icon"></i></b>
    					</h1>
    					<h3><span id="total_review"><?php echo ($amount > 0) ? $amount : 0 ?></span> Reviews</h3>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-2 mb-3">Write Review Here</h3>
    					<a href="#leave-review"><button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button></a>
    				</div>
    			</div>
    		</div>
    	</div>
		<hr>

	<?php else: ?>
		<h2> Oops.. Product is unavailable. Please try again. </h2>
	<?php endif ?>

	</div>

	<div class="tech-rev mb-3"> <h2> Reviews </h2> </div>

	<div class="row my-4">
		<?php
		if($prod):
		$selection = "SELECT * FROM rating
		LEFT JOIN user ON r_uid = u_id
		WHERE rating.r_pid = '".$prod['p_id']."'";
		
		$r = mysqli_query($conn, $selection);

		if(mysqli_num_rows($r) > 0) {
			while($row = mysqli_fetch_assoc($r)) {
		?>
		
		<div class="col-md-1 col-6">
			<img src="<?php echo $row['u_avatar'];?>" width="100%" style="border-radius:50%;" alt="user icon">
			<center> <p> <?php echo $row['u_user']; ?></p> </center>
		</div>

		<div class="col-md-11 col-6 mb-4" id="tech-rev-spacing">
				<h6> Rating: <?php echo $row['r_score']; ?> </h6>
				<hr>
				<p id="tech-review"> <?php echo $row['r_review']; ?> </p>
				<h6 id="r_date"><?php echo $row['created_at']; ?> </h6>
		</div>
		<?php
			}
		} else {
			echo "<center>This product has no reviews. Be the first one to write a review.</center>"; }
		endif
		?>

	</div>

	<hr>

	<h3> Leave a rating </h3>

	<div class="row my-4">
		
		<div class="form-group" id="leave-review">

		<form action="products-item.php?id=<?php echo $prod['p_id'] ?>" method="post">
			<div class="stars">
				<input type="hidden" name="current_id" value="<?php echo $prod['p_id']; ?>">
				<input type="radio" id="rate-5" name="r_score" value="5">
				<label for="rate-5" class="fas fa-star"></label>
				<input type="radio" id="rate-4" name="r_score" value="4">
				<label for="rate-4" class="fas fa-star"></label>
				<input type="radio" id="rate-3" name="r_score" value="3">
				<label for="rate-3" class="fas fa-star"></label>
				<input type="radio" id="rate-2" name="r_score" value="2">
				<label for="rate-2" class="fas fa-star"></label>
				<input type="radio" id="rate-1" name="r_score" value="1">
				<label for="rate-1" class="fas fa-star"></label>
			</div>
			<div class="textarea_style">
				<textarea class="form-control" name="r_review" onkeyup="charCount();" rows="4" cols="37" maxlength="8000" minlength="3" 
				placeholder="Write your review here..." required></textarea>
			</div>

			<div class="button-group">
				<input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit" style="width:30%">
				<input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:30%">
			</div>
			</form>

		</div>
	</div>
</div>

<?php 
	require 'layouts/footer.php';
?>