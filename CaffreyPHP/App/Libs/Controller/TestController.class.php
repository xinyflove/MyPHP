<?php
// 控制器

class TestController{

	function show()
	{
		$testModel = M('test');
		$data = $testModel -> get();
		$testView = V('test');
		$testView -> display($data);
	}
}

?>