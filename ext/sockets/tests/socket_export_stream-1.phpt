--TEST--
socket_export_stream: Basic test
--EXTENSIONS--
sockets
--FILE--
<?php

$domain = PHP_OS_FAMILY == 'Windows' ? AF_INET : AF_UNIX;
socket_create_pair($domain, SOCK_STREAM, 0, $s);

$s0 = reset($s);
$s1 = next($s);

$stream = socket_export_stream($s0);
var_dump($stream);

socket_write($s1, "test message");
socket_close($s1);

var_dump(stream_get_contents($stream));
?>
--EXPECTF--
resource(%d) of type (stream)
string(12) "test message"
