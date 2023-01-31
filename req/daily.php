<div class="text-end">
    <h3>Results Count : <span class="badge bg-secondary" id="count" style="font-size: 18pt; color: #ff0;"></span></h3>
</div>

<form action="Payments.php" method="post">
    <div class="row">
        <div class="col-4 mb-3">
            <label class="form-label">Date: </label>
            <input type="date" name="date" class="form-control">
        </div>
        <div class="col-4 mb-3">
            <label class="form-label">Institute :</label>
            <select class="form-control" name='institute' id="s1">
                <option value="0">-- Select --</option>
                <option value="All" selected>All</option>
                <?php
                $day = date("N");
                include_once '../connection.php';
                $sql1 = "SELECT DISTINCT institute, city FROM classes WHERE day='$day'";
                $result1 = mysqli_query($con, $sql1);
                while ($ri = mysqli_fetch_assoc($result1)) {
                    ?>
                    <option value="<?php echo $ri['institute'] ?>"><?php echo $ri['institute'] . " - " . $ri['city'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-4 mb-3">
            <label class="form-label">A/L Year :</label>
            <select class="form-control" name='year' id="s2">
                <option value="0">-- Select --</option>
                <option value="All" selected>All</option>
                <?php
                $sql2 = "SELECT DISTINCT al_year FROM classes WHERE day='$day'";
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

                        include_once '../connection.php';

                        if (isset($_POST['search'])) {
                            $d = $_POST['date'];
                            $date = str_replace('/', '-', $d);
                            $date = date("Y-m-d", strtotime($date));
                            $ins = $_POST['institute'];
                            $year = $_POST['year'];
                            if ($ins == "All") {
                                if ($year == "All") {
                                    $count = 0;
                                    $sql3 = "SELECT * FROM students";
                                    $result3 = mysqli_query($con, $sql3);
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $stdID = $row3['id'];
                                        $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                        $result4 = mysqli_query($con, $sql4);
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $sql5 = "SELECT * FROM payments WHERE pDate='$date' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                        $result5 = mysqli_query($con, $sql5);
                                        if (mysqli_num_rows($result5) > 0) {
                                            $row5 = mysqli_fetch_assoc($result5);
                                            $status = $row5['status'];
                                            $name = $row3['fname'] . " " . $row3['lname'];
                                            $date = $row5['pDate'];
                                            $ins = $row3['institute'];
                                            $action = "";
                                            if ($status == 1) {
                                                $countRow = mysqli_num_rows($result5);
                                                $count += $countRow;
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
                                    echo "<script>document.getElementById('count').textContent = $count;</script>";
                                } else {
                                    $count = 0;
                                    $sql3 = "SELECT * FROM students WHERE al_year='$year'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $stdID = $row3['id'];
                                        $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                        $result4 = mysqli_query($con, $sql4);
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $sql5 = "SELECT * FROM payments WHERE pDate='$date' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                        $result5 = mysqli_query($con, $sql5);
                                        if (mysqli_num_rows($result5) > 0) {
                                            $row5 = mysqli_fetch_assoc($result5);
                                            $status = $row5['status'];
                                            $name = $row3['fname'] . " " . $row3['lname'];
                                            $date = $row5['pDate'];
                                            $ins = $row3['institute'];
                                            $action = "";
                                            if ($status == 1) {
                                                $countRow = mysqli_num_rows($result5);
                                                $count += $countRow;
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
                                    echo "<script>document.getElementById('count').textContent = $count;</script>";
                                }
                            } else {
                                if ($year == "All") {
                                    $count = 0;
                                    $sql3 = "SELECT * FROM students WHERE institute='$ins'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $stdID = $row3['id'];
                                        $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                        $result4 = mysqli_query($con, $sql4);
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $sql5 = "SELECT * FROM payments WHERE pDate='$date' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                        $result5 = mysqli_query($con, $sql5);
                                        if (mysqli_num_rows($result5) > 0) {
                                            $row5 = mysqli_fetch_assoc($result5);
                                            $status = $row5['status'];
                                            $name = $row3['fname'] . " " . $row3['lname'];
                                            $date = $row5['pDate'];
                                            $ins = $row3['institute'];
                                            $action = "";
                                            if ($status == 1) {
                                                $countRow = mysqli_num_rows($result5);
                                                $count += $countRow;
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
                                    echo "<script>document.getElementById('count').textContent = $count;</script>";
                                } else {
                                    $count = 0;
                                    $sql3 = "SELECT * FROM students WHERE al_year='$year' AND institute='$ins'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $stdID = $row3['id'];
                                        $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                        $result4 = mysqli_query($con, $sql4);
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $sql5 = "SELECT * FROM payments WHERE pDate='$date' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                        $result5 = mysqli_query($con, $sql5);
                                        if (mysqli_num_rows($result5) > 0) {
                                            $row5 = mysqli_fetch_assoc($result5);
                                            $status = $row5['status'];
                                            $name = $row3['fname'] . " " . $row3['lname'];
                                            $date = $row5['pDate'];
                                            $ins = $row3['institute'];
                                            $action = "";
                                            if ($status == 1) {
                                                $countRow = mysqli_num_rows($result5);
                                                $count += $countRow;
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
                                    echo "<script>document.getElementById('count').textContent = $count;</script>";
                                }
                            }
                        } else {
                            $count = 0;
                            $date = date("Y-m-d");
                            $name = $date = $ins = $status = $action = "";
                            $sql3 = "SELECT * FROM students";
                            $result3 = mysqli_query($con, $sql3);
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                $stdID = $row3['id'];
                                $sql4 = "SELECT id FROM regclass WHERE studentId='$stdID'";
                                $result4 = mysqli_query($con, $sql4);
                                $row4 = mysqli_fetch_assoc($result4);
                                $sql5 = "SELECT * FROM payments WHERE pDate='$date' AND status='1' AND regclassID='" . $row4['id'] . "'";
                                $result5 = mysqli_query($con, $sql5);
                                if (mysqli_num_rows($result5) > 0) {
                                    $row5 = mysqli_fetch_assoc($result5);
                                    $status = $row5['status'];
                                    $name = $row3['fname'] . " " . $row3['lname'];
                                    $date = $row5['pDate'];
                                    $ins = $row3['institute'];
                                    $action = "";
                                    if ($status == 1) {
                                        $countRow = mysqli_num_rows($result5);
                                        $count += $countRow;
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
                            echo "<script>document.getElementById('count').textContent = $count;</script>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</form>
</div>