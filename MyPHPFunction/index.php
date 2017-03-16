<?php
include_once('/function/show.php');
include_once('/function/function.php');

$p = 'https://example.php?name=Peter&age=37';
$res = isHasHttp($p);
var_dump($res);
?>