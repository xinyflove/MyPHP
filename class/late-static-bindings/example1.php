<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:02
 * self:: 用法
 */
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test();