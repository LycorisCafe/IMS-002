<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
<!doctype html>
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
        if(isset($_POST['submit'])) {
            $type = $_POST['role'];
            $username = $_POST['username'];
            $pswd = $_POST['pswd'];
            $name = $_POST['name'];

            $sql1 = "SELECT name, username FROM login";
            $result1 = mysqli_query($con, $sql1);
            while ($row1 = mysqli_fetch_assoc($result1)) {
                if ($row1['username'] != $username && $row1['name'] != $name) {
                    //
                }
        }
        }
    ?>

    <div class="container"><br/>
        <h1 class="display-1 text-center" style="color: #fff;">System Maintainer</h1><br><br /><br />
        <h1 class="display-5" style="color: #10A0FF;">Add an Account</h1><br />

        <div>
                <div>
                    <form action="accounts.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class='alert alert-danger' role='alert'>
                                <?= $_GET['error'] ?>
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
                            <input type="text" class="form-control" name="username" aria-describedby="username" autocomplete="off" required placeholder="WarMachine 68">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Password: </label>
                            <input type="password" class="form-control" name="pswd" aria-describedby="pswd" autocomplete="off" required placeholder="xxxxxxxxxxx">
                        </div>
                        <div class="col-auto mb-3">
                            <label class="form-label">Account Name: </label>
                            <input type="text" class="form-control" name="name" aria-describedby="name" autocomplete="off" required placeholder="David Johns">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name='submit'>Add Account</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <br/><br/>
    <div class="container">
            <h1 class="display-5" style="color: #10A0FF;">Registered Accounts</h1><br />
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
                    $sql3 = "SELECT name, username, lastLogin FROM login WHERE type='Admin' OR type='User'";
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
        </div>

</body>

</html>

<?php } else {
header("Location: ../login.php");
exit;
}
?>