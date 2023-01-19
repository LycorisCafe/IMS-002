<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Attendance Report</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <div class="container"><br />
            <h1 class="display-2 text-center" style="color: #fff;">Attendance Report</h1><br><br />
        </div>

        <div class="container">
            <fieldset>
                <legend>Filters</legend>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Institute: </label>
                            <select class="form-control" name='institute'>
                                <option value="All">All</option>
                                <?php
                                include_once '../connection.php';
                                $sql1 = "SELECT DISTINCT institute, city FROM classes";
                                $result1 = mysqli_query($con, $sql1);
                                while ($ri = mysqli_fetch_assoc($result1)) {
                                ?>
                                    <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] . " - " . $ri['city'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Year: </label>
                            <select class="form-control" name='year'>
                                <option value="All">All</option>
                                <?php
                                $sql2 = "SELECT DISTINCT al_year FROM classes";
                                $result2 = mysqli_query($con, $sql2);
                                while ($ri2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                    <option value="<?php echo $ri2['al_year'] ?>"><?php echo $ri2['al_year'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">State: </label>
                            <select class="form-control" name='state'>
                                <option value="attend">Attended</option>
                                <option value="nAttend">Not Attended</option>
                            </select>
                        </div>
                    </div><br />
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" type="submit" name="search">Fetch Data</button>
                    </div>
                </form>
            </fieldset>
        </div><br /><br />

        <div class="container">
            <h4>Student Count : <span class="badge bg-secondary" id="count"></span></h4>
        </div>

        <div class="container-fluid">
            <div class="bd-example-snippet bd-code-snippet"><br />
                <div class="bd-example">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Admissoin No.</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">A/L Year</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Institute</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['search'])) {
                                $ins = $_POST['institute'];
                                $year = $_POST['year'];
                                $state = $_POST['state'];
                                $today = date("Y-m-d");
                                if ($state == "attend") {
                                    if ($ins == "All") {
                                        if ($year == "All") {
                                            $sql4 = "SELECT * FROM attendance WHERE date_='$today'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $count = 0;
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $clzID = $row4['regclassId'];
                                                $sql5 = "SELECT * FROM regclass WHERE id='$clzID'";
                                                $result5 = mysqli_query($con, $sql5);
                                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                                    $stdID = $row5['studentId'];
                                                    $sql6 = "SELECT * FROM students WHERE id='$stdID'";
                                                    $result6 = mysqli_query($con, $sql6);
                                                    $countRow = mysqli_num_rows($result6);
                                                    $count += $countRow;
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        $addNo = $row6['admissionNo'];
                                                        $sid = $row6['id'];
                                                        $fname = $row6['fname'];
                                                        $lname = $row6['lname'];
                                                        $alYear = $row6['al_year'];
                                                        $dob = $row6['DOB'];
                                                        $institute = $row6['institute'];

                                                        echo "<tr>";
                                                        echo "<td>$addNo</td>";
                                                        echo "<td>$sid</td>";
                                                        echo "<td>$fname</td>";
                                                        echo "<td>$lname</td>";
                                                        echo "<td>$alYear</td>";
                                                        echo "<td>$dob</td>";
                                                        echo "<td>$institute</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                            echo "<script>document.getElementById('count').textContent = $count</script>";
                                        } else {
                                            $sql4 = "SELECT * FROM attendance WHERE date_='$today'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $count = 0;
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $clzID = $row4['regclassId'];
                                                $sql5 = "SELECT * FROM regclass WHERE id='$clzID'";
                                                $result5 = mysqli_query($con, $sql5);
                                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                                    $stdID = $row5['studentId'];
                                                    $sql6 = "SELECT * FROM students WHERE id='$stdID' AND al_year='$year'";
                                                    $result6 = mysqli_query($con, $sql6);
                                                    $countRow = mysqli_num_rows($result6);
                                                    $count += $countRow;
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        $addNo = $row6['admissionNo'];
                                                        $sid = $row6['id'];
                                                        $fname = $row6['fname'];
                                                        $lname = $row6['lname'];
                                                        $alYear = $row6['al_year'];
                                                        $dob = $row6['DOB'];
                                                        $institute = $row6['institute'];

                                                        echo "<tr>";
                                                        echo "<td>$addNo</td>";
                                                        echo "<td>$sid</td>";
                                                        echo "<td>$fname</td>";
                                                        echo "<td>$lname</td>";
                                                        echo "<td>$alYear</td>";
                                                        echo "<td>$dob</td>";
                                                        echo "<td>$institute</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                            echo "<script>document.getElementById('count').textContent = $count</script>";
                                        }
                                    } else {
                                        if ($year == "All") {
                                            $sql4 = "SELECT * FROM attendance WHERE date_='$today'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $count = 0;
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $clzID = $row4['regclassId'];
                                                $sql5 = "SELECT * FROM regclass WHERE id='$clzID'";
                                                $result5 = mysqli_query($con, $sql5);
                                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                                    $stdID = $row5['studentId'];
                                                    $sql6 = "SELECT * FROM students WHERE id='$stdID' AND institute='$ins'";
                                                    $result6 = mysqli_query($con, $sql6);
                                                    $countRow = mysqli_num_rows($result6);
                                                    $count += $countRow;
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        $addNo = $row6['admissionNo'];
                                                        $sid = $row6['id'];
                                                        $fname = $row6['fname'];
                                                        $lname = $row6['lname'];
                                                        $alYear = $row6['al_year'];
                                                        $dob = $row6['DOB'];
                                                        $institute = $row6['institute'];

                                                        echo "<tr>";
                                                        echo "<td>$addNo</td>";
                                                        echo "<td>$sid</td>";
                                                        echo "<td>$fname</td>";
                                                        echo "<td>$lname</td>";
                                                        echo "<td>$alYear</td>";
                                                        echo "<td>$dob</td>";
                                                        echo "<td>$institute</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                            echo "<script>document.getElementById('count').textContent = $count</script>";
                                        } else {
                                            $sql4 = "SELECT * FROM attendance WHERE date_='$today'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $count = 0;
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $clzID = $row4['regclassId'];
                                                $sql5 = "SELECT * FROM regclass WHERE id='$clzID'";
                                                $result5 = mysqli_query($con, $sql5);
                                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                                    $stdID = $row5['studentId'];
                                                    $sql6 = "SELECT * FROM students WHERE id='$stdID' AND al_year='$year' AND institute='$ins'";
                                                    $result6 = mysqli_query($con, $sql6);
                                                    $countRow = mysqli_num_rows($result6);
                                                    $count += $countRow;
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        $addNo = $row6['admissionNo'];
                                                        $sid = $row6['id'];
                                                        $fname = $row6['fname'];
                                                        $lname = $row6['lname'];
                                                        $alYear = $row6['al_year'];
                                                        $dob = $row6['DOB'];
                                                        $institute = $row6['institute'];

                                                        echo "<tr>";
                                                        echo "<td>$addNo</td>";
                                                        echo "<td>$sid</td>";
                                                        echo "<td>$fname</td>";
                                                        echo "<td>$lname</td>";
                                                        echo "<td>$alYear</td>";
                                                        echo "<td>$dob</td>";
                                                        echo "<td>$institute</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                            echo "<script>document.getElementById('count').textContent = $count</script>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>