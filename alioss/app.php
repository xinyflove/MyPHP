<?php
echo '<pre>';
require_once __DIR__ . '/alioss.php';
if(!empty($_GET['op']) && $_GET['op'] == 'upload'){
	if(!empty($_GET['type'])){
		if($_GET['type'] == 'string'){
			// 字符串上传
			$alioss = new Alioss();
			$object = 'upload/string/helloworld.txt';
			$content = trim($_POST['string']);
			$alioss->putObject($object, $content);
		}
		
		if($_GET['type'] == 'file'){
			// 指定的本地文件上传
			$alioss = new Alioss();
			$object = "upload/images/".$_FILES['file']['name'];
			$filePath = $_FILES['file']['tmp_name'];
			$alioss->uploadFile($object, $filePath);
		}
		
		if($_GET['type'] == 'string_add'){
			// 字符串追加上传
			$alioss = new Alioss();
			$object = "upload/string/string_add.txt";
			$content_array = array('Hello OSS;', 'Hi OSS;', 'OSS OK;');
			$alioss->putAddObject($object, $content_array);
		}
		
		if($_GET['type'] == 'file_add'){
			// 文件追加上传
			$alioss = new Alioss();
			$object = "upload/string/file_add.txt";
			$filePath = $_FILES['file_add']['tmp_name'];
			$alioss->uploadAddFile($object, $filePath);
		}
	}
	
}

die;
