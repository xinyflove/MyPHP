<?php

/**
 * [curl 方式 获取一个get请求]
 * @param  [type] $url [get链接]
 * @return [type]      [code>0请求失败;code=0请求成功]
 * @tip 支持https链接请求
 */
function file_get_contents_curl($url) {
	$ch = curl_init();	// 初始化一个cURL会话
    curl_setopt($ch, CURLOPT_URL,$url); 	// 需要获取的 URL 地址，也可以在curl_init() 初始化会话的时候。
	curl_setopt($ch, CURLOPT_HEADER, 0);	// 启用时会将头文件的信息作为数据流输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	// TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	//不验证证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	//不验证证书
    $data = curl_exec($ch);	// 执行一个cURL会话

    $curl_errno = curl_errno($ch);  // 返回最后一次的错误号
    $curl_error = curl_error($ch);  // 返回一个保护当前会话最近一次错误的字符串

    curl_close($ch);

    $result = array('code' => $curl_errno);
    if( $curl_errno ){
        // 错误
        $result['msg'] = $curl_error;
        $result['data'] = '';
    }else{
        // 成功
        $result['msg'] = 'success';
        $result['data'] = $data;
    }

    return $result;
}