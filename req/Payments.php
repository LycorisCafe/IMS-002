<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en" data-bs-theme="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Attendance Report</title>
        <link rel="icon" type="image/x-icon" href="../Media/favicon.png">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/fonts.css">
        <link rel="stylesheet" href="../css/temp.css">
        <script src="../fontawesome.com.js"></script>
        <style>
            /* Style tab links */
            .tablink {
                background-color: #555;
                color: white;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                font-size: 17px;
                width: 50%;
            }

            .tablink:hover {
                background-color: #777;
            }

            .tabcontent {
                color: white;
                display: none;
                padding: 100px 20px;
                height: 100%;
            }

            #daily {
                background-color: green;
            }

            #monthly {
                background-color: orange;
            }
        </style>
    </head>
    <body>

        <!-- Imports -->
        <?php require_once "navbar.php"; ?>
        <div class="container"><br />
            <h1 class="display-2 text-center" style="color: #fff;">Payments Report</h1><br><br />
        </div>

        <div class="container">
            <br /><br />

            <button class="tablink" onclick="openPage('daily', this, 'green')" id="defaultOpen">Daily</button>
            <button class="tablink" onclick="openPage('monthly', this, 'orange')">Monthly</button>

            <div id="daily" class="tabcontent">
                <h3>Daily Payments</h3><br/>
                <?php require 'daily.php'; ?>
            </div>

            <div id="monthly" class="tabcontent">
                <h3>Monthly Payments</h3><br/>
                <?php require 'month.php'; ?>
            </div>

        </div>

        <script>
            function openPage(pageName, elmnt, color) {
                // Hide all elements with class="tabcontent" by default */
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                // Remove the background color of all tablinks/buttons
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                }

                // Show the specific tab content
                document.getElementById(pageName).style.display = "block";

                // Add the specific color to the button used to open the tab content
                elmnt.style.backgroundColor = color;
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

    </body>

    </html>

<?php } else {
    header("Location: ../login.php");
    exit;
}
?>