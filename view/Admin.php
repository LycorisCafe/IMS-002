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
	</head>

	<body>
		<?php require_once "../req/navbar.php"; ?>
		<div class="container"><br />
			<div class="row justify-content-around">
				<div class="col-sm-12 col-lg-4 p-1 d-flex">
					<div class="card">
						<div class="row">
							<div class="col-4">
								<img src="../Media/images/group.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
							</div>
							<div class="col-8">
								<div class="card-body">
									<h3 class="card-title">Total Students</h3>
									<h5 class="card-subtitle mb-2 text-muted">
										<?php
										require_once '../connection.php';
										$sql1 = "SELECT count(id) FROM students";
										$result1 = mysqli_query($con, $sql1);
										$row1 = mysqli_fetch_assoc($result1);
										$all_student = $row1['count(id)'];
										echo $all_student;
										?>
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-lg-4 p-1 d-flex">
					<div class="card">
						<div class="row">
							<div class="col-4">
								<img src="../Media/images/school.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
							</div>
							<div class="col-8">
								<div class="card-body">
									<h3 class="card-title">Total Classes</h3>
									<h5 class="card-subtitle mb-2 text-muted">
										<?php
										require_once '../connection.php';
										$sql2 = "SELECT count(id) FROM classes";
										$result2 = mysqli_query($con, $sql2);
										$row2 = mysqli_fetch_assoc($result2);
										$all_classes = $row2['count(id)'];
										echo $all_classes;
										?>
									</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br />
			<h5><?php echo $_SESSION['name']; ?>,<strong><span style="color:#cf4ed4;"> Welcome back! </span></strong><br />
			</h5>
			<hr style="border: 2px solid red;"><br />

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


							$sql3 = "SELECT al_year, day, time, institute, city FROM classes ORDER BY `classes`.`al_year` ASC";
							$result3 = mysqli_query($con, $sql3);
							while ($row3 = mysqli_fetch_assoc($result3)) {
								$institute = $row3['institute'];
								$city = $row3['city'];
								$al_year = $row3['al_year'];
								$day = $days[date($row3['day'])];
								$time = $row3['time'];

								$sql4 = "SELECT COUNT(id) FROM students WHERE institute='$institute' AND al_year='$al_year'";
								$result4 = mysqli_query($con, $sql4);
								$row4 = mysqli_fetch_assoc($result4);
								$numOfStd = $row4['COUNT(id)'];

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
				<hr style="border: 2px solid red;"><br />
				<h1 class="display-4">Student Information</h1><br />

				<form class="d-flex" role="search" action="Admin.php" method="POST" onsubmit="drawChart();">
					<?php if (isset($_GET['error'])) { ?>
						<div class='alert alert-danger' role='alert'>
							<?= $_GET['error'] ?>
						</div>
					<?php } ?>
					<input class="form-control me-2" type="search" placeholder="Search for Student by ID" aria-label="Search" name="std_id" autocomplete="off">
					<button class="btn btn-outline-success col-lg-3" type="submit" name="search">Search</button>
				</form>
				<br />

				<div class="container">
					<div class="row justify-content-center">
						<div class="col-sm-12 col-lg-4 p-1 d-flex">
							<div class="card">
								<div class="row">
									<div class="col-4">
										<img src="../Media/images/user.jpg" class="img-fluid rounded-start" alt="..." width="320" height="320">
									</div>
									<div class="col-8">
										<div class="card-body">
											<h3 class="card-title">Student Name</h3>
											<h5 class="card-subtitle mb-2 text-muted">
												<?php
												if (isset($_POST['search'])) {
													require_once '../connection.php';
													$std_id = $_POST['std_id'];
													$sql9 = "SELECT fname, lname FROM students WHERE id='$std_id'";
													$result9 = mysqli_query($con, $sql9);
													if (mysqli_num_rows($result9) > 0) {
														$row9 = mysqli_fetch_assoc($result9);
														$name = $row9['fname'] . " " . $row9['lname'];
														echo $name;
													} else {
														echo "No Records";
													}
												}
												?>
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 p-1 d-flex">
							<div class="card">
								<div class="row">
									<div class="col-4">
										<img src="../Media/images/id-card.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
									</div>
									<div class="col-8">
										<div class="card-body">
											<h3 class="card-title">Addmission No.</h3>
											<h5 class="card-subtitle mb-2 text-muted">
												<?php
												if (isset($_POST['search'])) {
													$std_id = $_POST['std_id'];
													$sql11 = "SELECT admissionNo FROM students WHERE id='$std_id'";
													$result11 = mysqli_query($con, $sql11);
													if (mysqli_num_rows($result11) > 0) {
														$row11 = mysqli_fetch_assoc($result11);
														$admissionNo = $row11['admissionNo'];
														echo $admissionNo;
													} else {
														echo "No Records";
													}
												}
												?>
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4 p-1 d-flex">
							<div class="card">
								<div class="row">
									<div class="col-4">
										<img src="../Media/images/school.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
									</div>
									<div class="col-8">
										<div class="card-body">
											<h3 class="card-title">Institute</h3>
											<h5 class="card-subtitle mb-2 text-muted">
												<?php
												if (isset($_POST['search'])) {
													$std_id = $_POST['std_id'];
													$sql12 = "SELECT institute FROM students WHERE id='$std_id'";
													$result12 = mysqli_query($con, $sql12);
													if (mysqli_num_rows($result12) > 0) {
														$row12 = mysqli_fetch_assoc($result12);
														$institute = $row12['institute'];
														echo $institute;
													} else {
														echo "No records";
													}
												}
												?>
											</h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<br />
				<div class="container">
					<h1 class="display-6">Exam History (This Month)</h1><br />
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Marks</th>
								<th scope="col">Grade</th>
								<th scope="col">Rank</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (isset($_POST['search'])) {
								$month = date("m");
								$std_id = $_POST['std_id'];
								$sql5 = "SELECT id FROM regClass WHERE studentId='$std_id'";
								$result5 = mysqli_query($con, $sql5);
								if (mysqli_num_rows($result5) > 0) {
									$row5 = mysqli_fetch_assoc($result5);
									$regClassid = $row5['id'];
									$sql6 = "SELECT * FROM exam WHERE regclassID='$regClassid'";
									$result6 = mysqli_query($con, $sql6);
									while ($row6 = mysqli_fetch_assoc($result6)) {
										$date = $row6['date'];
										$marks = $row6['marks'];
										$grade = $row6['grade'];
										$rank = $row6['rank'];

										echo "<tr>";
										echo "<td>$date</td>";
										echo "<td>$marks</td>";
										echo "<td>$grade</td>";
										echo "<td>$rank</td>";
										echo "</tr>";
									}
								}
							}
							?>
						</tbody>
					</table><br>
				</div>
			</div>
			<a href="../req/studentsInfo.php" class="btn btn-primary">See more details</a>
		</div>
		<?php include '../req/footer.php'; ?>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>