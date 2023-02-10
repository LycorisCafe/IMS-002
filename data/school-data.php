<?<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


<?php } else {
	header("Location: ../login.php");
	exit;
}
?>