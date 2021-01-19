<?php 

$servername = "localhost";
$username = "root";
$password = "gnlehdvskim1!";
$dbname = "konanservice";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql1 = "SELECT data_value FROM 30avg_data_info_4 order by measure_date_end desc limit 1";
$result_set1 = mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result_set1);

echo $row1['data_value']; 

?>