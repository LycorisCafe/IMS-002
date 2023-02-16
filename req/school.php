<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

<!DOCTYPE html>
	<html lang="en" data-bs-theme="dark">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Schools</title>
		<link rel="icon" type="image/x-icon" href="../Media/favicon.png">
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/fonts.css">
		<link rel="stylesheet" href="../css/temp.css">
		<script src="../fontawesome.com.js" crossorigin="anonymous"></script>
	</head>

	<body>
		<!-- Imports -->
		<?php require_once "navbar.php"; ?>
		<br/><h1 class="display-1 text-center">Schools</h1><br/>
		<div class="container">
			<h1 class="display-6">Registered Schools</h1><br/>
			<table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">School</th>
                        <th scope="col">City/ Town</th>
                        <th scope="col">District</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    	include '../connection.php';

						$sql1 = "SELECT * FROM schools";
						$result1 = mysqli_query($con, $sql1);
						if (mysqli_num_rows($result1) > 0) {
							while ($row1 = mysqli_fetch_assoc($result1)) {
								echo "
									<tr>
										<td>".$row1["id"]."</td>
										<td>".$row1["school"]."</td>
										<td>".$row1["town"]."</td>
										<td>".$row1["district"]."</td>
									</tr>";
							}
						}
                    ?>
                </tbody>
            </table>
		</div><br/><br/>

		<h1 class="display-6 container">Add new School</h1><br />
        <div class="container col-lg-8 col-md-5 align-self-center">
                <div class="card-body">
                    <form action="../data/school-data.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?><?php if (isset($_GET['success'])) { ?>
                            <div class='alert alert-success' role='alert'>
                                <?= $_GET['success'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">School: </label>
                            <input type="text" class="form-control" name="school" aria-describedby="school" autocomplete="off" required placeholder="Stanford University">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">City/ Town: </label>
                            <input type="text" class="form-control" name="town" aria-describedby="town" autocomplete="off" required placeholder="California">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">District: </label>
                            <select name="district" class="form-control">
                            	<option>Ampara</option>
                            	<option>Anuradhapura</option>
                            	<option>Badulla</option>
                            	<option>Batticaloa</option>
                            	<option>Colombo</option>
                            	<option>Galle</option>
                            	<option>Gampaha</option>
                            	<option>Hambantota</option>
                            	<option>Jaffna</option>
                            	<option>Kalutara</option>
                            	<option>Kandy</option>
                            	<option>Keglle</option>
                            	<option>Kilinochchi</option>
                            	<option>Kurunegala</option>
                            	<option>Mannar</option>
                            	<option>Matale</option>
                            	<option>Matara</option>
                            	<option>Monaragala</option>
                            	<option>Mullaitivu</option>
                            	<option>Nuwara Eliya</option>
                            	<option>Polonnaruwa</option>
                            	<option>Puttalam</option>
                            	<option>Ratnapura</option>
                            	<option>Trincomalee</option>
                            	<option>Vavuniya</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Add</button>
                        </div>
                    </form>
            </div><br><br><br>
        </div>
		<?php include 'footer.php'; ?>
	</body>

</html>

<?php } else {
	header("Location: ../login.php");
	exit;
}
?>