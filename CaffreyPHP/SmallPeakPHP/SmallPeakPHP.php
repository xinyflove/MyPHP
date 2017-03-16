<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/11
 * Time: 13:52
 * 主框架运行入口
 */
define('BASEDIR', __DIR__);
include_once BASEDIR . '/Function/function.php';
include_once BASEDIR . '/Libs/View/smarty/Smarty.class.php';
include_once BASEDIR . '/Libs/Core/Loader.class.php';
spl_autoload_register('\\Libs\\Core\\Loader::autoload');

class SmallPeakPHP {

    private static $config;

    private static function init_db(){
        $config = array(
            'dbhost' => self::$config['dbhost'],
            'dbuser' => self::$config['dbuser'],
            'dbpsw' => self::$config['dbpsw'],
            'dbname' => self::$config['dbname'],
            'dbcharset' => self::$config['dbcharset'],
        );
        \Libs\Core\DbFactory::init('MySQL', $config);
    }
    private static function init_view(){
        $config = array(
            'left_delimiter' => self::$config['left_delimiter'],
            'right_delimiter' => self::$config['right_delimiter'],
            'template_dir' => self::$config['template_dir'],
            'compile_dir' => self::$config['compile_dir'],
            'debugging' => self::$config['debugging'],
        );
        \Libs\Core\ViewFactory::init('Smarty', $config);
    }
    private static function init_controllor(){
        define('CONTROLLER', isset($_GET['c'])?sp_ucfirst(daddslashes($_GET['c'])):'index');
    }
    private static function init_method(){
        define('METHOD', isset($_GET['m'])?strtolower(daddslashes($_GET['m'])):'index');
    }
    public static function run(){
        session_start();
        $config = new Libs\Core\Config(BASEDIR.'/Conf');
        $app_conf = new Libs\Core\Config(APP_PATH .'Conf');
        $config = array_merge($config['Controller'], $app_conf['config']);
        //var_dump($config);die;
        self::$config = $config;
        date_default_timezone_set($config['timezone']);
        self::init_db();
        self::init_view();
        self::init_controllor();
        self::init_method();
        C(CONTROLLER, METHOD);
    }
}