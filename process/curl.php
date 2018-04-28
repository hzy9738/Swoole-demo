<?php
echo "process-start-time:".date("Y m d H:i:s");
$workers = [];
$urls = [
    'http://baidu.com',
    'http://sina.com.cn',
    'http://qq.com',
    'http://baidu.com?search=hzy9738',
];
for($i = 0;$i < 4; $i++){

    $pro =  new swoole_process(function (swoole_process $worker) use ($i , $urls){
        // curl
        $content = curlData($urls[$i]);
        //echo $content.PHP_EOL;
        $worker->write($content.PHP_EOL);
    },true);
    $pid = $pro->start();
    $workers[] = $pro;
}

foreach($workers as $pro) {
    echo $pro->read();
}

/**
 * 模拟请求URL的内容  1s
 * @param $url
 * @return string
 */
function curlData($url) {
    // curl file_get_contents
    sleep(1);
    return $url . "success".PHP_EOL;
}
echo "process-end-time:".date("Y m d H:i:s");