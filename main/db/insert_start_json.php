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
	$templeture = 27; // 실측 온도
	$F_count1 = 0;
	$F_count2 = 0;
	$F_count3 = 0;
	$F_count4 = 0;
	$F_count5 = 0;
	$F_count6 = 0;
	$F_count7 = 0;
	$F_count8 = 0;
	
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else if($conn){
		echo "DB Connect";
	}
	//datainfo 1
	  	$insert1 = "INSERT into data_info_1 values ('M20','".$time."','TSP','먼지',".round(($TSP->plaintext * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert1) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_1 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert1 . "<br>" . $conn->error;
    $F_count1 += 1;
}	
	$sql1 = "SELECT * from data_info_1 order by measure_date desc limit 1;";

	$result_set1 = mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_array($result_set1);

	$data_info_1 = new stdClass();

	$data_info_1->machine_num =  $row1['machine_num'];
	$data_info_1->measure_date =  $row1['measure_date'];
	$data_info_1->data_code =  $row1['data_code'];
	$data_info_1->data_name =  $row1['data_name'];
	$data_info_1->data_value =  $row1['data_value'];
	$data_info_1->data_range =  $row1['data_range'];
	$data_info_1->zerogas =  $row1['zerogas'];
	$data_info_1->zerogas_order =  $row1['zerogas_order'];
	$data_info_1->spangas=  $row1['spangas'];
	$data_info_1->zerogas_order=  $row1['zerogas_order'];
	$data_info_1->Ox2=  $row1['Ox2'];
	$data_info_1->pw=  $row1['pw'];
	$data_info_1->coress_area=  $row1['coress_area'];
	$data_info_1->density=  $row1['density'];
	$data_info_1->P=  $row1['P'];
	$data_info_1->wet=  $row1['wet'];
	$data_info_1->sys=  $row1['sys'];
	$data_info_1->control=  $row1['control'];
	
	$data_info_datacode = json_encode($data_info_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode;

//datainfo2

	 	$insert2 = "INSERT into data_info_2 values ('M20','".$time."','SO2','아황산',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert2) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_2 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert2 . "<br>" . $conn->error;
    $F_count2 += 1;
}	
	$sql2 = "SELECT * from data_info_2 order by measure_date desc limit 1;";

	$result_set2 = mysqli_query($conn,$sql2);

	$row2=mysqli_fetch_array($result_set2);

	$data_info_2 = new stdClass();

	$data_info_2->machine_num =  $row2['machine_num'];
	$data_info_2->measure_date =  $row2['measure_date'];
	$data_info_2->data_code =  $row2['data_code'];
	$data_info_2->data_name =  $row2['data_name'];
	$data_info_2->data_value =  $row2['data_value'];
	$data_info_2->data_range =  $row2['data_range'];
	$data_info_2->zerogas =  $row2['zerogas'];
	$data_info_2->zerogas_order =  $row2['zerogas_order'];
	$data_info_2->spangas=  $row2['spangas'];
	$data_info_2->zerogas_order=  $row2['zerogas_order'];
	$data_info_2->Ox2=  $row2['Ox2'];
	$data_info_2->pw=  $row2['pw'];
	$data_info_2->coress_area=  $row2['coress_area'];
	$data_info_2->density=  $row2['density'];
	$data_info_2->P=  $row2['P'];
	$data_info_2->wet=  $row2['wet'];
	$data_info_2->sys=  $row2['sys'];
	$data_info_2->control=  $row2['control'];
	
	$data_info_datacode2 = json_encode($data_info_2,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode2;

//data info 3

	 	$insert3 = "INSERT into data_info_3 values ('M20','".$time."','NOX','질소산',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert3) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_3 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert3 . "<br>" . $conn->error;
    $F_count3 += 1;
}	
	$sql3 = "SELECT * from data_info_3 order by measure_date desc limit 1;";

	$result_set3 = mysqli_query($conn,$sql3);

	$row3=mysqli_fetch_array($result_set3);

	$data_info_3 = new stdClass();

	$data_info_3->machine_num =  $row3['machine_num'];
	$data_info_3->measure_date =  $row3['measure_date'];
	$data_info_3->data_code =  $row3['data_code'];
	$data_info_3->data_name =  $row3['data_name'];
	$data_info_3->data_value =  $row3['data_value'];
	$data_info_3->data_range =  $row3['data_range'];
	$data_info_3->zerogas =  $row3['zerogas'];
	$data_info_3->zerogas_order =  $row3['zerogas_order'];
	$data_info_3->spangas=  $row3['spangas'];
	$data_info_3->zerogas_order=  $row3['zerogas_order'];
	$data_info_3->Ox2=  $row3['Ox2'];
	$data_info_3->pw=  $row3['pw'];
	$data_info_3->coress_area=  $row3['coress_area'];
	$data_info_3->density=  $row3['density'];
	$data_info_3->P=  $row3['P'];
	$data_info_3->wet=  $row3['wet'];
	$data_info_3->sys=  $row3['sys'];
	$data_info_3->control=  $row3['control'];
	
	$data_info_datacode3 = json_encode($data_info_3,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode3;

//data info 4


	 	$insert4 = "INSERT into data_info_4 values ('M20','".$time."','HCL','염화수',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert4) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_4 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert4 . "<br>" . $conn->error;
    $F_count4 += 1;
}	
	$sql4 = "SELECT * from data_info_4 order by measure_date desc limit 1;";

	$result_set4 = mysqli_query($conn,$sql4);

	$row4=mysqli_fetch_array($result_set4);

	$data_info_4 = new stdClass();

	$data_info_4->machine_num =  $row4['machine_num'];
	$data_info_4->measure_date =  $row4['measure_date'];
	$data_info_4->data_code =  $row4['data_code'];
	$data_info_4->data_name =  $row4['data_name'];
	$data_info_4->data_value =  $row4['data_value'];
	$data_info_4->data_range =  $row4['data_range'];
	$data_info_4->zerogas =  $row4['zerogas'];
	$data_info_4->zerogas_order =  $row4['zerogas_order'];
	$data_info_4->spangas=  $row4['spangas'];
	$data_info_4->zerogas_order=  $row4['zerogas_order'];
	$data_info_4->Ox2=  $row4['Ox2'];
	$data_info_4->pw=  $row4['pw'];
	$data_info_4->coress_area=  $row4['coress_area'];
	$data_info_4->density=  $row4['density'];
	$data_info_4->P=  $row4['P'];
	$data_info_4->wet=  $row4['wet'];
	$data_info_4->sys=  $row4['sys'];
	$data_info_4->control=  $row4['control'];
	
	$data_info_datacode4 = json_encode($data_info_4,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode4;
//datainfo 5
	 	$insert5 =  "INSERT into data_info_5 values ('M20','".$time."','HFB','불화수',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert5) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_5 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert5 . "<br>" . $conn->error;
    $F_count5 += 1;
}	
	$sql5 = "SELECT * from data_info_5 order by measure_date desc limit 1;";

	$result_set5 = mysqli_query($conn,$sql5);

	$row5=mysqli_fetch_array($result_set5);

	$data_info_5 = new stdClass();

	$data_info_5->machine_num =  $row5['machine_num'];
	$data_info_5->measure_date =  $row5['measure_date'];
	$data_info_5->data_code =  $row5['data_code'];
	$data_info_5->data_name =  $row5['data_name'];
	$data_info_5->data_value =  $row5['data_value'];
	$data_info_5->data_range =  $row5['data_range'];
	$data_info_5->zerogas =  $row5['zerogas'];
	$data_info_5->zerogas_order =  $row5['zerogas_order'];
	$data_info_5->spangas=  $row5['spangas'];
	$data_info_5->zerogas_order=  $row5['zerogas_order'];
	$data_info_5->Ox2=  $row5['Ox2'];
	$data_info_5->pw=  $row5['pw'];
	$data_info_5->coress_area=  $row5['coress_area'];
	$data_info_5->density=  $row5['density'];
	$data_info_5->P=  $row5['P'];
	$data_info_5->wet=  $row5['wet'];
	$data_info_5->sys=  $row5['sys'];
	$data_info_5->control=  $row5['control'];
	
	$data_info_datacode5 = json_encode($data_info_5,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode5;

	//datainfo 6
	$insert6 =  "INSERT into data_info_6 values ('M20','".$time."','NH3','암모니',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";
  	 if ($conn->query($insert6) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_6 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert6 . "<br>" . $conn->error;
    $F_count6 += 1;
}	
	$sql6 = "SELECT * from data_info_6 order by measure_date desc limit 1;";

	$result_set6 = mysqli_query($conn,$sql6);

	$row6=mysqli_fetch_array($result_set6);

	$data_info_6 = new stdClass();

	$data_info_6->machine_num =  $row6['machine_num'];
	$data_info_6->measure_date =  $row6['measure_date'];
	$data_info_6->data_code =  $row6['data_code'];
	$data_info_6->data_name =  $row6['data_name'];
	$data_info_6->data_value =  $row6['data_value'];
	$data_info_6->data_range =  $row6['data_range'];
	$data_info_6->zerogas =  $row6['zerogas'];
	$data_info_6->zerogas_order =  $row6['zerogas_order'];
	$data_info_6->spangas=  $row6['spangas'];
	$data_info_6->zerogas_order=  $row6['zerogas_order'];
	$data_info_6->Ox2=  $row6['Ox2'];
	$data_info_6->pw=  $row6['pw'];
	$data_info_6->coress_area=  $row6['coress_area'];
	$data_info_6->density=  $row6['density'];
	$data_info_6->P=  $row6['P'];
	$data_info_6->wet=  $row6['wet'];
	$data_info_6->sys=  $row6['sys'];
	$data_info_6->control=  $row6['control'];
	
	$data_info_datacode6 = json_encode($data_info_6,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode6;

	 //datainfo 7
	 $insert7 = "INSERT into data_info_7 values ('M20','".$time."','COb','일산화',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert7) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_7 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert7 . "<br>" . $conn->error;
    $F_count7 += 1;
}	
	$sql7 = "SELECT * from data_info_7 order by measure_date desc limit 1;";

	$result_set7 = mysqli_query($conn,$sql7);

	$row7=mysqli_fetch_array($result_set7);

	$data_info_7 = new stdClass();

	$data_info_7->machine_num =  $row7['machine_num'];
	$data_info_7->measure_date =  $row7['measure_date'];
	$data_info_7->data_code =  $row7['data_code'];
	$data_info_7->data_name =  $row7['data_name'];
	$data_info_7->data_value =  $row7['data_value'];
	$data_info_7->data_range =  $row7['data_range'];
	$data_info_7->zerogas =  $row7['zerogas'];
	$data_info_7->zerogas_order =  $row7['zerogas_order'];
	$data_info_7->spangas=  $row7['spangas'];
	$data_info_7->zerogas_order=  $row7['zerogas_order'];
	$data_info_7->Ox2=  $row7['Ox2'];
	$data_info_7->pw=  $row7['pw'];
	$data_info_7->coress_area=  $row7['coress_area'];
	$data_info_7->density=  $row7['density'];
	$data_info_7->P=  $row7['P'];
	$data_info_7->wet=  $row7['wet'];
	$data_info_7->sys=  $row7['sys'];
	$data_info_7->control=  $row7['control'];
	
	$data_info_datacode7 = json_encode($data_info_7,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode7;
//data info 8
	 $insert8 =   "INSERT into data_info_8 values ('M20','".$time."','O2b','산소',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert8) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_8 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){	
		// echo "<br/>";
		// echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');
	}
} else {
    echo "Error: " . $insert8 . "<br>" . $conn->error;
    $F_count8 += 1;
}	
	$sql8 = "SELECT * from data_info_8 order by measure_date desc limit 1;";

	$result_set8 = mysqli_query($conn,$sql8);

	$row8=mysqli_fetch_array($result_set8);

	$data_info_8 = new stdClass();

	$data_info_8->machine_num =  $row8['machine_num'];
	$data_info_8->measure_date =  $row8['measure_date'];
	$data_info_8->data_code =  $row8['data_code'];
	$data_info_8->data_name =  $row8['data_name'];
	$data_info_8->data_value =  $row8['data_value'];
	$data_info_8->data_range =  $row8['data_range'];
	$data_info_8->zerogas =  $row8['zerogas'];
	$data_info_8->zerogas_order =  $row8['zerogas_order'];
	$data_info_8->spangas=  $row8['spangas'];
	$data_info_8->zerogas_order=  $row8['zerogas_order'];
	$data_info_8->Ox2=  $row8['Ox2'];
	$data_info_8->pw=  $row8['pw'];
	$data_info_8->coress_area=  $row8['coress_area'];
	$data_info_8->density=  $row8['density'];
	$data_info_8->P=  $row8['P'];
	$data_info_8->wet=  $row8['wet'];
	$data_info_8->sys=  $row8['sys'];
	$data_info_8->control=  $row8['control'];
	
	$data_info_datacode8 = json_encode($data_info_8,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_info_datacode8;

	 //datainf01 avg 5 

	$count = "SELECT count(*) FROM data_info_1;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count1;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_1 r where data_code = 'TSP' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_1 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_1 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','TSP','먼지','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}
	 //datainfo2 avg 5 

	$count = "SELECT count(*) FROM data_info_2;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count2;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_2 r where data_code = 'SO2' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_2 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_2 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_2(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','SO2','아황산','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_2 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}
		 //datainfo3 avg 5 

	$count = "SELECT count(*) FROM data_info_3;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count3;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_3 r where data_code = 'NOX' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_3 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_3 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_3(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','NOX','질소산','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_3 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}

		 //datainfo4 avg 5 

	$count = "SELECT count(*) FROM data_info_4;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count4;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_4 r where data_code = 'HCL' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_4 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_4 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_4(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','HCL','염화수','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_4 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}

		 //datainfo5 avg 5 

	$count = "SELECT count(*) FROM data_info_5;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count5;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_5 r where data_code = 'HFb' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_5 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_5 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_5(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','HFb','불화수','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New HFb 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_5 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}

		 //datainfo5 avg 6 

	$count = "SELECT count(*) FROM data_info_6;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count6;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg =  "select avg(A.data_value) from (select r.data_value from data_info_6 r where data_code = 'NH3' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_6 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_6 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_6(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','NH3','암모','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New HFb 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_6 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}

		 //datainfo5 avg 6 

	$count = "SELECT count(*) FROM data_info_7;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count7;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_7 r where data_code = 'COb' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_7 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_7 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_7(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','COb','일산화','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New HFb 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_7 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}
		 //datainfo5 avg 8

	$count = "SELECT count(*) FROM data_info_8;";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 6 - $F_count7;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -5;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_8 r where data_code = 'O2b' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_8 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_8 order by measure_date desc limit 6,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_5avg = 
	"INSERT into 5avg_data_info_8(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','O2b','산소','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New HFb 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info_8 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}

}

		 //datainfo30 avg 1

	$count = "SELECT count(*) FROM data_info_1;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count1;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_1 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_1 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_1 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','O2b','산소','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 2

	$count = "SELECT count(*) FROM data_info_2;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count2;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_2 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_2 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_2 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_2(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','SO2','아황산','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_2 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 3

	$count = "SELECT count(*) FROM data_info_3;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count3;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_3 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_3 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_3 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_3(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','NOX','질소산','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_3 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 4

	$count = "SELECT count(*) FROM data_info_4;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count4;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_4 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_4 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_4 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_4(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','HCL','염화수','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_4 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo3 avg 5

	$count = "SELECT count(*) FROM data_info_5;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count5;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_5 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_5 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_5 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_5(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','HFb','불화수','mg',".$data_value_avg_1.");";


		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_5 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 6

	$count = "SELECT count(*) FROM data_info_6;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count6;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_6 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_6 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_6 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_6(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','NH3','암모','mg',".$data_value_avg_1.");";


		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_6 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 7

	$count = "SELECT count(*) FROM data_info_7;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count7;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_7 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_7 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_7 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_7(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','COb','일산화','mg',".$data_value_avg_1.");";


	 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_7 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

		 //datainfo30 avg 8

	$count = "SELECT count(*) FROM data_info_8;";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count1 = 30 - $F_count8;

	if($count_line % $div_count1 != 0){
		echo "<br/>";
		echo "30분 자료를 만들 수 없습니다";
		echo "<br/>";
	}else if($count_line % $div_count1 == 0){
				$line = $count_line -29;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_8 r limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "select measure_date from data_info_8 order by measure_date desc limit 1;";
		$start_time = "select measure_date from data_info_8 order by measure_date desc limit 30,1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$insert_30avg = 
	"INSERT into 30avg_data_info_8(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('M20','".$row4['measure_date']."','".$row3['measure_date']."','O2b','산소','mg',".$data_value_avg_1.");";


	 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";

    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info_8 order by measure_date_end desc limit 1;";

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

} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}

?>