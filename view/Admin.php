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
<body class='d-flex justify-content-center align-items-center vh-100'>
    <h1 class='display-1'>Now you are in the Administrator Page</h1>
    <div class='shadow w-450 p-3 text-center'>
        <small>Role: 
            <b><?php echo $_SESSION['role']; ?></b><br/>
            <h3> <?=$_SESSION['fname']?> </h3>
            <a href='../req/logout.php' class='btn btn-warning'> Logout </a>
        </small>
    </div>
</body>
</html>

<?php }else{ 
    header("Location: ../login.php");
    exit;
}
?>