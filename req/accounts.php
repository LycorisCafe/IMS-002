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
        <title>Accounts</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>
<?php
    if (isset($_POST['submit'])) {
        include_once '../connection.php';
        $username = $_POST['username'];
        $pswd = $_POST['pswd'];
        $acc_name = $_POST['acc_name'];
        $sql1 = "SELECT username, name FROM login";
        $result1 = mysqli_query($con, $sql1);
        while ($row1 = mysqli_fetch_assoc($result1)) {
            if($row1['username'] != $username && $row1['name'] != $acc_name) {
                $sql2 = "INSERT INTO login (username, password, name, lastLogin, type) VALUES ('$username', '$pswd', '$acc_name', '', 'User')";
                $result2 = mysqli_query($con, $sql2);
                if ($result2) {
                    echo "<script>alert('New User adding completed!');</script>";
                } else {
                    $em = "Error adding new account";
                    header("Location: accounts.php?error=$em");
                    exit;
                }
            }else {
                $em = "$acc_name is already exists!";
                header("Location: accounts.php?error=$em");
                exit;
            }
        }
    }
?>
<body>
    <!-- Imports -->
    <?php require_once "navbar.php"; ?>

    <div class="container col-lg-4 col-md-5 align-self-center">
                        <div class="card" style="transform: translate(0%, 20%);">
                                <div class="card-header text-center">
                                        <h3 class='display-5' style='color: #fff;'>New Account</h3>
                                </div>
                                <div class="card-body">
                                        <form action="accounts.php"  method="POST">
                                        <?php if(isset($_GET['error'])) { ?>
                                            <div class='alert alert-danger' role='alert'>
                                                <?=$_GET['error']?>
                                            </div>
                                        <?php } ?>
                                                <div class="col-auto mb-3">
                                                        <label class="form-label">Username: </label>
                                                        <input type="text" class="form-control" name="username" aria-describedby="username" autocomplete="off" required placeholder="WarMachine 68">
                                                </div>
                                                <div class="col-auto mb-3">
                                                        <label class="form-label">Password: </label>
                                                        <input type="password" class="form-control" name="pswd" aria-describedby="pswd" autocomplete="off" required placeholder="xxxxxxxxxxx">
                                                </div>
                                                <div class="col-auto mb-3">
                                                        <label class="form-label">Account Name: </label>
                                                        <input type="text" class="form-control" name="acc_name" aria-describedby="acc_name" autocomplete="off" required placeholder="David Johns">
                                                </div>
                                                
                                                <div class="d-grid gap-2">
                                                        <button type="submit" class="btn btn-primary" name='submit'>Add</button>
                                                </div>
                                        </form>
                                </div>
                        </div><br><br><br>

<?php include 'footer.php'; ?>
</body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>