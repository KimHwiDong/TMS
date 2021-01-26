<?php
 	//데이터 베이스에 연결 합니다.
 	include_once('DBMGR.php');
 	include_once('simplehtmldom_1_9_1/simple_html_dom.php');//측정된 가스 값을 가져옵니다.
 	//$TSP = file_get_html('http://192.168.1.99/TSP.txt');//측정된 먼지의 값입니다.
	$hlat = file_get_html('http://192.168.1.99/halt.txt');
	$control = file_get_html('http://192.168.1.99/control.txt');
	$operation_error = file_get_html('http://192.168.1.99/operation_error.txt');
	$repair = file_get_html('http://192.168.1.99/repaur.txt');
	
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


 	//자료 측정기 기기 번호
 	$M_num = 'M20';
 	//LT2에 연결한 제반 동작 해제 하고 자료수집 상태로 전환
 	$M_mode = "SELECT * from measure_machine where machine_num = '".$M_num."';";
 	$M_mode_value = mysqli_query($conn,$M_mode);
	$M_mode_row_value=mysqli_fetch_array($M_mode_value);

	$M_mode_result = new stdClass();

	$M_mode_result->machine_num = $M_mode_row_value['machine_num'];
	$M_mode_result->machine_version = $M_mode_row_value['machine_version'];
	$M_mode_result->machine_status = $M_mode_row_value['machine_status'];
	$M_mode_result->pass = $M_mode_row_value['pass'];
	$M_mode_result->measure_mode = $M_mode_row_value['measure_mode'];

	echo "<br/>";

	function DL_S($var){

	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "UPDATE DCD set DL_status = '".$var."';";
	echo $sql;
	  if (mysqli_query($conn, $sql)) {

        echo "레코드 수정 성공!";

    } else {

        echo "레코드 수정 실패! : ".mysqli_error($conn);

    }

    
	}
	


	switch ($M_mode_result->measure_mode) {
		
		case '2':
			# code...
				echo "시료 체취 중....\n";
				echo "<br/>";
			break;
		
		case '1':
				echo "시료 체취 중....\n";
			if ($M_mode_result->machine_status == 4) {
				# code...
				echo "LT2 기기 꺼짐";

				$insert_del = "INSERT INTO del_live_data SELECT * FROM data_info_1 where machine_num = 'M20';";
				$del_result = mysqli_query($conn,$insert_del);

				$time_sql = "SELECT * from data_info_1 where machine_num = 'M20' order by measure_date desc limit 0,1;";
				$time_result = mysqli_query($conn, $time_sql);
				$time_row = mysqli_fetch_array($time_result);
				echo $time_row['measure_date'];

				$date = date("Y-m-d", strtotime( $time_row['measure_date'] ) );
				echo "<br/>";
				echo $time = strtotime($date);
				echo "<br/>";
				echo $final = date("YmdHis", strtotime("+1 month", $time));

				if ($time_row['measure_date'] >= $final) {
    		# code...
    		$delQury = "DELETE from del_live_data where machine_num = 'M20' and measure_date < '".$final."';";
    		mysqli_query($conn,$delQury);
    			
    			}else{
    				echo "string";
    			}

				$sql= "delete from data_info_1 where machine_num = 'M20'";
				$result_set = mysqli_query($conn, $sql);
				

				
			}
			if($M_mode_result->machine_status == 8 ){
				echo "보수 중...";
				include_once('gas_error1.php');
				error_insert('M20',$SO2_code,$SO2,$SO2_Name);
				error_insert('M20',$TSP_code,$TSP,$TSP_Name);
				error_insert('M20',$NOX_code,$NOX,$NOX_Name);
				error_insert('M20',$HCL_code,$HCL,$HCL_Name);
			}
			if($M_mode_result->machine_status == 1 ){
				echo "교정 중...";
				include_once('gas_error1.php');
				error_insert('M20',$SO2_code,$SO2,$SO2_Name);
				error_insert('M20',$TSP_code,$TSP,$TSP_Name);
				error_insert('M20',$NOX_code,$NOX,$NOX_Name);
				error_insert('M20',$HCL_code,$HCL,$HCL_Name);
			}
			if($M_mode_result->machine_status == 2 ){
				echo "동작 불량";
				include_once('gas_error1.php');
				error_insert('M20',$SO2_code,$SO2,$SO2_Name);
				error_insert('M20',$TSP_code,$TSP,$TSP_Name);
				error_insert('M20',$NOX_code,$NOX,$NOX_Name);
				error_insert('M20',$HCL_code,$HCL,$HCL_Name);
			}

			if($M_mode_result->machine_status == 0){
				
				echo "<br/>";
				echo "자료 측정 시작...\n";
			
				$TSP = file_get_html('http://192.168.1.99/TSP.txt'.DL_S($var = 0)) or die ("DL 비정상 혹은 꺼짐".DL_S(4));
				echo "<br/>";
				//echo $var;
				DL_S($var);

				$DL_S = "SELECT * from DCD;";
				$DL_S_value = mysqli_query($conn, $DL_S);
				$DL_S_row_value = mysqli_fetch_array($DL_S_value);
				// DL 상태 출력
 
				if($DL_S_row_value['DL_status'] == 0){
						include('test_json.php');
						TSP('M20',$SO2_code,$SO2,$SO2_Name);
					 TSP('M20',$TSP_code,$TSP,$TSP_Name);
						 TSP('M20',$NOX_code,$NOX,$NOX_Name);
						 TSP('M20',$HCL_code,$HCL,$HCL_Name);
						
								
				}
			}

			break;

		default:
		break;
	}

?>