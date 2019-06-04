<?php
 
require_once('./vendor/autoload.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
 
$connection = new AMQPStreamConnection('10.90.242.122', 10001, 'guest', 'guest');
$channel = $connection->channel();
 
$channel->queue_declare('chat3', false, false, false, false);
 
$callback = function ($msg) {
  echo ' [X]  ', $msg->body, "\n";
};
 
$channel->basic_consume('chat3', '', false, true, false, false, $callback);
 
while (count($channel->callbacks)) {
    $channel->wait();
}