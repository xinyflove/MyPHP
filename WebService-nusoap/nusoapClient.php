<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/4/19
 * Time: 15:21
 */

require_once ("lib/nusoap.php");

/*
通过 WSDL 调用 WebService
参数 1 WSDL 文件的地址 (问号后的wsdl不能为大写)
参数 2  指定是否使用 WSDL
$client = new soapclient('http://localhost/nusoapService.php?wsdl',true);
*/
//$client = new soapclient('http://fw.hswzyj.com/api/index.php');
$client = new soapclient('http://localhost/nusoap/nusoapService.php');

$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;
$client->xml_encoding = 'UTF-8';

$result = $client->call( 'GetTestStr', array('name'=>'Caffrey') );

// 检查错误，获取返回值
if (! $err = $client->getError()) {
    echo $result;
} else {
    echo " Call wrong： ", $err;
}