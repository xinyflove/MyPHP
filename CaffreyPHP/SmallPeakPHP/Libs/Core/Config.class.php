<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/8
 * Time: 23:54
 * 自动加载配置
 */

namespace Libs\Core;


class Config implements \ArrayAccess {

    protected $path;
    protected $configs = array();

    // 传入配置文件目录
    public function  __construct($path)
    {
        $this -> path = $path;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($key)
    {
        return isset($this -> configs[$key]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($key)
    {
        if(empty($this -> configs[$key]))
        {
            $file_path = $this -> path . '/' . $key . '.php';
            $config = require_once $file_path;
            $this -> configs[$key] = $config;
        }
        return  $this -> configs[$key];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        throw new \Exception("cannot write config file");
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this -> configs[$key]);
    }
}