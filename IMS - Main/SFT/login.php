<!doctype html>
<html lang="en" data-bs-theme="dark">
		<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Login</title>
				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
				<style>
						body {
								background-image: url('Media/images/bg.jpg');
								background-repeat: no-repeat;
								background-attachment: fixed;
								background-size: cover;
						}
				</style>
		</head>

		<?php
					require_once 'controller/connection.php';
					if(isset($_POST['submit'])){
            $usrname = $_POST['username'];
            $psdw = $_POST['password'];
        
            $sql = "SELECT username, password FROM accounts where username='".$usrname."';";
            $result = mysqli_query($con, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['username'] == $usrname && $row['password'] == $psdw)
                    {
												if($usrname == "admin")
												{
													header("Location: view/Admin.php");
												}
												else
												{
													header("Location: view/Moderator.php");
												}
                        // header('Location: aboutUs.html');
                    }else
                    {
                        echo "Login faild.";
                    }
                }
					}
				}
		?>

		<body>
				<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
						<div class="container-fluid">
								<a class="navbar-brand" href="https://sftthaksalawa.com" style="font-weight: 900;"><span style="color: rgb(0, 191, 161);">SFT</span> තක්සලාව</a>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarCollapse">
								<ul class="navbar-nav me-auto mb-2 mb-md-0">
									<li class="nav-item">
										<a class="nav-link active" aria-current="page" href="index.html">Home</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="login.php">Login</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" href="aboutUs.html">About Us</a>
									</li>
								</ul>
								<form class="d-flex">
									<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
									<button class="btn btn-outline-success" type="submit">Search</button>
								</form>
							</div>
						</div>
					</nav>
				
				<div class="container col-lg-4 col-md-5 align-self-center">
						<div class="card" style="transform: translate(0%, 50%);">
								<div class="card-header text-center">
										<h3><i>Login</i></h3>
								</div>
								<div class="card-body">
										<form action="login.php"  method="POST">
												<div class="col-auto mb-3">
														<label class="form-label">Username :</label>
														<input type="text" class="form-control" name="username" aria-describedby="username" autocomplete="off" required>
												</div>
												<div class="col-auto mb-3">
														<label class="form-label">Password :</label>
														<input type="password" class="form-control" name="password" aria-describedby="password" autocomplete="off" required>
														<!-- <label class="font-monospace text-danger"><i>${label}</i></label> -->
												</div>
												<div class="mb-3 form-check">
														<input type="checkbox" class="form-check-input" name="keeplogin">
														<label class="form-check-label">Remember me!</label>
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
		</body>
</html>