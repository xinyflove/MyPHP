<?php
/**
 * Example Application
 *
 * @package Example-application
 * @author  Caffrey Xin
 * @mail    xinyflove@sina.com
 * @time    2016-06-07
 */

require_once( '/config/MySmarty.php' );

$smarty = new MySmarty();

$smarty->assign('name','Ned');
$smarty->display('demo.tpl');
