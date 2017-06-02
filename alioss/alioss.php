<?php
require_once __DIR__ . '/vendor/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
class Alioss {
	private $ossClient = '';
    private $bucket = 'caffrey-bucket01';
    
    public function __construct(){
		$accessKeyId = "LTAIJRAPmN5cjwm0";
		$accessKeySecret = "I3sl0PppTWpTmcApkpTq2YnEx5jd1b";
		$endpoint = "oss-cn-shanghai.aliyuncs.com";

		try {
			$this->ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
		} catch (OssException $e) {
			print $e->getMessage();
			exit;
		}
	}
	
	/**
	 * 上传字符串作为object的内容
	 *
	 */
	public function putObject($object, $content)
	{
		try{
			$this->ossClient->putObject($this->bucket, $object, $content);
		} catch(OssException $e) {
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
	}
	
	/**
	 * 上传指定的本地文件内容
	 *
	 */
	public function uploadFile($object, $filePath)
	{
		try{
			$this->ossClient->uploadFile($this->bucket, $object, $filePath);
		} catch(OssException $e) {
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
	}
	
	/**
	 * 字符串追加上传
	 *
	 */
	public function putAddObject($object, $content_array)
	{
		try{
			$position = 0;	// 文件开头位置
			foreach($content_array as $content){
				$position = $this->ossClient->appendObject($this->bucket, $object, $content, $position);
			}
		} catch(OssException $e) {
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
	}
	
	/**
	 * 文件追加上传
	 *
	 */
	public function uploadAddFile($object, $file_array)
	{
		try{
			$position = 0;	// 文件开头位置
			foreach($file_array as $file){
				$position = $this->ossClient->appendFile($this->bucket, $object, $file, $position);
			}
		} catch(OssException $e) {
			printf($e->getMessage() . "\n");
			return;
		}
		print(__FUNCTION__ . ": OK" . "\n");
	}
}




