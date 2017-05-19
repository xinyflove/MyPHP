<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/7
 * Time: 22:56
 */

interface Subject {

    public function attach(Observer $observer);

    public function detach(Observer $observer);

    public function notifyObservers();
}

class ConcreteSubject implements Subject {

    private $_observers;

    public function __construct()
    {
        $this->_observers = array();
    }

    public function attach(Observer $observer)
    {
        return $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $index = array_search($observer, $this->_observers, true);
        if($index === FALSE || !array_key_exists($index, $this->_observers)){
            return FALSE;
        }

        unset($this->_observers[$index]);
        return TRUE;
    }

    public function notifyObservers()
    {
        if(!is_array($this->_observers)){
            return FALSE;
        }

        foreach ($this->_observers as $observer){
            $observer->update();
        }

        return TRUE;
    }
}

interface Observer {
    public function update();
}

class ConcreteObserver implements Observer {

    private $_name;

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function update()
    {
        echo 'Observer:',$this->_name,' has notified.<br />';
    }
}

$subject = new ConcreteSubject();
/* 添加第一个观察者 */
$observer1 = new ConcreteObserver('Martin');
$subject->attach($observer1);
echo '<br /> The First notify:<br />';
$subject->notifyObservers();
/* 添加第二个观察者 */
$observer2 = new ConcreteObserver('phppan');
$subject->attach($observer2);
echo '<br /> The Second notify:<br />';
$subject->notifyObservers();
/* 删除第一个观察者 */
$subject->detach($observer1);
echo '<br /> The Third notify:<br />';
$subject->notifyObservers();