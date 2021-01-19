<?php

	include_once('simplehtmldom_1_9_1/simple_html_dom.php');
 
$TSP = file_get_html('http://192.168.1.99/TSP.txt');

	date_default_timezone_set('Asia/Seoul');
    ini_set("display_errors", 1);
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$time = date("Y-m-d-H-i-s");	

	$F_count1 = 0;
	 //datainfo30 avg 1

	$count = "SELECT count(*) FROM 5avg_data_info where machine_num = 'M20';";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 6 - $F_count1;

	if($count_line == 0 ){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}

	else if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -5;
				$data_value_avg = "SELECT avg(A.data_value) from (select r.data_value from 5avg_data_info r where machine_num='M20' limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "SELECT measure_date_end from 5avg_data_info where machine_num='M20' order by measure_date_end desc limit 5,1;";
		$start_time = "SELECT measure_date_start from 5avg_data_info where machine_num='M20' order by measure_date_start desc limit 1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date_start']."','".$row3['measure_date_end']."','O2b','산소','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //30분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info where machine_num = 'M20' order by measure_date_end desc limit 1;";

	$result_set1 = mysqli_query($conn,$avgSql);

	$row5=mysqli_fetch_array($result_set1);


    $data_avg5_1 = new stdClass();

	$data_avg5_1->machine_num =  $row5['machine_num'];
	$data_avg5_1->measure_date_start =  $row5['measure_date_start'];
	$data_avg5_1->measure_date_end =  $row5['measure_date_end'];
	$data_avg5_1->data_code =  $row5['data_code'];
	$data_avg5_1->data_name =  $row5['data_name'];
	$data_avg5_1->data_value =  $row5['data_value'];
	$data_avg5_1->data_range =  $row5['data_range'];
	// $data_avg5_1->zerogas =  $row5['zerogas'];
	// $data_avg5_1->zerogas_order =  $row5['zerogas_order'];
	// $data_avg5_1->spangas=  $row5['spangas'];
	// $data_avg5_1->zerogas_order=  $row5['zerogas_order'];
	// $data_avg5_1->Ox2=  $row5['Ox2'];
	// $data_avg5_1->pw=  $row5['pw'];
	// $data_avg5_1->coress_area=  $row5['coress_area'];
	// $data_avg5_1->density=  $row5['density'];
	// $data_avg5_1->P=  $row5['P'];
	// $data_avg5_1->wet=  $row5['wet'];
	// $data_avg5_1->sys=  $row5['sys'];
	// $data_avg5_1->control=  $row5['control'];
	
	$data_avg5_datacode = json_encode($data_avg5_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_avg5_datacode;

	 // 같은 자료가 들어오면 중복된 자료는 제거한다
	 $sameSQL = "SELECT * from 30avg_data_info where machine_num = 'M20' order by measure_date_end desc limit 1,1;";

	$result_set1 = mysqli_query($conn,$sameSQL);

	$row6=mysqli_fetch_array($result_set1);

		if($row5['measure_date_start'] == $row6['measure_date_start']){
			$del = "DELETE from 30avg_data_info  where machine_num = 'M20' order by measure_date_end desc limit 1";
			$result_set = mysqli_query($conn,$del);
			echo "삭제 성공";
		}


} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

?>
