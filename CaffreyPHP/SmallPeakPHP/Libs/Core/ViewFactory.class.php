<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/11
 * Time: 15:49
 * 视图工厂类
 */

namespace Libs\Core;

class ViewFactory {

    public static $view;

    public static function init($viewtype, $config)
    {
        self::$view = new $viewtype;

        /*
        $smarty = new Smarty(); // 实例化smarty
        $smarty -> left_delimiter = $config["left_delimiter"]; // 左定界符
        $smarty -> right_delimiter = $config["right_delimiter"]; // 右定界符
        $smarty -> template_dir = $config["template_dir"]; // html模版地址
        $smarty -> compile_dir = $config["compile_dir"]; // 模版编译生成的文件
        $smarty -> cache_dir = $config["cache_dir"]; // 缓存
        一下是开启缓存的另两个配置，因为通常不用smarty的缓存机制，所以此项为了解
        $smarty -> caching = true; // 开启缓存
        $smarty -> cache_lifetime = 120; //缓存时间
         */
        foreach ($config as $key => $value) {
            self::$view -> $key = $value;
        }
    }

    public static function assign($tpl_var, $value = null, $nocache = false)
    {
        self::$view -> assign($tpl_var, $value,  $nocache);
    }

    public static function display($template)
    {
        self::$view -> display(CONTROLLER . '/' . $template);
    }

    public static function registerPlugin($type, $tag, $callback, $cacheable = true, $cache_attr = null)
    {
        self::$view -> registerPlugin($type, $tag, $callback, $cacheable, $cache_attr);
    }
}