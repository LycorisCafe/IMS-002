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
		<link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/toastr.css" rel="stylesheet">
		<script src="../js/toastr.js"></script>
		<link rel="stylesheet" href="modstyle.css">
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
							<input type="text" class="form-control" placeholder="Student ID" name="id" autocomplete="off">
							<button class="btn btn-primary col-12" name="attend">Search and Mark Attend</button>
							<button class="btn btn-outline-primary col-12" name="search">Search</button>
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
				if(mysqli_num_rows($result1) > 0) {
					$row1 = mysqli_fetch_assoc($result1);
					$name = $row1['fname']." ". $row1['lname'];
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
		?>

		<div class="container col-sm-12 col-lg-6">
			<hr>
			<!-- <div class="card text-center ">
				<div class="card-header"> -->
					<center><h3>Student Search</h3></center>
				</div>
				<!-- <div class="card-body">
					<div class="row g-1">
						<table>
							<tr>
								<div class="col-12">
									<td rowspan="3">
											<?php if(isset($_POST['search']) && $img != "") {
												echo "<img src='$img' class='rounded' width='200' height='200' alt='student img'>";
											} else {
												echo "<img src='../Media/dummy.jpg' class='rounded' width='200' height='200' alt='student img'>";
											}
											?>
									</td>
								</div>
								<div class="col-12"> 
									<td>Name: <input type="text" class="form-control" readonly
										value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $name;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
									<td>ID: <input type="text" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $id;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							<tr>
									<td>Admission: <input type="text" class="form-control" readonly value="<?php if(isset($_POST['search']) || isset($_POST['attend'])) { echo $admissionNo;}?>" style='border: none; color: #10A0FF; font-weight: 700;'></td>
							</tr>
							</div>
						</table>
					</div> -->

					<div class="container mt-5">
         <div class="row d-flex justify-content-center">
             <div class="col-md-7">
                 <div class="card p-2 text-center">
                     <div class="row">
                         <div class="col-md-7 border-right no-gutters">
                             <div class="py-3"><img src="..\Media\dummy.jpg" width="100" class="rounded-circle">
                                 <h4 class="text-secondary">Randil</h4>
                                 <div class="allergy"><span>Lasith</span></div>
                                 <div class="stats">
                                     <table class="table table-borderless">
                                         <tbody>
                                             <tr>
                                                 <td>
                                                     <div class="d-flex flex-column"> <span class="text-left head">DOB</span> <span class="text-left bottom">03/13/2004</span> </div>
                                                 </td>
                                                 <td>
                                                     <div class="d-flex flex-column"> <span class="text-left head">ID</span> <span class="text-left bottom">T23047</span> </div>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <div class="d-flex flex-column"> <span class="text-left head">Admission</span> <span class="text-left bottom">1800</span> </div>
                                                 </td>
                                                 <td>
                                                     <div class="d-flex flex-column"> <span class="text-left head">School</span> <span class="text-left bottom">-------------</span> </div>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                               
                             </div>
                         </div>
                         <!-- <div class="col-md-5">
                             <div class="py-3">
                                 <div> <span class="d-block head">Home Address</span> <span class="bottom">123 Broadway,New York,NY,10012</span> </div>
                                 <div class="mt-4"> <span class="d-block head">Mobile Phone#</span> <span class="bottom">917 (543)-1234</span> </div>
                                 <div class="mt-4"> <span class="d-block head">Home Phone#</span> <span class="bottom">212 (213)-1234</span> </div>
                                 <div class="mt-4"> <span class="d-block head">Work Phone#</span> <span class="bottom">718 (702)-9876</span> </div>
                                 <div class="mt-4"> <span class="d-block head">Email</span> <span class="bottom">j.smith@gmail.com</span> </div>
                             </div>
                         </div> -->
                     </div>
                 </div>
             </div>
         </div>
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

<?php
	if(isset($_POST['finish'])) {
		$sql11 = "UPDATE regclass SET attendance='0'";
		$result11 = mysqli_query($con, $sql11);
		if($result11) {
			echo "<script>toastr.info('Done');</script>";
		}
		else {
			echo "<script>toastr.error('Done');</script>";
		}
	}							
?>

		<br><br>
		<div class="toast-container position-fixed bottom-0 end-0 p-3">
			<div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-body">
					<?php //if(isset($_POST['attend']) && $msg != "") { echo $msg;} ?>
					<div class="mt-2 pt-2 border-top">
						<button type="button" class="btn btn-primary btn-sm">Take action</button>
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			 //const toastTrigger = document.getElementById('liveToastBtn')
			 function showToast() {
				const toastLiveExample = document.getElementById('liveToast');
				//if (toastTrigger) {
					//toastTrigger.addEventListener('click', () => {
						const toast = new bootstrap.Toast(toastLiveExample);
						toast.show();
					//})
				//}
			}
		</script>

		<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->

		<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>