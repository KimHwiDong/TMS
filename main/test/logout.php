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
        session_destroy();
        header("Location: ./login.php");
      } else {
        echo '<h1>로그인 상태가 아닙니다.</h1>';
      }
    ?>
  </body>
</html>