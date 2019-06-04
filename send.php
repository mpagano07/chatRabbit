<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('10.90.242.122', 10001, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('mensajes', false, false, false, false);

$msg = new AMQPMessage('el mio no anda');
$channel->basic_publish($msg, '', 'mensajes');

echo " [x]'\n";

$channel->close();
$connection->close();