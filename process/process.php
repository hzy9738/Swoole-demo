<?php

$process = new swoole_process(function (swoole_process $process){
    //todo
    echo "123\n";
},true); // true=> '123'会被放入进程管道里， false则会打印出来

$pid = $process->start();
echo $pid.PHP_EOL;