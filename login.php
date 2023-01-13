<?php

setcookie("data-bs-theme", "dark", time() + 1814400);

?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="icon" type="image/x-icon" href="Media/favicon.png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/fonts.css">
	<!-- <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="css/temp.css">
	<script src="fontawesome.com.js" crossorigin="anonymous"></script>
	<style>
		body {
			background-image: url('Media/images/bg.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>
</head>

<body>
	<header class="main-header clearfix" role="header">
		<div class="logo">
			<a href="index.php"><em>SFT</em> තක්සලාව</a>
		</div>
		<a href="" class="menu-link"><i class="fa fa-bars"></i></a>
		<nav id="menu" class="main-nav" role="navigation">
			<ul class="main-menu">
				<li><a href="index.php">Home</a></li>

				<li><a href="aboutUs.php">About Us</a></li>
				<li><a href="login.php">Login</a></li>

			</ul>
		</nav>
	</header>

	<div class="container col-lg-4 col-md-5 align-self-center">
		<div class="card" style="transform: translate(0%, 50%);">
			<div class="card-header text-center">
				<h3 style="color: #000;">Login</h3>
			</div>
			<div class="card-body">
				<?php if (isset($_GET['error'])) { ?>
					<div class='alert alert-danger' role='alert'>
						<?= $_GET['error'] ?>
					</div>
				<?php } ?>
				<form action="req/login.php" method="POST">
					<div class="col-auto mb-3">
						<label class="form-label">Login As :</label>
						<select class="form-control" name='role'>
							<option value='1'>Administrator</option>
							<option value='2'>Moderator</option>
						</select>

					</div>
					<div class="col-auto mb-3">
						<label class="form-label">Username :</label>
						<input type="text" class="form-control" name="uname" aria-describedby="username" autocomplete="off">
					</div>
					<div class="col-auto mb-3">
						<label class="form-label">Password :</label>
						<input type="password" class="form-control" name="pass" aria-describedby="password" autocomplete="off">
						<!-- <label class="font-monospace text-danger"><i>${label}</i></label> -->
					</div>
					<div class="d-grid gap-2">
						<button type="submit" class="btn btn-primary" name='submit'>Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br><br><br>

	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/sftthaksalawacustom.js"></script>

</body>

</html>