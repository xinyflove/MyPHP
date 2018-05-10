<?php
/*
* PHP简单利用token防止表单重复提交
* 此处理方法纯粹是为了给初学者参考
*/
session_start();
header("Content-type: text/html; charset=utf-8");           
function set_token() {
    $_SESSION['token'] = md5(microtime(true));
}

//如果token为空则生成一个token
if(!isset($_SESSION['token']) || $_SESSION['token']=='') {
    set_token();
}

echo $_SESSION['token'];

?>
<form method="post" action="action.php">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
    <input type="text" name="test" value="Default">
    <input type="submit" value="提交" />
</form>