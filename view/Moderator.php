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
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/toastr.css" rel="stylesheet">
		<script src="../js/toastr.js"></script>
		<link href="../req/calendar.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar -->
		<link href="../req/cal-area.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar body -->
	</head>

	<body>
		<nav class="navbar bg-body-tertiary" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand">LycorisCafe</a>
				<div class="d-flex d-grid gap-2">
					<span style='color: #fff;' class="me-2">Role: <?php echo $_SESSION['role']; ?></span>
					<span style='color: #fff;' class="me-2">User: <?php echo $_SESSION['name']; ?></span>
					<a href="../req/logout.php" class="btn btn-danger">Logout</a>
				</div>
			</div>
		</nav>
		<br><br>
		<div class="container col-sm-12 col-lg-6">
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
<<<<<<< HEAD
							<input type="text" class="form-control" placeholder="Student ID" name="id" autocomplete="off" value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $_POST['id']; }?>">
							<button class="btn btn-primary col-12" name="attend">Search and Mark Attend</button>
							<button class="btn btn-outline-primary col-12" name="search">Search</button>
=======
						<div class="mb-2">
							<input type="text" class="form-control" placeholder="Student ID" name="id" autocomplete="off">
						</div>	
							<div class="d-grid gap-2">
								<button class="btn btn-primary col-12  " name="attend">Search and Mark Attend</button>
								<button class="btn btn-outline-primary col-12 " name="search">Search</button>
							</div>
>>>>>>> 0389ab84c0ff03f83d98e8103248eee6e806c1b8
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php
		$img = "";
		require_once '../connection.php';
		if (isset($_POST['search'])) {
			if (!empty($_POST['id'])) {
				$id = $_POST['id'];
				$sql1 = "SELECT * FROM students WHERE id='$id'";
				$result1 = mysqli_query($con, $sql1);
				if (mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$name = $row1['fname'] . " " . $row1['lname'];
					$id = $row1['id'];
					$admissionNo = $row1['admissionNo'];
					$img = $row1['pic'];
				} else {
					$em = "Invalid Student ID";
					header("Location: Moderator.php?error=$em");
					exit;
				}
			} else {
				$em = "Please enter the Student ID";
				header("Location: Moderator.php?error=$em");
				exit;
			}
		}
		if (isset($_POST['attend'])) {
			if (!empty($_POST['id'])) {
				$id = $_POST['id'];
				$today = date("Y-m-d");
				$sql1 = "SELECT * FROM students WHERE id='$id'";
				$result1 = mysqli_query($con, $sql1);
				if (mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$name = $row1['fname'] . " " . $row1['lname'];
					$id = $row1['id'];
					$admissionNo = $row1['admissionNo'];
					$img = $row1['pic'];
					$msg = "";
					$sql2 = "SELECT * FROM regclass WHERE studentId='$id'";
					$result2 = mysqli_query($con, $sql2);
					$row2 = mysqli_fetch_assoc($result2);
					$regclzid = $row2['id'];
					$sql3 = "UPDATE regclass SET attendance='1' WHERE id='$regclzid'";
					$result3 = mysqli_query($con, $sql3);
					if ($result3) {
						$sql4 = "SELECT * FROM attendance WHERE regclassId='$regclzid' AND date_='$today'";
						$result4 = mysqli_query($con, $sql4);
						if (mysqli_num_rows($result4) < 1) {
							$sql5 = "INSERT INTO attendance (regclassId, date_, d2d) VALUE ('$regclzid', '$today', '')";
							if (mysqli_query($con, $sql5)) {
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
		?>

		<div class="container col-sm-12 col-lg-6">
			<hr>
			<div class="card text-center">
				<div class="card-header">
					<h3>Student Search</h3>
				</div>
				<div class="card-body">
					<div class="row g-1">
						<table>
							<tr>
								<div class="col-12">
									<td rowspan="3">
										<?php if (isset($_POST['search']) && $img != "") {
											echo "<img src='$img' class='rounded' width='200' height='200' alt='student img'>";
										} else {
											echo "<img src='../Media/dummy.jpg' class='rounded' width='200' height='200' alt='student img'>";
										}
										?>
									</td>
								</div>
<<<<<<< HEAD
								<div class="col-12"> 
									<td>Name: <input type="text" class="form-control" readonly
										value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $name;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
									<td>ID: <input type="text" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $id;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
									<td>Admission: <input type="text" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $admissionNo;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
=======
								<div class="col-12">
									<td>Name: <input type="text" name="name" class="form-control" readonly value="<?php if (isset($_POST['search']) || isset($_POST['attend'])) {
																														echo $name;
																													} ?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
								<td>ID: <input type="text" name="id" id="id" class="form-control" readonly value="<?php if (isset($_POST['search']) || isset($_POST['attend'])) {
																														echo $id;
																													} ?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
								<td>Admission: <input type="text" name="admission" id="admission" class="form-control" readonly value="<?php if (isset($_POST['search']) || isset($_POST['attend'])) {
																																			echo $admissionNo;
																																		} ?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
>>>>>>> 0389ab84c0ff03f83d98e8103248eee6e806c1b8
							</tr>
					</div>
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
			<form action="Moderator.php" method="post">
				<div class="d-grid gap-2 col-lg-7 col-sm-12 mx-auto">
					<br><input type="submit" name="finish" class="btn btn-warning" value="Finish">
				</div>
			</form>
			<form action="Moderator.php" method="post">
				<div class="d-grid gap-2 col-lg-7 col-sm-12 mx-auto">
					<br><input type="submit" name="absent" class="btn btn-danger" value="Mark as Absent">
				</div>
			</form>
		</div>

<<<<<<< HEAD
<?php
	if(isset($_POST['finish'])) {
		$sql11 = "UPDATE regclass SET attendance='0'";
		$result11 = mysqli_query($con, $sql11);
		if($result11) {
			echo "<script>toastr.info('Done');</script>";
		}
		else {
			echo "<script>toastr.error('An error occurred!');</script>";
		}
	}

	if(isset($_POST['absent'])) {
		//
	}
?>
=======
		<?php
		if (isset($_POST['finish'])) {
			$sql11 = "UPDATE regclass SET attendance=0";
			$result11 = mysqli_query($con, $sql11);
			if ($result11) {
				echo "<script>toastr.info('Done');</script>";
			}
		}
		?>
>>>>>>> 0389ab84c0ff03f83d98e8103248eee6e806c1b8

		<br><br>
		<!-- <div class="toast-container position-fixed bottom-0 end-0 p-3">
			<div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-body">
<<<<<<< HEAD
=======
					<?php //if(isset($_POST['attend']) && $msg != "") { echo $msg;} 
					?>
>>>>>>> 0389ab84c0ff03f83d98e8103248eee6e806c1b8
					<div class="mt-2 pt-2 border-top">
						<button type="button" class="btn btn-primary btn-sm">Take action</button>
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
					</div>
				</div>
			</div>
		</div> -->

<<<<<<< HEAD
<!-- 		<script>
			 //const toastTrigger = document.getElementById('liveToastBtn')
			 function showToast() {
=======
		<script>
			//const toastTrigger = document.getElementById('liveToastBtn')
			function showToast() {
>>>>>>> 0389ab84c0ff03f83d98e8103248eee6e806c1b8
				const toastLiveExample = document.getElementById('liveToast');
				//if (toastTrigger) {
				//toastTrigger.addEventListener('click', () => {
				const toast = new bootstrap.Toast(toastLiveExample);
				toast.show();
				//})
				//}
			}
		</script> -->

		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->

		<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>