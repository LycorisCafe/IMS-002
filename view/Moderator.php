<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
	<!DOCTYPE html>
	<html lang="en" data-bs-theme="dark">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Moderator Panel</title>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/fonts.css">
		<link rel="stylesheet" href="../css/temp.css">
		<link href="../req/calendar.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar -->
		<link href="../req/cal-area.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar body -->
		<script src="../fontawesome.com.js" crossorigin="anonymous"></script>
	</head>

	<body>
		<header class="main-header clearfix" role="header">
			<div class="logo">
				<a href="../index.php"><em>Test</em> Name</a>
			</div>
			<a href="" class="menu-link"><i class="fa fa-bars"></i></a>
			<nav id="menu" class="main-nav" role="navigation">
				<ul class="main-menu">
					<li style='color: #fff;'>User: <?php echo $_SESSION['name']; ?></li>
					<li style='color: #fff;'>Role: <?php echo $_SESSION['role']; ?></li>
					<li style='color: #fff;'>Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
					<li><a href='../req/logout.php' class='btn btn-danger'> Logout </a></li>

				</ul>
			</nav>
		</header>



		<br><br>
		<div class="container col-lg-6">
			<br><br><br><br><br><br>
			<div class="modtext text-center">
				<h1 class="display-6">Test Name</h1>
				<h6>Moderator Panel</h6>
			</div>
			<div class="card text-center">
				<div class="card-header">
					<h4 class='display-6' style='color: #fff;'>Attendane Marking</h4>
				</div>
				<div class="card-body">
					<?php
					if (isset($_POST['submit'])) {
						if (!empty($_POST['id3'])) {
							$id3 = $_POST['id3'];
							include_once '../connection.php';
							$sql1 = "SELECT * FROM students WHERE id='$id3'";
							$result1 = mysqli_query($con, $sql1);
							if (mysqli_num_rows($result1) > 0) {
								while ($row = $result1->fetch_assoc()) {
									$stdName = $row['fname'] . ' ' . $row['lname'];
									$id3 = $row['id'];
									$_SESSION['id3'] = $id3;
									$sql10 = "SELECT * FROM regclass WHERE studentId='$id3'";
									$result10 = mysqli_query($con, $sql10);
									$row10 = mysqli_fetch_assoc($result10);
									$rid = $row10['id'];
									$sql11 = "SELECT * FROM payments WHERE regclassId='$rid'";
									$result11 = mysqli_query($con, $sql11);
									if(mysqli_num_rows($result11) > 0) {
										$row11 = mysqli_fetch_assoc($result11);
										if($row11['status'] == '0') {
											echo "<script>alert('Please Pay the Class Fees!');</script>";
										}
									}
								}
							} else {
								$em = "Student ID is invalid!";
								header("Location: Moderator.php?error=$em");
								exit;
							}
						} else {
							$em = "Student ID is required!";
							header("Location: Moderator.php?error=$em");
							exit;
						}
					}

					?>
					<form action='Moderator.php' method='POST'>
						<?php if (isset($_GET['error'])) { ?>
							<div class='alert alert-danger' role='alert'>
								<?= $_GET['error'] ?>
							</div>
						<?php } ?>
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Enter Student ID!" name='id3' autocomplete="off">
						</div>
						<div class="d-grid gap-2">
							<input class="btn btn-primary" type="submit" name='submit' value='Search'>
						</div>
						<hr>
						<div>
							<?php
							if (isset($_POST['submit'])) {
								include_once '../connection.php';
								$sql2 = "SELECT pic FROM students WHERE id='$id3'";
								$result2 = mysqli_query($con, $sql2);
								$data = mysqli_fetch_assoc($result2);
								if ($data['pic'] == "") {
									echo "<img src='../Media/dummy.jpg' class='rounded border border-success' height='150' width='150' alt='studentImage'>";
								} else {
									echo "<img src='" . $data['pic'] . "' class='rounded border border-success' height='150' width='150' alt='studentImage'>";
								}
							}
							?>

						</div><br />
					</form>
					<form action='Moderator.php' method='POST'>
						<?php
						if (isset($_POST['submit'])) {
							$std_id = $_SESSION['id3'];
							include_once '../connection.php';
							$sql7 = "SELECT id, admissionNo FROM students WHERE id='$std_id'";
							$result7 = mysqli_query($con, $sql7);
							$row7 = mysqli_fetch_assoc($result7);
							$addmissionNo = $row7['admissionNo'];
						}
						?>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Student Name'><?php if (isset($_POST['submit'])) {
															echo "Student ID: $std_id";
														} ?></b>
							</div>
						</div>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Student Name'><?php if (isset($_POST['submit'])) {
															echo "Admission No.: $addmissionNo";
														} ?></b>
							</div>
						</div>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Student Name'><?php if (isset($_POST['submit'])) {
															echo "Student Name: $stdName";
														} ?></b>
							</div>
						</div>
						<hr>
						<div class="form-check text-start">
							<input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name='day2day'>
							<label class="form-check-label" for="flexCheckChecked">Day 2 Day Paper</label>
							<?php
							$year = date("Y");
							$month = date("m");
							if (isset($_POST['finals'])) {
								$id3 = $_SESSION['id3'];
								$date = date("Y-m-d");
								$isDone = $_POST['day2day'];
								include_once '../connection.php';
								$p = $_POST['paid'];
								$sql3 = "SELECT * FROM regClass WHERE studentId='$id3'";
								$result3 = mysqli_query($con, $sql3);
								$row3 = mysqli_fetch_assoc($result3);
								$regClassId = $row3['id'];

								$sql4 = "SELECT COUNT(*) FROM attendance WHERE regclassId='$regClassId' AND date_='$date'";
								$result4 = mysqli_query($con, $sql4);
								$row4 = mysqli_fetch_assoc($result4);
								$count = $row4['COUNT(*)'];
								if ($count == 0) {
									$sql10 = "UPDATE regclass SET attendance='1' WHERE studentId='$id3'";
									$result10 = mysqli_query($con, $sql10);
									$sql5 = "INSERT INTO attendance (regclassId, date_, d2d) VALUES ('$regClassId', '$date', '$isDone')";
									$result5 = mysqli_query($con, $sql5);
									if ($result5 && $result10) {
										if ($p == 1) {
											$sql6 = "SELECT * FROM payments WHERE regclassId='$regClassId' AND year='$year' AND month='$month'";
											$result6 = mysqli_query($con, $sql6);
											if (mysqli_num_rows($result6) == 0) {
												$sql7 = "INSERT INTO payments (regclassId, year, month, status) VALUES ('$regClassId', '$year', '$month', '1')";
												$result7 = mysqli_query($con, $sql7);
												if ($result7) {
													echo "<script>alert('Attendance Marked!');</script>";
													header("Refresh:0; url=Moderator.php");
												}
											} else {
												$row6 = mysqli_fetch_assoc($result6);
												if($row6['status'] == "0") {
													$sql7 = "UPDATE payments SET status='1'";
													if(mysqli_query($con, $sql7)) {
														echo "<script>alert('Attendance Marked!');</script>";
														header("Refresh:0; url=Moderator.php");
													}
												} else {
													$em = "Already paid the class fees!";
												 	header("Location: Moderator.php?error=$em");
												 	exit;
												}
											}
										} else {
											$sql8 = "SELECT * FROM payments WHERE regclassId='$regClassId' AND year='$year' AND month='$month' AND status='0'";
											$result8 = mysqli_query($con, $sql8);
											if (mysqli_num_rows($result8) == 0) {
												$sql9 = "INSERT INTO payments (regclassId, year, month, status) VALUES ('$regClassId', '$year', '$month', '0')";
												$result9 = mysqli_query($con, $sql9);
												if ($result9) {
													echo "<script>alert('Attendance Marked!');</script>";
													header("Refresh:0; url=Moderator.php");
												}
											} 

											 else {
											 	$em = "Please Pay the Class Fees!";
											 	header("Location: Moderator.php?error=$em");
											 	exit;
											 }
										}
									}
								} else {
									$em = "Already marked the attendance!";
									header("Location: Moderator.php?error=$em");
									exit;
								}
							}
							?>
						</div>
						<div class="form-check text-start">
							<input class="form-check-input" type="checkbox" value="1" id="fees" name='paid'>
							<label class="form-check-label" for="fees">Paid/ Not Paid</label>
						</div>


						<?php
						require_once '../connection.php';
							if(isset($_POST['finish'])) {
								$sql11 = "UPDATE regclass SET attendance=0";
								$result11 = mysqli_query($con, $sql11);
								if($result11) {
									echo "<script>alert('Done');</script>";
								}
							}
							
						?>


						<div class="d-grid gap-2">
							<input class="btn btn-primary" type="submit" name='finals' value='Mark as Attend!'>
						</div>
						<div class="d-grid gap-2">
							<br/><button class="btn btn-warning" name="finish">Finish</button>
						</div>


				</div>
			</div>
			</form>
		</div>
		<hr style="border: 2px solid red;">
		<!-- CAALENDAR AREA -->
		<div class="container">
			<?php
			if (isset($_POST['submit'])) {
				$std_id = $_SESSION['id3'];
				include '../req/Calendar.php';
				include '../connection.php';
				$fulldate = date("Y-m-d");
				$sys_date = date("d");
				$sys_month = date("m");
				$sys_year = date("Y");
				$firstDay = date('Y-m-01');
				$lastDay = date('Y-m-t');
				$calendar = new Calendar($fulldate);
				$sql5 = "SELECT id FROM regClass WHERE studentId='$std_id'";
				$result5 = mysqli_query($con, $sql5);
				$row5 = mysqli_fetch_assoc($result5);
				$reclassid = $row5['id'];

				$sql6 = "SELECT * FROM attendance WHERE '$firstDay' <= date_ and date_ <= '$lastDay' AND regclassId='$reclassid'";
				$result6 = mysqli_query($con, $sql6);
				if (mysqli_num_rows($result6) > 0) {
					while ($row6 = mysqli_fetch_assoc($result6)) {
						$date = $row6['date_'];
						$d2d_done = $row6['d2d'];
						if ($d2d_done == '1') {
							$calendar->add_event('Attended, D2D', $date, 1, 'green');
						} else {
							$calendar->add_event('Attended', $date, 1, 'orange');
						}
					}
				}
			}
			?>
			<nav class="navtop">
				<div>
					<h1>Day to Day Paper</h1>
				</div>
			</nav>
			<div class="content home">
				<?php if (isset($_POST['submit'])) {
					echo $calendar;
				} ?>
			</div>
		</div>
		</div>
		<br><br>
		<br><br>

		<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../js/isotope.min.js"></script>
		<script src="../js/sftthaksalawacustom.js"></script>
		<?php include '../req/footer.php'; ?>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>