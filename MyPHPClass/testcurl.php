<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2016/1/28 0028
 * Time: 下午 16:54
 */
include_once('Class/Curl.php');

//$url = "www.baidu.com";
$url = "localhost/MyPHPClass/res.php";
$cu = new Curl($url);
$data = array(
    'name' => 'caffrey',
    'pass' => '123'
);
$file = array('uploadfile' => 'data/test.db', 'file' => 'images/pl.png');
$res = $cu->postJsonData($data);
var_dump($res);