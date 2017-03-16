<?php
header("Content-type: text/html;charset=utf-8"); // 防止乱码
//var_dump($_SERVER);die;
define('APP_PATH', './App/');
require_once 'SmallPeakPHP\SmallPeakPHP.php';
SmallPeakPHP::run();