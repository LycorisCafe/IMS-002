<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exams</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js"></script>
    </head>

    <?php

    function input_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;  
    }

    $markErr = $rankErr = "";

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $marks = $_POST['marks'];
        $rank = $_POST['rank'];

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $marks = input_data($_POST["marks"]);  
            // check if al year is well-formed  
            if (!preg_match ("/^[0-9]*$/", $marks)) {
                $markErr = "Only numeric value is allowed"; 
                header("Location: exams.php?error=$markErr");
                exit;
            } else {
                // messedup if...else if... else statement with python. && for AND operator in php
                if ($marks >= 0 && $marks <= 100) { 
                    if ($marks >= 75) {
                        $grade = "A";
                    } else if ($marks >= 65) {
                        $grade = "B";
                    } else if ($marks >= 55) {
                        $grade = "C";
                    } else if ($marks >= 35) {
                        $grade = "S";
                    } else {
                        $grade = "W";
                    }
                } else {
                    $em = "Marks should be 0 - 100 range!";
                    header("Location: exams.php?error=$em");
                    exit;
                }
            }
            $rank = input_data($_POST["rank"]);  
            // check if al year is well-formed  
            if (!preg_match ("/^[0-9]*$/", $rank)) {
                $rankErr = "Only numeric value is allowed"; 
                header("Location: exams.php?error=$rankErr");
                exit;
            }

        }

        $date = date("Y-m-d");
        include_once '../connection.php';
        if($markErr == "" && $rankErr == "") {
            $sql1 = "SELECT id FROM regclass WHERE studentId='$id'";
            $result1 = mysqli_query($con, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
                $regclzid = $row1['id'];

                $sql2 = "SELECT * FROM exam WHERE regclassID='$regclzid' AND date='$date'";
                $result2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($result2) == 0) {
                    $sql3 = "INSERT INTO exam (regclassID, date, marks, grade, rank) VALUES ('$regclzid', '$date', '$marks', '$grade', '$rank')";
                    $result3 = mysqli_query($con, $sql3);
                    echo "<script>alert('Marksheet updated!');</script>";
                } else {
                    $em = "Marks already added!";
                    header("Location: exams.php?error=$em");
                    exit;
                }
            } else {
                $em = "Invalid Student ID or Not found the ID";
                header("Location: exams.php?error=$em");
                exit;
            }
        }
    }
    ?>

    <body>
        <?php require_once "navbar.php"; ?>        <!-- Imports -->
        <div class="container col-lg-8 col-md-5 align-self-center" style="transform: translate(0%, 20%);">
                    <h3 class='display-4 text-center' style='color: #fff;'>Exam Result</h3><br/>
                <div class="card-body">
                    <form action="exams.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id" aria-describedby="id" autocomplete="off" required placeholder="123456">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Marks: </label>
                            <input type="text" class="form-control" name="marks" aria-describedby="marks" autocomplete="off" required placeholder="100">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Rank: </label>
                            <input type="text" class="form-control" name="rank" aria-describedby="rank" autocomplete="off" required placeholder="1">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Search & Submit</button>
                        </div>
                    </form>
            </div><br><br><br><br>

            <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>