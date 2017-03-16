<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/6
 * Time: 15:34
 * 函数类
 */

function C($name, $method)
{
    $file_path = "Libs/Controller/{$name}Controller.class.php";
    sp_loadfile($file_path);
    $name = $name.'Controller';
    sp_class_method($name, $method);
    //$obj = new $name;
   // $obj -> $method();
}

function M($name)
{
    $file_path = "Libs/Model/{$name}Model.class.php";
    sp_loadfile($file_path);
    $name = $name.'Model';
    //$obj = new $name;
    $obj = sp_class_exists($name);
    return $obj;
}

function V($name)
{
    $file_path = "Libs/View/{$name}View.class.php";
    sp_loadfile($file_path);
    $name = $name.'View';
    //$obj = new $name;
    $obj = sp_class_exists($name);
    return $obj;
}

function ORG($path, $name, $params=array())
{// path 是路径  name是第三方类名 params 是该类初始化的时候需要指定、赋值的属性，格式为 array(属性名=>属性值, 属性名2=>属性值2……)
    require_once('Libs/Org/'.$path.$name.'.class.php');
    $obj = new $name();
    if(!empty($params)){
        foreach($params as $key=>$value){
            $obj->$key = $value;
        }
    }
    return $obj;
}

/**过滤非法参数
 * [sp_addslashes在指定的预定义字符前添加反斜杠]
 * e.g.单引号 (')双引号 (")反斜杠 (\)NULL
 * @param  [string] $str [description]
 * @return [string]      [description]
 * note:默认情况下，PHP 指令 magic_quotes_gpc 为 on，
 * 对所有的 GET、POST 和 COOKIE 数据自动运行 addslashes()。
 * 不要对已经被 magic_quotes_gpc 转义过的字符串使用 addslashes()，
 * 因为这样会导致双层转义。遇到这种情况时可以使用函数 get_magic_quotes_gpc() 进行检测。
 */
function daddslashes($str)
{
    return (!get_magic_quotes_gpc())?addslashes($str):$str;
}

// 首字母大写
function sp_ucfirst($str)
{
    return ucfirst(strtolower($str));
}

// 文件加载
function sp_loadfile($file_path)
{
    $file_path = APP_PATH . $file_path;
    if(!file_exists($file_path))
    {
        die("Error!:Unable to load file. File path(". str_replace('\\', '/', $file_path) .") does not exist.");
    }
    require_once($file_path);
}

// 类方法是否存在
function sp_class_method($class_name ,$method)
{
    $obj = sp_class_exists($class_name);
    if(!method_exists($obj, $method)) die("Error!:Unable to load method. Method {$method}() does not exist in class {$class_name}.");
    $obj -> $method();
}

// 类是否存在
function sp_class_exists($class_name)
{
    if(!class_exists($class_name))
    {
        die("Error!:Unable to load class. Class name {$class_name} does not exist.");
    }
    return $obj = new $class_name();
}