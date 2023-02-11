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
		<?php //require_once "../req/navbar.php"; ?>
		<div class="container mt-5" style="transform: translate(0%, 10%);">
			<div class="container col-sm-12 col-lg-8">
				<div class="row p-3 d-flex justify-content-center">
					<a href="../view/Admin.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-tachometer fs-1"></i><br/>
						Dashboard<br>
					</a>

					<a href="../req/Students.php" class="col-sm-12 col-lg-6 btn btn-light gap-3 "><br>
						<i class="fa fa-graduation-cap fs-1"></i><br/>
						Students<br>
					</a>
</div>
<div class="row p-3 d-flex justify-content-center">

					<a href="../req/Payments.php" class="col-sm-12 col-lg-6 btn btn-light gap-3 "><br>
						<i class="fa fa-money fs-1"></i><br/>
						Payments<br>
					</a>

					<a href="../req/attendanceReport.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-calendar-check-o fs-1"></i><br/>
						Attendance Report<br>
					</a>
</div>
<div class="row p-3 d-flex justify-content-center">

					<a href="../req/newStudent.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-plus fs-1"></i><br/>
						Add new Students<br>
					</a>

					<a href="../req/studentsInfo.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-flag fs-1"></i><br/>
						Student Information<br>
					</a>
</div>
<div class="row p-3 d-flex justify-content-center">

					<a href="../req/addClass.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-cubes fs-1"></i><br/>
						Classes<br>
					</a>

					<a href="../req/exams.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-pencil-square-o fs-1"></i><br/>
						Exams<br>
					</a>
</div>
<div class="row p-3 d-flex justify-content-center">

					<a href="../req/accounts.php" class="col-sm-12 col-lg-6 btn btn-light gap-3"><br>
						<i class="fa fa-user fs-1"></i><br/>
						Accounts<br>
					</a>
					<a href="../req/logout.php" class="col-sm-12 col-lg-6 btn btn-warning gap-3" ><br>
						<i class="fa fa-sign-out fs-1"></i><br/>
						Logout<br>
					</a>
</div>
				</div>
			</div>
		</div>
	</body>

</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>
