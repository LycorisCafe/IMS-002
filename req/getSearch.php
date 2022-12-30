<?php
                            if(isset($_POST['submit']))
                            {
                                $indexNo = $_POST['indexNo'];
                                include_once '../connection.php';
                                $sql = "SELECT * FROM students WHERE indexNo='$indexNo'";
                                $result = mysqli_query($con, $sql);
                                    while($row = $result->fetch_assoc()){
                                        $stdName = $row['fname'] . ' ' . $row['lname'];
                                        header("Location: ../view/Moderator.php");
                                    }
                                }    
                            
                        ?>