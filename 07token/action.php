<?php
session_start();
header("Content-type: text/html; charset=utf-8");   

if(isset($_POST['test'])){
    if(!valid_token()){
        echo "token error";
    }else{
        echo '成功提交，Value:'.$_POST['test'];
    }
}

function valid_token() {
    $return = $_REQUEST['token'] === $_SESSION['token'] ? true : false;
    echo $_REQUEST['token'].'<br>';
    echo $_SESSION['token'];
    set_token();
    return $return;
}
function set_token() {
    $_SESSION['token'] = md5(microtime(true));
}

//header("location: redirect.php");

header("refresh:3;url=redirect.php");
print('正在加载，请稍等...<br>三秒后自动跳');
exit;