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

/**
 * [严格判断身份证有效性]
 * @param  [type]  $id_card [description]
 * @return boolean          [description]
 */
function isPeopleId($id_card)
{
    if(strlen($id_card) == 18)
    {
        return idcard_checksum18($id_card);
    }
    elseif((strlen($id_card) == 15))
    {
        $id_card = idcard_15to18($id_card);
        return idcard_checksum18($id_card);
    }else{
        return false;
    }
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard)
{
    if(strlen($idcard) != 18)
    {
        return false;
    }

    $idcard_base = substr($idcard,0,17);  // 前17位主要号码
    $idcard_sex = strtoupper(substr($idcard,17,1)); // 性别号码
    
    if(idcard_verify_number($idcard_base) != $idcard_sex)
    {
        return false;
    }
    else
    {
        return true;
    }
}
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base)
{
    if(strlen($idcard_base) != 17)
    {
        return false;
    }

    //加权因子
    $factor = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
    //校验码对应值
    $verify_number_list = array('1','0','X','9','8','7','6','5','4','3','2');
    $checksum = 0;

    for($i=0;$i<strlen($idcard_base);$i++)
    {
        // 变量每一位号码
        $checksum += substr($idcard_base,$i,1) * $factor[$i];
    }

    $mod=$checksum % 11;
    $verify_number = $verify_number_list[$mod];

    return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard)
{
    if(strlen($idcard) != 15)
    {
        return false;
    }
    else
    {
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        $special_code = substr($idcard,12,3);   // 最后三位
        
        if(array_search($special_code, array('996','997','998','999')) !== false)
        {
            $idcard=substr($idcard,0,6).'18'.substr($idcard,6,9);
        }
        else
        {
            $idcard=substr($idcard,0,6).'19'.substr($idcard,6,9);
        }
    }

    $idcard = $idcard.idcard_verify_number($idcard);
    
    return $idcard;
}

/**
 * [简单判断身份证有效性]
 * @param  [type]  $id_card [description]
 * @return boolean          [description]
 */
function isPeoplesId($id_card)
{
    $pattern = '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/';
    $res = preg_match($pattern, $id, $matches);
    // $res 结果是0,不是手机号码,否则返回1
    if($res) return true;
    return false;
}
?>