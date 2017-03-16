<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2016/3/17 0017
 * Time: 下午 14:48
 * Description 提供Redis使用类
 */

class RedisCX {
    private $redis;

    public function __construct($host = '127.0.0.1', $port = 6379, $passwd = "") {
        $this -> redis = new Redis();
        $this -> redis -> connect($host, $port);
        $this -> redis -> auth($passwd);
        $res = $this -> redis -> ping();
        if("+PONG" != $res) return die("连接redis失败!");
    }

    /**
     * @param $idx
     * 选择数据库
     */
    public function selectDb($idx) {
        $this -> redis -> select($idx);
    }

    /**
     * Hash 插入
     * @param $key
     * @param $field
     * @param $value
     * @return int
     * Description 插入一个哈希表值
     */
    public function setHashValue($key, $field, $value) {
        $res = $this -> redis -> hSet($key, $field, $value);
        return $res;
    }

    /**
     * Hash 插入
     * @param $key
     * @param $arr = array("field"=>"value")
     * @return bool
     * Description 插入多个哈希表值
     */
    public function setHashValues($key, $arr) {
        $res = $this -> redis -> hMset($key, $arr);
        return $res;
    }

    /**
     * Hash 插入
     * @param $key
     * @param $field
     * @param $value
     * @return bool
     * Description 插入一个field不存在的数据，如果存在，则插入无效
     */
    public  function  setHashOnlyFiledValue($key, $field, $value) {
        $res = $this -> redis -> hSetNx($key, $field, $value);
        return $res;
    }

    /**
     * Hash 获取
     * @param $key
     * @param $field
     * @return string
     * Description 根据key和field获取key指定的字段值
     */
    public function getHashValueByField($key, $field) {
        $data = $this -> redis -> hGet($key, $field);
        return $data;
    }

    /**
     * Hash 获取
     * @param $key
     * @param $fields = array("field1", "field2")
     * @return array
     */
    public function getHashValueByFields($key, $fields) {
        $data = $this -> redis -> hMGet($key, $fields);
        return $data;
    }

    /**
     * Hash 获取
     * @param $key
     * @return array
     * Description 根据key获取全部的数据
     */
    public function getHashValueAll($key) {
        $data = $this -> redis -> hGetAll($key);
        return $data;
    }

    /**
     * Hash 删除
     * @param $key
     * @param $field = array("field1", "field2")
     * @return int
     * Description 删除key里面的field
     */
    public function delHashField($key, $field) {
        //$args_arr = func_get_args();
        $i = 0;
        foreach($field as $f) {
            $data = $this -> redis -> hDel($key, $f);
            $i = $i + $data;
        }

        return $i;
    }


}

