<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

	<!DOCTYPE html>
	<html lang="en" data-bs-theme="dark">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administrator Panel</title>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
		<?php //require_once "../req/navbar.php"; 
		?>
		<br><br>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../view/Admin.php" class="btn btn-light col py-5">
						<i class="fa fa-tachometer fs-1"></i><br />
						Dashboard
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/Students.php" class="btn btn-light col py-5">
						<i class="fa fa-graduation-cap fs-1"></i><br />
						Students
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/Payments.php" class="btn btn-light col py-5">
						<i class="fa fa-money fs-1"></i><br />
						Payments
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/attendanceReport.php" class="btn btn-light col py-5">
						<i class="fa fa-calendar-check-o fs-1"></i><br />
						Attendance Report
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/newStudent.php" class="btn btn-light col py-5">
						<i class="fa fa-plus fs-1"></i><br />
						Add new Students
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/studentsInfo.php" class="btn btn-light col py-5">
						<i class="fa fa-flag fs-1"></i><br />
						Student Information
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/addClass.php" class="btn btn-light col py-5">
						<i class="fa fa-cubes fs-1"></i><br />
						Classes
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/school.php" class="btn btn-light col py-5">
						<i class="fa fa-university fs-1"></i><br />
						School
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/exams.php" class="btn btn-light col py-5">
						<i class="fa fa-pencil-square-o fs-1"></i><br />
						Exams
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/accounts.php" class="btn btn-light col py-5">
						<i class="fa fa-user fs-1"></i><br />
						Accounts
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/share.php" class="btn btn-light col py-5">
						<i class="fa fa-share-alt fs-1"></i><br />
						Share
					</a>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex justify-content-center">
					<a href="../req/logout.php" class="btn btn-warning col py-5">
						<i class="fa fa-sign-out fs-1"></i><br />
						Logout
					</a>
				</div>
			</div>
		</div>
		<br><br>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>