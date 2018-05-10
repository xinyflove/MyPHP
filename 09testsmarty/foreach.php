<?php 

require_once( '/config/MySmarty.php' );

$smarty = new MySmarty();

$list = array(
	array(
			'name' => 'Mike',
			'age' => '30',
			'mail' => 'mike@aa.com'
		),
	array(
			'name' => 'Peak',
			'age' => '27',
			'mail' => 'peak@aa.com'
		),
	array(
			'name' => 'Caffrey',
			'age' => '26',
			'mail' => 'caffrey@aa.com'
		),
	);
$smarty->assign('list', $list);
$smarty->display('foreach.tpl');

?>