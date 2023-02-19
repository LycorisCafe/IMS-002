<?php
session_start();
$markErr = $rankErr = "";
require_once '../connection.php';

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['submit'])) {
    if(!empty($_POST['id']) || !empty($_POST['date']) || !empty($_POST['marks']) || !empty($_POST['rank'])) {
        $id = $_POST['id'];
        $marks = $_POST['marks'];
        $rank = $_POST['rank'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $marks = input_data($_POST["marks"]);
            if (!preg_match("/^[0-9]*$/", $marks)) {
                $markErr = "Only numeric value is allowed";
                header("Location: ../req/exams.php?error=$markErr");
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
                        $grade = "F";
                    }
                } else {
                    $em = "Marks should be 0 - 100 range!";
                    header("Location: ../req/exams.php?error=$em");
                    exit;
                }
            }
            $rank = input_data($_POST["rank"]);
            if (!preg_match("/^[0-9]*$/", $rank)) {
                $rankErr = "Only numeric value is allowed";
                header("Location: ../req/exams.php?error=$rankErr");
                exit;
            }
        }

        $d = $_POST['date'];
        $date = str_replace('/', '-', $d);
        $date = date("Y-m-d", strtotime($date));
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
                    $m = "Marks added for <i><b>$id</b></i>";
                    header("Location: ../req/exams.php?success=$m");
                    exit;
                } else {
                    $em = "Marks already added!";
                    header("Location: ../req/exams.php?error=$em");
                    exit;
                }
            } else {
                $em = "Invalid Student ID or Incorrect Student ID";
                header("Location: ../req/exams.php?error=$em");
                exit;
            }
        }

    } else {
        $em = "All fields are required";
        header("Location: ../req/exams.php?error=$em");
        exit; 
    }
}

if(isset($_POST['search'])) {
    $d2 = $_POST['date2'];
    $date2 = str_replace('/', '-', $d2);
    $date2 = date("Y-m-d", strtotime($date2));
    $_SESSION['date2'] = $date2;
    $rank2 = "";
    $name2 = "";
    if(!empty($_POST['stID']) || !empty($_POST['date2'])) {
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
            $sql6 = "SELECT * FROM exam WHERE regclassID='$regID' AND date='$date2'";
            $result6 = mysqli_query($con, $sql6);
            if(mysqli_num_rows($result6) > 0) {
                $row6 = mysqli_fetch_assoc($result6);
                $marks2 = $row6['marks'];
                $rank2 = $row6['rank'];
                $data = "$stID,$name,$marks2,$rank2";
                header("Location: ../req/exams.php?data=$data");
                exit;
                
            } else {
                $em = "$stID has no exam records for $date2";
                header("Location: ../req/exams.php?error2=$em");
                exit;
            }
        } else {
            $em = "Invalid Student ID";
            header("Location: ../req/exams.php?error2=$em");
            exit;
        }
    } else {
        $em = "Student ID and Date required!";
        header("Location: ../req/exams.php?error2=$em");
        exit;
    }
}

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
                $grade = "F";
            }
        } else {
            $em = "Marks should be 0 - 100 range!";
            header("Location: ../req/exams.php?error2=$em");
            exit;
        }

        $sql8 = "SELECT id FROM regclass WHERE studentId='$id'";
        $result8 = mysqli_query($con, $sql8);
        $row8 = mysqli_fetch_assoc($result8);
        $regclassid = $row8['id'];

        $sql7 = "UPDATE exam SET marks='$marks2', grade='$grade', rank='$rank2' WHERE regclassID='$regclassid' AND date='".$_SESSION['date2']."'";
        if(mysqli_query($con, $sql7)) {
            $em = "Successfully updates Marksheet of <b>$name</b>";
            header("Location: ../req/exams.php?success2=$em");
            exit;
        } else {
            $em = "Faild to update the Marsheet of $name";
            header("Location: ../req/exams.php?success2=$em");
            exit;
        }

    }
}

?>