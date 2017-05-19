<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 13:40
 */
class A {
    public $foo = 1;
}

$a = new A;
$b = $a;     // $a ,$b都是同一个标识符的拷贝
// ($a) = ($b) = <id>
$b->foo = 2;

echo $a->foo."\n";
echo $b->foo."\n";

$a->foo = 3;
echo $a->foo."\n";
echo $b->foo."\n";