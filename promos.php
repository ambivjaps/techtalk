<title> Promos | TechTalk </title>

<?php 
	require 'layouts/header.php';

	if(empty($_SESSION['u_id'])) {
		header("location: home.php");
	}
?>

<div class="container my-5">
	<h2> Get a chance to win an iPhone! </h2>
	<hr>
	<h5> Mechanics: </h5>
	<h6> - User should be logged in to access the promos page. </h6>
	<h6> - User must be registered on our official website. </h6>
	<h6> - User should attend TechTalk events to get his/her promo code. </h6> 
	<h6> - One valid promo code per user only. No duplicate submissions. </h6>

<div class="form-group my-5">
		
	<form method="POST" action="promos.php">

		<div class="mb-3">
    		<label for="guess"> Promo Code: </label>
    		<input type="text" class="form-control" id="pcode" name="pcode" style="width:50%" required>
  		</div>

  		<br>

		<input class="btn btn-success" type="submit" name="submit" value="Submit Code" style="width:30%">

	</form>

</div>

		<?php 
			if  (! isset($_POST['pcode'])) {
				echo("<i> No promo code input yet. Try something.. </i>");

			} else if (! is_numeric($_POST['pcode'])) {
				echo("<i> Oops! User guess is <strong> not a number. </strong></i>");

			} else if ( strlen($_POST['pcode']) < 1 ) {
				echo("<i> Sorry.. You guessed <strong> too short. </strong></i>");

			} else if ( $_POST['pcode'] < 12621) {
				echo("<i> Oops! Invalid promo code. </i>");

			} else if ( $_POST['pcode'] > 12621) {
				echo("<i> Sorry.. Invalid promo code. </i>");

			} else {
				echo("<h3> Congratulations! You knew it. <strong>".$_POST['pcode']." is the promo code! </strong></h3>");
				echo("Screenshot this page and e-mail it to promos@techtalk.ph to redeem your prize.");
			}
		?>
	</div>

<?php 
	require 'layouts/footer.php';
?>