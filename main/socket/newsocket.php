<?php
	

		$sock = socket_create(AF_INET,SOCK_STREAM, 0) or die ("could not create socket\n");
	   				$result = socket_bind($sock, $host, $port) or die ("could not bind to socket \n");
	   				$result = socket_listen($sock, 3) or die ("could not set up socket listener\n");
	     			$accept = socket_accept($sock) or die ("could not accept incoming connections");
	      			$msg2 = socket_read($accept, 1024) or die ("could not read input12\n");
	      			$msg2 = trim($msg2);
?>