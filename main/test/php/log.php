<?php 
  include '../inc_head.php';
  if ( $jb_login ) {
  } else {
    header("Location: ../login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<mata name="viewport" content="width=device-width", initial-scale="1">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="./style.css">
<title>이벤트 로그</title>
<style>
      body {
        font-family: 12px;
      }
      table {
        width: 100%;
      }
      th, td {
        text-align: left;
        padding: 3px;
        border-bottom: 1px solid #dadada;
      }
    </style>
</head>
<body>
  <nav class="navbar navbar-default">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a class="navbar-brand" href="view.php">실시간 가스 현황</a></li>
				<li><a class="navbar-brand" href="view5.php">5분 가스 현황</a></li>
        <li><a class="navbar-brand" href="view30.php">30분 가스 현황</a></li>
        <li class="active"><a class="navbar-brand" href="log.php">이벤트 로그</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="../logout.php">로그아웃</a>
				</li>
			</ul>
    </div>
  </nav>
  <table>
      <thead>
        <tr>
          <th>아이디</th>
          <th>먼지</th>
          <th>아황산</th>
          <th>질소산</th>
          <th>염화수</th>
          <th>불화수</th>
          <th>암모니</th>
          <th>일산화</th>
          <th>산소</th>

        </tr>
      </thead>
      <tbody>
        <?php
          $jb_conn = mysqli_connect( 'localhost', 'root', 'gnlehdvskim1!', 'konanservice' );
          $jb_sql = "SELECT * FROM logs ORDER BY Time DESC LIMIT 50;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            echo 
            '<tr>
                <td>' . $jb_row[ 'ID' ] . '</td>
                <td>' . $jb_row[ '먼지' ] . '</td>
                <td>' . $jb_row[ '아황산' ] . '</td>
                <td>' . $jb_row[ '질소산' ] . '</td>
                <td>' . $jb_row[ '염화수' ] . '</td>
                <td>' . $jb_row[ '불화수' ] . '</td>
                <td>' . $jb_row[ '암모니' ] . '</td>
                <td>' . $jb_row[ '일산화' ] . '</td>
                <td>' . $jb_row[ '산소' ] . '</td>
            </tr>';
          }
        ?>
      </tbody>
    </table>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.js"></script>
  <script type="text/javascript">
</body>
</html>