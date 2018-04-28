<?php
/**
 * 读取文件
 * __DIR__
 */
$result = swoole_async_readfile(__DIR__.'/1.txt',function ($fileName,$fileContent){
    echo "fileName:" .$fileName.PHP_EOL;
    echo "fileContent:" .$fileContent.PHP_EOL;
});

var_dump($result);
echo 'start'.PHP_EOL;