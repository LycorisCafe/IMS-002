<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>System Maintainer</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <?php
        include_once '../connection.php';
        if (isset($_POST['submit'])) {
            $type = $_POST['role'];
            $username = $_POST['username'];
            $pswd = $_POST['pswd'];
            $name = $_POST['name'];
            $em = "";
            $sql1 = "SELECT name, username FROM login";
            $result1 = mysqli_query($con, $sql1);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                if ($row1['username'] == $username && $row1['name'] == $name) {
                    $em = "Account $username is already exist!";
                    header("Location: Maintainer.php?error=$em");
                    exit;
                } else if ($type == 'Admin') {
                    $sql2 = "SELECT * FROM login WHERE type='Admin'";
                    $result2 = mysqli_query($con, $sql2);
                    if (mysqli_num_rows($result2) > 0) {
                        $em = "You can't add Admin accounts more than one!";
                        header("Location: Maintainer.php?error=$em");
                        exit;
                    } else {
                        $sql2 = "INSERT INTO login (username, password, name, lastLogin, type) VALUE ('$username', '$pswd', '$name', '', '$type')";
                        $result2 = mysqli_query($con, $sql2);
                        if ($result2)
                            $m = "Successfully registered a New $type Account!";
                            header("Location: Maintainer.php?success=$m");
                            exit;
                            break;
                    }
                } else {
                    $sql2 = "INSERT INTO login (username, password, name, lastLogin, type) VALUE ('$username', '$pswd', '$name', '', '$type')";
                    $result2 = mysqli_query($con, $sql2);
                    if ($result2)
                        $m = "Successfully registered a New $type Account!";
                        header("Location: Maintainer.php?success=$m");
                        exit;
                    break;
                }
            }
        }
        ?>

        <div class="container"><br />
            <h1 class="display-1 text-center" style="color: #fff;">System Maintainer</h1><br><br /><br />
            <h1 class="display-5" style="color: #10A0FF;">Add an Account</h1><br />

            <div>
                <div>
                    <form action="Maintainer.php" method="POST">
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
                            <label class="form-label">Account Type: </label>
                            <select class="form-control" name='role'>
                                <option value='Admin'>Administrator</option>
                                <option value='User'>Moderator</option>
                            </select>
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Username: </label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required placeholder="WarMachine 68">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Password: </label>
                            <input type="password" class="form-control" name="pswd" autocomplete="off" required placeholder="xxxxxxxxxxx">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Account Name: </label>
                            <input type="text" class="form-control" name="name" autocomplete="off" required placeholder="David Johns">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Add Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br /><br />
        <div class="container">
            <h1 class="display-5" style="color: #10A0FF;">Registered Accounts</h1><br />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Last Login</th>
                        <th scope="col">Account Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../connection.php";
                    $sql3 = "SELECT name, username, lastLogin, type FROM login WHERE type='Admin' OR type='User'";
                    $result3 = mysqli_query($con, $sql3);
                    if (mysqli_num_rows($result3) > 0) {
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $name = $row3['name'];
                            $username = $row3['username'];
                            $lastLogin = $row3['lastLogin'];
                            $type = $row3['type'];

                            echo "<tr>";
                            echo "<td>$name</td>";
                            echo "<td>$username</td>";
                            echo "<td>$lastLogin</td>";
                            echo "<td>$type</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table><br>
        </div><br/>

        <?php
            if(isset($_POST['save'])) {
                $mail = $_POST['email'];
                $name2 = $_POST['name2'];
                $sql4 = "SELECT * FROM share";
                $result4 = mysqli_query($con, $sql4);
                if(mysqli_num_rows($result4) < 1) {
                    $sql5 = "INSERT INTO share (email, name) VALUE ('$mail', '$name2')";
                    if(mysqli_query($con, $sql5)){
                        $m = "New email settings saved";
                        header("Location: Maintainer.php?success2=$m");
                        exit;
                    }
                } else {
                    $sql5 = "UPDATE share SET email='$mail', name='$name2'";
                    if(mysqli_query($con, $sql5)){
                        $m = "New email settings changes saved";
                        header("Location: Maintainer.php?success2=$m");
                        exit;
                    }
                }
            }
        ?>

        <div class="container">
            <h1 class="display-5" style="color: #10A0FF;">Mail Settings</h1><br />
            <div>
                <form action="Maintainer.php" method="post">
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
                    
                        <div class="col-auto mb-3">
                            <label class="form-label">Admin Email (<i>Email will send with this email</i>): </label>
                            <input type="email" class="form-control" name="email" autocomplete="off" required placeholder="example@host.com">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Name (<i>This will show in the email body</i>): </label>
                            <input type="text" class="form-control" name="name2" autocomplete="off" required placeholder="David Johns">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='save'>Save Mail Details</button>
                        </div>

                </form>
            </div>
        </div><br/>

        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-outline-danger btn-sm" role="button" data-bs-toggle="button" href="../req/logout.php">Logout</a>
        </div>
        <?php include '../req/footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>