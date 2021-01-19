<?php

	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

		//측정 항목 수
		$count_sql = "SELECT count(distinct(data_code)) from 5avg_data_info where machine_num = 'M20';";
		$count_set = mysqli_query($conn, $count_sql);
		$count_row1 = mysqli_fetch_array($count_set);
			# code...
			$Count = $count_row1['count(distinct(data_code))'];
		

		//측정 일시 가져 오기
		$Time_sql = "SELECT measure_date_end from 5avg_data_info where machine_num = 'M20' order by measure_date_end desc;";
		$Time_set = mysqli_query($conn, $Time_sql);
		while ( $Time_row = mysqli_fetch_array($Time_set)) {
			# code...
			$Time = $Time_row['measure_date_end'];
		}
	

	echo $Count;        
?>