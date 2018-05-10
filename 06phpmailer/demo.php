<?php
/**
 * Created by PhpStorm.
 * User: Caffrey
 * Date: 2017/4/17
 * Time: 16:49
 * 发送邮件类,依赖PHPMailer
 */

class Myemail{
    private $mail;
    //private $protocol = 'smtp';
    /**
     * 邮件服务器的主机名
     * @var string
     */
    private $smtp_host = 'smtp.sina.com';
    /**
     * 端口
     * @var string
     */
    private $smtp_port = '25';
    /**
     * 帐号
     * @var string
     */
    private $smtp_user = '****test@sina.com';
    /**
     * 密码
     * @var string
     */
    private $smtp_pass = '****123456';
    /**
     * 发送邮箱
     * @var string
     */
    private $smtp_from_mail = '****@sina.com';
    /**
     * 发件人
     * @var string
     */
    private $smtp_from_user = 'Caffrey Service';
    /**
     * 邮件主题
     * @var string
     */
    private $smtp_subject = 'Caffrey Service邮件主题';

    public function __construct()
    {
        // 设置时区
        date_default_timezone_set('PRC');
        // 引入邮件类
        require 'PHPMailer/PHPMailerAutoload.php';
        //Create a new PHPMailer instance
        $this->mail = new PHPMailer;
        $this->init();
    }

    /**
     * [发送邮件]
     * @param  [type] $subject [description]
     * @param  [type] $to      [description]
     * @param  [type] $name    [description]
     * @param  [type] $msg     [description]
     * @return [type]          [description]
     */
    public function sendmail($subject, $to, $name, $msg)
    {
        $this->smtp_subject = $subject;
        //Set who the message is to be sent to
        $this->mail->addAddress($to, $name);
        //Set the subject line
        $this->mail->Subject = $this->smtp_subject;
        
        $this->mail->MsgHTML($msg);

        if (!$this->mail->send()) {
            return array('code'=>1, 'msg'=>$this->mail->ErrorInfo);
            //echo "Mailer Error: " . $this->mail->ErrorInfo;
        } else {
            //echo "Message sent!";
            return array('code'=>0, 'msg'=>'Message sent!');
        }
    }
    
    /**
     * [测试邮件]
     * @param  [type] $to   [description]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function test($to, $name)
    {
        //Set who the message is to be sent to
        $this->mail->addAddress($to, $name);
        //Set the subject line
        $this->mail->Subject = $this->smtp_subject;
        $body = '这是一条测试邮件，请勿回复！';
        $this->mail->MsgHTML($body);

        if (!$this->mail->send()) {
            echo "Mailer Error: " . $this->mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

    /**
     * 测试链接SMTP
     */
    function testConnectSMTP()
    {
        $smtp = new SMTP;

        //Enable connection-level debug output
        $smtp->do_debug = SMTP::DEBUG_CONNECTION;

        try {
            //Connect to an SMTP server
            if (!$smtp->connect($this->smtp_host, $this->smtp_port)) {
                throw new Exception('Connect failed');
            }
            //Say hello
            if (!$smtp->hello(gethostname())) {
                $res_msg = $smtp->getError();
                throw new Exception('EHLO failed: ' . $res_msg['error']);
            }
            //Get the list of ESMTP services the server offers
            $e = $smtp->getServerExtList();
            //If server can do TLS encryption, use it
            if (is_array($e) && array_key_exists('STARTTLS', $e)) {
                $tlsok = $smtp->startTLS();
                if (!$tlsok) {
                    $res_msg = $smtp->getError();
                    throw new Exception('Failed to start encryption: ' . $res_msg['error']);
                }
                //Repeat EHLO after STARTTLS
                if (!$smtp->hello(gethostname())) {
                    $res_msg = $smtp->getError();
                    throw new Exception('EHLO (2) failed: ' . $res_msg['error']);
                }
                //Get new capabilities list, which will usually now include AUTH if it didn't before
                $e = $smtp->getServerExtList();
            }
            //If server supports authentication, do it (even if no encryption)
            if (is_array($e) && array_key_exists('AUTH', $e)) {
                if ($smtp->authenticate($this->smtp_user, $this->smtp_pass)) {
                    echo "Connected ok!";
                } else {
                    $res_msg = $smtp->getError();
                    throw new Exception('Authentication failed: ' . $res_msg['error']);
                }
            }
        } catch (Exception $e) {
            echo 'SMTP error: ' . $e->getMessage(), "\n";
        }
        //Whatever happened, close the connection.
        $smtp->quit(true);
    }

    /**
     * 初始化
     * @throws phpmailerException
     */
    private function init()
    {
        $this->mail->CharSet    ="UTF-8";
        //Tell PHPMailer to use SMTP;通知PHPMailer用SMTP协议
        $this->mail->isSMTP();
        //Enable SMTP debugging;使SMTP调试
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $this->mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $this->mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $this->mail->Host = $this->smtp_host;
        //Set the SMTP port number - likely to be 25, 465 or 587
        $this->mail->Port = $this->smtp_port;
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;
        //Username to use for SMTP authentication
        $this->mail->Username = $this->smtp_user;
        //Password to use for SMTP authentication
        $this->mail->Password = $this->smtp_pass;
        //Set who the message is to be sent from
        $this->mail->setFrom($this->smtp_from_mail, $this->smtp_from_user);
        //Set an alternative reply-to address
        $this->mail->addReplyTo('', '');
        //Replace the plain text body with one created manually
        //当邮件不支持html时备用显示，可以省略
        $this->mail->AltBody = 'This is a plain-text message body';
    }
}

// 调用
$mail = new Myemail();
// 测试链接
//$mail->testConnectSMTP();
// 发送测试邮件
//$mail->test('****@qq.com', '***');
// 发送邮件
//$mail->sendmail('Email Subject', '*****@qq.com', '***', '邮件内容哈哈');
?>