<?php
	//먼저 지역코드 사업장 코드 배출구 번호 DCD 측정 항목수 측정 일시 측정 항목수 측정 일시 측정 항목 측정기 상태 D/L상태 보정여부 측정 자료1(데이터 값인거 같다) 보안코드 ETX CHK CR
	
	///5분 자료 생성 시 보내는 함수

function Send_5avg($store,$M_num){
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

		//배출 업소 코드 가져오는 곳
		$store_sql = "SELECT area_code, store_num, smoketast_num, DCD, safety_code from store where store_num = '".$store."' ;";
		$result_set1 = mysqli_query($conn, $store_sql);
		$row1 = mysqli_fetch_array($result_set1);

		//측정 항목 수
		$count_sql = "SELECT count(distinct(data_code)) from 5avg_data_info where machine_num = '".$M_num."';";
		$count_set = mysqli_query($conn, $count_sql);
		while ( $count_row = mysqli_fetch_array($count_set)) {
			# code...
			$Count = $count_row['count(distinct(data_code))'];
		}

		//측정 일시 가져 오기
		$Time_sql = "SELECT measure_date_end from 5avg_data_info where machine_num = '".$M_num."' order by measure_date_end desc;";
		$Time_set = mysqli_query($conn, $Time_sql);
		while ( $Time_row = mysqli_fetch_array($Time_set)) {
			# code...
			$Time = $Time_row['measure_date_end'];
		}


		//가스 종료 가져 오기
		$gas_count = "SELECT count(distinct(data_code)) from 5avg_data_info where machine_num = '".$M_num."';";
		$result_set2 = mysqli_query($conn, $gas_count);
		$row2 = mysqli_fetch_array($result_set2);
		$count = $row2['count(distinct(data_code))'];

		$sql1 = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 5avg_data_info A, 5avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit 0,1;";
		$sql1_set =  mysqli_query($conn, $sql1);
		$sql1_row =  mysqli_fetch_array($sql1_set);

		$sql2 = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 5avg_data_info A, 5avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit 1,1;";
		$sql2_set =  mysqli_query($conn, $sql2);
		$sql2_row =  mysqli_fetch_array($sql2_set);
		//1번쨰 2번쨰 가스 타입이 같으면 검색 하지 않게 하는 코드 문입니다
		if($sql1_row['data_code'] == $sql2_row['data_code']){
			$count = 1;
		}
		echo $count;


		for ($i=0; $i < $count; $i++) { 
			# code...
			$sql = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 5avg_data_info A, 5avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit ".$i.",1;";
			$result_set = mysqli_query($conn, $sql);
			
				while ($row = mysqli_fetch_assoc($result_set)){
				$MMM = "";
     			  $MMM .= $row['data_code'].$row['data_value'].$row['STATUS'].$row['control'];

   }
		}
				echo "<br/>";
				echo $MMM;
				$host = "127.0.0.1";
                  $port = "12348";
                  	$msg1 = $row1['area_code'].$row1['store_num'].$row1['smoketast_num'].$row1['DCD'].$Count.$Time.$MMM;
					echo "<br/>";
					echo $msg1;
					$len = strlen($msg1);
					echo "길이 : ".$len;
					$a = ' ';
					for($i =0; $i< $len; $i ++ ){
					 	$a = chr(ord($msg1) + $i);
					}
					echo $a;
					$msg2 = "02RM05".$msg1."03".$a."0D";
                    $sock  = socket_create(AF_INET, SOCK_STREAM, 0);
                    socket_connect($sock, $host, $port);

                    socket_write($sock, $msg2, strlen($msg2));
    }     
    
    function Send_30avg($store,$M_num){
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

		//배출 업소 코드 가져오는 곳
		$store_sql = "SELECT area_code, store_num, smoketast_num, DCD, safety_code from store where store_num = '".$store."' ;";
		$result_set1 = mysqli_query($conn, $store_sql);
		$row1 = mysqli_fetch_array($result_set1);

		//측정 항목 수
		$count_sql = "SELECT count(distinct(data_code)) from 30avg_data_info where machine_num = '".$M_num."';";
		$count_set = mysqli_query($conn, $count_sql);
		while ( $count_row = mysqli_fetch_array($count_set)) {
			# code...
			$Count = $count_row['count(distinct(data_code))'];
		}

		//측정 일시 가져 오기
		$Time_sql = "SELECT measure_date_end from 30avg_data_info where machine_num = '".$M_num."' order by measure_date_end desc;";
		$Time_set = mysqli_query($conn, $Time_sql);
		while ( $Time_row = mysqli_fetch_array($Time_set)) {
			# code...
			$Time = $Time_row['measure_date_end'];
		}


		//가스 종료 가져 오기
		$gas_count = "SELECT count(distinct(data_code)) from 30avg_data_info where machine_num = '".$M_num."';";
		$result_set2 = mysqli_query($conn, $gas_count);
		$row2 = mysqli_fetch_array($result_set2);
		$count = $row2['count(distinct(data_code))'];

		$sql1 = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 30avg_data_info A, 30avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit 0,1;";
		$sql1_set =  mysqli_query($conn, $sql1);
		$sql1_row =  mysqli_fetch_array($sql1_set);

		$sql2 = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 30avg_data_info A, 30avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit 1,1;";
		$sql2_set =  mysqli_query($conn, $sql2);
		$sql2_row =  mysqli_fetch_array($sql2_set);
		//1번쨰 2번쨰 가스 타입이 같으면 검색 하지 않게 하는 코드 문입니다
		if($sql1_row['data_code'] == $sql2_row['data_code']){
			$count = 1;
		}


		for ($i=0; $i < $count; $i++) { 
			# code...
			$sql = "SELECT distinct(A.data_code), A.data_name, A.data_value,A.control, A.STATUS from 30avg_data_info A, 30avg_data_info B where A.machine_num = '".$M_num."' and A.measure_date_end = B.measure_date_end order by A.measure_date_end desc limit ".$i.",1;";
			$result_set = mysqli_query($conn, $sql);
			
				while ($row = mysqli_fetch_assoc($result_set)){
				$MMM = "";
     			  $MMM .= $row['data_code'].$row['data_value'].$row['STATUS'].$row['control'];

   }
		}
				echo "<br/>";
				echo $MMM;
				$host = "127.0.0.1";
                  $port = "12348";
                  	$msg1 = $row1['area_code'].$row1['store_num'].$row1['smoketast_num'].$row1['DCD'].$Count.$Time.$MMM;
					echo "<br/>";
					echo $msg1;
					$len = strlen($msg1);
					echo "길이 : ".$len;
					$a = ' ';
					for($i =0; $i< $len; $i ++ ){
					 	$a = chr(ord($msg1) + $i);
					}
					echo $a;
					$msg2 = "02RM30".$msg1."03".$a."0D";
                    $sock  = socket_create(AF_INET, SOCK_STREAM, 0);
                    socket_connect($sock, $host, $port);

                    socket_write($sock, $msg2, strlen($msg2));
    }
    	 Send_5avg('1234','M20');
?>