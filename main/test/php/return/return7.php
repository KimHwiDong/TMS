<?php
$servername = "localhost";
$username = "root";
$password = "gnlehdvskim1!";
$dbname = "konanservice";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sync = "UPDATE sync SET a7 = 0";
mysqli_query($conn, $sync);


$sql1 = "SELECT a7 FROM sync";
$result_set1 = mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result_set1);
echo $row1['a7']; 

mysqli_close($conn);

?>