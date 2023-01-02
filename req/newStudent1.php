<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add a New Student</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

<?php

    if(isset($_POST['submit']))
    {
        // user data
        $id = $_POST['id2'];
        $admissionNo = $_POST['admissionNo'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $alYear = $_POST['alYear'];
        $dob = $_POST['DOB'];
        $alYear = $_POST['alYear'];
        $institute = $_POST['institute'];

        // file data
        $name = $_FILES['pic'] ['name'];
        $type = $_FILES['pic'] ['type'];
        $size = $_FILES['pic'] ['size'];
        $temp = $_FILES['pic'] ['tmp_name'];
        $error = $_FILES['pic'] ['error'];

        if($error > 0)
        {
            $temp2 = explode(".", $name);
            include_once '../connection.php';
            $sql = "INSERT INTO students(id, admissionNo, fname, lname, al_year, DOB, pic, institute) VALUES ('$id', 
                                '$admissionNo', '$fname', '$lname', '$alYear', '$dob', '', '$institute')";
            $result = mysqli_query($con, $sql);

            $sql2 = "SELECT id FROM classes WHERE institute='$institute'";
            $result2 = mysqli_query($con, $sql2);
            $row = $result2->fetch_assoc();
            $classid = $row['id'];

            $sql3 = "INSERT INTO regclass(studentId, classId) VALUES ('$id', '$classid')";
            $result3 = mysqli_query($con, $sql3);
            if($result && $result2 && $result3)
            {
                echo "<script>alert('New Student adding completed!');</script>";
            }else{
                echo "<script>alert('New Student adding Unsuccess!');</script>";
            }
        }else{
            $temp2 = explode(".", $name);
            $filename = "../uploads/$id.".$temp2[1];
            move_uploaded_file($temp, $filename);
            include_once '../connection.php';
            $sql = "INSERT INTO students(id, admissionNo, fname, lname, al_year, DOB, pic, institute) VALUES ('$id', 
                                '$admissionNo', '$fname', '$lname', '$alYear', '$dob', '$filename', '$institute')";
            $result = mysqli_query($con, $sql);
            $sql2 = "SELECT id FROM classes WHERE institute='$institute'";
            $result2 = mysqli_query($con, $sql2);
            while($row = $result2->fetch_assoc())
            {
                $classid = $row['id'];
                $sql3 = "INSERT INTO regclass(studentId, classId) VALUES ('$id', '$classid')";
                $result3 = mysqli_query($con, $sql3);
            }
            if($result && $result2 && $result3)
            {
                echo "<script>alert('New Student adding completed!');</script>";
            }else{
                echo "<script>alert('New Student adding Unsuccess!');</script>";
            }
            //
        }
    }

?>
    <body>
    <?php require_once "navbar.php"; ?>

    <div class="container col-lg-4 col-md-5 align-self-center">
						<div class="card" style="transform: translate(0%, 10%);">
								<div class="card-header text-center">
										<h3 class='display-5' style='color: #fff;'>New Student</h3>
								</div>
								<div class="card-body">
										<form action="newStudent1.php"  method="POST" enctype='multipart/form-data'>
                                                <div class="col-auto mb-3">
														<label class="form-label">Institute: </label>
														<select class="form-control" name='institute'>
                                                            <?php
                                                                include_once '../connection.php';
                                                                $sql5 = "SELECT DISTINCT institute, city FROM classes";
                                                                $result5 = mysqli_query($con, $sql5);
                                                                while($ri = mysqli_fetch_assoc($result5)) { 
                                                            ?>
                                                            <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute']. " - " .$ri['city'] ?></option>
                                                            <?php } ?>
														</select>
												</div>
                                                <div class="col-auto mb-3">
														<label class="form-label">Admission Number: </label>
														<input type="text" class="form-control" name="admissionNo" aria-describedby="admissionNo" autocomplete="off" required placeholder="XXXX">
												</div>
                                                <div class="col-auto mb-3">
														<label class="form-label">Student ID: </label>
														<input type="text" class="form-control" name="id2" aria-describedby="id2" autocomplete="off" required placeholder="XXXX">
												</div>
												<div class="col-auto mb-3">
														<label class="form-label">First Name: </label>
														<input type="text" class="form-control" name="fname" aria-describedby="fname" autocomplete="off" required placeholder="David">
												</div>
                                                <div class="col-auto mb-3">
														<label class="form-label">Last Name: </label>
														<input type="text" class="form-control" name="lname" aria-describedby="lname" autocomplete="off" required placeholder="Johns">
												</div>
                                                <div class="col-auto mb-3">
														<label class="form-label">A/L year: </label>
														<input type="text" class="form-control" name="alYear" aria-describedby="alYear" autocomplete="off" required placeholder="2022">
												</div>
                                                <div class="col-auto mb-3">
														<label class="form-label">Date of Birth (DOB): </label>
														<input type="text" class="form-control" name="DOB" aria-describedby="DOB" autocomplete="off" required placeholder="FORMAT: 2022-01-01">
												</div>
												<div class="col-auto mb-3">
														<label class="form-label">Student Photo :</label>
														<input type="file" class="form-control" name="pic" aria-describedby="pic">
												</div>
												<div class="d-grid gap-2">
														<button type="submit" class="btn btn-primary" name='submit'>Add</button>
												</div>
										</form>
								</div>
						</div>
				</div><br/><br/><br/>

        
<?php include 'footer.php'; ?>
  </body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>