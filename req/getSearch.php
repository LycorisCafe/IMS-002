<?php
                            
    if(isset($_POST['submit']))
    {
        $indexNo = $_POST['index'];
        include_once 'connection.php';
        $sql = "SELECT * FROM students WHERE indexNo='$indexNo'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) == 1)
        {
            while($row = $result->fetch_assoc()){
                $stdName = $row['fname'] . ' ' . $row['lname'];
                echo "<acript>alert($stdName);</script>";
            }
        }
    }
?>