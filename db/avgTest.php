<?php
	date_default_timezone_set('Asia/Seoul');
	error_reporting(E_ALL);
    ini_set("display_errors", 1);

	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else if($conn){
		echo "DB Connect11";
	}
	
	echo "현재 일시 : ". date("Y-m-d H:i:s")."<br/>";
	
	function avg5_data(){
	$time = date("Y-m-d-H-i-s");	
	$now = date("Y_m_d");
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$count = "SELECT count(*) FROM live_".$now.";";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);

	echo "<br/>";
	print_r($row1);

	echo "<br/>";
	echo $row1['count(*)'];

	$count_line = $row1['count(*)'];

	if($count_line % 6 != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % 6 == 0){
				$line = $count_line -5;
				$zerogas_avg = "select avg(A.zerogas) from (select r.zerogas from live_".$now." r limit ".$line.",6) A;";
				$result_set2 = mysqli_query($conn, $zerogas_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo (int)$row2['avg(A.zerogas)'];
				echo "<br/>";
				$zerogas_avg_1 = (int)$row2['avg(A.zerogas)'];


		$end_time = "select measure_date from live_".$now." order by measure_date desc limit 1;";
		$start_time = "select measure_date from live_".$now." order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, zerogas) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."',".$zerogas_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>";
    echo "New 5avg data_info insert";
} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}
	
	}


	function avg30_data(){

	$time = date("Y-m-d-H-i-s");	
	$now = date("Y_m_d");
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$count = "SELECT count(*) FROM live_".$now.";";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);

	echo "<br/>";
	print_r($row1);

	echo "<br/>";
	echo $row1['count(*)'];

	$count_line = $row1['count(*)'];

	if($count_line % 30 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % 30 == 0){
				$line = $count_line -29;
				$zerogas_avg = "select avg(A.zerogas) from (select r.zerogas from live_".$now." r limit ".$line.",30) A;";
				$result_set2 = mysqli_query($conn, $zerogas_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo (int)$row2['avg(A.zerogas)'];
				echo "<br/>";
				$zerogas_avg_1 = (int)$row2['avg(A.zerogas)'];


		$end_time = "select measure_date from live_".$now." order by measure_date desc limit 1;";
		$start_time = "select measure_date from live_".$now." order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, zerogas) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."',".$zerogas_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>";
    echo "New 30avg data_info insert";
} else {
    echo "Error: " . $insert_30avg . "<br>" . $conn->error;
}

}

	}	
	avg5_data();
	avg30_data();
?>