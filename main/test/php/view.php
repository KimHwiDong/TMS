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
				<li class="active"><a class="navbar-brand" href="view.jsp">실시간 가스 현황</a></li>
				<li><a class="navbar-brand" href="view5.php">5분 가스 현황</a></li>
        <li><a class="navbar-brand" href="view30.php">30분 가스 현황</a></li>
        <li><a class="navbar-brand" href="log.php">이벤트 로그</a></li>ㄴ
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
    function ack() {
      if (document.getElementById("a1").className == "bar stat-1 blink") {
        document.getElementById("a1").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack.php" // 접속 url
        })
      }
    }
    function ack2() {
      if (document.getElementById("a2").className == "bar stat-1 blink") {
        document.getElementById("a2").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack2.php" // 접속 url
        })
      }
    }

    function ack3() {
      if (document.getElementById("a3").className == "bar stat-1 blink") {
        document.getElementById("a3").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack3.php" // 접속 l
        })
      }
    }

    function ack4() {
      if (document.getElementById("a4").className == "bar stat-1 blink") {
        document.getElementById("a4").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack4.php" // 접속 url
        })
      }
    }

    function ack5() {
      if (document.getElementById("a5").className == "bar stat-1 blink") {
        document.getElementById("a5").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack5.php" // 접속 url
        })
      }
    }

    function ack6() {
      if (document.getElementById("a6").className == "bar stat-1 blink") {
        document.getElementById("a6").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack6.php" // 접속 url
        })
      }
    }

    function ack7() {
      if (document.getElementById("a7").className == "bar stat-1 blink") {
        document.getElementById("a7").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack7.php" // 접속 url
        })
      }
    }

    function ack8() {
      if (document.getElementById("a8").className == "bar stat-1 blink") {
        document.getElementById("a8").className = "bar stat-1 unblink";
        $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./ack/ack8.php" // 접속 url
        })
      }
    }

    setInterval(() => {
      fetch('./realtime/realtime.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a1').css('height', status * 10 + '%');
          document.getElementById("a1").title = status * 10 + '%';
          $("#a1").html((status * 10).toFixed(2) + '%');

        })
      });
      fetch('./sync/sync.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a1").className = "bar stat-1 unblink";
        })
      });
      var status1 = document.getElementById("a1").title;
      if (status1 >= "50%" && document.getElementById('a1').className == "bar stat-2") {
        document.getElementById("a1").className = "bar stat-1 blink";
      } 
      else {
        if (status1 < "50%" && document.getElementById('a1').className == "bar stat-1 unblink") {
          document.getElementById("a1").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return.php" // 접속 url
        })
        }
      }
    }, 1000);


    setInterval(() => {
      fetch('./realtime/realtime2.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a2').css('height', status * 10 + '%');
          document.getElementById("a2").title = status * 10 + '%';
          $("#a2").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync2.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a2").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a2").title;
      if (status >= "50%" && document.getElementById('a2').className == "bar stat-2") {
        document.getElementById("a2").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a2').className == "bar stat-1 unblink") {
          document.getElementById("a2").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return2.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime3.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a3').css('height', status * 10 + '%');
          document.getElementById("a3").title = status * 10 + '%';
          $("#a3").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync3.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a3").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a3").title;
      if (status >= "50%" && document.getElementById('a3').className == "bar stat-2") {
        document.getElementById("a3").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a3').className == "bar stat-1 unblink") {
          document.getElementById("a3").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return3.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime4.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a4').css('height', status * 10 + '%');
          document.getElementById("a4").title = status * 10 + '%';
          $("#a4").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync4.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a4").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a4").title;
      if (status >= "50%" && document.getElementById('a4').className == "bar stat-2") {
        document.getElementById("a4").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a4').className == "bar stat-1 unblink") {
          document.getElementById("a4").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return4.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime5.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a5').css('height', status * 10 + '%');
          document.getElementById("a5").title = status * 10 + '%';
          $("#a5").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync5.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a5").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a5").title;
      if (status >= "50%" && document.getElementById('a5').className == "bar stat-2") {
        document.getElementById("a5").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a5').className == "bar stat-1 unblink") {
          document.getElementById("a5").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return5.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime6.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a6').css('height', status * 10 + '%');
          document.getElementById("a6").title = status * 10 + '%';
          $("#a6").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync6.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a6").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a6").title;
      if (status >= "50%" && document.getElementById('a6').className == "bar stat-2") {
        document.getElementById("a6").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a6').className == "bar stat-1 unblink") {
          document.getElementById("a6").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return6.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime7.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a7').css('height', status * 10 + '%');
          document.getElementById("a7").title = status * 10 + '%';
          $("#a7").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync7.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a7").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a7").title;
      if (status >= "50%" && document.getElementById('a7').className == "bar stat-2") {
        document.getElementById("a7").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a7').className == "bar stat-1 unblink") {
          document.getElementById("a7").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return7.php" // 접속 url
        })
        }
      }
    }, 1000);

    setInterval(() => {
      fetch('./realtime/realtime8.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#a8').css('height', status * 10 + '%');
          document.getElementById("a8").title = status * 10 + '%';
          $("#a8").html((status * 10).toFixed(2) + '%');
        })
      });
      fetch('./sync/sync8.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          if(status == 1)
          document.getElementById("a8").className = "bar stat-1 unblink";
        })
      });
      var status = document.getElementById("a8").title;
      if (status >= "50%" && document.getElementById('a8').className == "bar stat-2") {
        document.getElementById("a8").className = "bar stat-1 blink";
      } else {
        if (status < "50%" && document.getElementById('a8').className == "bar stat-1 unblink") {
          document.getElementById("a8").className = "bar stat-2";
          $.ajax({
          type: "GET", // 요청 메소드 타입
          url: "./return/return8.php" // 접속 url
        })
        }
      }
    }, 1000);




    setInterval(() => {
      fetch('./5min/5min.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b1').css('height', status * 10 + '%');
          document.getElementById("b1").title = status * 10 + '%';
          $("#b1").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min2.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b2').css('height', status * 10 + '%');
          document.getElementById("b2").title = status * 10 + '%';
          $("#b2").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min3.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b3').css('height', status * 10 + '%');
          document.getElementById("b3").title = status * 10 + '%';
          $("#b3").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min4.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b4').css('height', status * 10 + '%');
          document.getElementById("b4").title = status * 10 + '%';
          $("#b4").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min5.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b5').css('height', status * 10 + '%');
          document.getElementById("b5").title = status * 10 + '%';
          $("#b5").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min5.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b5').css('height', status * 10 + '%');
          document.getElementById("b5").title = status * 10 + '%';
          $("#b5").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min6.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b6').css('height', status * 10 + '%');
          document.getElementById("b6").title = status * 10 + '%';
          $("#b6").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min7.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b7').css('height', status * 10 + '%');
          document.getElementById("b7").title = status * 10 + '%';
          $("#b7").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

    setInterval(() => {
      fetch('./5min/5min8.php').then(function (response) {
        response.text().then(function (text) {
          var status = text;
          $('#b8').css('height', status * 10 + '%');
          document.getElementById("b8").title = status * 10 + '%';
          $("#b8").html((status * 10).toFixed(2) + '%');
        })
      });
    }, 1000);

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
	<h1>실시간 가스 현황</h1>
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
          <div id="a1" class="bar stat-2" style="height: 0%; color: black;" onclick="ack();"></div>
        </div>
        <div class="bar-group">
          <div id="a2" class="bar stat-2" style="height: 0%; color: black;" onclick="ack2();"></div>
        </div>
        <div class="bar-group">
          <div id="a3" class="bar stat-2" style="height: 0%; color: black;" onclick="ack3();"></div>
        </div>
        <div class="bar-group">
          <div id="a4" class="bar stat-2" style="height: 0%; color: black;" onclick="ack4();"></div>
        </div>
        <div class="bar-group">
          <div id="a5" class="bar stat-2" style="height: 0%; color: black;" onclick="ack5();"></div>
        </div>
        <div class="bar-group">
          <div id="a6" class="bar stat-2" style="height: 0%; color: black;" onclick="ack6();"></div>
        </div>
        <div class="bar-group">
          <div id="a7" class="bar stat-2" style="height: 0%; color: black;" onclick="ack7();"></div>
        </div>
        <div class="bar-group">
          <div id="a8" class="bar stat-2" style="height: 0%; color: black;" onclick="ack8();"></div>
        </div>
      </div>
    </div>
  </div>

  <br>
  <h1>5분 가스 현황</h1>
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

          <div id="b1" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b2" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b3" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b4" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b5" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b6" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b7" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

        <div class="bar-group">
          <div id="b8" class="bar stat-2" style="height: 0%; color: black;"></div>
        </div>

      </div>

    </div>
  </div>

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