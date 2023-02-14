<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

	<!doctype html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Modarator</title>
		<script src="../js/jquery-3.6.3.min.js"></script>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/toastr.css" rel="stylesheet">
		<script src="../js/toastr.js"></script>
		<link href="../req/calendar.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar -->
		<link href="../req/cal-area.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar body -->
	</head>

	<body>
		<nav class="navbar bg-body-tertiary" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand">Lycoris Cafe</a>
				<div class="d-flex d-grid gap-2">
					<span style='color: #fff;' class="navbar">User: <?php echo $_SESSION['name']; ?></span>
					<span style='color: #fff;' class="navbar">&nbsp;&nbsp;Role: <?php echo $_SESSION['role']; ?></span>
					<a href="../req/logout.php" class="btn btn-danger">Logout</a>
				</div>
			</div>
		</nav>
		<br><br>
		<div class="container col-sm-12 col-lg-5">
			<div class="card text-center">
				<div class="card-header">
					<h2>Attendance Marking</h2>
				</div>
					<div class="d-grid gap-2">
					<div class="card-body">
						<?php if (isset($_GET['error'])) { ?>
							<div class='alert alert-danger' role='alert'>
								<?= $_GET['error'] ?>
							</div>
						<?php } ?>
						<?php if (isset($_GET['success'])) { ?>
							<div class='alert alert-success' role='alert'>
								<?= $_GET['success'] ?>
							</div>
						<?php } ?>
						<form action="Moderator.php" method="post">
							<div class="input-group mb-2">
							<input type="text" class="form-control" placeholder="Student ID" name="id" autocomplete="off" value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $_POST['id'];}?>">
							</div>
							<div class="d-grid gap-2">
							<button class="btn btn-primary col-12" name="attend">Search & Mark as Attend</button>
							<button class="btn btn-outline-primary col-12" name="search">Search</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php
		$img = "";
		$id = "";
		require_once '../connection.php';
		if (isset($_POST['search'])) {
			if (!empty($_POST['id'])) {
				$id = $_POST['id'];
				$sql1 = "SELECT * FROM students WHERE id='$id'";
				$result1 = mysqli_query($con, $sql1);
				if(mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$name = $row1['fname']." ". $row1['lname'];
					$id = $row1['id'];
					$_SESSION['id'] = $id;
					$admissionNo = $row1['admissionNo'];
					$img = $row1['pic'];
				} else {
					$em = "Invalid Student ID testone";
					header("Location: Moderator.php?error=$em");
					exit;
				}
			} else {
				$em = "Please enter the Student ID";
				header("Location: Moderator.php?error=$em");
				exit;
			}
		}
		if(isset($_POST['attend'])) {
			if (!empty($_POST['id'])) {
				$id = $_POST['id'];
				$today = date("Y-m-d");
				$sql1 = "SELECT * FROM students WHERE id='$id'";
				$result1 = mysqli_query($con, $sql1);
				if(mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$name = $row1['fname']." ". $row1['lname'];
					$id = $row1['id'];
					$_SESSION['id'] = $id;
					$admissionNo = $row1['admissionNo'];
					$img = $row1['pic'];
					$msg = "";
					$sql2 = "SELECT * FROM regclass WHERE studentId='$id'";
					$result2 = mysqli_query($con, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					$regclzid = $row2['id'];
					$sql3 = "UPDATE regclass SET attendance='1' WHERE id='$regclzid'";
					$result3 = mysqli_query($con, $sql3);
					if($result3) {
						$sql4 = "SELECT * FROM attendance WHERE regclassId='$regclzid' AND date_='$today'";
						$result4 = mysqli_query($con, $sql4);
						if(mysqli_num_rows($result4) < 1) {
							$sql5 = "INSERT INTO attendance (regclassId, date_, d2d) VALUE ('$regclzid', '$today', '')";
							if(mysqli_query($con, $sql5)) {
								echo "<script>toastr.success('Attendance Marked for $name ($id)');</script>";
							}
						} else {
							$em = "Already marked the attendance for <b>$name ($id)</b>!";
							header("Location: Moderator.php?error=$em");
							exit;
						}
					}
					
				} else {
					$em = "Invalid Student ID";
					header("Location: Moderator.php?error=$em");
					exit;
				}
			} else {
				$em = "Enter the Student ID";
				header("Location: Moderator.php?error=$em");
				exit;
			}
		}

		if(isset($_POST['absent'])) {
			$id = $_SESSION['id'];
			$today = date("Y-m-d");
			$sql7 = "SELECT id FROM students WHERE id='$id'";
			$result7 = mysqli_query($con, $sql7);
			if(mysqli_num_rows($result7) > 0) {
				$sql8 = "SELECT id FROM regclass WHERE studentId='$id'";
				$result8 = mysqli_query($con, $sql8);
				$row8 = mysqli_fetch_assoc($result8);
				$reglassid = $row8['id'];

				$sql9 = "UPDATE regclass SET attendance=0 WHERE id='$reglassid'";
				$result9 = mysqli_query($con, $sql9);
				if($result9) {
					$sql10 = "SELECT * FROM attendance WHERE regclassId='$reglassid' AND date_='$today'";
					$result10 = mysqli_query($con, $sql10);
					if(mysqli_num_rows($result10) < 2 && mysqli_num_rows($result10) > 0) {
						$sql11 = "DELETE FROM attendance WHERE regclassId='$reglassid' AND date_='$today'";
						if(mysqli_query($con, $sql11)) {
							echo "<script>toastr.success('Marked as Absent for $id');</script>";
						}
					}
				}
			} else {
				$em = "Invalid Student ID three";
				header("Location: Moderator.php?error=$em");
				exit;
			}
		}
		?>

		<?php
			require_once '../connection.php';
			if(isset($_POST['finish'])) {
				$sql17 = "UPDATE regclass SET attendance=0";
				$result17 = mysqli_query($con, $sql17);
				if($result17) {
					echo "<script>toastr.info('Done');</script>";
				} else {
					echo "<script>toastr.error('Error occurred');</script>";
				}
			}
		?>

		<?php
			// check if the student had paid the class fees
			$val = "";
			$year = date("Y");
			$month = date("m");
			$today = date("Y-m-d");
			$regID = "";
			if(isset($_POST['search']) || isset($_POST['attend'])) {
				$id = $_POST['id'];
				$sql12 = "SELECT * FROM regclass WHERE studentId='$id'";
				$result12 = mysqli_query($con, $sql12);
				$row12 = mysqli_fetch_assoc($result12);
				$regID = $row12['id'];

				$sql13 = "SELECT * FROM payments WHERE regclassID='$regID' AND year='$year' AND month='$month'";
				$result13 = mysqli_query($con, $sql13);
				if(mysqli_num_rows($result13) < 1) {
					$val = 0;
					echo "<script>toastr.warning('$id, Please pay the class fees for this month')</script>";
				} else {
					$val = 1;
				}
			}
		?>

		<?php
			if(isset($_POST['pay'])) {
				$id = $_SESSION['id'];
				$sql12 = "SELECT * FROM regclass WHERE studentId='$id'";
				$result12 = mysqli_query($con, $sql12);
				$row12 = mysqli_fetch_assoc($result12);
				$regID = $row12['id'];
				$sql14 = "INSERT INTO payments(regclassID, year, month, status, pDate) VALUES ('$regID', '$year', '$month', '1', '$today')";
				if(mysqli_query($con, $sql14)) {
					echo "<script>toastr.success('$id is successfully paid the class fees')</script>";
				}
			}
		?>

		<?php if((isset($_POST['search']) || isset($_POST['attend'])) && $val == 0) { ?>
		<div class="container col-sm-12 col-lg-5">
			<hr>
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">Payments</h3>
				</div>
				<div class="card-body text-center">
					<h4 class="text-danger">Please pay the class fees for <?php echo date('F'); ?></h4>
					<form action="Moderator.php" method="POST">
						<button type="submit" name="pay" class="btn btn-outline-dark col-12">Pay Now</button>
					</form>
				</div>
			</div>
		</div>

		<?php } ?>

		<?php if(isset($_POST['search']) || isset($_POST['attend'])) { ?>
		<div class="container col-sm-12 col-lg-5">
			<hr>
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">Details</h3>
				</div>
				<div class="card-body">
					<div class="row g-1">
						<div class="text-center">
							<?php 
							if(isset($_POST['search']) || isset($_POST['attend']) && $img != "") {
								echo "<img src='$img' class='rounded border border-success' width='200' height='200' alt='student img'>";
							} else {
								echo "<img src='../Media/dummy.jpg' class='rounded' width='200' height='200' alt='student img'>";
							}
							?>

						</div>
					</div><br />
					<div class="row g-1">
						<table>
							<tr>
								<th>Name</th>
								<td><input type="text" name="name" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $name;}?>" style='color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
								<th>Student ID</th>
								<td><input type="text" name="id" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $id;}?>" style='color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
								<th>Admission No.</th>
								<td><input type="text" id="admission" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $admissionNo;}?>" style='color: #10A0FF; font-weight: 700;'></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<hr>
		</div>



		<hr style="border: 2px solid red;">
		<!-- CAALENDAR AREA -->
		<div class="container">
			<?php
			if (isset($_POST['search']) || isset($_POST['attend'])) {
				$std_id = $id;
				include '../req/Calendar.php';
				include '../connection.php';
				$fulldate = date("Y-m-d");
				$sys_date = date("d");
				$sys_month = date("m");
				$sys_year = date("Y");
				$firstDay = date('Y-m-01');
				$lastDay = date('Y-m-t');
				$calendar = new Calendar($fulldate);
				$sql16 = "SELECT id FROM regclass WHERE studentId='$std_id'";
				$result16 = mysqli_query($con, $sql16);
				$row16 = mysqli_fetch_assoc($result16);
				$reclassid = $row16['id'];

				$sql6 = "SELECT * FROM attendance WHERE '$firstDay' <= date_ and date_ <= '$lastDay' AND regclassId='$reclassid'";
				$result6 = mysqli_query($con, $sql6);
				if (mysqli_num_rows($result6) > 0) {
					while ($row6 = mysqli_fetch_assoc($result6)) {
						$date = $row6['date_'];
						$calendar->add_event('Attended', $date, 1, 'green');
					}
					$sql15 = "SELECT * FROM payments WHERE regclassId='$reclassid' AND year='$sys_year' AND month='$sys_month'";
					$result15 = mysqli_query($con, $sql15);
					if(mysqli_num_rows($result15) > 0) {
						$row15 = mysqli_fetch_assoc($result15);
						$pDate = $row15['pDate'];
						$calendar->add_event('Paid', $pDate, 1, 'red');
					} 
				}
			}
			?>
			<nav class="navtop">
				<div>
					<h1>Attendance</h1>
				</div>
			</nav>
			<div class="content home">
				<?php if (isset($_POST['search']) || isset($_POST['attend'])) {
					echo $calendar;
				} ?>
			</div>
		</div>

		<div class="container">
			<form method="POST" action="Moderator.php">
				<div class="d-grid gap-2 col-lg-5 col-sm-12 mx-auto">
					<br><button class="btn btn-danger" type="submit" name="absent">Mark as Absent</button>
				</div>
			</form>
		</div>
		<br><br> <?php } ?>
		<div class="container">
			<form method="POST" action="Moderator.php">
			<div class="d-grid gap-2 col-lg-5 col-sm-12 mx-auto">
				<br><button class="btn btn-warning" type="submit" name="finish">Finish</button>
			</div>
		</form>
		</div>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>