<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


	<!doctype html>
	<html lang="en" data-bs-theme="dark">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Add a New Class</title>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/fonts.css">
		<link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/temp.css">
		<script src="../fontawesome.com.js" crossorigin="anonymous"></script>
	</head>

	<?php
	if (isset($_POST['submit'])) {
		$insName = $_POST['insName'];
		$city = $_POST['city'];
		$al_year = $_POST['al_year'];
		$day = $_POST['day'];
		$time = $_POST['h'] . ":" . $_POST['m'] . " " . $_POST['a_p'];

		// db connection
		include_once '../connection.php';
		$sql = "INSERT INTO classes (al_year,  day, time,institute, city) VALUES ('$al_year', '$day', '$time', '$insName', '$city')";
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('New Class adding completed!');</script>";
		} else {
			$em = "Error adding new class";
			header("Location: addClass.php?error=$em");
			exit;
		}
	}
	?>


	<body>
		<!-- Imports -->
		<?php require_once "navbar.php"; ?>

		<h1 class="display-1 text-center">Classes</h1><br>

		<div class="container">
			<h1 class="display-4">Registered Classes</h1><br />
			<div class="bd-example-snippet bd-code-snippet">
				<div class="bd-example">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Institute Name</th>
								<th scope="col">City</th>
								<th scope="col">A/L Year</th>
								<th scope="col">Day</th>
								<th scope="col">Time</th>
								<th scope="col">No. of Students</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$days = [
								1 => 'Sunday',
								2 => 'Monday',
								3 => 'Tuesday',
								4 => 'Wednesday',
								5 => 'Thursday',
								6 => 'Friday',
								7 => 'Saturday'
							];
							include_once '../connection.php';


							$sql2 = "SELECT al_year, day, time, institute, city FROM classes ORDER BY `classes`.`al_year` ASC";
							$result2 = mysqli_query($con, $sql2);
							while ($row2 = mysqli_fetch_assoc($result2)) {
								$institute = $row2['institute'];
								$city = $row2['city'];
								$al_year = $row2['al_year'];
								$day = $days[date($row2['day'])];
								$time = $row2['time'];

								$sql3 = "SELECT COUNT(id) FROM students WHERE institute='$institute' AND al_year='$al_year'";
								$result3 = mysqli_query($con, $sql3);
								$row3 = mysqli_fetch_assoc($result3);
								$numOfStd = $row3['COUNT(id)'];

								echo "<tr>";
								echo "<td>$institute</td>";
								echo "<td>$city</td>";
								echo "<td>$al_year</td>";
								echo "<td>$day</td>";
								echo "<td>$time</td>";
								echo "<td>$numOfStd</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<hr style="border: 2px solid red;"><br />


			<h1 class="display-4">Add a New Class</h1><br />
			<div class="container col-lg-4 col-md-5 align-self-center">
				<div class="card" style="transform: translate(0%, 5%);">
					<!-- <div class="card-header text-center">
					<h3 class='display-5' style='color: #fff;'>New Class</h3>
				</div> -->
					<div class="card-body">
						<form action="addClass.php" method="POST">
							<?php if (isset($_GET['error'])) { ?>
								<div class='alert alert-danger' role='alert'>
									<?= $_GET['error'] ?>
								</div>
							<?php } ?>
							<div class="col-auto mb-3">
								<label class="form-label">Institute Name: </label>
								<input type="text" class="form-control" name="insName" aria-describedby="insName" autocomplete="off" required placeholder="Apple">
							</div>
							<div class="col-auto mb-3">
								<label class="form-label">City: </label>
								<input type="text" class="form-control" name="city" aria-describedby="city" autocomplete="off" required placeholder="Galle">
							</div>
							<div class="col-auto mb-3">
								<label class="form-label">A/L Year: </label>
								<input type="text" class="form-control" name="al_year" aria-describedby="al_year" autocomplete="off" required placeholder="2022">
							</div>
							<div class="col-auto mb-3">
								<label class="form-label">Day: </label>
								<select class="form-control" name='day'>
									<option value='1'>Monday</option>
									<option value='2'>Tuesday</option>
									<option value='3'>Wednesdy</option>
									<option value='4'>Thursday</option>
									<option value='5'>Friday</option>
									<option value='6'>Saturday</option>
									<option value='7'>Sunday</option>
								</select>
							</div>
							<div class="col-auto mb-3">
								<label class="form-label">Time: </label>
								<div class="input-group mb-3">
									<input type="text" placeholder="HH" class="form-control" aria-label="Text input with dropdown button" name="h">
									<input type="text" placeholder="MM" class="form-control" aria-label="Text input with dropdown button" name="m">
									<select class="form-select" id="inputGroupSelect01" name='a_p'>

										<option value="AM">AM</option>
										<option value="PM">PM</option>
									</select>
								</div>
							</div>

							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary" name='submit'>Add</button>
							</div>
						</form>
					</div>
				</div>
			</div><br /><br />

			<div class="container">
				<h1 class="display-4 text-danger" style="font-weight: 500;">Danger Zone</h1>
				<form role="delteAcc" method="POST">

					<div class="row">
						<div class="col-sm-12 col-lg-2 p-1 d-flex">
							<label class="form-label">Institute: </label>
						</div>
						<div class="col-sm-12 col-lg-10 p-1 d-flex">
							<select class="form-control" name='institute'>
								<?php
								include_once '../connection.php';
								$sql4 = "SELECT DISTINCT institute FROM classes";
								$result4 = mysqli_query($con, $sql4);
								while ($ri = mysqli_fetch_assoc($result4)) {
								?>
									<option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-lg-2 p-1 d-flex">
							<label class="form-label">A/L Year: </label>
						</div>
						<div class="col-sm-12 col-lg-10 p-1 d-flex">
							<select class="form-control" name='year'>
								<?php
								include_once '../connection.php';
								$sql5 = "SELECT DISTINCT al_year FROM classes";
								$result5 = mysqli_query($con, $sql5);
								while ($ri = mysqli_fetch_assoc($result5)) {
								?>
									<option value="<?php echo $ri['al_year'] ?>"><?php echo $ri['al_year'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="d-grid gap-2">
						<button class="btn btn-outline-success" type="submit" name="search">Search</button>
						<button class="btn btn-outline-warning" type="reset" name="reset">Reset</button>
					</div>
				</form>
			</div>
			<br>
			<div class="container">
				<div class="bd-example-snippet bd-code-snippet">
					<div class="bd-example">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">Institute Name</th>
									<th scope="col">City</th>
									<th scope="col">A/L Year</th>
									<th scope="col">Day</th>
									<th scope="col">Time</th>
									<th scope="col">No. of Students</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_POST['search'])) {
									$days = [
										1 => 'Sunday',
										2 => 'Monday',
										3 => 'Tuesday',
										4 => 'Wednesday',
										5 => 'Thursday',
										6 => 'Friday',
										7 => 'Saturday'
									];
									include_once '../connection.php';

									$ins = $_POST['institute'];
									$year = $_POST['year'];
									$sql6 = "SELECT * FROM classes WHERE institute='$ins' AND al_year='$year'";
									$result6 = mysqli_query($con, $sql6);
									while ($row6 = mysqli_fetch_assoc($result6)) {
										$institute = $row6['institute'];
										$city = $row6['city'];
										$al_year = $row6['al_year'];
										$day = $days[date($row6['day'])];
										$time = $row6['time'];

										$sql7 = "SELECT COUNT(id) FROM students WHERE institute='$institute' AND al_year='$al_year'";
										$result7 = mysqli_query($con, $sql7);
										$row7 = mysqli_fetch_assoc($result7);
										$numOfStd = $row7['COUNT(id)'];

										echo "<tr>";
										echo "<td>$institute</td>";
										echo "<td>$city</td>";
										echo "<td>$al_year</td>";
										echo "<td>$day</td>";
										echo "<td>$time</td>";
										echo "<td>$numOfStd</td>";
										echo "</tr>";
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>

				<script type="text/javascript">
					function confirmation() {
						choice = confirm("Do you really want to remove this class from the Database?");
						if (choice) {
							<?php
							$ins2 = $_POST['institute'];
							$year2 = $_POST['year'];
							include_once '../connection.php';
							$sql8 = "DELETE FROM classes WHERE institute='$ins2' AND al_year='$year2'";
							$result8 = mysqli_query($con, $sql8);
							?>
						}
					}
				</script>

				<form class="d-flex mb-3" role="delete" method="POST" onsubmit="confirmation();">
					<div class="d-grid gap-2"><br>
						<button class="btn btn-outline-danger" type="submit" name="delete">Remove from Database</button>
					</div>

				</form>

			</div>

			<!-- <br /><br /><br /><br /><br /><br /> -->


			<?php include 'footer.php'; ?>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>