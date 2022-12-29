<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>


    <div class="text-center">
        <h1 class="display-6">SFT තක්සලාව</h1>
        <h6>Moderator Panel</h6>
    </div>

    <div class="container"></div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js></script>
  </body>
</html>

<?php }else{ 
    header("Location: ../login.php");
    exit;
}
?>