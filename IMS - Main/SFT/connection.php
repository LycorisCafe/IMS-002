<?php

$servername = "127.0.0.1";
$username   = "root";
$password   = "";
$dbname     = "mydb";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>