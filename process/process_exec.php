<?php

$process = new swoole_process(function (swoole_process $process){
    //todo
    $process->exec('/Applications/MAMP/bin/php/php7.0.27/bin/php',[__DIR__.'/../server/http_server.php']);
},false);

$pid = $process->start();
echo $pid.PHP_EOL;


swoole_process::wait();