<?php
class Ws{
    const HOST = '0.0.0.0';
    const PORT = '9500';

    public $ws = null;
    public function __construct(){
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('close',[$this,'onClose']);

        $this->ws->start();
    }

    /**
     * 监听打开连接事件
     * @param $server
     * @param $request
     */
    public function onOpen($server,$request){
        print_r("连接上了标识为 {$request->fd} 的客户端");
    }

    /**
     * 监听websocket消息事件
     * @param $server
     * @param $frame
     */
    public function onMessage($server,$frame){
        echo "客户端 {$frame->fd} 发送信息 ：{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "Server 已经连接上了");
    }

    /**
     * 监听客户端关闭事件
     * @param $server
     * @param $fd
     */
    public function onClose($server,$fd){
        echo "客户端 {$fd} closed\n";
    }
}

$obj = new Ws();