<form action="Payments.php" method="post">
    <div class="row">
        <div class="col-3 mb-3">
            <label class="form-label">Month: </label>
            <select class="form-control" name='month' id="s1">
                <option value="0">-- Select --</option>
                <option value="All">All</option>
                <?php
                include_once '../connection.php';
                $sql1 = "SELECT DISTINCT year, month FROM payments";
                $result1 = mysqli_query($con, $sql1);
                while ($ri = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $ri['year'] . "-" . $ri['month']; ?>"><?php echo $ri['year'] . " - " . $ri['month']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-3 mb-3">
            <label class="form-label">Institute :</label>
            <select class="form-control" name='institute' id="s1">
                <option value="0">-- Select --</option>
                <option value="All">All</option>
                <?php
                $sql1 = "SELECT DISTINCT institute, city FROM classes";
                $result1 = mysqli_query($con, $sql1);
                while ($ri = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] . " - " . $ri['city'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-3 mb-3">
            <label class="form-label">A/L Year :</label>
            <select class="form-control" name='year' id="s2">
                <option value="0">-- Select --</option>
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
        <div class="col-3 mb-3">
            <label class="form-label">Status :</label>
            <select class="form-control" name='status'>
                <option value="0">-- Select --</option>
                <option value='1'>Paid</option>
                <option value='2'>Not Paid</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-outline-success" type="submit" name="search2">Search</button>
        </div>
    </div>
    <br />
    <div class="bd-example-snippet bd-code-snippet"><br />
        <div class="bd-example"><br />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Institute</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function getData($year, $month, $ins, $ALyear, $status)
                    {

                    }
                    if (isset($_POST['search2'])) {
                        include_once '../connection.php';
                        $month = $_POST['month'];
                        $ins = $_POST['institute'];
                        $year = $_POST['year'];
                        $status = $_POST['status'];
                        if ($_POST['month'] == "All") {
                            if ($_POST['institute'] == "All") {
                                if ($_POST['year'] == "All") {
                                    if ($_POST['status'] == "1") {
                                        $name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        $name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                } else {
                                    if ($_POST['status'] == "1") {
                                        $name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                            }
                                        }
                                    } else {
                                        $name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                }
                            } else {
                                if ($_POST['year'] == "All") {
                                    if ($_POST['status'] == "1") {
                                        //$name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        //$name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                } else {
                                    if ($_POST['status'] == "1") {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins' AND al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins' AND al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $arr = explode('-', $_POST['month']);
                            $year2 = $arr[0];
                            $month2 = $arr[1];
                            if ($_POST['institute'] == "All") {
                                if ($_POST['year'] == "All") {
                                    if ($_POST['status'] == "1") {
                                        $sql3 = "SELECT * FROM students";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                } else {
                                    if ($_POST['status'] == "1") {
                                        $name = $date = $ins = $status = $action = "";
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                            }
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                }
                            } else {
                                if ($_POST['year'] == "All") {
                                    if ($_POST['status'] == "1") {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                } else {
                                    if ($_POST['status'] == "1") {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins' AND al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = $row5['pDate'];
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 1) {
                                                    $action = "<font color='green'>Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM students WHERE institute='$ins' AND al_year='$year'";
                                        $result3 = mysqli_query($con, $sql3);
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $stdID = $row3['id'];
                                            $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                            $result4 = mysqli_query($con, $sql4);
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql5 = "SELECT * FROM payments WHERE year='$year2' AND month='$month2' AND regclassID='" . $row4['id'] . "'";
                                            $result5 = mysqli_query($con, $sql5);
                                            if (mysqli_num_rows($result5) > 0) {
                                                $row5 = mysqli_fetch_assoc($result5);
                                                $status = $row5['status'];
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "";
                                                if ($status == 0) {
                                                    $action = "<font color='red'>Not Paid</font>";
                                                    echo "<tr>";
                                                    echo "<td>$name</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$ins</td>";
                                                    echo "<td>$action</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $name = $row3['fname'] . " " . $row3['lname'];
                                                $date = "-";
                                                $ins = $row3['institute'];
                                                $action = "<font color='red'>Not Paid</font>";
                                                echo "<tr>";
                                                echo "<td>$name</td>";
                                                echo "<td>$date</td>";
                                                echo "<td>$ins</td>";
                                                echo "<td>$action</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>