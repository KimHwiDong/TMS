<?php
	date_default_timezone_set('Asia/Seoul');

	$servername = "localhost";
	$username = "root";
	$password = "gnlehdvskim1!";
	$dbname = "konanservice";
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} else if($conn){
		echo "DB Connect11";
	}
	$sql1 = "SELECT * FROM manage";

	$result_set1 = mysqli_query($conn,$sql1);

	$row1=mysqli_fetch_array($result_set1);

	echo "<br/>";
	print_r($row1);

	echo "<br/>";
	echo $row1['id'];
	echo "<br/>";
	echo "현재 일시1 : ". date("Y-m-d H:i:s")."<br/>";
	
	function live_insert_data(){
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
data_value char(7),
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
sys char(12),
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
  	$insert1 = "INSERT into live_".$now." values ('M20','".$time."','1','1','1','1',2,1,1,1,1,1,1,1,1,1,'1','1')";

  		 if ($conn->query($insert1) ==  TRUE) {
	echo "<br/>";
    echo "New live insert";
   

} else {
    echo "Error: " . $insert1 . "<br>" . $conn->error;
}	
	$insert2 = "INSERT into data_info_1 values ('M20','".$time."','1','1','1','1',1,2,1,1,1,1,1,1,1,1,'1','1')";

  		 if ($conn->query($insert2) ==  TRUE) {
	echo "<br/>";
    echo "New data_info insert";
  

} else {
    echo "Error: " . $insert2 . "<br>" . $conn->error;
}	
echo "<br/>";
echo $i;


	}
	
	live_insert_data();
?>