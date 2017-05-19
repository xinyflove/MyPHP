<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:29
 * 类常量
 */
class Constant{
    const TYPE = 1;
    const bar = <<<'EOT'
bar
EOT;
    
    public function foo(){
        self::TYPE;
        self::bar;
    } 
}

$con = new Constant();
echo $con::TYPE;
echo $con::bar;