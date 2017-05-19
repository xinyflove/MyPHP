<?php
/**
 * Example Application
 *
 * @package Example-application
 * @author  Caffrey Xin
 * @mail    xinyflove@sina.com
 * @time    2016-06-08
 */

require_once( '/config/MySmarty.php' );

$smarty = new MySmarty();

$smarty->assign('foo1', 'Caffrey');
$smarty->assign('foo2', array('a', 'b', 'c', 'd', 'e'));
$smarty->assign('foo3', array('bar'=>'Mike'));
$smarty->assign('foo4', array('mike'=>'Mozzie'));
$smarty->assign('bar1', 'mike');
$smarty->assign('foo5', new Foo());

$smarty->display('var.tpl');

class Foo {
	public $name = 'Kate';

	public function getName() {
		return 'Kobe';
	}
}