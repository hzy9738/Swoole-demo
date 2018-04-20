<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);

if(!$client->connect('47.52.142.125','9503')){
    echo "连接失败";
    exit;
}
//php cli常量
fwrite(STDOUT,'请输出消息：');
$msg = trim(fgets(STDIN));

//发送消息给 tcp server服务器
$client->send($msg);

// 接收来自server 服务器
$result = $client->recv();
echo "{$result}\n";
