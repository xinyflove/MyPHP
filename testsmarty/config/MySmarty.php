<?php
/**
 * Example Application
 *
 * @package Example-application
 * @author  Caffrey Xin
 * @mail    xinyflove@sina.com
 * @time    2016-06-08
 */

// load Smarty library
require_once( 'libs/Smarty.class.php' );

class MySmarty extends Smarty {

  function __construct()
  {
    parent::__construct();

    $this->setTemplateDir( 'demo/templates/' );
    $this->setCompileDir( 'demo/templates_c/' );
    $this->setConfigDir( 'demo/configs/' );
    $this->setCacheDir( 'demo/cache/' );

    //$this->testInstall(); // 测试目录是否存在和可读写

    $this->force_compile = true;  // 强迫编译,用于调试
    //$this->debugging = true;    // debug调试
    $this->caching = true;      //开启缓存
    $this->cache_lifetime = 120;    //缓存存活时间（秒）

    // 定界符默认是{},但是与css样式定界符一样,所以用<{}>
    $this->left_delimiter = '<{'; // 左定界符
    $this->right_delimiter = '}>'; // 右定界符
  }
}
?>