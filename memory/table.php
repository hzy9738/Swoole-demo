<?php
// 创建内存表
$table = new swoole_table(1024);

// 内存表增加一列
$table->column('id', $table::TYPE_INT, 4);
$table->column('name', $table::TYPE_STRING, 64);
$table->column('age', $table::TYPE_INT, 3);
$table->create();


// 一种方案
$table->set('table_1', ['id' => 1, 'name'=> 'hzy', 'age' => 24]);

// 另外一种方案
$table['table_2'] = [
    'id' => 2,
    'name' => 'hong',
    'age' => 26,
];
//
$table->decr('table_2', 'age', 20); //减
//$table->incr('table_2', 'age', 10); //增

echo "delete table : table_1".PHP_EOL;
$table->del('table_1');



print_r($table->get('table_1'));
print_r($table->get('table_2'));
