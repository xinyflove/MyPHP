<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/23
 * Time: 16:42
 * Desc: 导出数据
 */

// 引用PHPExcel
$phpexceldir = __DIR__.'/PHPExcel/Classes'; // phpexcel工具类的绝对目录
require_once $phpexceldir.'/PHPExcel.php';
require_once $phpexceldir.'/PHPExcel/Writer/Excel5.php'; // 用于输出.xls的

$objPHPExcel = new PHPExcel(); //创建一个实例

// 设置excel的属性 方法1
$objPHPExcel->getProperties()->setCreator("创建人");
$objPHPExcel->getProperties()->setLastModifiedBy("最后修改人");
$objPHPExcel->getProperties()->setTitle("标题");
$objPHPExcel->getProperties()->setSubject("主题");
$objPHPExcel->getProperties()->setDescription("备注");
$objPHPExcel->getProperties()->setKeywords("关键字");
$objPHPExcel->getProperties()->setCategory("类别");

// 设置excel的属性 方法2
/*$objPHPExcel->getProperties()->setCreator("创建人")
    ->setLastModifiedBy("最后修改人")
    ->setTitle("标题")
    ->setSubject("主题")
    ->setDescription("备注")
    ->setKeywords("关键字")
    ->setCategory("类别");*/

//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //非2007格式
//$objWriter->save("xxx.xlsx");
//$objWriter->save("xxx.xls");

