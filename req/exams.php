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
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $marks = $_POST['marks'];
        $rank = $_POST['rank'];

        // finding the grade
        if ($marks >= 0 and $marks <= 100) {
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

        $date = date("Y-m-d");

        // db
        include_once '../connection.php';
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
            $em = "Invalid Student ID or Not found the iD";
            header("Location: exams.php?error=$em");
            exit;
        }
    }
    ?>

    <body>
        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <div class="container col-lg-4 col-md-5 align-self-center">
            <div class="card" style="transform: translate(0%, 20%);">
                <div class="card-header text-center">
                    <h3 class='display-5' style='color: #fff;'>Exam Result</h3>
                </div>
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
                </div>
            </div><br><br><br><br>

            <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>