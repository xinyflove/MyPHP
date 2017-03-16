<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/11
 * Time: 20:43
 * 分页
 */

namespace Libs\Core;


class Page {
    
    // 总行数/一共有多少条数据[从数据库获取]
    public $totalRows;
    // 起始行数
    public $firstRow = 1;
    // 默认列表每页显示行数
    public $listRows;
    // 分页总页面数
    public $totalPages;
    // 分页栏每页显示的页数[开发者定义]
    public $rollPage   = 5;
    // 分页的栏的总页数
    protected $coolPages;
    // 当前页数[用户输入]
    private $nowPage;
    // 分页URL地址
    private $url;

    public function __construct($totalRows, $listRows)
    {
        preg_match('/p\d+/', $_SERVER['REQUEST_URI'], $matches);
        $this -> totalRows = $totalRows;
        $this -> listRows = $listRows;
        $this -> url = $this -> getUrl($matches);
        $this -> nowPage = $this -> getNowPage($matches);
        $this -> firstRow = $this->listRows * ($this->nowPage - 1);
    }

    private function getNowPage($matches)
    {
        $num = 1;
        if(!empty($matches)) 
        {
            $num = intval(substr($matches[0], 1));
        }
        return $num > 0 ? $num : 1;
    }

    private function getUrl($matches)
    {
        $url = $_SERVER['REQUEST_URI'];
        if(!empty($matches)) 
        {
            $url = str_replace($matches[0], '', $url);
        }
        $url_last = substr($url,-1,1);
        if($url_last != '/') $url .= '/';
        return $url;
    }

    public function show()
    {
        if(0 == $this->totalRows) return '';

        $this -> totalPages = ceil($this -> totalRows / $this -> listRows);
        $this -> coolPages = ceil($this -> totalPages / $this -> rollPage);
        $nowCoolPage    =   ceil($this->nowPage/$this->rollPage);

        //var_dump($nowCoolPage);
        //var_dump($this -> coolPages);

        //上下翻页字符串
        $upRow          =   $this->nowPage-1;
        $downRow        =   $this->nowPage+1;
        if($upRow >0)
        {
            $upPage     =   '<a href="'.$this -> url . 'p' . $upRow.'"><</a> ';
        }
        else
        {
            $upPage = '';
        }
        if($downRow <= $this->totalPages)
        {
            $downPage   =   '<a href="'.$this -> url . 'p' . $downRow.'">></a> ';
        }
        else
        {
            $downPage   =   '';
        }

        // <<  >>
        if($nowCoolPage == 1)
        {
            $theFirst   =   '';
            $prePage    =   '';
        }
        else
        {
            $preRow     =   ($nowCoolPage - 2) * $this -> rollPage + 1;
            $prePage    =   '<a href="'.$this -> url . 'p' . $preRow .'"><<</a> ';
            $theFirst   =   '<a href="'.$this -> url . 'p1">首页</a> ';
        }
        if($nowCoolPage == $this->coolPages)
        {
            $nextPage   =   '';
            $theEnd     =   '';
        }
        else
        {
            $nextRow    =   $nowCoolPage * $this -> rollPage + 1;
            $theEndRow  =   ($this -> coolPages - 1) * $this -> rollPage + 1;
            $nextPage   =   '<a href="'.$this -> url . 'p' . $nextRow .'">>></a> ';
            $theEnd     =   '<a href="'.$this -> url . 'p' . $theEndRow .'">尾页</a> ';
        }

        $link_page = '';
        for ($i=1; $i <= $this -> rollPage; $i++) {
            $page       =   ($nowCoolPage-1)*$this->rollPage+$i;

            if($page > $this -> totalPages) break;

            if($page == $this -> nowPage)  $link_page .= $page .' ';
            else $link_page .= '<a href="'.$this -> url . 'p' . $page.'">'. $page .'</a> ';
        }

        return $this -> totalRows . '条记录，' . $theFirst.$prePage . $upPage . $link_page . $downPage.$nextPage.$theEnd . '总页数'.$this -> totalPages;
    }
}