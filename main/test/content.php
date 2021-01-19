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
        echo '<h1>안녕하세요.</h1>';
      } else {
        echo '<h1>로그인하세요.</h1>';
      }
    ?>
  </body>
</html>