<?php
/*
 *判断会员是否登陆 
 */
class CommonAction extends Action{
	public function _initialize(){
		if (!isset($_SESSION['username'])){
       		$this->assign('jumpUrl','Whitehats/userlogin'); // 设置提示后跳转页面
       		$this->error('未登陆，点击返回请登陆');
   		}
		
	}
}