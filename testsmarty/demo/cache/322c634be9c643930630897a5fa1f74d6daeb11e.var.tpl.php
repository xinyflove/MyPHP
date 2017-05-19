<?php
/* Smarty version 3.1.29, created on 2016-06-08 15:49:23
  from "D:\WWW\demo\smarty\demo\templates\var.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5757ce03dba358_50914136',
  'file_dependency' => 
  array (
    '322c634be9c643930630897a5fa1f74d6daeb11e' => 
    array (
      0 => 'D:\\WWW\\demo\\smarty\\demo\\templates\\var.tpl',
      1 => 1465372158,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5757ce03dba358_50914136 ($_smarty_tpl) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>变量</title>
</head>
<body>
	显示简单的变量 (非数组/对象) : Caffrey <br />
	在0开始索引的数组中显示第五个元素 : e <br />
	显示"bar"下标指向的数组值，等同于PHP的$foo['bar'] : Mike <br />
	显示以变量$bar值作为下标指向的数组值，等同于PHP的$foo[$bar] : Mozzie <br />
	显示对象属性 "name" : Kate <br />
	显示对象成员方法"getName"的返回 : Kobe <br />
	显示变量配置文件内的变量"foo : Nake <br />
	等同于{#foo6#} : Nake <br />

		index=0,  
	index_prev=-1,  
	index_next=1,  
	first=1,  
	last=,  
	iteration =1,  
	total=5,  
	value=a<br /> 
		index=1,  
	index_prev=0,  
	index_next=2,  
	first=,  
	last=,  
	iteration =2,  
	total=5,  
	value=b<br /> 
		index=2,  
	index_prev=1,  
	index_next=3,  
	first=,  
	last=,  
	iteration =3,  
	total=5,  
	value=c<br /> 
		index=3,  
	index_prev=2,  
	index_next=4,  
	first=,  
	last=,  
	iteration =4,  
	total=5,  
	value=d<br /> 
		index=4,  
	index_prev=3,  
	index_next=5,  
	first=,  
	last=1,  
	iteration =5,  
	total=5,  
	value=e<br /> 
		时间 : 1465372163 <br />
</body>
</html><?php }
}
