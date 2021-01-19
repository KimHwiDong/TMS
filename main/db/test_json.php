<?php

include_once('simplehtmldom_1_9_1/simple_html_dom.php');
 
$TSP = file_get_html('http://192.168.1.99/TSP.txt');
$SO2 = file_get_html('http://192.168.1.99/SO2.txt');
$NOX = file_get_html('http://192.168.1.99/NOX.txt');
$HCL = file_get_html('http://192.168.1.99/HCL.txt');

$TSP_Name = "먼지";
$SO2_Name = "아황산";
$NOX_Name = "질소산";
$HCL_Name = "염화수";

	$TSP_code = "TSP";
	$SO2_code = "SO2";
	$NOX_code = "NOX";
	$HCL_code = "HCL";


function TSP($M_num,$gas_code ,$gas, $gas_name){
include_once('simplehtmldom_1_9_1/simple_html_dom.php');
 



	date_default_timezone_set('Asia/Seoul');
    ini_set("display_errors", 1);
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$time = date("YmdHis");	
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
	echo "먼지값 : ";
	$var =  $gas->plaintext;
	if(empty($var)){
	echo "LT2 꺼짐";
	$M_statis = "UPDATE measure_machine set machine_status = 4 where machine_num = '".$M_num."'";
	$result_value_MS = mysqli_query($conn, $M_statis);
	//$row_value_MS = mysqli_fetch_array($result_value_MS);
	exit(); 
}else{
	
	$M_statis = "UPDATE measure_machine set machine_status = 0 where machine_num = '".$M_num."'";
	$result_value_MS = mysqli_query($conn, $M_statis);
}

	//datainfo 1
	  	$insert1 = "INSERT into data_info_1 values ('".$M_num."','".$time."','".$gas_code."','".$gas_name."',".round(($gas->plaintext * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert1) ==  TRUE) {
	// echo "<br/>";
 //    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	// echo "<br/>";
	// echo $row_value['data_value'];
	$M_count = "SELECT * from sendMesaage";
		$result_value = mysqli_query($conn,$M_count);
		$row_value_M = mysqli_fetch_array($result_value);
		echo "여부?? : ";
		echo $row_value_M['count_'."$gas_code"];

	if($row_value['data_value'] >= 5){	
		
		if($row_value_M['count_'."$gas_code"] == 0){
			
		// include_once('SendFTS_one.php');
			echo "카카오톡 전송";
			$update_count = "update sendMesaage set count_".$gas_code." = 1; ";
			echo $update_count;
			$result_value = mysqli_query($conn,$update_count);
			//$row_value_M=mysqli_fetch_array($result_value);
			echo $row_value_M['count_'."$gas_code"];
		}
		else if($row_value_M['count_'."$gas_code"] == 1){
			echo "이미 메시지를 보냄";
			echo $row_value_M['count_'."$gas_code"];
		}
	}
	if($row_value['data_value'] < 5){
			$update_count = "update sendMesaage set count_".$gas_code." = 0; ";
			$result_value = mysqli_query($conn,$update_count);
			//$row_value_M=mysqli_fetch_array($result_value);
			echo "초기화12";
			echo $row_value_M['count_'."$gas_code"];
		}

} else {
    echo "Error: " . $insert1 . "<br>" . $conn->error;
    $F_count1 += 1;
     echo "LT2에 오류 발생 했음";
     $M_statis = "UPDATE measure_machine set machine_status = 2 where machine_num = '".$M_num."'";
	$result_value_MS = mysqli_query($conn, $M_statis);
}	
	$sql1 = "SELECT * from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date desc limit 1;";

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

	

 
 //datainf01 avg 5 

	$count = "SELECT count(*) FROM data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."';";
	$result_set1 = mysqli_query($conn,$count);
	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	$div_count = 10 - $F_count1;

	if($count_line % $div_count != 0){
		echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -9;
				$data_value_avg = "select avg(A.data_value) from (select r.data_value from data_info_1 r where data_code = '".$gas_code."' and machine_num = '".$M_num."' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "SELECT measure_date from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date desc limit 9,1;";
		$start_time = "SELECT measure_date from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date desc limit 1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
		
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

//수정 시작할 시점 (80% 이상 이하 일때 코딩 추가 하여야 한다)
		//80%이상 정상일 때 
		$error_count = "SELECT count(*) from data_info_1 where data_value != '0' and machine_num = '".$M_num."' and data_code = '".$gas_code."';";
		$error_result = mysqli_query($conn, $error_count);
		$error_count_row = mysqli_fetch_array($error_result);

		if ($error_count_row['count(*)'] >= 8) {
	
	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('".$M_num."','".$row4['measure_date']."','".$row3['measure_date']."','".$gas_code."','".$gas_name."','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";
    		include_once('sendData.php');
    		 Send_5avg('1234','M20');  
   		$str_date = $row4['measure_date'];
		$date = date("Y-m-d", strtotime( $str_date ) );
		echo "<br/>";
		echo $time = strtotime($date);
		echo "<br/>";
		echo $final = date("YmdHis", strtotime("+1 month", $time));

    //1달뒤 데이터 자동 삭제
    if ($time >= $final) {
    	# code...
    	$delQury = "DELETE from 5avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' and measure_date_start < '".$final."';";
    	mysqli_query($conn,$delQury);
    }
    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1;";

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
	//$data_avg5_1->coress_area=  $row5['coress_area'];
	// $data_avg5_1->density=  $row5['density'];
	// $data_avg5_1->P=  $row5['P'];
	// $data_avg5_1->wet=  $row5['wet'];
	// $data_avg5_1->sys=  $row5['sys'];
	// $data_avg5_1->control=  $row5['control'];
	
	$data_avg5_datacode = json_encode($data_avg5_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_avg5_datacode;
	 //사업장 정보 나열 
	 $store_info = "SELECT * from ";


	
	$D_Live_q = "DELETE from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."'";
	 if ($conn->query($D_Live_q) ==  TRUE) {
	 	echo "5분 데이터 생성 후 실시간 자료 삭제";	
	 }else{
	 		echo "string";
	 }
	
	
} else { 
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}else if($error_count_row['count(*)'] < 8){// 비정상
	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value, STATUS) values ('".$M_num."','".$row4['measure_date']."','".$row3['measure_date']."','".$gas_code."','".$gas_name."','mg',".$data_value_avg_1.",'***');";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 5avg data_info insert";
    				include_once('sendData.php');
    		 		Send_5avg('1234',$M_num);  
   		$str_date = $row4['measure_date'];
		$date = date("Y-m-d", strtotime( $str_date ) );
		echo "<br/>";
		echo $time = strtotime($date);
		echo "<br/>";
		echo $final = date("YmdHis", strtotime("+1 month", $time));

    //1달뒤 데이터 자동 삭제
    if ($time >= $final) {
    	# code...
    	$delQury = "DELETE from 5avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' and measure_date_start < '".$final."';";
    	mysqli_query($conn,$delQury);
    }
    //5분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 5avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1;";

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
	//$data_avg5_1->coress_area=  $row5['coress_area'];
	// $data_avg5_1->density=  $row5['density'];
	// $data_avg5_1->P=  $row5['P'];
	// $data_avg5_1->wet=  $row5['wet'];
	// $data_avg5_1->sys=  $row5['sys'];
	// $data_avg5_1->control=  $row5['control'];
	
	$data_avg5_datacode = json_encode($data_avg5_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_avg5_datacode;


	// $host = "127.0.0.1";
	// $port = "12348";
	// $msg = "먼지 측정 5분 자료 생성";
	// $sock  = socket_create(AF_INET, SOCK_STREAM, 0);
	// 	socket_connect($sock, $host, $port);

	// 	socket_write($sock, $msg, strlen($msg));	
	
	$D_Live_q = "DELETE from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."'";
	 if ($conn->query($D_Live_q) ==  TRUE) {
	 	echo "5분 데이터 생성 후 실시간 자료 삭제";	
	 }else{
	 		echo "string";
	 }
	
	
} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
}
}

	 //datainfo30 avg 1
	$count2 = "SELECT count(*) from data_info_1 where machine_num = '".$M_num."' and data_code = '".$gas_code."';";
	$result_set = mysqli_query($conn,$count2);
	$count2_row = mysqli_fetch_array($result_set);
	$count2_line = $count2_row['count(*)'];
	echo "이거 : ".$count2_line;

	$count = "SELECT count(*) FROM 5avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."';";

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
	}else if($count_line % $div_count1 == 0 && $count2_line == 0){
				$line = $count_line -5;
				$data_value_avg = "SELECT avg(A.data_value) from (select r.data_value from 5avg_data_info r where machine_num='".$M_num."' and data_code = '".$gas_code."' limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "SELECT measure_date_end from 5avg_data_info where machine_num='".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 5,1;";
		$start_time = "SELECT measure_date_start from 5avg_data_info where machine_num='".$M_num."' and data_code = '".$gas_code."' order by measure_date_start desc limit 1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$sql = "SELECT count(*) from 5avg_data_info where STATUS = '***' and machine_num = '".$M_num."' and data_code = '".$gas_code."';";	
	$result_set = mysqli_query($conn, $sql);
	$result_row = mysqli_fetch_array($result_set);

	if($result_row['count(*)'] < 4){
		$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('".$M_num."','".$row4['measure_date_start']."','".$row3['measure_date_end']."','".$gas_code."','".$gas_name."','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 30avg data_info insert";
    	include_once('sendData.php');
    		Send_30avg('1234',$M_num);  
    //30분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1;";

	$result_set1 = mysqli_query($conn,$avgSql);

	$row5=mysqli_fetch_array($result_set1);


    $data_avg30_1 = new stdClass();

	$data_avg30_1->machine_num =  $row5['machine_num'];
	$data_avg30_1->measure_date_start =  $row5['measure_date_start'];
	$data_avg30_1->measure_date_end =  $row5['measure_date_end'];
	$data_avg30_1->data_code =  $row5['data_code'];
	$data_avg30_1->data_name =  $row5['data_name'];
	$data_avg30_1->data_value =  $row5['data_value'];
	$data_avg30_1->data_range =  $row5['data_range'];
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
	
	$data_avg30_datacode = json_encode($data_avg30_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_avg30_datacode;

	  // 같은 자료가 들어오면 중복된 자료는 제거한다
	 $sameSQL = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1,1;";

	$result_set1 = mysqli_query($conn,$sameSQL);

	$row6=mysqli_fetch_array($result_set1);

		if($row5['measure_date_start'] == $row6['measure_date_start']){
			$del = "DELETE from 30avg_data_info  where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1";
			$result_set = mysqli_query($conn,$del);
			echo "삭제 성공";
		}

		$str_date = $row5['measure_date_start'];
		$date = date("Y-m-d", strtotime( $str_date ) );
		echo "<br/>";
		echo $time = strtotime($date);
		echo "<br/>";
		echo $final = date("YmdHis", strtotime("+1 month", $time));

    //1달뒤 데이터 자동 삭제
    if ($time >= $final) {
    	# code...
    	$delQury = "DELETE from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' and measure_date_start < '".$final."';";
    	mysqli_query($conn,$delQury);
    }
} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
	}
	 if ($result_row['count(*)'] >= 4) {// 비정상적인 30분 자료
		# code...
	 			$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value, STATUS) values ('".$M_num."','".$row4['measure_date_start']."','".$row3['measure_date_end']."','".$gas_code."','".$gas_name."','mg',".$data_value_avg_1.", '***');";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 30avg data_info insert";

    //30분데이터 결과 json으로 출력

    $avgSql = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1;";

	$result_set1 = mysqli_query($conn,$avgSql);

	$row5=mysqli_fetch_array($result_set1);


    $data_avg30_1 = new stdClass();

	$data_avg30_1->machine_num =  $row5['machine_num'];
	$data_avg30_1->measure_date_start =  $row5['measure_date_start'];
	$data_avg30_1->measure_date_end =  $row5['measure_date_end'];
	$data_avg30_1->data_code =  $row5['data_code'];
	$data_avg30_1->data_name =  $row5['data_name'];
	$data_avg30_1->data_value =  $row5['data_value'];
	$data_avg30_1->data_range =  $row5['data_range'];
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
	
	$data_avg30_datacode = json_encode($data_avg30_1,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

	 echo $data_avg30_datacode;

    	include_once('sendData.php');
    		Send_30avg('1234','M20');

	  // 같은 자료가 들어오면 중복된 자료는 제거한다
	 $sameSQL = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1,1;";

	$result_set1 = mysqli_query($conn,$sameSQL);

	$row6=mysqli_fetch_array($result_set1);

		if($row5['measure_date_start'] == $row6['measure_date_start']){
			$del = "DELETE from 30avg_data_info  where machine_num = '".$M_num."' and data_code = '".$gas_code."' order by measure_date_end desc limit 1";
			$result_set = mysqli_query($conn,$del);
			echo "삭제 성공";
		}

		$str_date = $row5['measure_date_start'];
		$date = date("Y-m-d", strtotime( $str_date ) );
		echo "<br/>";
		echo $time = strtotime($date);
		echo "<br/>";
		echo $final = date("YmdHis", strtotime("+1 month", $time));

    //1달뒤 데이터 자동 삭제
    if ($time >= $final) {
    	# code...
    	$delQury = "DELETE from 30avg_data_info where machine_num = '".$M_num."' and data_code = '".$gas_code."' and measure_date_start < '".$final."';";
    	mysqli_query($conn,$delQury);
    }
} else {
    echo "Error: " . $insert_5avg . "<br>" . $conn->error;
}
	}

	
}
}

?>