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
<title>가스 현황 페이지</title>
</head>
<body>
  <nav class="navbar navbar-default">
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a class="navbar-brand" href="view.php">실시간 가스 현황</a></li>
				<li><a class="navbar-brand" href="view5.php">5분 가스 현황</a></li>
        <li class="active"><a class="navbar-brand" href="view30.php">30분 가스 현황</a></li>
        <li><a class="navbar-brand" href="log.php">이벤트 로그</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="../logout.php">로그아웃</a>
				</li>
			</ul>
    </div>
	</nav>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.js"></script>

  <script type="text/javascript">
    setInterval(() => {
      fetch('./30min/30min.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c1').css('height', status * 10 + '%');
          document.getElementById("c1").title = status * 10 + '%';
          $("#c1").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min2.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c2').css('height', status * 10 + '%');
          document.getElementById("c2").title = status * 10 + '%';
          $("#c2").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min3.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c3').css('height', status * 10 + '%');
          document.getElementById("c3").title = status * 10 + '%';
          $("#c3").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min4.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c4').css('height', status * 10 + '%');
          document.getElementById("c4").title = status * 10 + '%';
          $("#c4").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min5.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c5').css('height', status * 10 + '%');
          document.getElementById("c5").title = status * 10 + '%';
          $("#c5").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min6.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c6').css('height', status * 10 + '%');
          document.getElementById("c6").title = status * 10 + '%';
          $("#c6").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min7.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c7').css('height', status * 10 + '%');
          document.getElementById("c7").title = status * 10 + '%';
          $("#c7").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./30min/30min8.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#c8').css('height', status * 10 + '%');
          document.getElementById("c8").title = status * 10 + '%';
          $("#c8").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

  </script>
  
  <br>
  <h1>30분 가스 현황</h1>
  <div id="bar-chart">
    <div class="graph">
      <ul class="x-axis">
        <li><span>먼지</span></li>
        <li><span>아황산</span></li>
        <li><span>질소산</span></li>
        <li><span>염화수</span></li>
        <li><span>불화수</span></li>
        <li><span>암모니</span></li>
        <li><span>일산화</span></li>
        <li><span>산소</span></li>
      </ul>
      <ul class="y-axis">
        <li><span>100%</span></li>
        <li><span>75%</span></li>
        <li><span>50%</span></li>
        <li><span>25%</span></li>
        <li><span>0%</span></li>
      </ul>
      <div class="bars">
        <div class="bar-group">

          <div id="c1" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c2" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c3" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c4" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c5" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c6" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c7" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="c8" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

      </div>

    </div>
  </div>
</body>
</html>