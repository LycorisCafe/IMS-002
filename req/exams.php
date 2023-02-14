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
            if (!preg_match ("/^[0-9]*$/", $marks)) {
                $markErr = "Only numeric value is allowed"; 
                header("Location: exams.php?error=$markErr");
                exit;
            } else {
                if ($marks >= 0 && $marks <= 100) { 
                    if ($marks >= 75) {
                        $grade = "A";
                    } else if ($marks >= 65) {
                        $grade = "B";
                    } else if ($marks >= 50) {
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
                    $m = "Marksheet Updated for $id";
                    header("Location: exams.php?success=$m");
                    exit;
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
        <br/><br/><h1 class='display-1 text-center' style='color: #fff;'>Exams</h1><br/>
        <div class="container"><h1 class="display-5" style="color: #10A0FF;">Add Marks</h1></div>
        <div class="container col-lg-8 col-md-5 align-self-center" style="transform: translate(0%, 5%);">
                <div class="card-body">
                    <form action="exams.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class='alert alert-success' role='alert'>
                                <?= $_GET['success'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id" autocomplete="off" required placeholder="123456">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Marks: </label>
                            <input type="text" class="form-control" name="marks" autocomplete="off" required placeholder="100">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Rank: </label>
                            <input type="text" class="form-control" name="rank" autocomplete="off" required placeholder="1">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Search & Submit</button>
                        </div>
                    </form>
            </div></div></div>
            <br /><br /><br />

            <div class="container">
                <h1 class="display-5 text-warning">Edit Marks</h1><br />
                <form class="d-flex mb-3" method="POST" action="exams.php">
                    <input class="form-control me-2" type="search" placeholder="Search for Student by ID" name="stID" autocomplete="off" id="id">
                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
            </form>
            </div>

            <?php
                include_once '../connection.php';
                if(isset($_POST['search'])) {
                    $rank2 = "";
                    $name2 = "";
                    if(!empty($_POST['stID'])) {
                        $stID = $_POST['stID'];
                        $sql4 = "SELECT * FROM students WHERE id='$stID'";
                        $result4 = mysqli_query($con, $sql4);
                        if(mysqli_num_rows($result4) > 0 && mysqli_num_rows($result4) < 2) {
                            $row4 = mysqli_fetch_assoc($result4);
                            $name = $row4['fname'] . " " . $row4['lname'];
                            $sql5 = "SELECT id FROM regclass WHERE studentId='$stID'";
                            $result5 = mysqli_query($con, $sql5);
                            $row5 = mysqli_fetch_assoc($result5);
                            $regID = $row5['id'];
                            $today = date("Y-m-d");
                            $sql6 = "SELECT * FROM exam WHERE regclassID='$regID' AND date='$today'";
                            $result6 = mysqli_query($con, $sql6);
                            if(mysqli_num_rows($result6) > 0) {
                                $row6 = mysqli_fetch_assoc($result6);
                                $marks2 = $row6['marks'];
                                $rank2 = $row6['rank'];
                                
                            } else {
                                echo "<script>alert('No today records for $stID')</script>";
                            }
                        } else {
                            $em = "Invalid Student ID";
                            header("Location: exams.php?error=$em");
                            exit;
                        }
                    } else {
                        $em = "Enter the Student ID!";
                        header("Location: exams.php?error=$em");
                        exit;
                    }
                }
            ?>

            <?php
                include_once '../connection.php';
                if(isset($_POST['update'])) {
                    if(!empty($_POST['id2']) && !empty($_POST['name2']) && !empty($_POST['marks2']) && !empty($_POST['rank2'])) {
                        $id = $_POST['id2'];
                        $marks2 = $_POST['marks2'];
                        $rank2 = $_POST['rank2'];
                        $name = $_POST['name2'];
                        $grade = "";


                        if ($marks2 >= 0 && $marks2 <= 100) { 
                            if ($marks2 >= 75) {
                                $grade = "A";
                            } else if ($marks2 >= 65) {
                                $grade = "B";
                            } else if ($marks2 >= 50) {
                                $grade = "C";
                            } else if ($marks2 >= 35) {
                                $grade = "S";
                            } else {
                                $grade = "W";
                            }
                        } else {
                            $em = "Marks should be 0 - 100 range!";
                            header("Location: exams.php?error=$em");
                            exit;
                        }

                        $sql8 = "SELECT * FROM regclass WHERE studentId='$id'";
                        $result8 = mysqli_query($con, $sql8);
                        $row8 = mysqli_fetch_assoc($result8);
                        $regid = $row8['id'];

                        $sql9 = "SELECT * FROM exam WHERE regclassID='$regid' ORDER BY date DESC LIMIT 1";
                        $result9 = mysqli_query($con, $sql9);
                        if(mysqli_num_rows($result9) > 0 && mysqli_num_rows($result9) < 2) {
                            $row9 = mysqli_fetch_assoc($result9);
                            $date = $row9['date'];

                            $sql7 = "UPDATE exam SET marks='$marks2', grade='$grade', rank='$rank2' WHERE date='$date'";
                            if(mysqli_query($con, $sql7)) {
                                echo "<script>alert('Successfully updates Marksheet of $name')</script>";
                            } else {
                                echo "<script>alert('Faild to update the Marsheet of $name')</script>";
                            }

                        } else {
                            echo "<script>alert('No recent exam records for $id')</script>";
                        }
                    }
                }
            ?>

            <div class="container">
                <br>
                <form action="exams.php" method="POST">
                <div class='row'>
                        <div class='col'>
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id2" autocomplete="off" readonly value="<?php if(isset($_POST['search'])) { echo $stID; } ?>">
                        </div>
                        <div class='col'>
                            <label class="form-label">Name: </label>
                            <input type="text" class="form-control" name="name2" autocomplete="off" readonly value="<?php if(isset($_POST['search'])) { echo $name; } ?>">
                        </div>
                    </div><div class='row'>
                        <div class='col'>
                            <label class="form-label">Marks: </label>
                            <input type="text" class="form-control" name="marks2" autocomplete="off" required placeholder="000" value="<?php if(isset($_POST['search']) && $marks2 != "") { echo $marks2; } ?>">
                        </div>
                        <div class='col'>
                            <label class="form-label">Rank: </label>
                            <input type="text" class="form-control" name="rank2" autocomplete="off" required placeholder="000" value="<?php if(isset($_POST['search']) && $rank2 != "") { echo $rank2; } ?>">
                        </div>
                    </div><br/>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-warning" type="submit" name="update">UPDATE</button>
                    </div>
                </form>
            </div>

            <br><br><br><br>

            <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>