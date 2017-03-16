<?php
/**
 * User: Caffrey Xin
 * Date: 2015/11/20 0020
 * Time: 下午 16:49
 * Description: 类
 */

class Demo {
	
	// 声明一个公共的成员变量
	public $pub = '';
	
	// 声明一个私有的成员变量
	private $pri = '';
	
	// 声明一个受保护的成员变量
	protected $pro = '';
	
	// 声明一个静态变量
	public static $pubs = '';
	
	// 声明一个常量
	const user = 'Caffrey';
	
	// 定义构造函数，用于初始化赋值
	function __construct(){
		$this -> pub = 'I am a public member variable';
		$this -> pri = 'I am a private member variable';
		$this -> pro = 'I am a protected member variable';
		self :: $pubs = 'I am a public static member variable';
	}
	
	// 析构函数
	function __destruct(){}
	
	// 打印成员函数
	function printMember()
	{
		print $this -> pub;
		echo '<br />';
		print $this -> pri;
		echo '<br />';
		print $this -> pro;
		echo '<br />';
		print self :: $pubs;
		echo '<br />';
	}
	
	// 静态方法
	static function staFun()
	{
		print 'I am a static function';
	}
	
	// 私有方法
	private function priFun()
	{
		print 'I am a private function';
	}
	
	// 受保护的方法
	protected function proFun()
	{
		print 'I am a protected function';
	}
}
?>