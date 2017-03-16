<?php

class AdminController{

	public $auth = '';

	public function __construct()
	{
		// 判断当前是否已经登录 -> auth模型去处理

		// 如果不是登录页，而且没有登录，就要跳转到登录页
		$authobj = M('auth');
		$this -> auth = $authobj -> getauth();

		if(empty($this -> auth) && (METHOD != 'login'))
		{
			$this -> showmessage('请登录后再操作！', 'index.php?c=admin&m=login');
		}
	}

	function index()
	{
		//echo 'this admin '.__METHOD__;
		$newsobj = M('news');
		$newsnum = $newsobj -> count();
		\Libs\Core\ViewFactory::assign(array('newsnum' => $newsnum));
		\Libs\Core\ViewFactory::assign('auth_info', $_SESSION['auth']);
		\Libs\Core\ViewFactory::display('index.html');
	}

	function login()
	{
		// 登录页面
		if($_POST)
		{
			// 进行登录处理
			//var_dump($_POST);
			// 登录处理的业务逻辑放在Admin auth 模型里面
			// admin 同表名的模型：从数据库取用户信息
			// auth 模型：进行用户信息的核对
			// -->把一系列的登录处理操作拆分到新的方法里面去
			$this -> checklogin();
		}
		else
		{
			// 显示登录界面
			\Libs\Core\ViewFactory::display('login.html');
		}
	}

	public function logout(){
		$authobj = M('auth');
		$authobj -> logout();
		$this->showmessage('退出成功！', 'index.php?c=admin&m=login');
	}

	private function checklogin()
	{
		$authobj = M('auth');
		if($authobj -> loginsubmit())
		{
			//header("refresh:3;url=index.php?c=admin&m=index");
			echo 1;
			//header("location: index.php?c=admin");

			//$this -> showmessage('登录成功', 'index.php?c=admin&m=index');
		}
		else
		{
			echo 0;die;
			$this -> showmessage('登录失败', 'index.php?c=admin&m=login');
		}
	}

	public function newsadd()
	{
		// 判断是否有post数据 没有post数据，显示添加、修改界面
		if(empty($_POST))
		{
			if(isset($_GET['id']))
			{
				$data = M('news') -> getnewsinfo($_GET['id']);
			}
			else
			{
				$data = array();
			}

			\Libs\Core\ViewFactory::assign('data', $data);
			\Libs\Core\ViewFactory::display('newsadd.html');
		}
		else // 进入添加、修改的处理程序
		{
			//var_dump($_POST);
			//var_dump(intval(''));
			 $this -> newssubmit();
		}
	}

	private function newssubmit()
	{
		$newsobj = M('news');
		$res = $newsobj -> newssubmit($_POST);

		if($res == 0)
		{
			$this -> showmessage("操作失败！", "index.php?c=admin&m=newsadd&id={$_POST['id']}");
		}

		if($res == 1)
		{
			$this -> showmessage("添加成功！", "index.php?c=admin&m=newslist");
		}

		if($res == 2)
		{
			$this -> showmessage("修改成功！", "index.php?c=admin&m=newslist");
		}
	}

	public function newslist()
	{
		$page = new \Libs\Core\Page(999 , 12 , 10 , 6 , '?');
		$page->getpagelist();
		$newsobj = M('news');
		$data = $newsobj -> findAll_orderby_dateline();
		if(empty($data)) $data = array();
		\Libs\Core\ViewFactory::assign("page",$page->result);
		\Libs\Core\ViewFactory::assign('data', $data);
		\Libs\Core\ViewFactory::display('newslist.html');
	}

	public function newsdel()
	{
		if($id = intval($_GET['id']))
		{
			$newsobj = M('news');
			$newsobj -> del_by_id($id);
			$this -> showmessage("删除新闻成功", 'index.php?c=admin&m=newslist');
		}
	}

	private function showmessage($info, $url)
	{
		echo "<script>alert('$info');window.location.href='$url'</script>";
		exit;
	}
}
?>