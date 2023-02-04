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

	<?php
	$thisMonth = date("m");
	$thisYear = date("Y");
	$today = date("Y-m-s");
	include_once '../connection.php';
	$msg = "";
	$regclzID = "";
	if (isset($_POST['search'])) {
		if (!empty($_POST['id'])) {
			$stdID = $_POST['id'];
			$sql1 = "SELECT * FROM students WHERE id='$stdID'";
			$result1 = mysqli_query($con, $sql1);
			if (mysqli_num_rows($result1) > 0) {
				$row1 = mysqli_fetch_assoc($result1);
				$id = $row1['id'];
				$adNo = $row1['admissionNo'];
				$name = $row1['fname'] . " " . $row1['lname'];
				$img = $row1['pic'];
				$sql2 = "SELECT id FROM regclass WHERE studentId='$id'";
				$result2 = mysqli_query($con, $sql2);
				$row2 = mysqli_fetch_assoc($result2);
				$regclzID = $row2['id'];
				$sql3 = "SELECT * FROM payments WHERE regclassID='$regclzID' AND year='$thisYear' AND month='$thisMonth'";
				$result3 = mysqli_query($con, $sql3);
				if (mysqli_num_rows($result3) > 0) {
					$row3 = mysqli_fetch_assoc($result3);
					if ($row3['status'] == "0") {
						$msg = "Please pay the class fees!";
					}
				} else {
					$msg = "Please pay the class fees!";
				}
			} else {
				$em = "Invalid Student ID";
				header("Location: Moderator.php?error=$em");
				exit;
			}
		} else {
			$em = "Student ID Required!";
			header("Location: Moderator.php?error=$em");
			exit;
		}
	}

	if(isset($_POST['submit'])) {
		$msg = "";
		$p = $_POST['paid'];
		$sql4 = "SELECT * FROM attendance WHERE regclassId='$regclzID' AND date_='$today'";
		$result4 = mysqli_query($con, $sql4);
		if(mysqli_num_rows($result4) < 1) {
			$sql5 = "UPDATE	regclass SET attendance='1' WHERE id='$regclzID'";
			if(mysqli_query($con, $sql5)) {
				$sql5 = "INSERT INTO attendance (regclassId, date_) VALUES ('$regclzID', '$today')";
				$result5 = mysqli_query($con, $sql5);
				if($p) {
					$sql6 = "SELECT * FROM payments WHERE regclassId='$regclzID' AND year='$thisYear' AND month='$thisMonth'";
					$result6 = mysqli_query($con, $sql6);
					if(mysqli_num_rows($result6) < 1) {
						$sql7 = "INSERT INTO payments (regclassId, year, month, status, pDate) VALUES ('$regclzID', '$thisYear', '$thisMonth', '1', '$today')";
						if(mysqli_query($con, $sql7)) {
							//
						}
					} else {
						$msg = "Already paid the class fees!";
					}
				}
			}
		} else {
			$msg = "Already marked the attendance";
		}
	}

	?>

	<body>
		<!-- Navbar -->
		<header class="main-header clearfix" role="header">
			<div class="logo">
				<a href="../index.php">Lycoris Cafe</a>
			</div>
			<a href="../index.php" class="menu-link"><i class="fa fa-bars"></i></a>
			<nav id="menu" class="main-nav" role="navigation">
				<ul class="main-menu">
					<li style='color: #fff;'>User: <?php echo $_SESSION['name']; ?></li>
					<li style='color: #fff;'>Role: <?php echo $_SESSION['role']; ?></li>
					<li style='color: #fff;'>Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
					<li><a href='../req/logout.php' class='btn btn-danger'> Logout </a></li>

				</ul>
			</nav>
		</header>

		<!-- Content -->
		<div class="container col-lg-6"><br><br><br><br><br><br><br><br><br><br>
			<div class="card text-center">
				<div class="card-header">
					<h4 class='display-6' style='color: #fff;'>Attendane Marking</h4>
				</div>
				<div class="card-body">
					<form action='Moderator.php' method='POST'>
					<?php if ((isset($_POST['search']) && $msg != "")) { ?>
							<div class='alert alert-danger' role='alert' id="msg">
								<?php echo $msg; ?>
							</div>
						<?php } elseif (isset($_GET['error'])){?>
							<div class='alert alert-danger' role='alert' id="msg">
							<?php echo $_GET['error']; ?>
						</div>
						<?php } ?>
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Enter Student ID!" name='id'
								autocomplete="off">
						</div>
						<div class="d-grid gap-2">
							<input class="btn btn-primary" type="submit" name='search' value='Search'>
						</div>
						<hr>
						<div>

						</div><br />
					</form>

					<form action='Moderator.php' method='POST'>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Student ID'><?php if (isset($_POST['search'])) {
									echo "Student ID: <font color='#10A0FF'>$id</font>";
								} ?></b>
							</div>
						</div>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Admission Number'><?php if (isset($_POST['search'])) {
									echo "Admission No.: <font color='#10A0FF'>$adNo</font>";
								} ?></b>
							</div>
						</div>
						<div class="mb-3">
							<div class="rounded border border-success" style='font-size: 22px;'>
								<b title='Student Name'><?php if (isset($_POST['search'])) {
									echo "Student Name: <font color='#10A0FF'>$name</font>";
								} ?></b>
							</div>
						</div>
						<hr>
						<div class="form-check text-start">
							<input class="form-check-input" type="checkbox" id="flexCheckChecked" name='day2day'>
							<label class="form-check-label" for="flexCheckChecked">Day 2 Day Paper</label>

						</div>
						<div class="form-check text-start">
							<input class="form-check-input" type="checkbox" id="fees" name='paid'>
							<label class="form-check-label" for="fees">Paid</label>
						</div><br />

						<div class="d-grid gap-2">
							<input class="btn btn-primary" type="submit" name='submit' value='Mark as Attend!'>
						</div>
						<div class="d-grid gap-2">
							<br /><button class="btn btn-warning" name="finish">Finish</button>
						</div>


				</div>
			</div>
			</form>
		</div>
		</div>
		</div>

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