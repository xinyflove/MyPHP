<?php
/**
 * 阿里直播
 * 参考文档:
 * 	直播推流:https://help.aliyun.com/document_detail/45211.html?spm=a2c4g.11186623.6.565.ang56b
 * 	直播鉴权:https://help.aliyun.com/document_detail/45210.html?spm=a2c4g.11186623.6.566.2A6nQG
 * 
 */

$domain = 'livepush.tvplaza.cn';//域名
$AppName = 'AppName';//应用名称(自定义)
$StreamName = 'StreamName';//流名称(自定义)
$privateKey = 'Dz7c85wFBz';//Key值
$uid = 0;//uid暂无使用,设置成0即可

/*=======================*/
//推流地址
$uri = "/{$AppName}/{$StreamName}";
$timestamp = time();
$rand = mt_rand(0, 9);
$sarr = array($uri, $timestamp, $rand, $uid, $privateKey);
$hashValue = md5(join('-', $sarr));
$uarr = array($timestamp, $rand, $uid, $hashValue);

$url = "rtmp://video-center.alivecdn.com{$uri}?vhost={$domain}&auth_key=".join('-', $uarr);
echo('推流地址: '.$url);
echo '<br>';

/*=======================*/
//直播流地址
$uri = "/{$AppName}/{$StreamName}.flv";
$timestamp = time();
$rand = mt_rand(0, 9);
$sarr = array($uri, $timestamp, $rand, $uid, $privateKey);
$hashValue = md5(join('-', $sarr));
$uarr = array($timestamp, $rand, $uid, $hashValue);

$url = "http://{$domain}{$uri}?auth_key=".join('-', $uarr);
echo('直播流地址: '.$url);