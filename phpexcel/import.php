<?php
header("Content-type: text/html; charset=utf-8");

$datas = array();
if (!empty($_FILES['file']['name']))
{
	$uname = explode('.', $_FILES['file']['name']);
	$savePath = 'upfile/';
	$file_name = $savePath . time() . '.' .end($uname);
	$result = move_uploaded_file($_FILES["file"]["tmp_name"], $file_name);

	if( !$result )
	{
		echo '上传文件失败!';
		exit();
	}

	require_once 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
	//require_once 'PHPExcel/Classes/PHPExcel/Reader/Excel5.php';//excel 2003
	require_once 'PHPExcel/Classes/PHPExcel/Reader/Excel2007.php';//excel 2007

	// $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format
	// $objPHPExcel = $objReader->load($file_name); //这个容易造成httpd崩溃
	$objPHPExcel = PHPExcel_IOFactory::load($file_name);//改成这个写法就好了

	$sheet = $objPHPExcel->getSheet(0);
	$highestRow = $sheet->getHighestRow(); // 取得总行数
	$highestColumn = $sheet->getHighestColumn(); // 取得总列数

	//循环读取excel文件,读取一条,插入一条
	for($j=2;$j<=$highestRow;$j++)
	{
		$data = array();
		for($k='A';$k<=$highestColumn;$k++)
		{
			$data[] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
		}

		$datas[] = $data;
		unset($data);
	}

	unlink($file_name); //删除上传的excel文件
}

echo '<pre>';
var_dump($datas);