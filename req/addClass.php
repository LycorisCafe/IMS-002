<?php
session_start();
setcookie("data-bs-theme", "dark", time() + 1814400);
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add a New Class</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <?php
    if (isset($_POST['submit'])) {
        $insName = $_POST['insName'];
        $city = $_POST['city'];
        $al_year = $_POST['al_year'];
        $day = $_POST['day'];
        $time = $_POST['h'] . ":" . $_POST['m'] ." ". $_POST['a_p'];

        // db connection
        include_once '../connection.php';
        $sql = "INSERT INTO classes (al_year,  day, time,institute, city) VALUES ('$al_year', '$day', '$time', '$insName', '$city')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('New Class adding completed!');</script>";
        } else {
            $em = "Error adding new class";
            header("Location: addClass.php?error=$em");
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
                    <h3 class='display-5' style='color: #fff;'>New Class</h3>
                </div>
                <div class="card-body">
                    <form action="addClass.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">Institute Name: </label>
                            <input type="text" class="form-control" name="insName" aria-describedby="insName" autocomplete="off" required placeholder="Apple">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">City: </label>
                            <input type="text" class="form-control" name="city" aria-describedby="city" autocomplete="off" required placeholder="Galle">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">A/L Year: </label>
                            <input type="text" class="form-control" name="al_year" aria-describedby="al_year" autocomplete="off" required placeholder="2022">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Day: </label>
                            <select class="form-control" name='day'>
                                <option value='1'>Monday</option>
                                <option value='2'>Tuesday</option>
                                <option value='3'>Wednesdy</option>
                                <option value='4'>Thursday</option>
                                <option value='5'>Friday</option>
                                <option value='6'>Saturday</option>
                                <option value='7'>Sunday</option>
                            </select>
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Time: </label>
                            <div class="input-group mb-3">
                                <input type="text" placeholder="HH" class="form-control" aria-label="Text input with dropdown button" name="h">
                                <input type="text" placeholder="MM" class="form-control" aria-label="Text input with dropdown button" name="m">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">AM/PM</button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#" name="am">AM</a></li>
                                    <li><a class="dropdown-item" href="#" name="pm">PM</a></li>
                                </ul>
                                <select class="dropdown-menu dropdown-menu-end" name='a_p'>
                                    <option value='AM'>AM</option>
                                    <option value='PM'>PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><br /><br /><br /><br /><br /><br />


        <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>