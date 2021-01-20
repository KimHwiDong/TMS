<?php
	date_default_timezone_set('Asia/Seoul');
	include_once('dbcon.php');

	$host = "127.0.0.1";
	$port = 12349;
	set_time_limit(0);

	  $sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
   $result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");

   $result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
   echo "Listening for connections";

   class chat{
      function readLine()
      {
         return rtrim(fgets(STDIN));
      }
   }

   do
   {
      $accept = socket_accept($sock) or die ("could not accept incoming connections");
      $msg = socket_read($accept, 1024) or die ("could not read input\n");


      $msg = trim($msg);
      echo "Client says:  \t ".date("Y-m-d H:i:s`").$msg."\n\n";
      if($msg == "DMPF"){
      	echo "DM05\n";
      	$sql = "select * from 5avg_data_info order by measure_date_end desc limit 1;";
		$result_value = mysqli_query($conn,$sql);
		$row_value = mysqli_fetch_array($result_value);
		echo $row_value['data_value'];
		$TSP_V = $row_value['data_value'];
		//측정 일시
		$date = $row_value['measure_date_end'];
		//지역코드
		$sql2 = "SELECT * from store";
		$result_value = mysqli_query($conn,$sql2);
		$row_value = mysqli_fetch_array($result_value);
		$areacode = $row_value['area_code'];
		$store_num = $row_value['store_num'];
		$smoketast_num = $row_value['smoketast_num'];

		//LT2 상태 
		$sql3 = "SELECT * from measure_machine;";
		$result_value = mysqli_query($conn,$sql3);
		$row_value = mysqli_fetch_array($result_value);
		$LT2st = $row_value['machine_status'];



		$msg2 = "02RM05".$areacode.$store_num.$smoketast_num.$LT2st."01".$date."TSP".$TSP_V."003";  //
         socket_write($accept, $msg2,strlen($msg2)) or die("Could noe wirte output2");

      }

      if($msg == "DMPH"){
         echo "DM30\n";
        	$sql = "select * from 30avg_data_info order by measure_date_end desc limit 1;";
		$result_value = mysqli_query($conn,$sql);
		$row_value = mysqli_fetch_array($result_value);
		echo $row_value['data_value'];
		$TSP_V = $row_value['data_value'];
		//측정 일시
		$date = $row_value['measure_date_end'];
		//지역코드
		$sql2 = "SELECT * from store";
		$result_value = mysqli_query($conn,$sql2);
		$row_value = mysqli_fetch_array($result_value);
		$areacode = $row_value['area_code'];
		$store_num = $row_value['store_num'];
		$smoketast_num = $row_value['smoketast_num'];

		//LT2 상태 
		$sql3 = "SELECT * from measure_machine;";
		$result_value = mysqli_query($conn,$sql3);
		$row_value = mysqli_fetch_array($result_value);
		$LT2st = $row_value['machine_status'];



		$msg2 = "02RM30".$areacode.$store_num.$smoketast_num.$LT2st."01".$date."TSP".$TSP_V."003";  //
         socket_write($accept, $msg2,strlen($msg2)) or die("Could noe wirte output2");

          
      }

      if($msg == "CVER"){//기기 버젼 확인
      	$sql = "SELECT * from measure_machine";
      	$result_value = mysqli_query($conn, $sql);
      		while($row_value = mysqli_fetch_row($result_value)){
      		$msg2 =  $row_value[1];
      	
      		socket_write($accept,  $msg2, strlen($msg2)) or die ("could not write machine info");
      		
      			}
      				print "DVER"."\n";
      		//socket_write($accept, $msg2, strlen($msg2)) or die ("could not write machine info");
      }


      	if($msg == 'SETP'){
      		$msg1 = "기기번호를 입력하세요 : ";
      		socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
      		
      			while (true) {
      				# code...
	      			$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
	   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
	   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
	     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
	      			$msg3 = socket_read($accept, 1024) or die ("could not read input12\n");
	      			$msg3 = trim($msg3);

	      			$sql = "SELECT * from measure_machine where machine_num ='".$msg3."';";
	 				$result_value = mysqli_query($conn,$sql);
	 				$row_value = mysqli_fetch_array($result_value);
					$M_num = $row_value['machine_num'];

					if($msg3 == $M_num){
					$msg1 = $M_num."의 현제 비밀 번호를 누르세요";
	      			socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");

					$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
	   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
	   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
	     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
	      			$msg2 = socket_read($accept, 1024) or die ("could not read input12\n");
	      			$msg2 = trim($msg2);

	      			$password = $msg2;
 					$password_hash = hash("sha256", $password);

	      				if($row_value['pass'] == $password_hash){
	      					$msg1 = "바꿀 비빌번호를 누르세요";
	      					echo $msg1;
							socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");

								$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
				   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
				   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
				     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
				      			$msg2 = socket_read($accept, 1024) or die ("could not read input123\n");
				      			$msg2 = trim($msg2);

				      			$password = $msg2;
			 					$password_hash = hash("sha256", $password);


				      			$sql = "UPDATE measure_machine set pass = '".$password_hash."' where machine_num = '".$msg3."'; ";
				      			echo $sql;
				      			$result_value = mysqli_query($conn,$sql);
								//$row_value = mysqli_fetch_array($result_value);

				      			$msg1 = "비밀 번호가 정상적으로 바뀜";
				      			echo $msg1;
								socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");				      			
	      				}else{
	      					$msg1 = "비밀번호가 비 일치";
	      					echo $msg1;
							socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
	      				}
					}else{
						$msg1 = "없는 기기 번호 입니다";
						echo $msg1;
						socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
					}
	      			break;
	      			}
	      			//break;
      		}

      	if($msg == 'CCHK'){
      		$sql = "SELECT * from data_info_1 order by measure_date desc limit 1";
      		$result_value = mysqli_query($conn,$sql);
			$row_value = mysqli_fetch_array($result_value);

			$span = $row_value['spangas'];
			$zero = $row_value['zerogas'];
			$P = $row_value['P'];
			$msg1 = "zerp : ".$zero." span : ".$span." 피토우 계수".$P."\n";
			socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");

			echo "CNST\n";
      	}

      	if($msg == "DMPL"){
      		$msg1 = "검색할 측정 데이터 코드를 입력하세요\n";
      		socket_write($accept, $msg1, strlen($msg1)) or die ("counld not send message1");

      		$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
			$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
			$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
			$accept = socket_accept($sock) or die ("could not accept incoming connections\n");
			$msg2 = socket_read($accept, 1024) or die ("could not read input12\n");
			$msg2 = trim($msg2);

		 	switch ($msg2) {
		 		case 'TSP':
		 			# code...
		 			break;
		 		
		 		default:
		 			# code...
		 			break;
		 	}
      	}

      		if($msg == 'REST'){
      		$msg1 = "제반 상태를 바꿀 기기번호를 입력하세요 : ";
      		socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
      		
      			while (true) {
      				# code...
	      			$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
	   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
	   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
	     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
	      			$msg3 = socket_read($accept, 1024) or die ("could not read input1\n");
	      			$msg3 = trim($msg3);

	      			$sql = "SELECT * from measure_machine where machine_num ='".$msg3."';";
	 				$result_value = mysqli_query($conn,$sql);
	 				$row_value = mysqli_fetch_array($result_value);
					$M_num = $row_value['machine_num'];

					if($msg3 == $M_num){
					$msg1 = $M_num."의 비밀 번호를 눌러 주세요";
	      			socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");

					$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
	   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
	   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
	     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
	      			$msg2 = socket_read($accept, 1024) or die ("could not read input1\n");
	      			$msg2 = trim($msg2);

	      			$password = $msg2;
 					$password_hash = hash("sha256", $password);

	      				if($row_value['pass'] == $password_hash){
	      					$msg1 = $M_num."의 어떤 상태로 바꿀건가요? \n 2: 자료 채취 모드 \n 1: 자료 측정 모드";
	      					echo $msg1;
							socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");

								$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
				   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
				   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
				     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
				      			$msg2 = socket_read($accept, 3) or die ("could not read input1234\n");
				      			$msg2 = trim($msg2);

				      			echo "\nmsg2 :".$msg2."\n";

				      			if($msg2 != 1 && $msg2 != 2 && $msg2 = ' '){
				      				echo "다시 입력";
				      				$msg5 = "다시 확인 하고 입력 해 주세요";
				      				socket_write($accept, $msg5, strlen($msg5)) or die ("could not write machine_num");		
				      				break;
				      			}
				      			$M_status = $msg2;
			 					//$password_hash = hash("sha256", $password);



				      			$sql = "UPDATE measure_machine set measure_mode = '".$M_status."' where machine_num = '".$msg3."'; ";
				      			echo $sql;
				      			$result_value = mysqli_query($conn,$sql);
								//$row_value = mysqli_fetch_array($result_value);

				      			$msg1 = "기기 재반 상태가 정상적으로 바뀜\n";
				      			echo $msg1;
								socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");				      			
	      				}else{
	      					$msg1 = "비밀번호가 비 일치\n";
	      					echo $msg1;
							socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
	      				}
					}else{
						$msg1 = "없는 기기 번호 입니다\n";
						echo $msg1;
						socket_write($accept, $msg1, strlen($msg1)) or die ("could not write machine_num");
					}
	      			//break;
	      			}
	      			//break;
      		}
      }while (true);
      # code...
      socket_close($accept, $sock);
?>