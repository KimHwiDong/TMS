<?php
$servername = "localhost";
$username = "root";
$password = "gnlehdvskim1!";
$dbname = "konanservice";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO logs (질소산 ,Time) VALUES (now(),now())"; 
$sync = "UPDATE sync SET a3 = 1";

mysqli_query($conn, $sync);
mysqli_query($conn, $sql);

mysqli_close($conn);
?>