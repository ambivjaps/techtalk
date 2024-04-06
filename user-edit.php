<?php
	require 'layouts/header.php';
	include 'includes/dbh.inc.php';

	if(empty($_SESSION['u_id'])) {
		header("location: home.php");
	}

	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		$user_acc = "SELECT * FROM user WHERE u_id = $id";
		$result = mysqli_query($conn, $user_acc);
		$user_current = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
	}
?>
<?php
if(isset($_POST['submit'])) {
	$u_id = $_SESSION['u_id'];

	$u_lname = $_POST['u_lname'];
	$u_fname = $_POST['u_fname'];
    $u_user = $_POST['u_user'];
	$u_pwd = password_hash($_POST['u_pwd'], PASSWORD_DEFAULT);
	$u_bio = mysqli_real_escape_string($conn, $_POST['u_bio']);
	$u_email = $_POST['u_email'];

	$new_image = $_FILES['u_avatar']['name'];
	$old_image = $_POST['u_avatar_old'];

	if($new_image != '') {
		$update_filename = 'img/upload/' . $_FILES['u_avatar']['name'];
	} else {
		$update_filename = $old_image;
	}

	if(file_exists("img/upload/" . $_FILES['u_avatar']['name'])) {
	} else {
		$query = "UPDATE user SET u_avatar='$update_filename' WHERE u_id='$u_id' ";
		$query_run = mysqli_query($conn, $query);

		if($query_run) {
			if($_FILES['u_avatar']['name'] != '') {
				move_uploaded_file($_FILES['u_avatar']['tmp_name'], "img/upload/" . $_FILES['u_avatar']['name']);
				unlink($old_image);
			}
		} else {
			?>
			<script>
			swal("Error", "Error occurred while saving changes to profile.", "error");
			</script>
		<?php
		}
	}

	$profile_query = "UPDATE user SET u_lname='$u_lname', u_fname='$u_fname',u_user='$u_user',u_pwd='$u_pwd',u_bio='$u_bio',u_email='$u_email'
			 WHERE u_id='$u_id' ";
    $edit_profile = mysqli_query($conn, $profile_query);

    if($edit_profile) {
		?>
		<script>
		swal("Success!", "Your profile has been updated!", "success");
		</script>
		<?php
        $_SESSION['u_lname'] = $_POST['u_lname'];
        $_SESSION['u_fname'] = $_POST['u_fname'];
        $_SESSION['u_user'] = $_POST['u_user'];
        $_SESSION['u_email'] = $_POST['u_email'];
        $_SESSION['u_bio'] = $_POST['u_bio'];
    } else {
        header('Location: user-edit.php');
    }
}
?>

<title> Edit Profile | TechTalk </title>
<link rel="stylesheet" src="css/form.css">
<style>
	.user-bio {
    margin-left: 16px;
	}

	#back {
		color: #fff;
		float: right;
		margin: 11px;
		font-size: 28px;
		cursor: pointer;
	}
</style>
<style>
	hr.line {
		border: 1px solid #777;
	}
	a:link,
	a:active,
	a:visited {
		color: #a05801;
		text-decoration: underline;
		transition: 0.5 ease;
	}

	#edit {
		padding: 2% 0;
		padding-right: 80px;
	}

	#edit .upload-profile-image {
		position: relative;
		width: 10%;
		margin-left: auto;
		margin-right: auto;
		transition: filter .8s ease;
	}

	#edit .upload-profile-image:hover {
		filter: drop-shadow(1px 1px 12px #7584bb);
	}

	#upload-profile {
		position: absolute;
		top: 0;
		right:-200%;
		z-index: 10;
		width: 200px;
		margin-top: 0px;
		opacity: 0;
	}

	#upload-profile::-webkit-file-upload-button {
		visibility: hidden;
	}

	#upload-profile::before {
		content: '';
		display: inline-block;
		width: 200px;
		height: 200px;
		cursor: pointer;
		border-radius: 50%;
	}

	#edit .upload-profile-image .camera-icon {
		position: absolute;
		top: 70px;
		width: 60px !important;
		filter: invert(30%) !important;
	}

	#edit .upload-profile-image:hover .camera-icon {
		filter: invert(100%) !important;
	}

	input[type='text']::-webkit-input-placeholder{
    	color: #a05801;
	}
	input[type='email']::-webkit-input-placeholder{
    	color: #a05801;
	}
	input[type='password']::-webkit-input-placeholder{
    	color: #a05801;
	}
	#edit-form textarea::-webkit-input-placeholder {
		color: #a05801;
	}
	
	input[type='text']::-moz-input-placeholder{
    	color: #a05801;
	}
	input[type='email']::-moz-input-placeholder{
    	color: #a05801;
	}
	input[type='password']::-moz-input-placeholder{
    	color: #a05801;
	}
	#edit-form textarea::-moz-input-placeholder {
		color: #a05801;
	}

	input[type='text']::-ms-input-placeholder{
    	color: #a05801;
	}
	input[type='email']::-ms-input-placeholder{
    	color: #a05801;
	}
	input[type='password']::-ms-input-placeholder{
    	color: #a05801;
	}
	#edit-form textarea::-ms-input-placeholder {
		color: #a05801;
	}

	input[type='text']::placeholder{
    	color: #a05801;
	}
	input[type='email']::placeholder{
    	color: #a05801;
	}
	input[type='password']::placeholder{
    	color: #a05801;
	}
	#edit-form textarea::placeholder {
		color: #a05801;
	}

	#edit-form input[type='text'],
	#edit-form input[type='email'],
	#edit-form input[type='password'] {
		border: none;
		border-radius: unset;
		border-bottom: 1px solid #777;
		background-color: transparent;
		color: #fbfbfb;
	}

	#edit-form input[type='text'],
	#edit-form input[type='email'],
	#edit-form input[type='password'] {
		outline: none;
		box-shadow: none;
	}

	#edit-form textarea {
		border: none;
		border-radius: unset;
		border-bottom: 1px solid #777;
		background-color: transparent;
		color: #fbfbfb;
	}

	#edit-form textarea{
		outline: none;
		box-shadow: none;
	}

	.col {
		margin-bottom: 8px;
	}

	#submit {
		color: #f2f2f2;
		font-weight: 500;
		background-color: #a05801;
		border: #a05801 1px solid;
		border-radius: 16px;
		transition: all 0.3s ease;
	}

	#submit:hover {
		color: #FFA500;
		background-color: #333;
		border: #a05801 1px solid;
		transform: scale(0.95); 
	}
</style>

<div class="container my-5">
	<div class="row mb-5">
	<?php
		$selection = "SELECT * FROM user WHERE u_id = '".$_SESSION['u_id']."'";
		$bioquery = mysqli_query($conn, "SELECT u_bio FROM user WHERE u_id = '".$_SESSION['u_id']."'", mysqli_store_result($conn));

		$bio = mysqli_fetch_row($bioquery);

		$_SESSION['u_bio'] = $bio[0];

		$r = mysqli_query($conn, $selection);

		if(mysqli_num_rows($r) > 0) {
			while($row = mysqli_fetch_assoc($r)) {
		?>
		<div class="col-md-2">
	   		<img class="mb-3" width="100%" src="<?php echo $row['u_avatar']; ?>" title="<?php echo $user_current['u_user']; ?>" style="visibility:hidden;">
	   	</div>

	   	<div class="col-md-10">
			<div class="tech-head mb-3"><h1 align="left"><?php echo $row['u_user']; ?>
			<a href="user.php"><i class="fas fa-address-card" id="back" data-toggle="tooltip" title="Back to Profile"></i></a></h1></div>

			<section id="edit">
				<div class="d-flex justify-content-center">
						<form action="user-edit.php" method="POST" enctype="multipart/form-data" id="edit-form">
							<div class="upload-profile-image d-flex justify-content-center pb-5">
							<div class="text-center">
								<div class="d-flex justify-content-center">
									<img class="camera-icon" src="./img/camera_icon.png" alt="camera">
								</div>
								<img src="<?php echo $row['u_avatar']; ?>" style="width:190px; height:200px" id="imgDisplay" class="img rounded-circle" alt="person">
								<small class="form-text text-warning">Choose Image</small>
								<input type="file" class="form-control-file" onchange="readURL(this)" value="" name="u_avatar" id="upload-profile">
								<input type="hidden" name="u_avatar_old" id="upload-profile" onchange="readURL(this)" value="<?php echo $row['u_avatar']; ?>">
							</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<input type="text" name="u_fname" id="u_fname" class="form-control" value="<?=$_SESSION['u_fname']?>" placeholder="<?php echo $row['u_fname']; ?>">
								</div>
								<div class="col-sm-6">
									<input type="text" name="u_lname" id="u_lname" class="form-control" value="<?=$_SESSION['u_lname']?>" placeholder="<?php echo $row['u_lname']; ?>">
								</div>
							</div>

							<div class="form-row my-4">
								<div class="col">
									<input type="text" name="u_user" id="u_user" class="form-control" value="<?=$_SESSION['u_user']?>" placeholder="<?php echo $row['u_user']; ?>">
								</div>
								<div class="col">
									<input type="email" name="u_email" id="u_email" class="form-control" value="<?=$_SESSION['u_email']?>" placeholder="<?php echo $row['u_email']; ?>">
								</div>
								<div class="col">
									<input type="text" name="u_bio" id="u_bio" class="form-control" value="<?=$_SESSION['u_bio']?>" placeholder="<?php echo $row['u_bio']; ?>"></textarea>
								</div>
							</div>

							<div class="form-row my-4">
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
								<div class="col">
									<input type="password" name="u_pwd" id="u_pwd" class="form-control" placeholder="Password" onchange='check_pass();' required>
								</div>
								<div class="col">
									<input type="password" name="c_pwd" id="c_pwd" class="form-control" placeholder="Confirm Password" onchange='check_pass();' required>
									<small id="c_error" class="text-danger"></small>
								</div>
							</div>
							<div class="text-center">
								<input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Edit Profile">
							</div>
						</form>
					</div>
			</section>
		</div>
		<?php }
		} ?>

	</div>

	<div class="tech-rev mb-3"> <h2> Recent reviews </h2> </div>
	<table id="datatable" class="table table-bordered sched-data">
						<thead>
							<tr>
							<th></th>
							<th>Product</th>
							<th>Rated</th>
							<th>Review</th>
							<th>Date & Time</th>
							</tr>
						</thead>

						<tbody>
						<?php
						$select = "SELECT * FROM rating
						LEFT JOIN product ON r_pid = p_id
						WHERE rating.r_uid ='".$_SESSION['u_id']."'";
						$query_run = $conn->query($select);

						if($query_run) {
						    $num_rows = 1;
							foreach($query_run as $row) {
						?>
						
							<tr id="<?php echo $row['r_id'] ?>">
							    <td><?php echo $num_rows++; ?></td>
								<td><?php echo $row['p_name']; ?></td>
								<td><?php echo $row['r_score'] ?></td>
								<td><?php echo $row['r_review'] ?></td>
								<td><?php echo $row['created_at'] ?></td>
							</tr>
						<?php }
						} else {
							echo "No Reviews Found";
						} ?>
						</tbody>


					</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js" integrity="sha512-X7kCKQJMwapt5FCOl2+ilyuHJp+6ISxFTVrx+nkrhgplZozodT9taV2GuGHxBgKKpOJZ4je77OuPooJg9FJLvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ntegrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<script>
	$('#u_pwd, #c_pwd').on('keyup', function () {
	if ($('#u_pwd').val() == $('#c_pwd').val()) {
		$('#c_error').html('Passwords Matching').css('color', 'green');
	} else 
		$('#c_error').html('Passwords Not Matching').css('color', 'red');
	});

	function check_pass() {
		if (document.getElementById('u_pwd').value ==
				document.getElementById('c_pwd').value) {
			document.getElementById('submit').disabled = false;
		} else {
			document.getElementById('submit').disabled = true;
		}
	}

	function readURL(el) {
    if (el.files && el.files[0]) {
         var FR= new FileReader();
         FR.onload = function(e) {
              $("#imgDisplay").attr("src", e.target.result);
              socket.emit('image', e.target.result);
              console.log(e.target.result);
         };       
         FR.readAsDataURL( el.files[0] );
    } 
};
</script>

<?php 
	require 'layouts/footer.php';
?>