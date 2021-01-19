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

<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
table.type01 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    margin : 10px 5px;
}
table.type01 th {
    width: 150px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border: 1px solid #ccc;
}
table.type01 td {
    width: 350px;
    padding: 10px;
    vertical-align: top;
    border: 1px solid #ccc;
}
    </style>

        <style type="text/css">
table.type02 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    margin : 20px 10px;
}
table.type02 th {
    width: 150px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border: 1px solid #ccc;
}
table.type02 td {
    width: 350px;
    padding: 10px;
    vertical-align: top;
    border: 1px solid #ccc;
}

    </style>
    <title>환영합니다</title>
</head>
<body>
    <script type="text/javascript">
        let check = setInterval(() => {
            fetch('live_table.php').then(function(response){
                    response.text().then(function(text){
                        document.getElementById('table01').innerHTML = text;
                    })
                });
        }, 1000);
   
        let check1 = setInterval(() => {
            fetch('5live.php').then(function(response){
                    response.text().then(function(text){
                        document.getElementById('table02').innerHTML = text;
                    })
                });
        }, 1000);
        let check2 = setInterval(() => {
            fetch('30live.php').then(function(response){
                    response.text().then(function(text){
                        document.getElementById('talbe03').innerHTML = text;
                    })
                });
        }, 1000); 
    </script>
    
    <h1>실시간 데이터 현황 </h1>
    <table class='type01' id = 'table01'>


    </table>
<br>
 
  <h1>5실시간 데이터 현황 </h1>
<table class='type01' id = 'table02'>


    </table>
   <br>
<h1>30실시간 데이터 현황 </h1>
    <table class='type01' id = 'talbe03'>


    </table>
</body>
</html>


        
<!-- 
            $n= 1;
        while ($row = mysqli_fetch_array($result) {
            # code...
            echo "<tr>";
            echo "<td>".$row['machine_num']."</td>";
            echo "<td>".$row['measure_date']."</td>";
            echo "<td>".$row['data_code']."</td>";
            echo "<td>".$row['data_name']."</td>";
            echo "<td>".$row['data_value']."</td>";
            echo "<td>".$row['data_range']."</td>";
            echo "<td>".$row['zerogas']."</td>";
            echo "<td>".$row['zerogas_order']."</td>";
            echo "<td>".$row['spangas']."</td>";
            echo "<td>".$row['spangas_order']."</td>";
            echo "<td>".$row['Ox2']."</td>";
            echo "<td>".$row['pw']."</td>";
            echo "<td>".$row['coress_area']."</td>";
            echo "<td>".$row['density']."</td>";
            echo "<td>".$row['P']."</td>";
            echo "<td>".$row['wet']."</td>";
            echo "<td>".$row['sys']."</td>";
            echo "<td>".$row['control']."</td>";
            echo "</tr>";
            $n ++;
        } -->
