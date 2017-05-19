<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:04
 * 非静态环境下使用 static::
 */
class A {
    private function foo() {
        echo "success!\n";
    }
    public function test() {
        $this->foo();
        //static::foo();
    }
}

class B extends A {
    /* foo() will be copied to B, hence its scope will still be A and
     * the call be successful */
}

class C extends A {
    private function foo() {
        /* original method is replaced; the scope of the new one is C */
        echo 'succ\n';
    }
}

$b = new B();
$b->test();
$c = new C();
$c->test();   //fails