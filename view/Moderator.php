<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


	<!doctype html>
	<html lang="en" data-bs-theme="light">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Moderator Panel</title>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/fonts.css">
		<link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/temp.css">
		<link href="../req/calendar.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar -->
		<link href="../req/cal-area.css" rel="stylesheet" type="text/css"> <!-- CSS for the calendar body -->
		<script src="../fontawesome.com.js" crossorigin="anonymous"></script>

		<style type="text/css">
			/* Import Google font - Poppins */
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
				font-family: 'Poppins', sans-serif;
			}

			body {
				display: flex;
				align-items: center;
				padding: 0 10px;
				justify-content: center;
				min-height: 100vh;
				background: #9B59B6;
			}

			.wrapper {
				width: 450px;
				background: #fff;
				border-radius: 10px;
				box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
			}

			.wrapper header {
				display: flex;
				align-items: center;
				padding: 25px 30px 10px;
				justify-content: space-between;
			}

			header .icons {
				display: flex;
			}

			header .icons span {
				height: 38px;
				width: 38px;
				margin: 0 1px;
				cursor: pointer;
				color: #878787;
				text-align: center;
				line-height: 38px;
				font-size: 1.9rem;
				user-select: none;
				border-radius: 50%;
			}

			.icons span:last-child {
				margin-right: -10px;
			}

			header .icons span:hover {
				background: #f2f2f2;
			}

			header .current-date {
				font-size: 1.45rem;
				font-weight: 500;
			}

			.calendar {
				padding: 20px;
			}

			.calendar ul {
				display: flex;
				flex-wrap: wrap;
				list-style: none;
				text-align: center;
			}

			.calendar .days {
				margin-bottom: 20px;
			}

			.calendar li {
				color: #333;
				width: calc(100% / 7);
				font-size: 1.07rem;
			}

			.calendar .weeks li {
				font-weight: 500;
				cursor: default;
			}

			.calendar .days li {
				z-index: 1;
				cursor: pointer;
				position: relative;
				margin-top: 30px;
			}

			.days li.inactive {
				color: #aaa;
			}

			.days li.active {
				color: #fff;
			}

			.days li::before {
				position: absolute;
				content: "";
				left: 50%;
				top: 50%;
				height: 40px;
				width: 40px;
				z-index: -1;
				border-radius: 50%;
				transform: translate(-50%, -50%);
			}

			.days li.active::before {
				background: #9B59B6;
			}

			.days li:not(.active):hover::before {
				background: #f2f2f2;
			}

			.Daytoday {
				position: relative;
				left: 0;
			}


			.abs {
				position: absolute;
			}

			.rel {
				position: relative;
			}
		</style>

	</head>

	<body>
		<header class="main-header clearfix" role="header">
			<div class="logo">
				<a href="../index.php"><em>SFT</em> තක්සලාව</a>
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
				<h1 class="display-6">SFT තක්සලාව</h1>
				<h6>Moderator Panel</h6>
			</div>
			<div class="card text-center">
				<div class="card-header">
					<h4 class='display-6' style='color: #000;'>Attendane Marking</h4>
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
							<input type="text" class="form-control" placeholder="Enter Student ID!" aria-label="studentId" aria-describedby="basic-addon1" name='id3' autocomplete="off">
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
							$date = date("Y-m-d");
							// echo "<script>alert('Attendance Marked!');</script>";
							// header("Refresh:0; url=Moderator.php");
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
									$sql5 = "INSERT INTO attendance (regclassId, date_, d2d) VALUES ('$regClassId', '$date', '$isDone')";
									$result5 = mysqli_query($con, $sql5);
									if ($result5) {
										// $sql6 = "SELECT COUNT(*) ";
										echo "<script>alert('Attendance Marked!');</script>";
										header("Refresh:0; url=Moderator.php");
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
							<input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name='paid'>
							<label class="form-check-label" for="flexCheckChecked">Paid/ Not Paid</label>
						</div>
						<div class="d-grid gap-2">
							<input class="btn btn-primary" type="submit" name='finals' value='Mark as Attend!'>
						</div>
				</div>
			</div>
			</form>
			<!-- </div> -->
			<hr style="border: 2px solid red;">
			<!-- CAALENDAR AREA -->
			<!-- <div class="container"> -->
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
				//$calendar = new Calendar($fulldate);
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
							//$calendar->add_event('Attended, D2D', $date, 1, 'green');
						} else {
							//$calendar->add_event('Attended', $date, 1, 'orange');
						}
					}
				}
			} else {
				// $calendar->add_event('Not Attended', $day, 1, 'red');
			}
			?>
			<nav class="nav-justified bg-dark ">
				<div class="Daytoday text-center">
					<h1 class='display-6' style='color: #FFFFFF;'>Day to Day Paper</h1>
				</div>
			</nav>
			<!-- <div class="content home"> -->
			<?php //if(isset($_POST['submit'])) { echo $calendar; } 
			?>
			<div class="wrapper">
				<header>
					<p class="current-date d-flex justify-content-center"></p>
					<div class="icons ral">
						<span id="prev" class="material-symbols-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
								<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
							</svg></span>
						<span id="next" class="material-symbols-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
								<path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
							</svg></span>
					</div>
				</header>
				<div class="calendar ral">
					<ul class="weeks ral">
						<li>Sun</li>
						<li>Mon</li>
						<li>Tue</li>
						<li>Wed</li>
						<li>Thu</li>
						<li>Fri</li>
						<li>Sat</li>
					</ul>
					<ul class="days"></ul>
				</div>
			</div>
		</div>
		<!-- </div> --></div>
		</div>
		<br><br>
		<br><br>

		<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../js/isotope.min.js"></script>
		<script src="../js/sftthaksalawacustom.js"></script>
		<script type="text/javascript">
			const daysTag = document.querySelector(".days"),
				currentDate = document.querySelector(".current-date"),
				prevNextIcon = document.querySelectorAll(".icons span");

			// getting new date, current year and month
			let date = new Date(),
				currYear = date.getFullYear(),
				currMonth = date.getMonth();

			// storing full name of all months in array
			const months = ["January", "February", "March", "April", "May", "June", "July",
				"August", "September", "October", "November", "December"
			];

			const renderCalendar = () => {
				let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
					lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
					lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
					lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
				let liTag = "";

				for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
					liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
				}

				for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
					// adding active class to li if the current day, month, and year matched
					let isToday = i === date.getDate() && currMonth === new Date().getMonth() &&
						currYear === new Date().getFullYear() ? "active" : "";
					liTag += `<li class="${isToday}">${i}</li>`;
				}

				for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
					liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
				}
				currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
				daysTag.innerHTML = liTag;
			}
			renderCalendar();

			prevNextIcon.forEach(icon => { // getting prev and next icons
				icon.addEventListener("click", () => { // adding click event on both icons
					// if clicked icon is previous icon then decrement current month by 1 else increment it by 1
					currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

					if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
						// creating a new date of current year & month and pass it as date value
						date = new Date(currYear, currMonth);
						currYear = date.getFullYear(); // updating current year with new date year
						currMonth = date.getMonth(); // updating current month with new date month
					} else {
						date = new Date(); // pass the current date as date value
					}
					renderCalendar(); // calling renderCalendar function
				});
			});
		</script>
		<?php include '../req/footer.php'; ?>
	</body>

	</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>