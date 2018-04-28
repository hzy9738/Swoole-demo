<?php

$redisClient = new swoole_redis;
$redisClient->connect('127.0.0.1', '6379', function (swoole_redis $swoole_redis, $result) {
    echo '连接上了redis' . PHP_EOL;
//    $swoole_redis->set('data', time(), function (swoole_redis $swoole_redis, $result) {
//        var_dump($result);
//    });
//
//    $swoole_redis->get('data', function (swoole_redis $swoole_redis, $result) {
//        var_dump($result);
//    });

//    $swoole_redis->keys('data', function (swoole_redis $swoole_redis, $result) {
//        var_dump($result);
//    });

    $swoole_redis->keys('*ata', function (swoole_redis $swoole_redis, $result) {
        var_dump($result);
    });
    $swoole_redis->close();
});
echo 'true' . PHP_EOL;