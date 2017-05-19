<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:58
 */

interface A {
    const TYPE = 1;
    public function fooa();
}

interface B {
    public function foob();
}

interface C extends A, B{
    public function fooc();
}

class H implements C{

    public function fooa()
    {
        // TODO: Implement fooa() method.
    }

    public function foob()
    {
        // TODO: Implement foob() method.
    }

    public function fooc()
    {
        // TODO: Implement fooc() method.
    }
}

class I implements A, B{

    public function fooa()
    {
        // TODO: Implement fooa() method.
    }

    public function foob()
    {
        // TODO: Implement foob() method.
    }
}