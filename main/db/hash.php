<?php 
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


	$password = "gnlehdvskim1!";
 	$password_hash = hash("sha256", $password);
   	echo "해싱 전 : ".$password."<br/>"; 
   	echo "해싱 후 : ".$password_hash."<br/>";
    echo "해싱 후 (대문자) : ".strtoupper($password_hash)."<br/>";


function insert($M_num, $gas, $gas_name){
include('DBMGR.php');
$templeture = 0;
$time = "0000000";
    	$insert1 = "INSERT into data_info_1 values ('".$M_num."','".$time."','".$gas."','".$gas_name."',".round(($gas->plaintext * (273+ $templeture)/273),3).",'mg',0,0,0,0,0,0,0,0,0,0,'".$time."','0')";

  	 if ($conn->query($insert1) ==  TRUE) {
	// echo "<br/>";
    echo "New data_info insert111";	
  	 }
}
    	
    	insert('M20',$TSP,$TSP_Name);
     ?>

