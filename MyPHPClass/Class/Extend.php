<?php
/**
 * User: Caffrey Xin
 * Date: 2015/11/20 0020
 * Time: 下午 16:49
 * Description: 继承类
 */
class Animal {
	// 基类的属性，名字$name
	public $name;

	// 基类的构造函数，初始化赋值
	public function __construct($name)
	{
		 $this->name = $name;
	}
	
	function eyes()
	{
		echo 'Animal have eyes';
	}
}

class Person extends Animal
{
	//对于派生类，新定义了属性$personSex性别、$personAge年龄
	public static $personSex;       
	public $personAge;

	//派生类的构造函数
	function __construct( $personSex, $personAge )
	{
		//使用parent调用了父类的构造函数
		parent :: __construct("Caffrey");
		
		self :: $personSex = $personSex;
		$this -> personAge = $personAge;
	}

	//派生类的成员函数，用于打印，格式：名字 is name,age is 年龄
	function printPerson()
	{
		print( $this->name. " is ".self :: $personSex. ",age is ".$this->personAge );
	}
	
	function eyes()
	{
		// 重写父类的eyes方法，也可以调用父类eyes方法
		parent :: eyes();
		echo 'Person hava eyes';
	}
}
?>