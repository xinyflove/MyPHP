<?php

require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()
    ->setCreator("affrey Xin")  // 创建人
    ->setLastModifiedBy("Caffrey Xin")   // 最后修改人
    ->setTitle("导出模版")    // 标题
    ->setSubject("导出模版")  // 主题
    ->setDescription("导出模版实例")    // 备注
    ->setKeywords("导出模版")    // 关键字
    ->setCategory("导出");  // 类别

// Set title data array('title' => 'width')
$row1 = array(
    'A' => array('编号', 15),
    'B' => array('名称', 15),
    'C' => array('性别', 15),
    'D' => array('电话', 15),
    'E' => array('地址', 30),
    'F' => array('身份证', 20),
    'G' => array('图片', 20)
);

$datas = array(
    array(
        'id' => '001',
        'name' => 'Caffrey',
        'sex' => '男',
        'phone' => '18653621610',
        'addr' => '山东省青岛市李沧区大崂路，乐客城对面',
        'idno' => '123321456654789987',
        'img' => 'img/test.png',
    ),
    array(
        'id' => '002',
        'name' => 'Mozzie',
        'sex' => '男',
        'phone' => '18653621611',
        'addr' => '山东省青岛市崂山区科苑纬3路，先锋电商产业园10层',
        'idno' => '123321456654789988',
        'img' => '',
    ),
);

$i = 1;
$objPHPExcel->setActiveSheetIndex(0);
foreach ($datas as $k => $v){

    if( $i == 1 )
    {
        if( !empty($row1) )
        {
            // 添加title
            foreach ($row1 as $tk => $tv)
            {
                if( count($tv) != 2 )
                {
                    echo 'title 格式错误!';
                    exit();
                }
                $objPHPExcel->getActiveSheet()->setCellValue($tk.$i, $tv[0]);
                $objPHPExcel->getActiveSheet()->getColumnDimension($tk)->setWidth($tv[1]);
            }
            $i ++;
            unset($row1);
        }
    }

    $data = array(
        'A' => array($v['id'], 0),
        'B' => array($v['name'], 0),
        'C' => array($v['sex'], 0),
        'D' => array($v['phone'], 0),
        'E' => array($v['addr'], 0),
        'F' => array($v['idno'], 1),
        'G' => array($v['img'], 2)
    );

    foreach ($data as $dk => $dv){
        switch ($dv[1]){
            case 1:
                // 设置文本格式
                $objPHPExcel->getActiveSheet()->setCellValueExplicit($dk.$i, $dv[0], PHPExcel_Cell_DataType::TYPE_STRING);
                break;
            case 2:
                // 为excel加图片
                $pic_path = $dv[0];
                if( file_exists($pic_path) )
                {
                    // 为excel加图片
                    $objDrawing = new PHPExcel_Worksheet_Drawing();
                    $objDrawing->setName('Photo');
                    $objDrawing->setDescription('Photo');
                    $objDrawing->setPath($pic_path);
                    $objDrawing->setHeight(170);
                    $objDrawing->setWidth(120);
                    $objDrawing->setCoordinates($dk.$i);
                    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                }
                else
                {
                    $objPHPExcel->getActiveSheet()->setCellValue($dk.$i, '无商品图片');
                }
                break;
            default :
                $objPHPExcel->getActiveSheet()->setCellValue($dk.$i, $dv[0]);
        }
    }

    unset($data);

    // 设置自动换行
    $objPHPExcel->getActiveSheet()->getStyle('E'.$i)->getAlignment()->setWrapText(true);
    //$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getAlignment()->setWrapText(true);
    $i ++;
}
unset($datas);

// 行高
for($k = 2; $k < $i; $k++)
{
    $objPHPExcel->getActiveSheet()->getRowDimension($k)->setRowHeight(100);
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('导入模版');

// Redirect output to a client’s web browser (Excel2007)]

ob_end_clean();//清除缓冲区

$filename = '导出模版';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;