<?php

$http = new swoole_http_server("0.0.0.0", 9501);

$http->set([
    'enable_static_handler' => true,    // 静态web路径(不监听 request 事件了)
    'document_root' => './../data'      // 路径
]);


$http->on("request", function ($request, $response) {
//    $response->header("Content-Type", "text/plain");
    $get = $request->get;   // get参数
    $response->cookie('cook','cookValue',time()+1800);  // 设置cookie
    $response->end("<h1>Hello World</h1>");
});


$http->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});


$http->start();