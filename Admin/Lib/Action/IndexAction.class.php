<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends CommonAction
{
	public function login(){		
		echo $this->display('login');
	}
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
    	//print_r($_SESSION);
    	
        $this->display('index');
    }

    /**
     * 头部框架
     */
    public function topframe(){
    	
    	echo $this->display('topframe');
    }
    
    /**
     * 左侧框架
     */
    public function leftframe(){
    	echo $this->display('leftframe');
    }
    
    /**
     * 中间框架
     */
    public function mainframe(){
    	
    	echo $this->display('mainframe');
    	
    }
    
	/**
	 * 转换框架
	 */
    public function switchframe(){
    	echo $this->display('switchframe');
    }
    /**
     * 首页页面
     */
    public function manframe(){
    	$this->assign('phpversion',PHP_VERSION);
    	$this->assign('getapache',apache_get_version());
    	$gd	=	gd_info();
    	$this->assign('gd',$gd['GD Version']);
    	echo $this->display('manframe');
    	
    }
}
?>