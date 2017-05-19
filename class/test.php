<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/8
 * Time: 17:46
 */
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    public function sayHello() {
        //parent::sayHello();
        echo 'World!';
    }
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();