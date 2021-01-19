  <?php

     $servername = "localhost";
    $username = "root";
    $password = "gnlehdvskim1!";
    $dbname = "konanservice";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $now = date("Y_m_d");
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } else if($conn){
      
    }

     $result1 = mysqli_query($conn, "SELECT * from 5avg_data_info order by measure_date_end desc limit 5");
         echo "<div style= 'border';>";
    echo "<table class='type02'>
     <th>기기번호 </th><th>측정 시작 시간 </th><th>측정 끝난 시간 </th><th>데이터 코드 </th><th>데이터 이름 </th><th>측정 값 </th><th>데이터 단위</th>
             <th>제로가스 </th> <th>제로가스 오더 </th> <th>스판가스 </th> <th>스판가스 오더 </th><th>산소 </th> <th>암호 </th>
             <th>단면적 </th><th>밀도 </th><th>피토우 계수 </th> <th>수분 </th><th>동기화 일시 </th><th>보정 설정 </th> ";

             $n = 1;
        while($row = mysqli_fetch_array($result1)){
         echo "<tr>";
            echo "<td>".$row['machine_num']."</td>";
            echo "<td>".$row['measure_date_start']."</td>";
            echo "<td>".$row['measure_date_end']."</td>";
            echo "<td>".$row['data_code']."</td>";
            echo "<td>".$row['data_name']."</td>";
            echo "<td>".$row['data_value']."</td>";
            echo "<td>".$row['data_range']."</td>";
            echo "<td>".$row['zerogas']."</td>";
            echo "<td>".$row['zerogas_order']."</td>";
            echo "<td>".$row['spangas']."</td>";
            echo "<td>".$row['spangas_order']."</td>";
            echo "<td>".$row['Ox2']."</td>";
            echo "<td>".$row['pw']."</td>";
            echo "<td>".$row['coress_area']."</td>";
            echo "<td>".$row['density']."</td>";
            echo "<td>".$row['P']."</td>";
            echo "<td>".$row['wet']."</td>";
            echo "<td>".$row['sys']."</td>";
            echo "<td>".$row['control']."</td>";
            echo "</tr>";
        $n++;
    }


            echo "</table>";
            echo "</div>";
      
   ?>
   