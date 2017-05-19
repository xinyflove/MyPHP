<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/9
 * Time: 14:14
 * 类的属性
 */
class Property{

    public $nickname = '辛小峰';
    protected $name = '辛玉峰';
    private $age = '27';
    public static $gender = 'man';
    public $eod = <<<'EOD'
hello world
!
EOD;

    public function foo(){
        $this->nickname = '小峰';
        $this->name = '玉峰';
        $this->age = '28';
        self::$gender = 'man';
    }
}

echo Property::$gender;
$p = new Property();
echo $p->nickname;
echo $p->eod;
