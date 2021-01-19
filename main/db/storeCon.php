<?php
$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);



	function DCD($DCD,$store_num){
	date_default_timezone_set('Asia/Seoul');
	error_reporting(E_ALL);
    ini_set("display_errors", 1);
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);


		$sql = "UPDATE store SET DCD = '".$DCD."' where store_num = ".$store_num.";";
		echo $sql;
		 
	}

	//데이터 베이스 연결 하는 코드 입니다 
	//연결 오류시 연결 실패 구문을 전송하고 아닐시 DB Connection 문구를 반환합니다.





	if (function_exists('DCD'))  
{ 
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error.DCD(1,'1234'));
	} else if($conn){
		echo "DB Connect";
		DCD(0,'1234');
	}; 
}  
else
{ 
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error.DCD(1,'1234'));
	} else if($conn){
		echo "DB Connect";
		DCD(0,'1234');
	} 
} 
?>