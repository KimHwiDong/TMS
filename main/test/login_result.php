<?php 
  include 'inc_head.php';
?>
<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>PHP</title>
  </head>
  <body>
    <?php
        if ( $jb_login ) {
        echo '<h1>이미 로그인하셨습니다.</h1>';
        
      } else {
        $username = $_POST[ 'username' ];
        $password = $_POST[ 'password' ];
        if ( $username == 'konan' and $password == '1234' ) {
          $_SESSION[ 'username' ] = $username;
          header("Location: ./php/view.php");
        } else {
          $username = $_POST[ 'username' ];
          $password = $_POST[ 'password' ];
          if ( $username == 'admin' and $password == '1234' ) {
            $_SESSION[ 'username' ] = $username;
            header("Location: ./php/view.php");
        }
          echo '<p>사용자 이름 또는 비밀번호가 틀렸습니다.</p>';
        }
      }
    ?>
  </body>
</html>