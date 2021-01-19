<?php

	//디비가 연결 되었다
	//1. 실시간 데이터를 디비에 연결한다. 다만 먼지 값만 넣어 준다
	function TSP_data_info($M_num){
		include('DBMGR.php'); // data base connection
		$TSP = file_get_html('http://192.168.1.99/TSP.txt');
		$templeture = 0;
		$time = date("YmdHis");	



	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else if($conn){
		echo "DB Connect";
	}
	//echo "먼지값 : ";
	$var =  $TSP->plaintext;
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



		$insert_TSP = "INSERT into data_info_1 values ('".$M_num."','".$time."','TSP','먼지',".round(($TSP->plaintext * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";
		if($conn->query($insert_TSP) == TRUE){
			 $value_over = "SELECT data_value from data_info_1 where machine_num = '".$M_num."' order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);

	$M_count = "SELECT * from sendMesaage";
		$result_value = mysqli_query($conn,$M_count);
		$row_value_M = mysqli_fetch_array($result_value);
		
	//	echo $row_value_M['count'];

	if($row_value['data_value'] >= 5){	
		
		if($row_value_M['count'] == 0){
			
		 //include_once('SendFTS_one.php');
			echo "카카오톡 전송";
			$update_count = "update sendMesaage set count = 1; ";
			$result_value = mysqli_query($conn,$update_count);
			$row_value_M=mysqli_fetch_array($result_value);
			//echo $row_value_M['count'];
		}
		else if($row_value_M['count'] == 1){
			//echo "이미 메시지를 보냄";
			//echo $row_value_M['count'];
		}
	}
	if($row_value['data_value'] < 5){
			$update_count = "update sendMesaage set count = 0; ";
			$result_value = mysqli_query($conn,$update_count);
			//$row_value_M=mysqli_fetch_array($result_value);
			//echo "초기화12";
			//echo $row_value_M['count'];
		}

} else {
    echo "Error: " . $insert1 . "<br>" . $conn->error;
    $F_count1 += 1;
     echo "LT2에 오류 발생 했음";
     $M_statis = "UPDATE measure_machine set machine_status = 2 where machine_num ='".$M_num."'";
	$result_value_MS = mysqli_query($conn, $M_statis);
}	
	
	 data_info_json($M_num);//실시간 자료가 들어 오는 것을 json형태로 확인
	 data_5avg($M_num);//5분 자료 생성 프로그램

	 //data_30avg($M_num);
	}
 //

	// 2. 넣어진 데이터 출력(실시간)
	function data_info_json($M_num){
		include('DBMGR.php'); 
		$sql1 = "SELECT * from data_info_1 where machine_num = '".$M_num."' order by measure_date  desc limit 1;";

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
	 mysqli_close($conn);
	}
	//5분 자료 생성
	function data_5avg($M_num){
		include('DBMGR.php');//디비 연결 파일 불러 오기
		$count = "SELECT count(*) FROM data_info_1 where machine_num = '".$M_num."';";
		$result_set1 = mysqli_query($conn,$count);
		$row1=mysqli_fetch_array($result_set1);
		$count_line = $row1['count(*)'];
		$div_count = 300;

		if($count_line % $div_count != 0){
		//echo "5분 자료를 만들 수 없습니다";
	}else if($count_line % $div_count == 0){
				$line = $count_line -299;
				$data_value_avg = "SELECT avg(A.data_value) from (select r.data_value from data_info_1 r where data_code = 'TSP' and machine_num = '".$M_num."' limit ".$line.",".$div_count.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				//echo "<br/>";
			//	echo $row2['avg(A.data_value)'];
			//	echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];

				$end_time = "SELECT measure_date from data_info_1 where machine_num = '".$M_num."' order by measure_date desc limit 299,1;";
		$start_time = "SELECT measure_date from data_info_1 where machine_num = '".$M_num."' order by measure_date desc limit 1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
		
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

		$start = $row3['measure_date'];
		$end = $row4['measure_date'];
		

		$error_count = "SELECT count(*) from data_info_1 where data_value != '0' and machine_num = '".$M_num."';";
		$error_result = mysqli_query($conn, $error_count);
		$error_count_row = mysqli_fetch_array($error_result);
		//echo $error_count_row['count(*)'];

		if ($error_count_row['count(*)'] >= 240) {//정상적인 5분 자료 생성
			nomal_5avg($start, $end, $M_num,$data_value_avg_1);
			data_avg_info_json($M_num,'5');
			del_data_info($M_num);
			later_M_del($M_num,'5');

		}else if($error_count_row['count(*)'] < 240){//비정상 적인 5분 자료
			unnomal_5avg($start, $end, $M_num,$data_value_avg_1);
			data_avg_info_json($M_num,'5');
			del_data_info($M_num);
			later_M_del($M_num,'5');
		}

	}
}
	//80% 이상 정장 데이터가 들어오는 함수
	function nomal_5avg($row3, $row4, $M_num,$data_value_avg_1){
		//echo "<br/>";
		
		include('DBMGR.php');

		
	
	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('".$M_num."','".$row4."','".$row3."','TSP','먼지','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	//echo "<br/>"; 
    echo "New TSP 5avg data_info insert";
    
			}
	}

	//80% 이하 비정상 데이터가 들어올 때 함수
	function unnomal_5avg($row3, $row4, $M_num,$data_value_avg_1){
		//echo "<br/>";
		
		include('DBMGR.php');

		
	
	$insert_5avg = 
	"INSERT into 5avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value, STATUS) values ('".$M_num."','".$row4."','".$row3."','TSP','먼지','mg',".$data_value_avg_1.",'***');";

		 if ($conn->query($insert_5avg) ==  TRUE) {
	//echo "<br/>"; 
    echo "New TSP unnomal 5avg data_info insert";
    
			}	
	}

	function data_avg_info_json($M_num,$avg){
		include('DBMGR.php');
		$avgSql = "SELECT * from ".$avg."avg_data_info where machine_num = '".$M_num."' order by measure_date_end desc limit 1;";

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
	}
//실시간 데이터 생성후 삭제
	function del_data_info($M_num){
		include('DBMGR.php');
			 $store_info = "SELECT * from ";

	$M_sql = "SELECT * from measure_machine where  machine_num = '".$M_num."';";
	$M_result_set1 = mysqli_query($conn,$M_sql);
	$M_row=mysqli_fetch_array($M_result_set1);

	
	$D_Live_q = "DELETE from data_info_1 where machine_num = '".$M_num."'";
	 if ($conn->query($D_Live_q) ==  TRUE) {
	 	echo "5분 데이터 생성 후 실시간 자료 삭제";	
	 }else{
	 		//echo "string";
	 }
	}
//한달 뒤 데이터 삭제 
	function later_M_del($M_num,$avg){
		include('DBMGR.php');
		$sql = "SELECT * from ".$avg."avg_data_info where machine_num = '".$M_num."'";
		$result_sql = mysqli_query($conn,$sql);
		$str_date = mysqli_fetch_array($result_sql);
		$str_date = $str_date['measure_date_start'];
		$date = date("Y-m-d", strtotime( $str_date ) );
		echo "<br/>";
		 $time = strtotime($date);
		echo "<br/>";
		 $final = date("YmdHis", strtotime("+1 month", $time));

		 if ($time >= $final) {
    	# code...
    	$delQury = "DELETE from ".$avg."avg_data_info where machine_num = '".$M_num."' and measure_date_start < '".$final."';";
    	mysqli_query($conn,$delQury);
    }else{
    	echo "\n 삭제 실페";
    }
} 
	//////////////////////////////////////////////////////////////////////////////////
//30분 데이터
	function data_30avg($M_num){
		include('DBMGR.php');
		$count = "SELECT count(*) FROM 5avg_data_info where machine_num = '".$M_num."';";

	$result_set1 = mysqli_query($conn,$count);

	$row1=mysqli_fetch_array($result_set1);
	$count_line = $row1['count(*)'];
	echo $count_line;
	$div_count1 = 6;

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
				$data_value_avg = "SELECT avg(A.data_value) from (select r.data_value from 5avg_data_info r where machine_num='".$M_num."' limit ".$line.",".$div_count1.") A;";
				$result_set2 = mysqli_query($conn, $data_value_avg);
				$row2 = mysqli_fetch_array($result_set2);
				echo "<br/>";
				echo $row2['avg(A.data_value)'];
				echo "<br/>";
				$data_value_avg_1 = $row2['avg(A.data_value)'];


		$end_time = "SELECT measure_date_end from 5avg_data_info where machine_num='".$M_num."' order by measure_date_end desc limit 5,1;";
		$start_time = "SELECT measure_date_start from 5avg_data_info where machine_num='".$M_num."' order by measure_date_start desc limit 1;";

		$result_set3 = mysqli_query($conn, $end_time);
		$result_set4 = mysqli_query($conn, $start_time);
	
		$row3 = mysqli_fetch_array($result_set3);
		$row4 = mysqli_fetch_array($result_set4);

	$sql = "SELECT count(*) from 5avg_data_info where STATUS = '***' and machine_num = '".$M_num."';";	
	$result_set = mysqli_query($conn, $sql);
	$result_row = mysqli_fetch_array($result_set);

	if($result_row['count(*)'] < 4){
		nomal_30avg($row3, $row4, $M_num,$data_value_avg_1);
		data_avg_info_json($M_num,'30');
		later_M_del($M_num,'30');
		del_same_30avg($M_num);
	}else if($result_row['count(*)'] >= 4){
		unnomal_30avg($row3, $row4, $M_num,$data_value_avg_1);
		data_avg_info_json($M_num,'30');
		later_M_del($M_num,'30');
		del_same_30avg($M_num);
	}
}
}

//정상 적인 30분 자료
function nomal_30avg($row3, $row4, $M_num,$data_value_avg_1){
	include('DBMGR.php');
		$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value) values ('".$M_num."','".$row4['measure_date_start']."','".$row3['measure_date_end']."','TSP','먼지','mg',".$data_value_avg_1.");";

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New TSP 30avg data_info insert";
}
}
// 비정상적인 30분 자료
function unnomal_30avg($row3, $row4, $M_num,$data_value_avg_1){
	include('DBMGR.php');
	$insert_30avg = 
	"INSERT into 30avg_data_info(machine_num, measure_date_start, measure_date_end, data_code, data_name, data_range, data_value, STATUS) values ('".$M_num."','".$row4['measure_date_start']."','".$row3['measure_date_end']."','TSP','먼지','mg',".$data_value_avg_1.", '***');"; 

		 if ($conn->query($insert_30avg) ==  TRUE) {
	echo "<br/>"; 
    echo "New unnomal TSP 30avg data_info insert";

}
}
function del_same_30avg($M_num){
	include('DBMGR.php');
	$avgSql = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' order by measure_date_end desc limit 1;";

	$result_set1 = mysqli_query($conn,$avgSql);

	$row5=mysqli_fetch_array($result_set1);



	$sameSQL = "SELECT * from 30avg_data_info where machine_num = '".$M_num."' order by measure_date_end desc limit 1,1;";

	$result_set1 = mysqli_query($conn,$sameSQL);

	$row6=mysqli_fetch_array($result_set1);

		if($row5['measure_date_start'] == $row6['measure_date_start']){
			$del = "DELETE from 30avg_data_info  where machine_num = '".$M_num."' order by measure_date_end desc limit 1";
			$result_set = mysqli_query($conn,$del);
			echo "삭제 성공";
		}	
}


	//TSP_data_info('M21');
	 //data_5avg('M21');
	// nomal_5avg('20210111083015','20210112141449','M21');
	 //data_avg_info_json('M20','5');
	//later_M_del('M20','5');
	//data_30avg('M21');
?>