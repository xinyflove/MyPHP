<?php

class IndexController{

	function index()
	{
		$newsobj = M('news');
		
		$count = $newsobj -> count();
		$page = new \Libs\Core\Page($count, 2);
		$data = $newsobj -> get_new_list_limit($page -> firstRow, $page -> listRows);
		
		\Libs\Core\ViewFactory::assign('page', $page -> show());
		if(empty($data)) $data = array();
		\Libs\Core\ViewFactory::assign('data', $data);
		\Libs\Core\ViewFactory::display('index.html');
	}

	function newsshow()
	{
		$newsobj = M('news');
		$data = $newsobj -> getnewsinfo($_GET['id']);
		\Libs\Core\ViewFactory::assign('data', $data);
		\Libs\Core\ViewFactory::display('newsshow.html');
	}
}

?>