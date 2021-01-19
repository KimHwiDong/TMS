<?php
	
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else if($conn){
		echo "DB Connect";
	}

	// $sql3 = "SELECT * from measure_machine;";
	// 	$result_value = mysqli_query($conn,$sql3);
	// 	$row_value = mysqli_fetch_array($result_value);
	// 	$LT2st = $row_value['machine_status'];

	// 	echo $LT2st;
		$msg2 = "M20";
		$sql = "SELECT * from measure_machine where machine_num ='".$msg2."';";
		echo $sql;
	 	$result_value = mysqli_query($conn,$sql);
	 	$row_value = mysqli_fetch_array($result_value);

	    $M_num = $row_value['machine_num'];
	    echo $M_num;

      	
      	//기기 버젼 출력
      	
?>