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
require_once $phpexceldir.'/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel(); //创建一个实例

// 设置excel的属性 方法1
$objPHPExcel->getProperties()->setCreator('创建人');
$objPHPExcel->getProperties()->setLastModifiedBy('最后修改人');
$objPHPExcel->getProperties()->setTitle('标题');
$objPHPExcel->getProperties()->setSubject('主题');
$objPHPExcel->getProperties()->setDescription('备注');
$objPHPExcel->getProperties()->setKeywords('关键字');
$objPHPExcel->getProperties()->setCategory('类别');

// 设置excel的属性 方法2
/*$objPHPExcel->getProperties()->setCreator('创建人')
    ->setLastModifiedBy('最后修改人')
    ->setTitle('标题')
    ->setSubject('主题')
    ->setDescription('备注')
    ->setKeywords('关键字')
    ->setCategory('类别');*/


$objPHPExcel->setActiveSheetIndex(0);   // 设置当前的sheet
$objPHPExcel->getActiveSheet()->setTitle('sheet的标题'); // 设置sheet的标题
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  // 设置单元格宽度
for($i=1;$i<5;$i++){
    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(40);  // 设置单元格高度
}
$objPHPExcel->getActiveSheet()->mergeCells('A2:A3');  // 合并单元格
//$objPHPExcel->getActiveSheet()->unmergeCells('A2:A3');    // 拆分单元格
// 设置保护cell,保护工作表
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
$objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');

//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //非2007格式
//$objWriter->save("xxx.xlsx");
//$objWriter->save("xxx.xls");

