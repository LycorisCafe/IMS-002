<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
	<!doctype html>
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

		<div class="container"><br/>
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
											$result1 = mysqli_query($con,$sql1);
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
											$result2 = mysqli_query($con,$sql2);
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
			<br/><h5><?php echo $_SESSION['name']; ?>,<strong><span style="color:#cf4ed4;"> Welcome back! </span></strong><br/>
			</h5><hr style="border: 2px solid red;"><br/>

			<h1 class="display-4">Registered Classes</h1><br/>
			<div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
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
			  			while($row3 = mysqli_fetch_assoc($result3)) {
			  				$institute = $row3['institute'];
			  				$city = $row3['city'];
			  				$al_year = $row3['al_year'];
			  				$day = $days[date($row3['day'])];
			  				$time = $row3['time'];
			  				echo "<tr>";
				  				echo "<td>$institute</td>";
				  				echo "<td>$city</td>";
				  				echo "<td>$al_year</td>";
				  				echo "<td>$day</td>";
				  				echo "<td>$time</td>";
				  			echo "</tr>";
			  			}
			  		?>
			  	</tbody>
			</table>
			</div>



		</div>
		<?php include '../req/footer.php'; ?>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>