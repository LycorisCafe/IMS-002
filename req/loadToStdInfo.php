<div class="container">
					<div class="row justify-content-center">
						<div class="col-sm-12 col-lg-4 p-1 d-flex">
							<div class="card">
								<div class="row">
									<div class="col-4">
										<img src="../Media/images/group.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
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
													if(mysqli_num_rows($result9) > 0) {
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
										<img src="../Media/images/group.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
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
													if(mysqli_num_rows($result11) > 0) {
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
													if(mysqli_num_rows($result12) > 0) {
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


<div class="container">
					<h1 class="display-6">Latest Exam Result (Last Day)</h1><br />
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
								$sql7 = "SELECT id FROM regClass WHERE studentId='$std_id'";
								$result7 = mysqli_query($con, $sql7);
								if(mysqli_num_rows($result7) > 0) {
									$row7 = mysqli_fetch_assoc($result7);
									$regClassid = $row7['id'];
									$sql8 = "SELECT * FROM exam WHERE regclassID='$regClassid' ORDER BY date DESC LIMIT 1;";
									$result8 = mysqli_query($con, $sql8);
									$row8 = mysqli_fetch_assoc($result8);
									$date = $row8['date'];
									$marks = $row8['marks'];
									$grade = $row8['grade'];
									$rank = $row8['rank'];

									echo "<tr>";
										echo "<td>$date</td>";
										echo "<td>$marks</td>";
										echo "<td>$grade</td>";
										echo "<td>$rank</td>";
									echo "</tr>";
								}
							}
							?>
						</tbody>
					</table><br/>
				</div>
				
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
								if(mysqli_num_rows($result5) > 0) {
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
				
			<div class="container">
				<h1 class="display-6">Progress Analysis (This Month)</h1><br />
			<div id="curve_chart"></div>

				<br><br>
				
				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				<script type="text/javascript">
					
					google.charts.load('current', {'packages':['corechart']});
				    google.charts.setOnLoadCallback(drawChart);

				      function drawChart() {
				        var data = google.visualization.arrayToDataTable([
				          ['Month', 'Marks'],
				          <?php
							if(isset($_POST['search'])) {
								//$date = array();
								//$marks = array();
								$data = array();
								$firstDay = date('Y-m-01');
								$lastDay = date('Y-m-t');
								$std_id = $_POST['std_id'];
								$sql9 = "SELECT id FROM regClass WHERE studentId='$std_id'";
								$result9 = mysqli_query($con, $sql9);
								if(mysqli_num_rows($result9) > 0) {
									$row9 = mysqli_fetch_assoc($result9);
									$regClassid = $row5['id'];
									$sql10 = "SELECT * FROM exam WHERE '$firstDay' <= date and date <= '$lastDay' AND regclassID='$regClassid'";
									$result10 = mysqli_query($con, $sql10);
									while ($row10 = mysqli_fetch_assoc($result10)) {
										echo "['".$row10['date']."', ".$row10['marks']."],";
									}
								}
							}
						?>
				        ]);

				        var options = {
				          title: 'Student Progress',
				          curveType: 'function',
				          legend: { position: 'bottom' }
				        };

				        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

				        chart.draw(data, options);
				      }

				</script>
				
				<div id="curve_chart" style="width: 100%; height: 50%;"></div>
				</div>
			</div>

		</div>