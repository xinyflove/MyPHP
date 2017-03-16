<?php
// 模型
// 从数据库存取数据
class UserModel{

	// 定义表名
    public $_table = 'user';

    // 通过用户名，取用户信息
    function findOne_by_username($uname)
    {
        $sql = 'select * from ' . $this ->_table . " where uname = '{$uname}'";
        return \Libs\Core\DbFactory::findOne($sql);
    }

    // 用户密码核对 --> auth模型
}

?>