<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moderator Panel</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link href="https://www.sftthaksalawa.com/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js" crossorigin="anonymous"></script>
    </head>

    <body>
    <header class="main-header clearfix" role="header">
        <div class="logo">
            <a href="index.html"><em>SFT</em> තක්සලාව</a>
        </div>
        <a href="" class="menu-link"><i class="fa fa-bars"></i></a>
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
            <li style='color: #fff;'>User: <?php echo $_SESSION['name']; ?></li>
            <li style='color: #fff;'>Role: <?php echo $_SESSION['role']; ?></li>
            <li style='color: #fff;'>Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
            <li><a href='../req/logout.php' class='btn btn-danger'> Logout </a></li>

            </ul>
        </nav>
    </header>
        <br><br>
        <div class="text-center">
            <h1 class="display-6">SFT තක්සලාව</h1>
            <h6>Moderator Panel</h6>
        </div>

        <br><br>
        <div class="container col-lg-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h4 class='display-6' style='color: #000;'>Attendane Marking</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_POST['submit']))
                            {
                                if(!empty($_POST['id3'])){
                                $id3 = $_POST['id3'];
                                include_once '../connection.php';
                                $sql1 = "SELECT * FROM students WHERE id='$id3'";
                                $result1 = mysqli_query($con, $sql1);
                                    while($row = $result1->fetch_assoc()){
                                        $stdName = $row['fname'] . ' ' . $row['lname'];
                                        $id3 = $row['id'];
                                        $_SESSION['id3'] = $id3;
                                    }
                                }else{
                                    $em = "Student ID is required!";
                                    header("Location: Moderator.php?error=$em");
                                    exit;
                                }
                            }    
                            
                        ?>
                    <form action='Moderator.php' method='POST'>
                        <?php if(isset($_GET['error'])) { ?>
										<div class='alert alert-danger' role='alert'>
											<?=$_GET['error']?>
										</div>
						<?php } ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter Student ID!" aria-label="studentId" aria-describedby="basic-addon1" name='id3'>
                        </div>
                        <div class="d-grid gap-2">
                                <input class="btn btn-primary" type="submit" name='submit' value='Search'>
                        </div>
                        <hr>
                        <div>
                            <?php
                                if(isset($_POST['submit'])){
                                    include_once '../connection.php';
                                    $sql2 = "SELECT pic FROM students WHERE id='$id3'";
                                    $result2 = mysqli_query($con, $sql2);
                                    while($data = $result2->fetch_assoc()){
                                        echo "<img src='".$data['pic']."' class='rounded border border-success' height='150' width='150' alt='studentImage'>";
                                    }
                                }
                            ?>
                            
                        </div><br/></form>
                        <form action='Moderator.php' method='POST'>
                        <div class='d-grid gap-2'>
                            <a href='../req/newStudent.php' class='btn btn-warning'>Add a New Student</a><br/>
                        </div>
                        <div class="rounded border border-success"  style='font-size: 22px;'>
                            <b title='Student Name'><?php if(isset($_POST['submit'])){ echo $stdName; } ?></b>
                        </div>
                        <hr>
                        <div class="form-check text-start">
                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name='day2day'>
                            <label class="form-check-label" for="flexCheckChecked">
                                Day 2 Day Paper
                            </label>
                            <?php
                                if(isset($_POST['finals']))
                                {
                                    $date = date("Y-m-d");
                                    $isDone = $_POST['day2day'];
                                    include_once '../connection.php';
                                    $sql3 = "SELECT id, classId FROM regclass WHERE studentId='".$_SESSION['id3']."'";
                                    $result3 = mysqli_query($con, $sql3);
                                    while($row = $result3->fetch_assoc())
                                    {
                                        $regClassId = $row['id'];
                                        $sql4 = "INSERT INTO attendance (regclassId, date_, d2d) VALUES ('$regClassId', '$date', '$isDone');";
                                        $result4 = mysqli_query($con, $sql4);
                                    }
                                    if($result3 && $result4)
                                    {
                                        echo "<script>alert('Attendance Marked!');</script>";
                                        header("Refresh:0; url=Moderator.php");
                                    }else{
                                        echo "<script>alert('Attendance Marking Unsuccess!');</script>";
                                    }
                                }
                            ?>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" name='finals' value='Mark as Attend!'>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <br><br>

        <script src="../bootstrap/js/bootstrap.bundle.min.js></script">
             <script src="js/isotope.min.js"></script>
    <script src="js/sftthaksalawacustom.js"></script>

  </body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>