<!DOCTYPE html>
<html>
<head>
   <title>클라이언트 체팅 테스트</title>
</head>
<body>
      <div align="center">
         <form method="POST">
            <table>
               <tr>
               <td><label>Enter Message</label>
                  <input type="text" name="txtMessage">
                  <input type="submit" name="btnSend">
               </td>
               </tr>
               <?php
                  $host = "127.0.0.1";
                  $port = "12348";

                  if(isset($_POST['btnSend'])){
                     $msg = $_REQUEST['txtMessage'];
                     $sock  = socket_create(AF_INET, SOCK_STREAM, 0);
                     socket_connect($sock, $host, $port);

                     socket_write($sock, $msg, strlen($msg));

                     $reply = socket_read($sock, 1924);
                     $reply = trim($reply);
                     $reply = "Server say:\t".$reply;
                  }
               ?>
               <tr>
                  <td>
                     <textarea rows="10" col = "50"><?php echo @$reply; ?></textarea>
                  </td>
               </tr>
            </table>
         </form>
      </div>
</body>
</html>