<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2016/9/8
 * Time: 17:13
 */

class Saler implements SplSubject{

    // 注册观察者
    private $_observers;
    private $_price = 0;

    public function __construct()
    {
        $this->_observers = array();
    }

    /**
     * Attach an SplObserver
     * @link http://php.net/manual/en/splsubject.attach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to attach.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer)
    {
        $this->_observers[] = $observer;
    }

    /**
     * Detach an observer
     * @link http://php.net/manual/en/splsubject.detach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to detach.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer)
    {
        if($idx = array_search($observer, $this->_observers, true))
        {
            unset($this->_observers[$idx]);
        }
    }

    /**
     * Notify an observer
     * @link http://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify()
    {
        if(!empty($this->_observers))
        {
            foreach($this->_observers as $observer)
            {
                $observer->doActor($this);
            }
        }
    }

    public function setPrice($price){
        $this->_price = $price;
    }

    public function getPrice(){
        return $this->_price;
    }
}

abstract class Buyer implements SplObserver{
    abstract function doActor(Saler $saler);
}

class PoorBuyer extends Buyer{

    /**
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $subject)
    {
        // TODO: Implement update() method.
    }

    function doActor(Saler $saler)
    {
        // TODO: Implement doActor() method.
    }
}

interface test {
    const name = 'hello';
}

class tt implements test{
    
}