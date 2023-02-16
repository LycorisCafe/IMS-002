<?php

function input_data($data)
{
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $marks = input_data($_POST["marks"]);
        if (!preg_match("/^[0-9]*$/", $marks)) {
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
        if (!preg_match("/^[0-9]*$/", $rank)) {
            $rankErr = "Only numeric value is allowed";
            header("Location: exams.php?error=$rankErr");
            exit;
        }
    }

    $date = date("Y-m-d");
    include_once '../connection.php';
    if ($markErr == "" && $rankErr == "") {
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
