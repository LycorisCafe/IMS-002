<?php
session_start();
if (isset($_SESSION['indexNo'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upload a Photo</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    
    if(isset($_POST['upload']))
    {
        $name = $_FILES['pic'] ['name'];
        $type = $_FILES['pic'] ['type'];
        $size = $_FILES['pic'] ['size'];
        $temp = $_FILES['pic'] ['tmp_name'];
        $error = $_FILES['pic'] ['error'];

        if($error > 0)
        {
            die("Error Uploading Image! Code: $error");
        }else{
            $filename = "../uploads/".$_SESSION['indexNo'];
            move_uploaded_file($temp, $filename);
            include_once '../connection.php';
            $sql = "UPDATE students SET pic='$filename' WHERE indexNo='".$_SESSION['indexNo']."';";
            $result = mysqli_query($con, $sql);
            if($result)
            {
                echo "<script>alert('Upload completed!');</script>";
                
                // header("Location: ../view/Moderator.php");
            }else{
                echo "<script>alert('Upload Unsuccess!');</script>";
            }
            //
        }
    }
    
?>

<body>
    <div class='container text-center'>
        <h1 class='display-2'>Upload a Photo</h1>

        <div class='shadow w-450 p-3 text-center d-flex justify-content-center align-items-center vh-100'>
        <form action='upload.php' method='POST' enctype='multipart/form-data'>
            <input type='file' name='pic'>
            <input type='submit' value='Upload' name='upload'>
        </form>
        <a href='endSession.php' class='btn btn-warning'> Back </a>
        </div>
    </div>
</body>
</html>

<?php } else {
    header("Location: ../view/Moderator.php");
    exit;
}
?>