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
		<div class="container mt-5" style="transform: translate(10%, 10%);">
			<div class="container text-center">
				<div class="row row-cols-4">
					<a href="../view/Admin.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-tachometer fs-1"></i><br/>
						Dashboard
					</a>

					<a href="../req/Students.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-graduation-cap fs-1"></i><br/>
						Students
					</a>

					<a href="../req/Payments.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-money fs-1"></i><br/>
						Payments
					</a>

					<a href="../req/attendanceReport.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-calendar-check-o fs-1"></i><br/>
						Attendance Report
					</a>

					<a href="../req/newStudent.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-plus fs-1"></i><br/>
						Add new Students
					</a>

					<a href="../req/studentsInfo.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-flag fs-1"></i><br/>
						Student Information
					</a>

					<a href="../req/addClass.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-cubes fs-1"></i><br/>
						Classes
					</a>

					<a href="../req/school.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-university fs-1"></i><br/>
						School
					</a>

					<a href="../req/exams.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-pencil-square-o fs-1"></i><br/>
						Exams
					</a>

					<a href="../req/accounts.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-user fs-1"></i><br/>
						Accounts
					</a>
					<a href="../req/share.php" class="col btn btn-light m-1 py-5">
						<i class="fa fa-share-alt fs-1"></i><br/>
						Share
					</a>
					<a href="../req/logout.php" class="col btn btn-warning m-1 py-5" >
						<i class="fa fa-sign-out fs-1"></i><br/>
						Logout
					</a>
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
