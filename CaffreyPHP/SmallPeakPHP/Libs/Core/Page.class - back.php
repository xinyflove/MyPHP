<?php
/**
 * Created by PhpStorm.
 * User: SmallPeak
 * Date: 2015/5/11
 * Time: 20:43
 * 分页ing
 */

namespace Libs\Core;


class Page {
    public $count;      #结果总数
    public $page;       #当前页
    public $pagesize;   #每页结果数
    public $pagecount;  #翻页数
    public $baseurl;    #url
    public $result;     #结果数组集
    public $pagelist;   #每翻页数

    //构造函数，初始化变量
    function __construct( $count , $page , $pagesize , $pagelist , $baseurl = false )
    {
        $this->count     = $count;
        $this->page      = $page;
        $this->pagesize  = $pagesize;
        $this->baseurl   = isset($baseurl) ? $baseurl : $this->__geturl();
        $this->pagelist = $pagelist;
    }

    #获得当前url
    function __geturl()
    {
        return ereg_replace("(^|&)page={}","",$_SERVER['QUERY_STRING']);
    }

    #获得分页列表
    function __getpagelist()
    {
        $this->result['count'] = $this->count;
        $this->result['page'] = $this->page;
        $this->result['pagesize'] = $this->pagesize;
        $this->result['pagecount'] = ceil($this->count/$this->pagesize);
        if($this->result['pagecount']<=1) //只有一页以下
        {
            $this->result['pagelist'] = 0;
        }
        else //一页以上
        {
            #前一页，第一页的算法
            $this->result['first'] = ($this->page == 1) ? 0 : 1;
            $this->result['pre'] = ($this->page == 1) ? 0 : 1;
            #后一页，最后一页的算法
            $this->result['next'] = ($this->page == $this->pagecount ) ? 0 : 1;
            $this->result['last'] = ($this->page == $this->pagecount ) ? 0 : 1;



            #起始
            $pagearray = array();
            $start = floor(($this->page-1)/10)*10+1;
            for($i=0;$i<10;$i++)
            {
                if( ($start+$i) <= $this->result['pagecount'])
                {
                    $pagearray[$i]['page'] = $start+$i;
                }
                if( ($start+$i) != $this->page )
                {
                    $pagearray[$i]['link'] = 1;
                }
            }
            #分页导航列表
            $this->result['pagelist'] = $pagearray;
            $this->result['baseurl'] = $this->baseurl;
        }
    }

    function getpagelist()
    {
        $this -> result =  $this->count .'条记录' . '';
    }
}