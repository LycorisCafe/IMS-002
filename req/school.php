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
		<br/><h1 class="display-2 text-center">Schools</h1><br/>
		<div class="container">
			<h1 class="display-6">Registered Schools</h1><br/>
			<table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">School</th>
                        <th scope="col">City/ Town</th>
                        <th scope="col">District</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    	<td>1</td>
                    	<td>Christ Church Boys' College</td>
                    	<td>Baddegama</td>
                    	<td>Galle</td>
                    </tr>
                </tbody>
            </table>
		</div><br/><br/>

		<h1 class="display-6 container">Add new School</h1><br />
        <div class="container col-lg-8 col-md-5 align-self-center">
                <div class="card-body">
                    <form action="accounts.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">School: </label>
                            <input type="text" class="form-control" name="school" aria-describedby="school" autocomplete="off" required placeholder="">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">City/ Town: </label>
                            <input type="password" class="form-control" name="town" aria-describedby="town" autocomplete="off" required placeholder="">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">District: </label>
                            <select name="district" class="form-control">
                            	<option>Galle</option>
                            	<option>Matara</option>
                            	<option>Hambanthota</option>
                            	<option>Colombo</option>
                            	<option>Kaluthara</option>
                            	<option>Gampaha</option>
                            	<option>Nuwara Eliya</option>
                            	<option>Rathnapura</option>
                            	<option>Puttalama</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
                            	<option>Galle</option>
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