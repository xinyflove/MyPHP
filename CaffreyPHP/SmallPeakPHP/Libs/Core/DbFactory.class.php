<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/11
 * Time: 14:47
 * DB引擎工厂类
 */

namespace Libs\Core;
use Libs\Db\MySQL;

class DbFactory {

    public static $db;

    public static function init($dbtype = 'MySQL', $config)
    {
        if($dbtype == 'MySQL')
        {
            self::$db = new MySQL();
            self::$db -> connect($config);
        }
    }

    public static function query($sql)
    {
        return self::$db -> query($sql);
    }

    public static function findAll($sql)
    {
        $query = self::$db -> query($sql);
        return self::$db -> findAll($query);
    }

    public static function findOne($sql)
    {
        $query = self::$db -> query($sql);
        return self::$db -> findOne($query);
    }

    public static function findResult($sql, $row = 0, $filed = 0)
    {
        $sql = self::$db -> query($sql);
        return self::$db -> findResult($sql, $row, $filed);
    }

    public static function insert($table, $arr)
    {
        return self::$db -> insert($table, $arr);
    }

    public static function update($table, $arr, $where)
    {
        return self::$db -> update($table, $arr, $where);
    }

    public static function del($table, $where)
    {
        return self::$db -> del($table, $where);
    }
}