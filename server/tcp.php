<?php
$server = new swoole_server("0.0.0.0", 9503);

$server->set([
    'worker_num' => 8 ,  // worker的进程  cpu1-4倍数
    'max_request' => 10000,
]);
/**
 * 监听连接进入事件
 * $fd 客户端连接的唯一标示
 * $reactor_id   线程id
 */
$server->on('connect', function ($server, $fd , $reactor_id){
    echo "Client: {$reactor_id} - {$fd}-Connect.\n";
});
/**
 * 监听接收事件
 */
$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Server: {$reactor_id} - {$fd} - {$data}");
//    $server->close($fd);
});
/**
 * 监听连接关闭事件
 */
$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});
$server->start();