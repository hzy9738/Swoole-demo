<?php
$content = date('Ymd H:i:s',time()).PHP_EOL;
/**
 * FILE_APPEND 追加内容
 */
swoole_async_writefile(__DIR__.'/2.txt',$content,function ($fileName){
    echo 'success :写入成功'.PHP_EOL;
},FILE_APPEND);

echo 'start'.PHP_EOL;