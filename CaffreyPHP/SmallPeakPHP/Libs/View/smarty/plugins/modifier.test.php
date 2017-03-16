<?php
/**
 * Created by PhpStorm.
 * User: voip1
 * Date: 2015/5/7
 * Time: 16:37
 */
// 自定义变量调节器插件
function smarty_modifier_test($utime, $format)
{
    return date($format,$utime);
}