<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
?>
    <!doctype html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administrator Panel</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <?php require_once "../req/navbar.php"; ?>

        <!-- <div class="row">
            <div class="col-md-10"> -->
        <!-- left column -->
        <!-- <center>
                    <h4>Monthly Student Registration</h4>
                </center>
                <canvas id="lineChart" width="800" height="450"></canvas>
            </div>
        </div> -->

        <div class="container"><br/>
            <div class="row justify-content-around">
                <div class="col-sm-12 col-lg-4 p-1 d-flex">
                    <div class="card">
                        <div class="row">
                            <div class="col-4">
                                <img src="../Media/images/group.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">Total Students</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <?php
                                            require_once '../connection.php';
                                            $sql1 = "SELECT count(id) FROM students";
                                            $result1 = mysqli_query($con,$sql1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $all_student = $row1['count(id)'];
                                            echo $all_student;
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 p-1 d-flex">
                    <div class="card">
                        <div class="row">
                            <div class="col-4">
                                <img src="../Media/images/school.png" class="img-fluid rounded-start" alt="..." width="320" height="320">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">Total Classes</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                    <?php
                                            require_once '../connection.php';
                                            $sql2 = "SELECT count(id) FROM classes";
                                            $result2 = mysqli_query($con,$sql2);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $all_student = $row2['count(id)'];
                                            echo $all_student;
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/><h5><?php echo $_SESSION['name']; ?>,<strong><span style="color:#cf4ed4;"> Welcome back! </span></strong></h5>
        </div>


        <script>
            function showLineChart(monthly_std_reg) {

                var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");

                new Chart(document.getElementById("lineChart"), {
                    type: 'line',
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            label: "New Student Registration",
                            borderColor: "#00c0ef",
                            fill: false,
                            data: monthly_std_reg1

                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: ''
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            };
        </script>
    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>