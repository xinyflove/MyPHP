<?php
/**
 * Created by PhpStorm.
 * User: voip1
 * Date: 2015/5/7
 * Time: 16:30
 */
// 自定义函数插件
function smarty_function_test($params)
{
    $w = $params['width'];
    $h = $params['height'];
    $area = $w*$h;
    return $area;
}