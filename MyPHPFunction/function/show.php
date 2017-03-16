<?php
/**
 * [打印输出详情函数]
 * @param  [type] $var [需要打印的变量]
 * @return [type]      [详情]
 */
function show($var = null)
{
	if(empty($var))
	{
		echo 'null';
	}
	elseif(is_array($var) || is_object($var))
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	else
	{
		echo $var;
	}
}