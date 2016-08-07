<?php
/*
 *判断厂商是否登陆 
 */
class CorpscommonAction extends Action{
	public function _initialize(){
		if (!isset($_SESSION['corps_id'])){
       		$this->assign('jumpUrl','Corps/corpslogin'); // 设置提示后跳转页面
       		$this->error('未登陆，点击返回请登陆');
   		}
		
	}
}