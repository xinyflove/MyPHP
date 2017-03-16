<?php
/**
 * Created by PhpStorm.
 * User: voip1
 * Date: 2015/5/7
 * Time: 17:03
 */
// 自定义block插件
function smarty_block_testsp($params, $content)
{
    $replace = $params['replace'];

    $maxnum = $params['maxnum'];

    if($replace == 'true')
    {
        $content = str_replace('，', ',',  $content);
        $content = str_replace('。', '.',  $content);
    }
    $content = substr($content, 0, $maxnum);
    return $content;
}