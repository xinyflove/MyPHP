<?php

/**
 * [向ftp上传文件]
 * @param  [type] $remote [目标文件路径]
 * @param  [type] $local  [本地文件路径]
 * @return [type]         [code=1上传失败;code=0长传成功]
 */
function ftp_put_file($remote, $local)
{
	$ftp_host = 'xungeng.vpaas.net';
    $ftp_user = 'root';
    $ftp_pass = 'zehin@123';
    $code = 1;

    $conn_id = ftp_connect($ftp_host);

    if($conn_id)
    {
    	// try to login
    	$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
    	if($login_result)
    	{
    		$source_file = $local;  //源地址
    		$destination_file = $remote;  //目标地址
    		$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);

    		if($upload)
    		{
    			$msg = "success";
    			$code = 0;
    		}
    		else
    		{
    			$msg = "FTP upload has failed!";
    		}
    	}
    	else
    	{
    		$msg = "FTP connection has failed!"."Attempted to connect to $ftp_host for user $ftp_user";
    	}
    }
    else
    {
    	$msg = "无法连接到$ftp_host";
    }

    ftp_close($conn_id);
    return array('code' => $code, 'msg' => $msg);
}

$remote = '/home/wwwroot/xungeng.vpaas.net/sites/'.'text.txt';
$local = '../data/text.txt';
$res = ftp_put_file($remote, $local);
var_export($res);