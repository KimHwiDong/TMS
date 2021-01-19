<?php
	date_default_timezone_set('Asia/Seoul');
	error_reporting(E_ALL);
    ini_set("display_errors", 1);
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);


	include_once('simplehtmldom_1_9_1/simple_html_dom.php');//측정된 가스 값을 가져옵니다.
 	//$TSP = file_get_html('http://192.168.1.99/TSP.txt');//측정된 먼지의 값입니다.
	$hlat = file_get_html('http://192.168.1.99/halt.txt');
	$control = file_get_html('http://192.168.1.99/control.txt');
	$operation_error = file_get_html('http://192.168.1.99/operation_error.txt');
	$repair = file_get_html('http://192.168.1.99/repaur.txt');
	
	

	include_once('storeCon.php');
	
	echo "<br/>";
	if($repair->plaintext == 1){
		$sql = "UPDATE measure_machine set machine_status = '8' where machine_num = 'M20';";
		$result_set1 =mysqli_query($conn, $sql);
		
		if($conn->query($sql) ==  TRUE){
			echo "string";
		}
	}else if($hlat->plaintext == 1){
		$sql = "UPDATE measure_machine set machine_status = '4' where machine_num = 'M20';";
		$result_set1 =mysqli_query($conn, $sql);
	}else if($operation_error->plaintext == 1){
		$sql = "UPDATE measure_machine set machine_status = '2' where machine_num = 'M20';";
		$result_set1 =mysqli_query($conn, $sql);
	}else if ($control->plaintext == 1) {
		# code...
		$sql = "UPDATE measure_machine set machine_status = '1' where machine_num = 'M20';";
		$result_set1 =mysqli_query($conn, $sql);
	}else{
		$sql = "UPDATE measure_machine set machine_status = '0' where machine_num = 'M20';";
		$result_set1 =mysqli_query($conn, $sql);
	}

?>