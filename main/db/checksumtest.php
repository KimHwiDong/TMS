<?php
define('SOH', chr(0x01));

$message = '8=FIX.4.2|9=42|35=0|49=A|56=B|34=12|52=20100304-07:59:30|';
$message = str_replace('|', SOH, $message);
echo $message, '10=', GenerateCheckSum($message, strlen($message)), SOH;

function GenerateCheckSum($buf, $bufLen )
{
      for( $idx=0, $cks=0; $idx < $bufLen; $cks += ord($buf[ $idx++ ]) );
      return sprintf( "%03d", $cks % 256);
}
?>