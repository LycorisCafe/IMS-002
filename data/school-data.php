<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {

function input_data($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

require '../connection.php';
$sclError = $townError = "";

if(isset($_POST['submit'])) {
	$school = input_data($_POST["school"]);    
	if (preg_match ("/^[0-9]*$/", $school)) {  
		$sclError = "Only alphabets are allowed";
		header("Location: ../req/school.php?error=$sclError");
		exit;
	}

	$town = input_data($_POST["town"]);  
	if (preg_match ("/^[0-9]*$/", $town)) {  
		$townError = "Only alphabets are allowed";
		header("Location: ../req/school.php?error=$townError");
		exit;
	}
}

if(isset($_POST['submit'])) {
	if($sclError == "" && $townError == "") {
		$school = $_POST["school"];
		$town = $_POST["town"];
		$district = $_POST["district"];

		$sql2 = "SELECT * FROM schools WHERE school LIKE '%$school%' AND town LIKE '%$town%'";
		$result2 = mysqli_query($con, $sql2);
		if(mysqli_num_rows($result2) < 1) {
			$sql3 = "INSERT INTO schools (school, town, district) VALUES ('$school', '$town', '$district')";
			if(mysqli_query($con, $sql3)) {
				$m = "Successfully added new school <b><i>$school - $town</i></b>";
				header("Location: ../req/school.php?success=$m");
				exit;
			}

		}

	}
}


} else {
	header("Location: ../login.php");
	exit;
}
?>