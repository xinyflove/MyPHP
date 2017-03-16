<?php
/**
 * Created by PhpStorm.
 * User: Mozzie
 * Date: 2015/5/8
 * Time: 23:42
 * MySQL数据库
 */

namespace Libs\Db;
use Libs\Int\IDatabase;

class MySQL implements IDatabase {

    /**
     * [err 报错函数]
     * @param  [string] $error [description]
     * @return [type]        [description]
     */
    function err($error)
    {
        // die有两种作用 输出和终止 相当于echo和exit的组合
        die("对不起，您的操作有误，错误原因：".$error);
    }

    /**
     * [connect 连接数据库]
     * @param  [string] $config [配置数组array($dbhost,$dbuser.$dbpsw,$dbname,$dbcharset)]
     * @return [bool]         [连接成功或失败]
     */
    function connect($config)
    {
        extract($config); // 将数组还原成变量
        // mysql_connect连接数据库函数
        if(!($con = @mysql_connect($dbhost,$dbuser.$dbpsw)))
        {
            $this -> err(mysql_error() . ' line:' . __LINE__);
        }
        // mysql_select_db选择数据库函数
        if(!mysql_select_db($dbname,$con))
        {
            $this -> err(mysql_error() . ' line:'. __LINE__);
        }
        // 使用mysql_query设置编码格式:mysql_query("set names utf-8")
        mysql_query("set names ".$dbcharset);
    }

    /**
     * [query 执行sql语句]
     * @param  [string] $sql [description]
     * @return [bool]      [返回执行成功、资源或执行失败]
     */
    function query($sql)
    {
        // 使用mysql_query函数执行sql语句
        if(!($query = mysql_query($sql)))
        {
            //var_dump($sql);
            $this -> err($sql.'<br />'.mysql_error() . ' line:'. __LINE__); // mysql_error报错
        }
        else
        {
            return $query;
        }
    }

    /**
     * [findAll 列表]
     * @param  [source] $query [sql语句通过mysql_query执行出来的资源]
     * @return [array]        [返回列表数组]
     */
    function findAll($query)
    {
        // mysql_fetch_array函数把资源转换为数组，一次转换出一行出来
        while($res = mysql_fetch_array($query, MYSQL_ASSOC))
        {
            $list[] = $res;
        }
        return isset($list) ? $list : '';
    }

    /**
     * [findOne 单条]
     * @param  [source] $query [sql语句通过mysql_query执行出来的资源]
     * @return [array]        [返回单条信息数组]
     */
    function findOne($query)
    {
        $res = mysql_fetch_array($query, MYSQL_ASSOC);
        return $res;
    }

    /**
     * [findResult 指定行的指定字段的值]
     * @param  [source] $query [sql语句通过mysql_query执行出来的资源]
     * @param  integer $row   [description]
     * @param  integer $field [description]
     * @return [array]         [返回指定行的指定字段的值]
     */
    function findResult($query, $row = 0, $field = 0)
    {
        $res = mysql_result($query, $row, $field);
        return $res;
    }

    /**
     * [insert 添加函数]
     * @param  [string] $table [表名]
     * @param  [array] $arr   [添加数组(包含字段和值的一维数组)]
     * @return [type]        [返回添加的id]
     * note:`tbalename` and `字段名`
     */
    function insert($table, $arr)
    {
        // $sql = "insert into 表名(多个字段) value(多个值)";
        foreach ($arr as $key => $value) {
            $value = mysql_real_escape_string($value);
            $keyArr[] = "`{$key}`";
            $valueArr[] = "'{$value}'";
        }
        $keys = join(',', $keyArr);
        $values = join(',', $valueArr);
        $sql = "insert into `{$table}` ({$keys}) value ({$values})";
        $this -> query($sql);
        return mysql_insert_id();
    }
    /**
     * [update 更新数据]
     * @param  [type] $table [description]
     * @param  [type] $arr   [description]
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    function update($table, $arr, $where)
    {
        // update table set 字段 = 字段值 where ……
        foreach ($arr as $key => $value) {
            $value = mysql_real_escape_string($value);
            $keyAndvalueArr[] = "`{$key}` = '{$value}'";
        }
        $keyAndvalues = join(',', $keyAndvalueArr);
        $sql = "update `{$table}` set {$keyAndvalues} where {$where}";
        $this -> query($sql);
    }

    function del($table, $where)
    {
        $sql = "delete from {$table} where {$where}";
        $this -> query($sql);
    }

    function close()
    {
        mysql_close($this->conn);
    }
}