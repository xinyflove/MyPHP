<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 13:45
 */

class A {
    public $foo = 1;
}

$c = new A;
$d = &$c;    // $c ,$d是引用
// ($c,$d) = <id>

$d->foo = 4;

echo $c->foo."\n";
echo $d->foo."\n";

$c->foo = 5;

echo $c->foo."\n";
echo $d->foo."\n";