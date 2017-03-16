<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/8
 * Time: 23:40
 * 数据库接口
 */

namespace Libs\Int;

interface IDatabase {
    // 数据库连接
    function connect($config);
    // 执行Sql语句
    function query($sql);
    //  列表
    function findAll($query);
    // 单条
    function findOne($query);
    // 指定行的指定字段的值
    function findResult($query, $row = 0, $field = 0);
    // 添加函数
    function insert($table, $arr);
    // 更新数据
    function update($table, $arr, $where);
    // 删除
    function del($table, $where);
    // 关闭数据库
    function close();
}