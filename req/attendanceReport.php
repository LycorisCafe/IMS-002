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
                                //include_once '../connection.php';
                                $sql2 = "SELECT DISTINCT al_year FROM classes";
                                $result2 = mysqli_query($con, $sql2);
                                while ($ri2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                    <option value="<?php echo $ri2['al_year'] ?>"><?php echo $ri2['al_year'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Range: </label>
                            <select class="form-control" name='timeRange'>
                                <option value="All">Today</option>
                                <option value="All">This Month</option>
                                <option value="All">This Year</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">State: </label>
                            <select class="form-control" name='state'>
                                <option value="All">Attended</option>
                                <option value="All">Not Attended</option>
                            </select>
                        </div>
                    </div><br />
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" type="submit" name="search">Fetch Data</button>
                    </div>
                </form>
            </fieldset>
        </div><br /><br />

        <div class="container-fluid">
            <?php
            if (isset($_POST['search'])) {
                $ins = $_POST['institute'];
                $year = $_POST['year'];
                $range = $_POST['timeRange'];
                $state = $_POST['state'];
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
                                $range = $_POST['timeRange'];
                                $state = $_POST['state'];
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