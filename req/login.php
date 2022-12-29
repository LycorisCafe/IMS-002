<?php

session_start();

if(isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['role']))
{
    include '../connection.php';
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    if (empty($uname))
    {
        $em = "Username is required!";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($pass))
    {
        $em = "Password is required!";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($role))
    {
        $em = "An error occurred!";
        header("Location: ../login.php?error=$em");
        exit;
    }
    else
    {
        if($role == '1')
        {
            $role = "Admin";
            $sql = "SELECT * FROM admin";
        }
        else
        {
            $role = "User";
            $sql = "SELECT * FROM user";
        }
        $result = mysqli_query($con, $sql);
        
            if (mysqli_num_rows($result) > 0) {
                 while($row = $result->fetch_assoc()) {
                    $username = $row['username'];
                    $password = $row['password'];
                    $fname = $row['fname'];
                    $id = $row['id'];
                     if($username == $uname)
                     {
			 			if($password == $pass)
                        {
                            $_SESSION['id'] = $id;
                            $_SESSION['fname'] = $fname;
                            $_SESSION['role'] = $role;

                            if($role == "Admin")
                            {
                                header("Location: ../view/Admin.php");
                            }
                            else
                            {
                                header("Location: ../view/Moderator.php");
                            }
                        }
                        else
                        {
                            $em = "Invalid Username or Passowrd";
                            header("Location: ../login.php?error=$em");
                            exit;
                        }
                     }else
                     {
                            $em = "Invalid Username or Passowrd";
                            header("Location: ../login.php?error=$em");
                            exit;
                     }
                 }
			 		}
			 		
    }
}
else
{
    header("Location: ../login.php");
    exit;
}

?>