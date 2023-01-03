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
    <div class="container col-lg-4 col-md-5 align-self-center">
                        <div class="card" style="transform: translate(0%, 20%);">
                                <div class="card-header text-center">
                                        <h3 class='display-5' style='color: #fff;'>Exam Result</h3>
                                </div>
                                <div class="card-body">
                                        <form action="accounts.php"  method="POST">
                                        <?php if(isset($_GET['error'])) { ?>
                                            <div class='alert alert-danger' role='alert'>
                                                <?=$_GET['error']?>
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