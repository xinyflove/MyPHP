<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2015/11/20 0020
 * Time: 下午 16:49
 * Description: 操作SQLite3类
 */

class SQLite3DB  extends SQLite3{
	
	private static $db_dir = './';
	
    function __construct($db_name)
    {
		$db_path = self :: $db_dir.$db_name.'.db';
        if(file_exists($db_path))
        {
            $this->open($db_path);
        }
        else
        {
            die('Fatal:Database file ('.$db_path.') does not exist! in '.__FILE__.' on line '.__LINE__);
        }
    }

    /**
     * [插入多条数据]
     * @param  [string] $dbname    [表名]
     * @param  [array]  $arrFields [array(array('字段名1' => '值1', '字段名2' => '值2' ...),array('字段名1' => '值1', '字段名2' => '值2' ...)...)]
     * @return [boolean]           [如果成功返回true,失败返回false]
     */
    function db_inserts($dbname, $arrFields)
    {
        if(empty($arrFields) || empty($dbname)) return false;
        $sql = '';
        foreach($arrFields as $arrField)
        {
            $key = array();
            $val = array();
            foreach($arrField as $k => $v)
            {
                $key[] = $k;
                $val[] = "'".$v."'";
            }
            $keystr = join(',', $key);
            $valstr = join(',', $val);

            $sql .= "INSERT INTO {$dbname} ({$keystr}) VALUES ($valstr);";
        }
        if(!empty($sql))
        {
            $ret = $this->exec($sql);
            return $ret;
        }
        return false;
    }

    /**
     * [插入一条数据]
     * @param  [string] $dbname   [表名]
     * @param  [array]  $arrField [array('字段名1' => '值1', '字段名2' => '值2' ...)]
     * @return [boolean]          [如果成功返回true,失败返回false]
     */
    function db_insert($dbname, $arrField)
    {
        if(empty($arrField) || empty($dbname)) return false;
        $key = array();
        $val = array();
        foreach($arrField as $k => $v)
        {
            $key[] = $k;
            $val[] = "'".$v."'";
        }
        $keystr = join(',', $key);
        $valstr = join(',', $val);

        if(!empty($keystr))
        {
            $sql = "INSERT INTO {$dbname} ({$keystr}) VALUES ($valstr);";
            $ret = $this->exec($sql);
            return $ret;
        }
        return false;
    }

    /**
     * [更新数据]
     * @param  [type] $dbname   [表名]
     * @param  [type] $arrField [array('字段名1' => '值1', '字段名2' => '字段名2+|-1' ...)]
     * @param  [type] $arrWhere [array('字段名1' => '值1', '字段名2' => '值2' ...)]
     * @return [type]           [如果成功返回true,失败返回false]
     */
    function db_update($dbname, $arrField, $arrWhere=array())
    {
        if(empty($arrField) || empty($dbname)) return false;

        $arr_f = array();
        foreach($arrField as $kf => $vf)
        {
            preg_match("/\+|-/", $vf, $match);
            if(!empty($match)) $arr_f[] = "$kf=$vf";
            else $arr_f[] = "$kf='{$vf}'";
        }
        $arr_f_str = join(', ', $arr_f);

        $arr_w_str = '';

        if(!empty($arrWhere))
        {
            $arr_w = array();
            foreach($arrWhere as $kw => $vw)
            {
                $arr_w[] = "$kw='{$vw}'";
            }
            $arr_w_str = " WHERE ".join(' AND ', $arr_w);
        }

        $sql_update = "UPDATE {$dbname} SET ".$arr_f_str.$arr_w_str.";";
        $ret = $this->exec($sql_update);
        return $ret;
    }

    /**
     * [删除数据]
     * @param  [type] $dbname   [表名]
     * @param  array  $arrWhere [array('字段名1' => '值1', '字段名2' => '值2' ...)]
     * @return [type]           [如果成功返回true,失败返回false]
     */
    function db_delete($dbname, $arrWhere=array())
    {
        if(empty($dbname)) return false;

        $arr_w_str = '';
        if(!empty($arrWhere))
        {
            $arr_w = array();
            foreach($arrWhere as $kw => $vw)
            {
                $arr_w[] = "$kw='{$vw}'";
            }
            $arr_w_str = ' WHERE '.join(' AND ', $arr_w);
        }
        

        $sql_del = "DELETE FROM {$dbname}".$arr_w_str.";";
        $ret = $this->exec($sql_del);
        return $ret;
    }

    /**
     * [情况表数据]
     * @param  [type] $dbname [表名]
     * @return [type]         [如果成功返回true,失败返回false]
     */
    function db_truncate($dbname)
    {
        if(empty($dbname)) return false;
        $sql_truncate = "DELETE FROM {$dbname};UPDATE sqlite_sequence SET seq = 0 WHERE name ='{$dbname}';";
        $ret = $this->exec($sql_truncate);
        return $ret;
    }

    /**
     * [查询数据]
     * @param  [type] $dbname    [表名]
     * @param  array  $findField [array('字段名1', '字段名2' ...)]
     * @param  array  $arrWhere  [array('字段名1' => '值1', '字段名2' => '值2' ...)]
     * @param  integer$type      [0 -> array('key' => 'value') 1-array('column'=>'value') 2-array('key' => 'value','column'=>'value')]
     * @return [type]            [返回数组，没有数据返回false]
     */
    function db_select($dbname, $findField=array(), $arrWhere=array(), $type=0)
    {
        if(empty($dbname)) return false;

        if(empty($findField) || $findField[0] == '*')
        {
            $find = '*';
        }
        else
        {
            $find = join(',', $findField);
        }

        $arr_w_str = '';
        if(!empty($arrWhere))
        {
            $arr_w = array();
            foreach($arrWhere as $kw => $vw)
            {
                $arr_w[] = "$kw='{$vw}'";
            }
            $arr_w_str = ' WHERE '.join(' AND ', $arr_w);
        }

        $sql = "SELECT {$find} FROM {$dbname}".$arr_w_str;
        $ret = $this -> query($sql);
        $data = array();
        $data1 = array();
        $data2 = array();
        $data3 = array();

        while($row = $ret->fetchArray(SQLITE3_ASSOC))
        {
            $data1[] = $row;
            $i = 0;
            $d = array();
            foreach ($row as $v)
            {
                $d[$i] = $v;
                $i ++;
            }
            $data2[] = $d;
            $data3[] = array_merge($row, $d);
        }

        if($type == 1)
        {
            $data = $data2;
        }
        elseif($type == 2)
        {
            $data = $data3;
        }
        else
        {
            $data = $data1;
        }
        
        if(empty($data)) return false;
        return $data;
    }

    /**
     * [根据key，如果有，就是更新数据，没有就是添加数据]
     * @param  [type] $dbname [表名]
     * @param  array  $fields [数据数组]
     * @param  array  $key    [key值数组]
     * @return [type]         [如果成功返回true,失败返回false]
     */
    function db_merge($dbname, $fields=array(), $key=array())
    {
        if(empty($fields) || empty($dbname)) return false;

        if(!empty($key))
        {
            $res = $this -> db_select($dbname, array(), $key);
            if($res)
            {
                // update
                $ret = $this -> db_update($dbname, $fields, $key);
                return $ret;
            }
        }

        // insert
        $ret = $this -> db_insert($dbname, $fields);
        return $ret;
    }

    /**
     * [查看表是否存在]
     * @param  [type] $tname [表名]
     * @return [type]        [如果存在返回true,不存在返回false,并die输出错误信息]
     */
    private function selectTable($tname)
    {
        $sql = "SELECT COUNT(*) AS c FROM sqlite_master WHERE type='table' AND name='{$tname}'";
        $ret = $this -> query($sql);
        if($row = $ret->fetchArray(SQLITE3_ASSOC))
        {
            if($row['c']) return true;
        }
        die('Fatal:Table ('.$tname.') does not exist! in '.__FILE__.' on line '.__LINE__);
        return false;
    }

    /**
     * [关闭数据库]
     * @return [type] [void]
     */
    private function db_close()
    {
        $this -> close();
    }
}

$db = new SQLite3DB('test');
if(!$db)
{
    echo $db->lastErrorMsg();
    die;
}

//$ret = $db->db_update('user_list', array('uage'=>'uage+1', 'upasswd' => 12));
//$ret = $db -> db_insert('user_list', array('uname' => 'Paul2', 'upasswd' => '123'));
//$ret = $db -> db_delete('user_list');
//$ret = $db -> db_truncate('user_list');
//$ret = $db -> selectTable('user_list1');
//$ret = $db -> db_select('user_list', array('*'),array(),2);
$ret = $db -> db_merge('user_list', array('uname' => 'mozzie', 'upasswd' => '1234', 'uage' => 15), array('uname' => 'mozzie', 'id' => '5'));
echo '<pre>';
var_export($ret);