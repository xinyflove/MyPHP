<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/8/30
 * Time: 16:18
 */
abstract class AbstractClass{
    // 强制要求子类定义这些方法
    abstract protected function getValue();
    abstract protected function prefixValue($prefix);

    // 普通方法（非抽象方法）
    public function printOut()
    {
        print $this->getValue() . "\n";
    }
}

class ConcreteClass1 extends AbstractClass{

    protected function getValue()
    {
        return "ConcreteClass1";
    }

    protected function prefixValue($prefix)
    {
        return "{$prefix}ConcreteClass1";
    }
}

class ConcreteClass2 extends AbstractClass{

    protected function getValue()
    {
        return "ConcreteClass2";
    }

    protected function prefixValue($prefix)
    {
        return "{$prefix}ConcreteClass2";
    }
}
