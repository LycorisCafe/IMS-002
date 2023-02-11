<?<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {

include '../connection.php';




} else {
	header("Location: ../login.php");
	exit;
}
?>