<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:35
 * 类继承
 */

class Vehicle {

    // 公有的函数，子类只能设置为公有
    public function run(){
        echo '车会跑\n';
    }

    // 受保护的函数，子类可以设为受保护和公有
    protected function belong(){
        echo '属于';
    }

    // 私有函数，子类可以设为受保护和公有和私有
    private function person(){
        echo '归属者';
    }

    // 子类不能重写
    final function test(){
        echo 'final';
    }

    public static function foo(){

    }
}

class Car extends Vehicle{
    public function run(){
        parent::run();
        echo '小车车会跑\n';
    }


    public function belong(){
        parent::belong();
        echo '属于小车';
    }

    public function person(){
        parent::test();
        echo '归属者小车';
    }

    public static function foo(){
        parent::foo();
    }
}

Car::foo();
$c = new Car();
$c->run();