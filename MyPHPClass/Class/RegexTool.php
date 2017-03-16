<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2015/11/25 0020
 * Time: 下午 16:08
 * Description: 正则表达式工具类
 */
class RegexTool{
	private $reg = array(
				'require'   =>  '/.+/',
				'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
				'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
				'currency'  =>  '/^\d+(\.\d+)?$/',
				'number'    =>  '/^\d+$/',
				'zip'       =>  '/^\d{6}$/',
				'integer'   =>  '/^[-\+]?\d+$/',
				'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
				'english'   =>  '/^[A-Za-z]+$/',
				'qq'		=>	'/^\d{5,11}$/',
				'mobile'	=>	'/^1(3|4|5|7|8)\d{9}$/',
			);
}
?>