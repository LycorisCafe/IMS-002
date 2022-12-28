<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>


    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Moderator</title>
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
            <li style='color: #fff;'>User: <?php echo $_SESSION['fname']; ?></li>
            <li style='color: #fff;'>Role: <?php echo $_SESSION['role']; ?></li>
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
                        <h4 class='display-5' style='color: #000;'>Attendane Marking</h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_POST['submit']))
                            {
                                $indexNo = $_POST['indexNo'];
                                include_once '../connection.php';
                                $sql = "SELECT * FROM students WHERE indexNo='$indexNo'";
                                $result = mysqli_query($con, $sql);
                                    while($row = $result->fetch_assoc()){
                                        $stdName = $row['fname'] . ' ' . $row['lname'];
                                        $_SESSION['indexNo'] = $indexNo;
                                    }
                                }    
                            
                        ?>
                    <form action='Moderator.php' method='POST'>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter Student ID!" aria-label="studentId" aria-describedby="basic-addon1" name='indexNo'>
                        </div>
                        <div class="d-grid gap-2">
                                <input class="btn btn-primary" type="submit" name='submit' value='Search'>
                        </div>
                        <hr>
                        <div>
                            <?php
                                if(isset($_POST['submit'])){
                                    include_once '../connection.php';
                                    $sql = "SELECT pic FROM students WHERE indexNo='$indexNo'";
                                    $result2 = mysqli_query($con, $sql);
                                    while($data = $result2->fetch_assoc()){
                                        echo "<img src='".$data['pic']."' class='rounded border border-success' height='150' width='150' alt='studentImage'>";
                                    }
                                }
                            ?>
                            
                        </div><br/></form>
                        <form action='Moderator.php' method='POST'>
                        <div class='d-grid gap-2'>
                            <a href='../req/upload.php' class='btn btn-warning'>Upload a Photo </a><br/>
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
                                    $isDone = $_POST['day2day'];
                                    include_once '../connection.php';
                                    $sql = "UPDATE students SET day2day='$isDone' WHERE indexNo='".$_SESSION['indexNo']."';";
                                    $result = mysqli_query($con, $sql);
                                    if($result)
                                    {
                                        echo "<script>alert('Attendance Marked!');</script>";
                                        header("Refresh:0; url=Moderator.php");
                                    }else{
                                        echo "<script>alert('Upload Unsuccess!');</script>";
                                    }
                                }
                            ?>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" name='finals' value='Mark as Attend!'>
                            <input class="btn btn-warning" type="reset" name='reset' value='RESET'>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <br><br>

        <script src="../bootstrap/js/bootstrap.bundle.min.js></script">
  </body>
</html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>