<?php
header("Content-type: text/html; charset=utf-8");
/**
 * Class User
 * 用户登陆-诠释观察者模式
 */
class User implements SplSubject  {

	// 注册观察者
	private $_observers;

	public $type;
	public $email = '944857599@qq.com';
	public $title = '通知';
	public $content = '内容信息';

	// 动作类型
	const OBSERVER_TYPE_REGISTER = 1;	// 注册
	const OBSERVER_TYPE_EDIT     = 2;   // 编辑

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
                $this->email = $observer->email;
                $this->title = $observer->title;
                $this->content = $observer->content;

				$observer->update($this);
			}
		}
	}

	public function addUser()
	{
		//执行sql
		//数据库插入成功
		$res = true;
		//调用通知观察者
		$this->type = self::OBSERVER_TYPE_REGISTER;
		$this->notify();
		return $res;
	}

	public function editUser()
	{
		//执行sql
		//数据库更新成功
		$res = true;
		//调用通知观察者
		$this->type = self::OBSERVER_TYPE_EDIT;
		$this->notify();
		return $res;
	}
}

class SendMail implements SplObserver
{
	public $email;
	public $title;
	public $content;

	public function __construct($mail_info)
	{
		$this->email = $mail_info['email'];
		$this->title = $mail_info['title'];
		$this->content = $mail_info['content'];
	}

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
		$this->sendEmail($subject->email, $subject->title, $subject->content);
	}

	public function sendEmail($email, $title, $content)
	{
		//调用邮件接口，发送邮件
		echo '邮件地址:'.$email.';主题:'.$title.';内容:'.$content.'<br/>';
	}
}

$user = new User();

$send_mail1 = new SendMail(array('email'=>'2088867845@qq.com','title'=>'通知1','content'=>'内容1'));
$user->attach($send_mail1);
$user->addUser();

$send_mail2 = new SendMail(array('email'=>'xinyflove@sina.com','title'=>'通知2','content'=>'内容2'));
$user->attach($send_mail2);
$user->addUser();