<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

<<<<<<< HEAD
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrator Panel</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="btn btn-primary text-start" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">-/-</button>
                <a class="navbar-brand" href="#">ClassName</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="#">Logout</a>
                    </div>
=======
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator Panel</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="btn btn-primary text-start" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">-/-</button>
            <a class="navbar-brand" href="#">ClassName</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="btn btn-danger" aria-current="page" href="#">Logout</a>
>>>>>>> 70b04dc98fc90c2dfbaf35a49e05a1c5a565d5a0
                </div>
            </div>
        </nav>



        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel"><em>SFT</em> තක්සලාව</a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button">Home</button>
                    <button class="btn btn-primary" type="button">Other</button>
                </div>
            </div>
        </div>
<<<<<<< HEAD

        <script src="js/isotope.min.js"></script>
        <script src="js/sftthaksalawacustom.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
=======
    </div>


    <script src="js/isotope.min.js"></script>
    <script src="js/sftthaksalawacustom.js"></script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
>>>>>>> 70b04dc98fc90c2dfbaf35a49e05a1c5a565d5a0

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>