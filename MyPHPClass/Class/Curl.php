<?php
/**
 * Created by PhpStorm.
 * User: Caffrey Xin
 * Date: 2016/1/28 0028
 * Time: 下午 16:51
 * Description: Crul类
 * Function List:
 * 1.postData 模拟浏览器表单POST数据
 * 2.postJsonData
 */
class Curl {
    private $ch = "";

    /**
     * 构造函数
     * @param $url
     */
    public function __construct($url)
    {
        // 创建一个新cURL资源
        $this -> ch = curl_init();
        // 设置URL
        curl_setopt($this -> ch, CURLOPT_URL, $url);
    }

    public function test()
    {
        // 设置相应的选项
        // 启用时会将头文件的信息作为数据流输出
        //curl_setopt($this -> ch, CURLOPT_HEADER, 0);
        // 抓取URL并把它传递给浏览器
        //curl_exec($this -> ch);
    }

    /**
     * 模拟浏览器表单POST数据
     * @param $fields Array [可选] 要post的数据 e.g.array('user' => 'Caffrey', 'passwd' => '123')
     * @param $file   Array [可选] 要上传的文件 e.g.array('filename1' => 'filepath1', 'filename2' => 'filepath2')
     * return Array()
     *
     * 接收文件示例:
     * var_export($_POST);
     * foreach($_FILES as $k => $upfile) {
     *     $r = move_uploaded_file($upfile["tmp_name"], "upload/" . $upfile["name"]);
     *     var_export($r);
     * }
     * echo 'ok';
     *
     * last replace 2016-02-02
     */
    public function postData($fields = array(), $file = array())
    {
        // 启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表提交的一样
        curl_setopt($this -> ch, CURLOPT_POST, 1);

        if (!empty($file)) {
            // 判断文件是否存在
            foreach ($file as $f_k => $f_path) {
                if (!file_exists($f_path)) {
                    $msg = "文件{$f_path}不存在";
                    return $data = array('code' => 0, 'msg' => $msg);
                }

                $fields[$f_k] = new CURLFile($f_path);
            }

            $param = $fields;
        }
        else {
            $param = "";
            if (is_array($fields))
            {
                $res = array();
                foreach ($fields as $k => $v)
                {
                    $res[] = $k . '=' . urlencode($v);
                }
                if (!empty($res)) $param = join('&', $res);
            }
        }

        /*
         * 全部数据使用HTTP协议中的"POST"操作来发送。要发送文件，在文件名前面加上@前缀并使用完整路径。这个参数可以通过
         * urlencoded后的字符串类似'para1=val1&para2=val2&...'或使用一个以字段名为键值，字段数据为值的数组。
         * 如果value是一个数组，Content-Type头将会被设置成multipart/form-data
         */
        curl_setopt($this -> ch, CURLOPT_POSTFIELDS, $param);

        // 将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
        curl_setopt($this -> ch, CURLOPT_RETURNTRANSFER, 0);
        $data = curl_exec($this -> ch);
        return array('code' => 1, 'msg' => 'SUCCESS', 'data' => $data);
    }

    /**
     * POST JSON数据
     * @param $fields 数组
     * @return String
     * Description 请求处理服务器用file_get_contents("php://input")或$GLOBALS['HTTP_RAW_POST_DATA']接收
     * 但是php://input 不能用于 enctype="multipart/form-data"
     */
    public function postJsonData($fields)
    {
        $data_string = json_encode($fields);
        $http_head = array(
            'Content-Type:application/json'
        );

        curl_setopt($this -> ch, CURLOPT_POST, 1);
        curl_setopt($this -> ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($this -> ch, CURLOPT_HTTPHEADER, $http_head);
        curl_setopt($this -> ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this -> ch, CURLOPT_HEADER, true);

        $data = curl_exec($this -> ch);
        return $data;
    }

    /**
     * 析构函数
     */
    public function __destruct()
    {
        curl_close($this -> ch);
    }
}