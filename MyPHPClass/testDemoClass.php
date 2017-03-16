<?php
include_once('Class/Demo.php');
// 创建一个对象
$demo = new Demo;	// or new Demo();

print $demo -> pub;
echo '<br />';
print Demo :: $pubs;
echo '<br />';
print $demo :: user;
echo '<br />';
echo '<hr />';
$demo -> printMember();
echo '<br />';
Demo :: staFun();
echo '<br />';
?>