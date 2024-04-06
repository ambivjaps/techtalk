<?php
	session_start();
?>

<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta name="description" content="By tech enthusiasts, for the tech enthusiasts." />
		<meta name="keywords" content="TechTalk, Philippines, technology, reviews, products, tech" />

		<meta property="og:url"                content="https://techtalkph.epizy.com/admin" />
		<meta property="og:title"              content="Admin - TechTalk Philippines" />
		<meta property="og:description"        content="By tech enthusiasts, for the tech enthusiasts." />
		<meta property="og:image"              content="img/bg_og.jpg" />

		<link rel="icon" href="img/favicon.png" type="image/x-icon"/>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
   		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'/>
		<link rel="stylesheet" type="text/css" href="css/admin.css?<?php echo time(); ?>">
	</head>

	<body>

	<header>
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  			<div class="container-fluid">
	 		<a class="navbar-brand" href="admin.php"><img src="img/logo_nav.png" alt="Logo" title="TechTalk Philippines" width="150"></a>

	 		<button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
    		</button>

		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">

		<?php
			if (isset($_SESSION['a_id'])){
				echo '<div class="navbar-nav me-auto text-center">
					<a class="nav-link" href="admin_dashboard"> <i class="fas fa-home"></i> Dashboard </a>
					<a class="nav-link" href="admin_products"> <i class="fas fa-microchip"></i> Products </a>
					<a class="nav-link" href="admin_videos"> <i class="fas fa-play"></i> Videos</a>
					<a class="nav-link" href="admin_slides"> <i class="fas fa-images"></i> Slideshow </a>
					<a class="nav-link" href="admin_users"> <i class="fas fa-play"></i> Users </a>
				</div>';

				echo '<i class="fas fa-user"></i> &nbsp <a class="user" href="admin_profile.php?id='.$_SESSION['a_id'].'">'.$_SESSION['a_user'].'</a>&nbsp;&nbsp;
						
						<form class="form-inline" action="includes/logout_admin.inc.php" method="POST">
							<button class="btn btn-secondary my-3 my-sm-0" id="logout" name="logout" type="submit"> <i class="fas fa-sign-out-alt"></i> Logout</button>
						</form>
					</div>';

			} else {
				echo 'Welcome! Please login.';
			}
		?>

		</div>	
  		</div>
		</nav>

	</header>