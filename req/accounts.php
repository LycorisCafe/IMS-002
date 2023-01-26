<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accounts</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
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
            if ($row1['username'] != $username && $row1['name'] != $acc_name) {
                $sql2 = "INSERT INTO login (username, password, name, lastLogin, type) VALUES ('$username', '$pswd', '$acc_name', '', 'User')";
                $result2 = mysqli_query($con, $sql2);
                if ($result2) {
                    echo "<script>alert('New User adding completed!');</script>";
                    break;
                } else {
                    $em = "Error adding new account";
                    header("Location: accounts.php?error=$em");
                    break;
                }
            } else {
                $em = "$acc_name is already exist!";
                header("Location: accounts.php?error=$em");
                exit;
            }
        }
    }
    ?>

    <body>
        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <h1 class="display-2 text-center">User Accounts</h1><br />
        <div class="container">
            <h1 class="display-6">Registered Accounts (Moderators)</h1><br />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Last Login</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../connection.php";
                    $sql3 = "SELECT name, username, lastLogin FROM login WHERE type='User'";
                    $result3 = mysqli_query($con, $sql3);
                    if (mysqli_num_rows($result3) > 0) {
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $name = $row3['name'];
                            $username = $row3['username'];
                            $lastLogin = $row3['lastLogin'];

                            echo "<tr>";
                            echo "<td>$name</td>";
                            echo "<td>$username</td>";
                            echo "<td>$lastLogin</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table><br>
        </div><br />
        <h1 class="display-6 container">Add new moderator account</h1><br />
        <div class="container col-lg-4 col-md-5 align-self-center">
            <div class="card" style="transform: translate(0%, 5%);">
                <div class="card-body">
                    <form action="accounts.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
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
        </div>

        <?php
        if (isset($_POST['delete'])) {
            $usrname = $_POST['account'];
            include_once '../connection.php';
            $sql5 = "SELECT * FROM login WHERE username='$usrname'";
            $result5 = mysqli_query($con, $sql5);
            if (mysqli_num_rows($result5) > 0) {
                $sql6 = "DELETE FROM login WHERE username='$usrname'";
                $result6 = mysqli_query($con, $sql6);
                if ($result6) {
                    echo "<script>alert('Account Deleted!');</script>";
                } else {
                    $em = "Error Deleting account: $acc_name!";
                    header("Location: accounts.php?error=$em");
                    exit;
                }
            }
        }
        ?>

        <div class="container">
            <h1 class="display-4 text-danger" style="font-weight: 500;">Danger Zone</h1>
            <form role="delteAcc" method="POST" action="accounts.php">
            <div class="col-auto mb-3">
				<label class="form-label">Account: </label>
                <select class="form-control" name='account'>
                    <?php
                    include_once '../connection.php';
                    $sql4 = "SELECT username, name FROM login WHERE type='User'";
                    $result4 = mysqli_query($con, $sql4);
                    while ($ri = mysqli_fetch_assoc($result4)) {
                    ?>
                        <option value="<?php echo $ri['username'] ?>"><?php echo $ri['username'] . " - " . $ri['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-outline-danger" type="submit" name="delete">Delete</button>
            </div>

            </form>
        </div>

        <?php include 'footer.php'; ?>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>