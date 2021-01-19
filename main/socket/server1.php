<?php

   $host = "127.0.0.1";
   $port = 20205;
   set_time_limit(0);

   $sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
   $result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");

   $result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
   echo "Listening for connections";

   class chat{
      function readLine()
      {
         return rtrim(fgets(STDIN));
      }
   }

   do
   {
      $accept = socket_accept($sock) or die ("could not accept incoming connections");
      $msg = socket_read($accept, 1024) or die ("could not read input\n");


      $msg = trim($msg);
      echo "Client says: \t ".$msg."\n\n";
      if($msg == "123"){
      	echo "5분자료 요청\n";
         $reply2 = "dust : 588";
         socket_write($accept, $reply2,strlen($reply2)) or die("Could noe wirte output2");

      }

      if($msg == "1234"){
         echo "30분자료 요청\n";
         $reply2 = "dust : 589";
         socket_write($accept, $reply2,strlen($reply2)) or die("Could noe wirte output2");
          
      }

      // $line = new chat();
      // echo "Enter Reply \t" ;
      // $reply = $line->readLine();

      // socket_write($accept, $reply, strlen($reply)) or die ("Could not write output\n");

   }while (true);
      # code...
      socket_close($accept, $sock);
   
?>