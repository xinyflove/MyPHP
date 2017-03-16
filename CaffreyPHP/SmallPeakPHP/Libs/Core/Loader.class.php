<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/8
 * Time: 23:54
 * 自动加载类
 */

namespace Libs\Core;


class Loader {
    static function autoload($class)
    {
        require BASEDIR . '/' . str_replace('\\', '/',$class) . '.class.php';
    }
}