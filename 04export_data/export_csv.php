<?php
require "lib/csv.php";
$list = require "data.php";

$data = array();
foreach ($list as $value){
  $param = array();
  $param['id'] = $value['id'];
  $param['name'] = $value['name'];
  $param['sex'] = $value['sex'];
  $param['age'] = $value['age'];
  $param['education'] = $value['education'];
  $param['address'] = $value['address'];
  $param['remark'] = $value['remark'];
  $data[$value['id']] = $param;
}
//header
$header = array(
        'id' => 'ID',
        'name' => '姓名',
        'sex' => '性别',
        'age' => '年龄',
        'education' => '学历',
        'address' => '地址',
        'remark' => '备注',
);
//header数组的值将被插入到数组的开头
array_unshift($data, $header);
$csv = new Csv();
$export_data = $csv->charset($data,'UTF-8','GBK');
$title = '导出CSV数据Demo';
$csv->filename = $csv->charset($title,'UTF-8');
$csv->export($export_data);
exit();