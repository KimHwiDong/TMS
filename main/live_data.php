<?php
	$servername = "localhost";
    $username = "root";
    $password = "gnlehdvskim1!";
    $dbname = "konanservice";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $now = date("Y_m_d");
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } else if($conn){
      
    }

?>

<?php
  	$i = 1;
  	 $sql1 = "SELECT measure_date_end from 5avg_data_info limit 1";

  		$result_set1 = mysqli_query($conn,$sql1);

		$row1=mysqli_fetch_array($result_set1);

  	 	echo $row1['measure_date_end'];
  ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Chart.js Responsive Bar Chart Demo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <h2>Chart.js Responsive Bar Chart Demo</h2>
  <div>
    <canvas id="canvas"></canvas>
  </div>
</div>

<p class="p">Demo by Monty Shokeen. <a href="http://www.sitepoint.com/fancy-responsive-charts-with-chart-js" target="_blank">See article</a>.</p>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>

  <script>
  
var barChartData = {
  labels: ["dD 1", "dD 2", "dD 3", "dD 4", "dD 5", "dD 6", "dD 7", "dD 8", "dD 9", "dD 10"],
  datasets: [{
    fillColor: "rgba(0,60,100,1)",
    strokeColor: "black",
    data: ["2","2", "2", "2", "2", "2", "2", "2", "2", "2"]
  }]
}

var index = 11;
var ctx = document.getElementById("canvas").getContext("2d");
var barChartDemo = new Chart(ctx).Bar(barChartData, {
  responsive: true,
  barValueSpacing: 2
});


  </script>

</body>
</html>
