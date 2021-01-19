<?PHP
  $address = gethostbyname('127.0.0.1');
  $service_port = 5091;

  if(($sock = socket_create(AF_INET, SOCK_STREAM, 0)) < 0)
    echo "socket_create() failed: reason: " . socket_strerror($sock) . "<br>";
  if(($result = socket_connect($socket, $address, $service_port)) == false)
     echo "socket_connect() failed: reason: " . socket_strerror($result) . "<br>";

  $in = "Apple Orange Banana Pear "; 
  $out = "";
  socket_write($sock, $in, strlen($in));
  echo "Send data : $in <br>";

  $out = socket_read($sock, 2048);
  echo "Receive data : $out <br>";
  socket_close($sock);
?>
