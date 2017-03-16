<?php

/**
 * [curl 方式 获取一个post请求]
 * @param  string $url       [post链接]
 * @param  string $post_data [键值数组或者key=val&key2=val2]
 * @return [type]            [code>0请求失败;code=0请求成功]
 */
function request_post($url = '', $post_data = '') {
    if (empty($url) || empty($post_data)) {
        return false;
    }

    $postUrl = $url;
    $curlPost = $post_data;

    $ch = curl_init();//初始化curl
    $this_header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
    // 设置 HTTP 头字段的数组。格式： array('Content-type: text/plain', 'Content-length: 100')
    curl_setopt($ch, CURLOPT_HTTPHEADER,$this_header);
    // 需要获取的 URL 地址，也可以在curl_init() 初始化会话的时候。
    curl_setopt($ch, CURLOPT_URL,$postUrl);
    // 启用时会将头文件的信息作为数据流输出
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // TRUE 时会发送 POST 请求，类型为：application/x-www-form-urlencoded，是 HTML 表单提交时最常见的一种。
    curl_setopt($ch, CURLOPT_POST, 1);
    // 提交数据
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    // 设置超时 秒
    curl_setopt($ch, CURLOPT_TIMEOUT,15);
    // 执行一个cURL会话
    $data = curl_exec($ch);

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