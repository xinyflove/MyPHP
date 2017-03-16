<?php
// 模型

class NewsModel{

	public $_table = 'news';

	function count()
	{
		$sql = 'select count(*) from ' . $this -> _table;
		return \Libs\Core\DbFactory::findResult($sql,0,0);
	}

	public function getnewsinfo($id)
	{
		if(empty($id))
		{
			return array();
		}
		else
		{
			$id = intval($id);
			$sql = "select * from " . $this -> _table . " where id = {$id}";
			return \Libs\Core\DbFactory::findOne($sql);
		}
	}

	function newssubmit($data)
	{
		extract($data);
		if(empty($title) || empty($content))
		{
			return 0;
		}

		$title = addslashes($title);
		$content = addslashes($content);
		$author = addslashes($author);
		$from = addslashes($from);
		$id = intval($id);
		$data = array(
			'title' => $title,
			'content' => $content,
			'author' => $author,
			'from' => $from,
			'dateline' => time()
			);

		// 区分添加修改
		if($id != 0)
		{
			\Libs\Core\DbFactory::update($this -> _table, $data, "id={$id}");
			return 2;
		}
		else
		{
			\Libs\Core\DbFactory::insert($this -> _table, $data);
			return 1;
		}
	}

	function findAll_orderby_dateline()
	{
		$sql = 'select * from ' . $this -> _table . ' order by dateline desc';
		return \Libs\Core\DbFactory::findAll($sql);
	}

	function findAll_orderby_dateline_limit($firstRow, $listRows)
	{
		$sql = 'select * from ' . $this -> _table . ' order by dateline desc limit ' . "{$firstRow},{$listRows}";
		return \Libs\Core\DbFactory::findAll($sql);
	}

	function del_by_id($id)
	{
		return \Libs\Core\DbFactory::del($this -> _table, "id={$id}");
	}

	function get_news_list()
	{
		$data = $this -> findAll_orderby_dateline();
		foreach ($data as $k => $news) {
			// strip_tags() 函数剥去 HTML、XML 以及 PHP 的标签
			// mb_substr截取中文
			$data[$k]['content'] = mb_substr(strip_tags($data[$k]['content']), 0, 200);
			$data[$k]['dateline'] = date('Y-m-d H:i:s', $data[$k]['dateline']);
		}
		return $data;
	}

	function get_new_list_limit($firstRow, $listRows)
	{
		$data = $this -> findAll_orderby_dateline_limit($firstRow, $listRows);
		foreach ($data as $k => $news) {
			$data[$k]['content'] = mb_substr(strip_tags($data[$k]['content']), 0, 200);
			$data[$k]['dateline'] = date('Y-m-d H:i:s', $data[$k]['dateline']);
		}
		return $data;
	}
}

?>