<?php
include_once('/function/show.php');
include_once('/function/function.php');

/*isHasHttp begin*/
$p = 'https://example.php?name=Peter&age=37';
$res = isHasHttp($p);
//var_dump($res);
unset($res);
/*isHasHttp end*/

/*isPeopleId begin*/
$id_card = '370687199107120690';
$res = isPeopleId($id_card);
var_dump($res);
unset($res);
/*isPeopleId end*/
?>