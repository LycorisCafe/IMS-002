<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Administrator Panel</title>
</head>
<body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://sftthaksalawa.com" style="font-weight: 900;"><span style="color: rgb(0, 191, 161);">SFT</span> තක්සලාව</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                        <b style='color: white;'>User: <?php echo $_SESSION['fname']; ?></b>
                  </li>
                  <li class="nav-item">
                        <b style='color: white;'>Role: <?php echo $_SESSION['role']; ?></b>
                  </li>
                </ul>
                <a href='../req/logout.php' class='btn btn-danger'> Logout </a>
              </div>
            </div>
          </nav>
    <div class='d-flex justify-content-center align-items-center vh-100'>
        <h1 class='display-1'>Now you are in the Administrator Page</h1>
        <div class='shadow w-450 p-3 text-center'>
            <small>Role: 
                <b><?php echo $_SESSION['role']; ?></b><br/>
                <h3> <?=$_SESSION['fname']?> </h3>
                <a href='../req/logout.php' class='btn btn-warning'> Logout </a>
            </small>
        </div>
    </div>
</body>
</html>

<?php }else{ 
    header("Location: ../login.php");
    exit;
}
?>