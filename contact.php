<title> Contact Us | TechTalk </title>
<style>
	.container-wrapper {
		margin-top: 30px;
		padding-right: 40%;
		padding-bottom: 50px;
	}

	.btn {
		margin-left: 2px;
		margin-right: 2px;
	}

	.form-group .form-control:not(#c_message) {
		width: 650px;
	}
	
	.form-group label {
		color: #FFA500;
	}

	#submit {
	color: #f2f2f2;
	font-weight: 500;
	background-color: #a05801;
	border: #a05801 1px solid;
	transition: all 0.3s ease;
}

	#submit:hover {
		color: #FFA500;
		background-color: #333;
		border: #a05801 1px solid;
		transform: scale(0.95); 
	}

	#reset {
	color: #FFA500;
	font-weight: 500;
	background-color: #333;
	border: #333 1px solid;
	transition: all 0.3s ease;
}

	#reset:hover {
		color: #f2f2f2;
		background-color: #a05801;
		border: #333 1px solid;
		transform: scale(0.95); 
	}
</style>

<?php 
	require 'layouts/header.php';
?>

<div class="container my-5">
	<h2> Contact Form </h2>
	<hr>
		<p> Do you have any comments, suggestions, or questions regarding our website? Feel free to use our contact form below. <br> Rest assured we'll get back to you immediately! </p>
		
		<div class="container-wrapper">
		<div class="form-group">

			<form method="POST" action="mailto:techtalkph@gmail.com" enctype="text/plain">

			<div class="mb-3">
				<label for="name"> Name: </label>
				<input type="text" class="form-control" id="c_name" name="c_name" placeholder="Enter your name." required>
			</div>

			<div class="mb-3">
				<label for="email"> E-mail Address: </label>
				<input type="email" class="form-control" id="c_email" name="c_email" placeholder="Enter your e-mail address." required>
			</div>

			<div class="mb-3">
				<label for="subject"> Subject: </label>
				<input type="text" class="form-control" id="c_subject" name="c_subject" placeholder="Enter your subject." required>
			</div>

			<div class="mb-3">
				<label for="message" class="form-label">Message: </label>
				<textarea class="form-control" id="c_message" rows="8" placeholder="Enter your message here." required></textarea>
			</div>

			<input class="btn btn-success mt-3" type="submit" id="submit" name="submit" value="Submit Message" style="width:30%">
			<input class="btn btn-danger mt-3" type="reset" id="reset" value="Reset Form" style="width:30%">

			</form>

		</div>
	</div>
</div>


<?php 
	require 'layouts/footer.php';
?>