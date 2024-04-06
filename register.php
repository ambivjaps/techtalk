<title>Register | TechTalk</title>
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

	#register {
		padding: 5% 0;
	}

	#register .upload-profile-image {
		position: relative;
		width: 10%;
		margin-left: auto;
		margin-right: auto;
		transition: filter .8s ease;
	}

	#register .upload-profile-image:hover {
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

	#register .upload-profile-image .camera-icon {
		position: absolute;
		top: 70px;
		width: 60px !important;
		filter: invert(30%) !important;
	}

	#register .upload-profile-image:hover .camera-icon {
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
	
	input[type='text']::-moz-input-placeholder{
    	color: #a05801;
	}
	input[type='email']::-moz-input-placeholder{
    	color: #a05801;
	}
	input[type='password']::-moz-input-placeholder{
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

	input[type='text']::placeholder{
    	color: #a05801;
	}
	input[type='email']::placeholder{
    	color: #a05801;
	}
	input[type='password']::placeholder{
    	color: #a05801;
	}

	#reg-form input[type='text'],
	#reg-form input[type='email'],
	#reg-form input[type='password'] {
		border: none;
		border-radius: unset;
		border-bottom: 1px solid #777;
		background-color: transparent;
		color: #fbfbfb;
	}

	#reg-form input[type='text'],
	#reg-form input[type='email'],
	#reg-form input[type='password'] {
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

<?php require 'layouts/header.php'; ?>
<?php
include 'includes/register.inc.php';
$user = new Registration();
if(isset($_POST['submit'])) {
	$timestamp = date("Y-m-d H:i:s");

	$image = $_FILES['u_avatar']['name'];  
    $temp_name = $_FILES['u_avatar']['tmp_name'];  
    if(isset($image) and !empty($image)){
        $location = './img/upload/';      
        if(move_uploaded_file($temp_name, $location.$image)){
            echo '';
    	}
        } else {
            $image = 'img/person_black.png';
        }

    $u_lname = $_POST['u_lname'];
	$u_fname = $_POST['u_fname'];
    $u_user = $_POST['u_user'];
	$u_pwd = $_POST['u_pwd'];
	$u_bio = "Default profile bio.";

    $u_email = $_POST['u_email'];
  
    $user->registerUser($u_lname,$u_fname,$u_user,$u_pwd,$u_bio,$u_email,$image,$timestamp);
	?>
	<script>
		swal("Success!", "Your registration has been successful!", "success");
	</script>
	<?php
}
?>
	
<div class="container my-2">
	<section id="register">
		<div class="row m-0">
			<div class="wrapper col-4 offset-md-4 form-div">
				<div class="text-center pb-2">
					<h4 style="color: #FFA500;">Registration</h4>
					<span><a href="login.php">I already have an account</a></span>
					<hr class="line">
				</div>
				<div class="d-flex justify-content-center">
					<form action="register.php" method="POST" enctype="multipart/form-data" id="reg-form">
						<div class="upload-profile-image d-flex justify-content-center pb-5">
						<div class="text-center">
							<div class="d-flex justify-content-center">
								<img class="camera-icon" src="./img/camera_icon.png" alt="camera">
							</div>
							<img src="./img/person_black.png" style="width:190px; height:200px" id="imgDisplay" class="img rounded-circle" alt="person">
							<small class="form-text text-warning">Choose Image</small>
							<input type="file" class="form-control-file" onchange="readURL(this)" value="" name="u_avatar" id="upload-profile">
						</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<input type="text" name="u_fname" id="u_fname" class="form-control" placeholder="First Name" required>
							</div>
							<div class="col-sm-6">
								<input type="text" name="u_lname" id="u_lname" class="form-control" placeholder="Last Name" required>
							</div>
						</div>

						<div class="form-row my-4">
						<div class="col">
								<input type="text" name="u_user" id="u_user" class="form-control" placeholder="Username" required>
							</div>
							<div class="col">
								<input type="email" name="u_email" id="u_email" class="form-control" placeholder="Email Address" required>
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
							<input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Register">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
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