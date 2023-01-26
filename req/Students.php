<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Students</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js"></script>
    </head>

    <body>

        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <div class="container"><br />
            <h1 class="display-2 text-center" style="color: #fff;">Students</h1><br><br />
            <form action="Students.php" method="post">
                <div class="col-auto mb-3">
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
                <div class="col-auto mb-3">
                    <label class="form-label">A/L Year: </label>
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
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
            </form>
        </div>

        <div class="container-fluid">
            <?php
            if (isset($_POST['search'])) {
                $ins = $_POST['institute'];
                $year = $_POST['year'];
                echo "<br/><br/><h1 class='display-6' style='color: #fff;'>Showing Results for:- Institute: <font color='red'>" . $ins . "</font>  and  A/L Year: <font color='red'>" . $year . "</font></h1>";
            }
            ?>
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
                                if ($ins == "All") {
                                    if ($year == "All") {
                                        $sql3 = "SELECT * FROM `students` ORDER BY `students`.`al_year` ASC";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $addNo = $row3['admissionNo'];
                                            $sid = $row3['id'];
                                            $fname = $row3['fname'];
                                            $lname = $row3['lname'];
                                            $alYear = $row3['al_year'];
                                            $dob = $row3['DOB'];
                                            $institute = $row3['institute'];

                                            echo "<tr onmouseover='ChangeColor(this, true);' onmouseout='ChangeColor(this, false);' onclick='readvalues(this);' name='clicked'>";
                                            echo "<td>$addNo</td>";
                                            echo "<td>$sid</td>";
                                            echo "<td>$fname</td>";
                                            echo "<td>$lname</td>";
                                            echo "<td>$alYear</td>";
                                            echo "<td>$dob</td>";
                                            echo "<td>$institute</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $addNo = $row3['admissionNo'];
                                            $sid = $row3['id'];
                                            $fname = $row3['fname'];
                                            $lname = $row3['lname'];
                                            $alYear = $row3['al_year'];
                                            $dob = $row3['DOB'];
                                            $institute = $row3['institute'];

                                            echo "<tr onmouseover='ChangeColor(this, true);' onmouseout='ChangeColor(this, false);' onclick='readvalues(this);' name='clicked'>";
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
                                } else {
                                    if ($year == "All") {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $addNo = $row3['admissionNo'];
                                            $sid = $row3['id'];
                                            $fname = $row3['fname'];
                                            $lname = $row3['lname'];
                                            $alYear = $row3['al_year'];
                                            $dob = $row3['DOB'];
                                            $institute = $row3['institute'];

                                            echo "<tr onmouseover='ChangeColor(this, true);' onmouseout='ChangeColor(this, false);' onclick='readvalues(this);' name='clicked'>";
                                            echo "<td>$addNo</td>";
                                            echo "<td>$sid</td>";
                                            echo "<td>$fname</td>";
                                            echo "<td>$lname</td>";
                                            echo "<td>$alYear</td>";
                                            echo "<td>$dob</td>";
                                            echo "<td>$institute</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year' AND institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $addNo = $row3['admissionNo'];
                                            $sid = $row3['id'];
                                            $fname = $row3['fname'];
                                            $lname = $row3['lname'];
                                            $alYear = $row3['al_year'];
                                            $dob = $row3['DOB'];
                                            $institute = $row3['institute'];

                                            echo "<tr onmouseover='ChangeColor(this, true);' onmouseout='ChangeColor(this, false);' onclick='readvalues(this);' name='clicked'>";
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
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script>
            function ChangeColor(tableRow, highLight) {
                if (highLight) {
                    tableRow.style.backgroundColor = '#dcfac9';
                } else {
                    tableRow.style.backgroundColor = '#212529';
                }
            }

            function readvalues(tableRow) {
                var columns = tableRow.querySelectorAll("td");
                for (var i = 0; i < columns.length; i++) {
                }
                location.replace('studentsInfo.php');
                
            }
        </script>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>