<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 13:49
 */
class A {
    public $foo = 1;
}


$e = new A;

function foo($obj) {
    // ($obj) = ($e) = <id>
    $obj->foo = 6;
}

foo($e);
echo $e->foo."\n";