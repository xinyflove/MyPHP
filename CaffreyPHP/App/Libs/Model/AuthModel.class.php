<?php
// 模型

class AuthModel{

	private $auth = ''; // 当前管理员的信息

	public function __construct()
	{
		if(isset($_SESSION['auth']) && (!empty($_SESSION['auth'])))
		{
			$this -> auth = $_SESSION['auth'];
		}
	}

	// 进行登录验证的一系列业务逻辑
	public function loginsubmit()
	{
		if(empty($_POST['uname']) || empty($_POST['upasswd']))
		{
			return false;
		}

		$uname = addslashes($_POST['uname']);
		$upasswd = addslashes($_POST['upasswd']);

		// 用户验证操作 -> 拆分到另外一个方法里面去写，减少这个方法的代码量
		if($this -> auth = $this -> checkuser($uname, $upasswd))
		{
			$_SESSION['auth'] = $this -> auth;
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getauth()
	{
		return $this -> auth;
	}

	private function checkuser($uname, $upasswd)
	{
		$adminobj = M('user');
		$auth = $adminobj -> findOne_by_username($uname);

		if((!empty($auth)) && $auth['upasswd'] == md5($upasswd))
		{
			return $auth;
		}
		else{
			return false;
		}
	}

	public function logout(){
		unset($_SESSION['auth']);
		$this -> auth ='';
	}
}

?>