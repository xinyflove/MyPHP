<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/10/31
 * Time: 15:07
 */
// 请开启soap扩展
try{

    $ser = 'Server.php';    // soap服务文件
    $location = 'http://'.$_SERVER['HTTP_HOST'].'/soap/'.$ser;

    $soap = new SoapClient(null,array("location"=>$location,"uri"=>$ser));

    //两种调用方式，直接调用方法，和用__soapCall简接调用
    $result1 = $soap->getName();
    $result2 = $soap->__soapCall("getName",array());
    echo $result1."<br/>";
    echo $result2;

}catch(SoapFault $e){
    echo $e->getMessage();
}catch(Exception $e){
    echo $e->getMessage();
}