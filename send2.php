<?php

require_once('./vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
 
$lines = trim(fgets(STDIN));
$connection = new AMQPStreamConnection('10.90.242.122', 10001, 'guest', 'guest');
$channel = $connection->channel();
 
$channel->queue_declare('mensajes', false, false, false, false);
 
$msg = new AMQPMessage($lines);
$channel->basic_publish($msg, '', 'mensajes');
 
echo "termino\n";