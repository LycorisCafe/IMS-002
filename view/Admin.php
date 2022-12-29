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
        
        <div class="row" >
    	<div class="col-md-10" ><!-- left column -->
        	<center><h4>Monthly Student Registration</h4></center>
            <canvas id="lineChart" width="800" height="450"></canvas>
         </div>  
     </div>
		
<script>
                    
function showLineChart(monthly_std_reg){	
 
	var monthly_std_reg1 = JSON.parse("[" + monthly_std_reg + "]");
 
	new Chart(document.getElementById("lineChart"), {
		type: 'line',
		data: {
		  labels: ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"],
		  datasets: [
			{
			  label: "New Student Registration",
			  borderColor: "#00c0ef",
			  fill: false,
			  data: monthly_std_reg1
			 
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true,
			text: ''
		  },
		  scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
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