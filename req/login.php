<?php

session_start();

if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['role'])) {
    include '../connection.php';
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    $lastLogin = date("Y-m-d h:i:s A");
        if ($role == '1') {
            $role = "Admin";
        } else if ($role == '2') {
            $role = "User";
        } else {
            $role = "Maintainer";
        }
        $sql = "SELECT * FROM login WHERE type='$role'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $username = $row['username'];
                $password = $row['password'];
                $fname = $row['name'];
                $id = $row['id'];
                if ($username == $uname) {
                    if ($password == $pass) {
                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $fname;
                        $_SESSION['role'] = $role;
                        $sql = "UPDATE login SET lastLogin='$lastLogin' WHERE id='$id'";
                        $result = mysqli_query($con, $sql);
                        $_SESSION['lastLogin'] = $lastLogin;

                        if ($role == "Admin") {
                            header("Location: ../view/Home.php");
                        } else if($role == "User") {
                            header("Location: ../view/Moderator.php");
                        } else {
                            header("Location: ../view/Maintainer.php");
                        }
                    } else {
                        $em = "Invalid Username or Passowrd";
                        header("Location: ../login.php?error=$em");
                        exit;
                    }
                } else {
                    $em = "Invalid Username or Passowrd";
                    header("Location: ../login.php?error=$em");
                    exit;
                }
            }
        } else {
            $em = "Account not found!";
            header("Location: ../login.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
