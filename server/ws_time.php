<?php
class Ws{
    const HOST = '0.0.0.0';
    const PORT = '9500';

    public $ws = null;
    public function __construct(){
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);
        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);
        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('task',[$this,'onTask']);
        $this->ws->on('finish',[$this,'onFinish']);
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
        if($request->fd == 1){
            // 每2秒执行
            swoole_timer_tick(2000,function ($timerID){
                echo "timer: 定时器id {$timerID}\n";
            });
        }
    }

    /**
     * 监听websocket消息事件
     * @param $server
     * @param $frame
     */
    public function onMessage($server,$frame){
        echo "客户端 {$frame->fd} 发送信息 ：{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $data = [
            'fd' => $frame->fd
        ];
//        $server->task($data);
        swoole_timer_after(5000,function () use($server,$frame){
            echo 'time 5s';
            $server->push($frame->fd, "time-after-5s" );
        });
        $server->push($frame->fd, "Server 已经连接上了");
    }

    /**
     * 监听task任务
     * @param $server
     * @param $taskId
     * @param $workerId
     * @param $data
     * @return string
     */
    public function onTask($server,$taskId,$workerId,$data){
        $data['taskId'] = $taskId;
        $data['workerId'] = $workerId;
        print_r($data);
        sleep(10);
        return 'task 任务 finish';
    }

    /**
     * @param $server
     * @param $taskId
     * @param $data
     */
    public function onFinish($server,$taskId,$data){
        echo "taskId :{$taskId}\n";
        echo "finish-success :{$data}\n";
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