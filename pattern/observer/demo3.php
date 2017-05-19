<?php
header("Content-type: text/html; charset=utf-8");

//实现注册观察者，删除观察者和通知的功能。
class Saler implements SplSubject {
    // 注册观察者
    private $_observers;
    protected $range = 0;

    public function __construct()
    {
        $this->_observers = array();
    }

    public function attach(SplObserver $observer)
    {
        $this->_observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        if($idx = array_search($observer, $this->_observers, true))
        {
            unset($this->_observers[$idx]);
        }
    }

    public function notify()
    {
        if(!empty($this->_observers))
        {
            foreach($this->_observers as $observer)
            {
                $methods = get_class_methods($observer);
                foreach($methods as $m){
                    $observer->$m($this);
                }
                //$observer->doActor($this);
            }
        }
    }

    public function increPrice($range)
    {
        $this->range = $range;
    }

    public function getAddRange()
    {
        return $this->range;
    }
}


//为了容易阅读，我在这里增加了一层，定义了一个买家， 之后会有Poor和Rich两种不同的类型继承这个类，用以表示不同类型的买家
abstract class Buyer implements SplObserver
{
    abstract public function doActor(SplSubject $subject);
}

class PoorBuyer extends Buyer
{
    //PoorBurer的做法
    public function doActor(SplSubject $subject)
    {
        if($subject->getAddRange() > 10)
            echo  '不买了.<br />';
        else
            echo $subject->getAddRange().'还行，买一点吧.<br />';
    }


    public function update(SplSubject $subject)
    {
        echo 'update info<br />';
    }
}

class RichBuyer extends Buyer
{
    //RichBuyer的做法
    public function doActor(SplSubject $subject)
    {
        echo '你再涨我也不怕，咱不差钱.<br />';
    }

    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
    }
}


$saler = new Saler();  //小贩(被观察者)

$saler->attach(new PoorBuyer()); //注册一个低收入的消费者(观察者)
$saler->attach(new RichBuyer()); //注册一个高收入的消费者(观察者)

$saler->notify(); //通知

$saler->increPrice(20);  //涨价
$saler->notify();        //通知