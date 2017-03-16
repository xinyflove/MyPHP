<?php
/**
 * 其他常用函数整理
 */

/**
 * 是否移动端访问访问
 * @return boolean [返回true是移动端]
 * Auth: Caffrey Xin
 * Time: 2016-10-24
 */
function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
	
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
	
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array (
			'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
        );
		
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
	
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}

/**
 * 重定向页面
 * @param  [type] $url [目标页面链接]
 * @return [type]      [无返回值]
 * Auth: Caffrey Xin
 * Time: 2016-10-24
 */
function redirect($url)
{
	header("Location: {$url}");
    //确保重定向后，后续代码不会被执行
    exit;
}

/**
 * [判断是否是手机号码]
 * @param  [type]  $phoneNumber [手机号码]
 * @return boolean              [返回true是手机号码]
 */
function isPhoneNumber($phoneNumber) 
{
    $pattern = '/^1[34578]\d{9}$/';
    $res = preg_match($pattern, $phoneNumber, $matches);
    // $res 结果是0,不是手机号码,否则返回1
    if($res) return true;
    return false;
}

/**
 * [判断是否是邮件地址]
 * @param  [type]  $mailAddr [邮件地址]
 * @return boolean           [返回true是邮件地址]
 */
function isMailAddr($mailAddr)
{
    $res = filter_var($mailAddr, FILTER_VALIDATE_EMAIL);
    // $res 结果是false,不是邮件地址,否则返回邮件地址
    if($res) return true;
    return false;
}

/**
 * [判断是否是IP地址]
 * @param  [type]  $ipAddr [IP地址]
 * @return boolean         [返回true是IP地址]
 */
function isIpAddr($ipAddr)
{
    $res = filter_var($ipAddr, FILTER_VALIDATE_IP);
    // $res 结果是false,不是IP地址,否则返回IP地址
    if($res) return true;
    return false;
}

/**
 * [判断链接地址是否含有http或https]
 * @param  [type]  $urlAddr [description]
 * @return boolean          [description]
 */
function isHasHttp($urlAddr)
{
    $pattern = '/^http:.+|https:.+/';
    $res = preg_match($pattern, $urlAddr, $matches);
    // $res 结果是false,不含有http或https,否则返回Url地址
    if($res) return true;
    return false;
}
?>