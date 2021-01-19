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
		echo "DB Connect";
	}
	$sql1 = "SELECT * FROM manage";

	$result_set1 = mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_array($result_set1);

	echo "<br/>";
	print_r($row1);

	echo "<br/>";
	echo $row1['id'];
	echo "<br/>";
	echo "현재 일시 : ". date("Y-m-d H:i:s")."<br/>";
	
	

	function live_insert_data(){
		// 신호가 끊어 졌을 때 미싱 카운트 생성
			$templeture = 27; // 실측 온도

			echo "<br/>";
	echo round((rand(1,5) * (273+ $templeture)/273),3);

	global $F_count;
	$F_count = 0;
	$time = date("Y-m-d-H-i-s");	
	$now = date("Y_m_d");
	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

		$sql1 = "CREATE TABLE live_".$now."(
machine_num char(4),
measure_date char(25),
data_code char(3),
data_name char(3),
data_value double(7,2),
data_range char(3),
zerogas int(4),
zerogas_order int(6),
spangas int(4),
spangas_order int(6),
Ox2 int(2),
pw int(12),
coress_area float(6),
density float(4),
P float(4),
wet float(4),
sys char(25),
control char(1));";


	

		if (mysqli_query($conn,$sql1))
  	{
	  echo "Database my_db created successfully";
  	}
	else
  	{
  	echo "Error creating database: " . mysqli_error($conn);
  	}

  	//테스트용으로 데이터 넣어 보기
  	$insert1 = "INSERT into live_".$now." values ('M20','".$time."','TSP','먼지',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  		 if ($conn->query($insert1) ==  TRUE) {
	echo "<br/>";
    echo "New live insert";
   

} 
else {
    echo "Error: " . $insert1 . "<br>" . $conn->error;
}	
	$insert2 = "INSERT into data_info_1 values ('M20','".$time."','TSP','먼지',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  		 if ($conn->query($insert2) ==  TRUE) {
	echo "<br/>";
    echo "New data_info insert111";
   
    $value_over = "SELECT data_value from data_info_1 order by measure_date desc limit 1;";
	$result_value = mysqli_query($conn,$value_over);
	$row_value=mysqli_fetch_array($result_value);
	echo "<br/>";
	echo $row_value['data_value'];

	if($row_value['data_value'] >= 5){
		
		
		echo "<br/>";
		echo "카카오톡 문자 전송";
		// include_once('SendFTS_one.php');


	}

} else {
    echo "Error: " . $insert2 . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_SO2 = "INSERT into data_info_2 values ('M20','".$time."','SO2','아황산',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
	 if ($conn->query($insert_SO2) ==  TRUE) {
	echo "<br/>";
    echo "New SO2 data_info insert";
  

} else {
    echo "Error: " . $insert_SO2 . "<br>" . $conn->error;
    $F_count += 1;
}	


$insert_NOX = "INSERT into data_info_3 values ('M20','".$time."','NOX','질소산',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_NOX) ==  TRUE) {
	echo "<br/>";
    echo "New NOX data_info insert";
  

} else {
    echo "Error: " . $insert_NOX . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_HCL = "INSERT into data_info_4 values ('M20','".$time."','HCL','염화수',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_HCL) ==  TRUE) {
	echo "<br/>";
    echo "New HCL data_info insert";
  

} else {
    echo "Error: " . $insert_HCL . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_HFB = "INSERT into data_info_5 values ('M20','".$time."','HFB','불화수',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_HFB) ==  TRUE) {
	echo "<br/>";
    echo "New HFB data_info insert";
  

} else {
    echo "Error: " . $insert_HFB . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_NH3 = "INSERT into data_info_6 values ('M20','".$time."','NH3','암모니',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_NH3) ==  TRUE) {
	echo "<br/>";
    echo "New NH3 data_info insert";
  

} else {
    echo "Error: " . $insert_NH3 . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_COb = "INSERT into data_info_7 values ('M20','".$time."','COb','일산화',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_COb) ==  TRUE) {
	echo "<br/>";
    echo "New COb data_info insert";
  

} else {
    echo "Error: " . $insert_COb . "<br>" . $conn->error;
    $F_count += 1;
}	

$insert_O2b = "INSERT into data_info_8 values ('M20','".$time."','O2b','산소',".round((rand(1,5) * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

		
				 if ($conn->query($insert_O2b) ==  TRUE) {
	echo "<br/>";
    echo "New O2b data_info insert";
  

} else {
    echo "Error: " . $insert_O2b . "<br>" . $conn->error;
    $F_count += 1;
}	





echo "<br/>";

	

	}
	
	live_insert_data();
	echo "<br/>";
	echo "미싱 밸류값 : ";
	echo $F_count;
	echo "<br/>";
?>