<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/8
 * Time: 22:16
 */

// 要正确了解序列化，必须包含下面一个文件
require_once 'A.php';

$s = file_get_contents('store');
$a = unserialize($s);

// 现在可以使用对象$a里面的函数 show_one()
$a->getValue();