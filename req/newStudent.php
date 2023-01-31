<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add a New Student</title>
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

    function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    $fnameErr = $lnameErr = $admissionErr = $yearErr = $dateErr = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = input_data($_POST["fname"]);    
        if (!preg_match("/^[a-zA-Z]*$/",$fname)) {  
            $fnameErr = "Only alphabets and white space are not allowed";
            header("Location: newStudent.php?error=$fnameErr");
            exit;
        }

        $lname = input_data($_POST["lname"]);  
        if (!preg_match("/^[a-zA-Z]*$/",$lname)) {  
            $lnameErr = "Only alphabets and white space are not allowed";
            header("Location: newStudent.php?error=$lnameErr");
            exit;
        }

        $aNO = input_data($_POST["admissionNo"]);  
        if (!preg_match ("/^[0-9]*$/", $aNO) ) {  
            $admissionErr = "Only numeric value is allowed."; 
            header("Location: newStudent.php?error=$admissionErr");
            exit;
        }

        $year = input_data($_POST["alYear"]);  
        if (!preg_match ("/^[0-9]*$/", $year) || strlen ($year) != 4 ) {
            $yearErr = "Enter a valid year."; 
            header("Location: newStudent.php?error=$yearErr");
            exit;
        }

        if (empty($_POST["DOB"])) {  
            $dateErr = "Date of Birth (DOB) is required";  
        } else {  
           $dob = $_POST["DOB"];
           try {
                if(!validateDate($dob)) {
                    $dateErr = "Enter a valid date";
                    header("Location: newStudent.php?error=$dateErr");
                    exit;
                }
           } catch (Exception $e) {
                $dateErr = "Enter a valid date";
                header("Location: newStudent.php?error=$dateErr");
                exit;
           }
       }


    }

        if (isset($_POST['submit'])) {
            if($fnameErr == "" && $lnameErr == "" && $admissionErr == "" && $yearErr == "" && $dateErr == "") {
                $id = $_POST['id2'];
                $admissionNo = $_POST['admissionNo'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $dob = $_POST['DOB'];
                $alYear = $_POST['alYear'];
                $institute = $_POST['institute'];

                $name = $_FILES['pic']['name'];
                $type = $_FILES['pic']['type'];
                $size = $_FILES['pic']['size'];
                $temp = $_FILES['pic']['tmp_name'];
                $error = $_FILES['pic']['error'];

                if (!file_exists("../uploads")) {
                    mkdir("../uploads", 0777, true);
                }

                if ($error > 0) {
                    $temp2 = explode(".", $name);
                    include_once '../connection.php';
                    $sql6 = "SELECT * FROM students WHERE id='$id' OR admissionNo='$aNO'";
                    $result6 = mysqli_query($con, $sql6);
                    if (mysqli_num_rows($result6) < 1) {

                        $sql = "INSERT INTO students(id, admissionNo, fname, lname, al_year, DOB, pic, institute) VALUES ('$id', 
                                            '$admissionNo', '$fname', '$lname', '$alYear', '$dob', '', '$institute')";
                        $result = mysqli_query($con, $sql);

                        $sql2 = "SELECT id FROM classes WHERE institute='$institute'";
                        $result2 = mysqli_query($con, $sql2);
                        $row = $result2->fetch_assoc();
                        $classid = $row['id'];

                        $sql3 = "INSERT INTO regclass(studentId, classId, attendance) VALUES ('$id', '$classid', '0')";
                        $result3 = mysqli_query($con, $sql3);
                        if ($result && $result2 && $result3) {
                            echo "<script>alert('New Student adding completed!');</script>";
                        } else {
                            echo "<script>alert('New Student adding Unsuccess!');</script>";
                        }
                    } else {
                        $em = "Student ID or Admission No. is already exist!";
                        header("Location: newStudent.php?error=$em");
                        exit;
                    }
                } else {
                    $temp2 = explode(".", $name);
                    $filename = "../uploads/$id." . $temp2[1];
                    move_uploaded_file($temp, $filename);
                    include_once '../connection.php';
                    $sql7 = "SELECT id FROM students WHERE id='$id'";
                    $result7 = mysqli_query($con, $sql7);
                    if (mysqli_num_rows($result7) == 0) {
                        $sql = "INSERT INTO students(id, admissionNo, fname, lname, al_year, DOB, pic, institute) VALUES ('$id', 
                                                '$admissionNo', '$fname', '$lname', '$alYear', '$dob', '$filename', '$institute')";
                        $result = mysqli_query($con, $sql);
                        $sql2 = "SELECT id FROM classes WHERE institute='$institute'";
                        $result2 = mysqli_query($con, $sql2);
                        while ($row = $result2->fetch_assoc()) {
                            $classid = $row['id'];
                            $sql3 = "INSERT INTO regclass(studentId, classId, attendance) VALUES ('$id', '$classid', '0')";
                            $result3 = mysqli_query($con, $sql3);
                        }
                        if ($result && $result2 && $result3) {
                            echo "<script>alert('New Student adding completed!');</script>";
                        } else {
                            echo "<script>alert('New Student adding Unsuccess!');</script>";
                        }
                    } else {
                        $em = "$id is already exist!";
                        header("Location: newStudent.php?error=$em");
                        exit;
                    }
                }
            } else {
                $em = "Error occurred in adding new Student!";
                header("Location: newStudent.php?error=$em");
                exit;
            }
        }

    ?>

    <body>
        <?php require_once "navbar.php"; ?>
        <div class="container col-lg-8 col-md-5 align-self-center" style="transform:translate(0%, 10%);">
                    <h3 class='display-5 text-center' style='color: #fff;'>New Student</h3>
                <div class="card-body">
                    <?php if (isset($_GET['error'])) { ?>
                        <div class='alert alert-danger' role='alert'>
                            <?= $_GET['error'] ?>
                        </div>
                    <?php } ?>
                    <form action="newStudent.php" method="POST" enctype='multipart/form-data'>
                        <br/><br/><div class="col-auto mb-3">
                            <label class="form-label">Institute: </label>
                            <select class="form-control" name='institute'>
                                <?php
                                    include_once '../connection.php';
                                    $sql5 = "SELECT DISTINCT institute, city FROM classes";
                                    $result5 = mysqli_query($con, $sql5);
                                    while ($ri = mysqli_fetch_assoc($result5)) {
                                ?>
                                    <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] . " - " . $ri['city'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Admission Number: </label>
                            <input type="text" class="form-control" name="admissionNo" autocomplete="off" required placeholder="XXXX">
                            
                        </div>
                        <div class="col-auto mb-3"> <i class="bi bi-person"></i>
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id2" autocomplete="off" required placeholder="XXXX">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">First Name: </label>
                            <input type="text" class="form-control" name="fname" autocomplete="off" required placeholder="David">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Last Name: </label>
                            <input type="text" class="form-control" name="lname" autocomplete="off" required placeholder="Johns">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">A/L year: </label>
                            <input type="text" class="form-control" name="alYear" autocomplete="off" required placeholder="2022">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Date of Birth (DOB): </label>
                            <input type="text" class="form-control" name="DOB" autocomplete="off" required placeholder="FORMAT: 2022-01-01">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Student Photo :</label>
                            <input type="file" class="form-control" name="pic">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Add</button>
                        </div>
                    </form>
        </div><br /><br /><br />


        <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>