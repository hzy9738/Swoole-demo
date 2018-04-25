<?php

$server = new swoole_websocket_server('0.0.0.0',9500);

// 监听websocket连接打开事件
$server->on('open','onOpen');

// 监听websocket消息事件
$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "客户端 {$frame->fd} 发送信息 ：{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "Server 已经连接上了");
});
// 监听关闭事件
$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

function onOpen($server , $request){
    print_r("连接上了标识为 {$request->fd} 的客户端");
}

$server->start();