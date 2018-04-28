<?php

class AysMysql {
    public $db = null;
    public $config = [];
    public function __construct()
    {
        $this->db = new swoole_mysql;
        $this->config = [
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 'root',
            'database' => 'salary',
            'charset' => 'utf8', //指定字符集
            'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
        ];
    }

    public function select(){
        $this->db->connect($this->config ,function ($db,$result){
            if ($result === false) {
                var_dump($db->connect_errno, $db->connect_error);
                die;
            }
            $sql = 'select * from users';
            $db->query($sql, function(swoole_mysql $db, $result) {
                if ($result === false)
                {
                    var_dump($db->error, $db->errno);
                }
                elseif ($result === true )
                {
                    var_dump($db->affected_rows, $db->insert_id);
                }
                var_dump($result);
                $db->close();
            });
        });
        return true;
    }

    public function update(){

    }

    public function add(){

    }
}
$obj = new AysMysql();
$obj->select();