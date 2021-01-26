<?php

	include 'DBMGR.php';


	$gas_code = 'TSP';
	$M_num = 'M20';
		$check_sql = "SELECT * from data_info_1 where data_code='".$gas_code."' and machine_num = '".$M_num."' and data_value >= 5 limit 0,1;";
		echo $check_sql;
        $check_result = mysqli_query($conn, $check_sql);
        $check_row = mysqli_fetch_array($check_result);


       // $over = $check_row['data_value'] - 5;
        echo $check_row['data_value']."qwer";
?>