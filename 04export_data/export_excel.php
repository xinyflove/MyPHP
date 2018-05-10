<?php
require "lib/excel.php";
$list = require "data.php";

$excel_obj = new Excel();
$excel_data = array();
//设置样式
$excel_obj->setStyle(array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1')));
//header
$excel_data[0][] = array('styleid'=>'s_title','data'=>'ID');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'姓名');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'性别');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'年龄');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'学历');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'地址');
$excel_data[0][] = array('styleid'=>'s_title','data'=>'备注');
//data
foreach ($list as $k => $v){
  $excel_data[$k+1][] = array('data'=>$v['id']);
  $excel_data[$k+1][] = array('data'=>$v['name']);
  $excel_data[$k+1][] = array('data'=>$v['sex']);
  $excel_data[$k+1][] = array('data'=>$v['age']);
  $excel_data[$k+1][] = array('data'=>$v['education']);
  $excel_data[$k+1][] = array('data'=>$v['address']);
  $excel_data[$k+1][] = array('data'=>$v['remark']);
}
//转码
$excel_data = $excel_obj->charset($excel_data,'UTF-8');
//添加多行数据
$excel_obj->addArray($excel_data);
$title = '导出Excel数据Demo';
$excel_obj->addWorksheet($excel_obj->charset($title,'UTF-8'));
$excel_obj->generateXML($excel_obj->charset($title,'UTF-8').date('Y-m-d-H',time()));
exit();