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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
					<h2>Attendance Mark</h2>
				</div>
					<div class="d-grid gap-2">
					<div class="card-body"><?php if (isset($_GET['error'])) { ?>
						<div class='alert alert-danger' role='alert'>
							<?= $_GET['error'] ?>
						</div>
					<?php } ?>
						<form action="Moderator.php" method="post">
							<input type="text" class="form-control" placeholder="Student ID" name="id">
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
								$msg = "Attendance Marked successfully!";
								echo "<script>showToast();</script>";
							}
						} else {
							$em = "Already marked the attendance!";
							header("Location: Moderator.php?error='$em'");
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
					<div class="row g-3">
						<div class="col-12">
							<?php if(isset($_POST['searchAandAttend']) && $img != "") {
								echo "<img src='$img' class='rounded' width='200' height='200' alt='student img'>";
							} else {
								echo "<img src='../Media/dummy.jpg' class='rounded' width='200' height='200' alt='student img'>";
							}
							?>
						</div>
						<div class="col-12">
							<h5 id="name">Name : <?php if(isset($_POST['search'])) {echo $name;}?></h5>
							<h5 id="id">ID : <?php if(isset($_POST['search'])) {echo $id;}?></h5>
							<h5 id="admision">Admission : <?php if(isset($_POST['search'])) {echo $admissionNo;}?></h5>
						</div>
					</div>
				</div>
			</div>
			<hr>
		</div>

		<div class="container">
			<div class="d-grid gap-2 col-lg-7 col-sm-12 mx-auto">
				<button class="btn btn-danger" type="button">Mark as Absent</button>
			</div>
		</div>
		<br><br>


		<button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

		<div class="toast-container position-fixed bottom-0 end-0 p-3">
			<div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-body">
					<?php //if(isset($_POST['attend']) && $msg != "") { echo $msg;} ?>
					Hello
					<div class="mt-2 pt-2 border-top">
						<button type="button" class="btn btn-primary btn-sm">Take action</button>
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			// const toastTrigger = document.getElementById('liveToastBtn')
			function showToast() {
				const toastLiveExample = document.getElementById('liveToast')
				//if (toastTrigger) {
					toastTrigger.addEventListener('click', () => {
						const toast = new bootstrap.Toast(toastLiveExample)
						toast.show();
					})
				//}
			}
		</script>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>