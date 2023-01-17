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
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <div class="container"><br />
            <h1 class="display-2 text-center" style="color: black;">Students</h1><br><br />
            <form action="Students.php" method="post">
                <div class="col-auto mb-3">
                    <label class="form-label">Institute: </label>
                    <select class="form-control" name='institute'>
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
                echo "<br/><br/><h1 class='display-5' style='color: black;'>Showing Results for: Institute: <font color='red'>" . $ins . "</font>  and  A/L Year: <font color='red'>" . $year . "</font></h1>";
            }
            ?>
            
        </div>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>