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
        <script src="../fontawesome.com.js"></script>
        <script src="../js/jquery-3.6.3.min.js"></script>

    </head>

    <body>
        <?php require_once "navbar.php"; ?>        <!-- Imports -->
        <br/><br/><h1 class='display-1 text-center' style='color: #fff;'>Exams</h1><br/>
        <div class="container"><h1 class="display-5" style="color: #10A0FF;">Add Marks</h1></div>
        <div class="container col-lg-8 col-md-5 align-self-center" style="transform: translate(0%, 5%);">
                <div class="card-body">
                    <form action="../data/exam-data.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                            <div class='alert alert-success' role='alert'>
                                <?= $_GET['success'] ?>
                            </div>
                        <?php } ?>
                        <div class="col-auto mb-3">
                            <label class="form-label">Date: </label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id" autocomplete="off" required placeholder="123456" id="id">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Marks: </label>
                            <input type="text" class="form-control" name="marks" autocomplete="off" required placeholder="100">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Rank: </label>
                            <input type="text" class="form-control" name="rank" autocomplete="off" required placeholder="1">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Submit</button>
                        </div>
                    </form>
            </div></div></div>
            <br /><br /><br />

            <div class="container">
                <h1 class="display-5 text-warning">Edit Marks</h1><br />
                <?php if (isset($_GET['error2'])) { ?>
                        <div class='alert alert-danger' role='alert'>
                            <?= $_GET['error2'] ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success2'])) { ?>
                        <div class='alert alert-success' role='alert'>
                            <?= $_GET['success2'] ?>
                        </div>
                    <?php } ?>
                <form class="d-flex mb-3" method="POST" action="../data/exam-data.php">
                    <input class="form-control me-2" type="search" placeholder="Search for Student by ID" name="stID" autocomplete="off" id="id">
                    <input type="date" class="form-control" name="date2" required>
                    <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </form>
            </div>

            <div class="container">
                <br>
                <form action="../data/exam-data.php" method="POST">
                <div class='row'>
                        <div class='col'>
                            <label class="form-label">Student ID: </label>
                            <input type="text" class="form-control" name="id2" autocomplete="off" readonly value="<?php if (isset($_GET['data'])) { echo explode(",",$_GET['data'])[0]; } ?>">
                        </div>
                        <div class='col'>
                            <label class="form-label">Name: </label>
                            <input type="text" class="form-control" name="name2" autocomplete="off" readonly value="<?php if (isset($_GET['data'])) { echo explode(",",$_GET['data'])[1]; } ?>">
                        </div>
                    </div><div class='row'>
                        <div class='col'>
                            <label class="form-label">Marks: </label>
                            <input type="text" class="form-control" name="marks2" autocomplete="off" required placeholder="000" value="<?php if (isset($_GET['data'])) { echo explode(",",$_GET['data'])[2]; } ?>">
                        </div>
                        <div class='col'>
                            <label class="form-label">Rank: </label>
                            <input type="text" class="form-control" name="rank2" autocomplete="off" required placeholder="000" value="<?php if (isset($_GET['data'])) { echo explode(",",$_GET['data'])[3]; } ?>">
                        </div>
                    </div><br/>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-warning" type="submit" name="update">UPDATE</button>
                    </div>
                </form>
            </div>

            <br><br><br><br>

            <?php include 'footer.php'; ?>
            
        <script>
            // $(document).ready(function() {
            //     $("#id").keypress(function() {
            //         $.ajax({
            //             type: 'POST',
            //             url: '../data/exam-data.php',
            //             data: {
            //                 name: $("#id").val(),
            //             },
            //             success: function(data) {
            //                 //
            //             }
            //         });
            //     });
            // });
        </script>

    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>