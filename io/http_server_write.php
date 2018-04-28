<?php

$http = new swoole_http_server("0.0.0.0", 9501);

//$http->set([
//    'enable_static_handler' => true,    // 静态web路径(不监听 request 事件了)
//    'document_root' => './../data'      // 路径
//]);


$http->on("request", function ($request, $response) {
    $content =  [
        'date: ' =>   date('Ymd H:i:s',time()),
        'get: ' =>   $request->get,
        'post: ' =>   $request->post,
        'header: ' =>   $request->header,
   ];
    swoole_async_writefile(__DIR__.'/write.log',json_encode($content).PHP_EOL,function ($fileName){
        // todo
    },FILE_APPEND);

    $response->end("Swoole".json_encode($request->get));
});


$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});


$http->start();