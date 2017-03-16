<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2016/3/17 0017
 * Time: 下午 16:41
 */
include_once('Class/RedisCX.php');

$redis = new RedisCX('127.0.0.1', 6379, 1234);
$redis -> selectDb(0);

//$data2 = $redis ->setHashValue("test", "sex", "male");
//var_export($data2);

//$arr = array("pass"=>123,"num" => 12);
//$data3 = $redis -> setHashValues("test", $arr);
//var_export($data3);

//$data4 = $redis -> setHashFiledToValue("test", "cate", "人");
//var_export($data4);

//$data5 = $redis -> delHashField("test", array("sex", "cate"));
//var_export($data5);

$data = $redis -> getHashValueAll("test");
var_export($data);