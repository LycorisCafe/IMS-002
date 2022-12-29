<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrator Panel</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <?php require_once "../req/navbar.php"; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>