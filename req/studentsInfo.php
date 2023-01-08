<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Information</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php require_once "navbar.php"; ?>
        <h1 class="display-2 text-center">Student Details</h1>
        <div class="container">
            <br>
            <form class="d-flex mb-3" role="search" method="POST" onsubmit="drawChart();" method="studentsInfo.php">
                <input class="form-control me-2" type="search" placeholder="Search for Student by ID" aria-label="Search" name="std_id">
                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                <button class="btn btn-outline-warning" type="reset" name="reset">Reset</button>
            </form>
        </div><br/>

        <?php include 'loadtoStdInfo.php'; ?>

        <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>