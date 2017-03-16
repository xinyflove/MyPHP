<?php
include_once('Class/Extend.php');
// 创建一个对象
$person = new Person('male', '17');
$person -> printPerson();
echo '<br />';
$person -> eyes();