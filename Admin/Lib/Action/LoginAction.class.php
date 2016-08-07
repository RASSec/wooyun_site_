<?php
/*
 * 后台登陆
 */
class LoginAction extends Action{
	function index(){
		echo $this->display('index');
	}
	
	function test(){
		echo $this->display('test');
	}
	
	/**
	 * 检查管理员登陆
	 */
	public function checklogin(){
		 if($_SESSION['verify'] != md5($_POST['code'])) {
		 	  $this->assign('jumpUrl','Login'); // 设置提示后跳转页面
		      $this->error('验证码错误！,请点击返回');
 		}
		$admins	=	new AdminsModel();
		if($admins->autoCheckToken($_POST)){
			if ($admins->create()){
				$uname	=	trim($_POST['uname']);
				$passwd	=	md5($_POST['passwd']);
				import("ORG.Input");
				$uname	=	Input::getVar($uname);
				$result	=	$admins->where('exp_username="'.$uname.'"')->find();
				if ($result['exp_password']==$passwd){
					if ($result['status']=='0'){
						$this->assign('jumpUrl','Login'); // 设置提示后跳转页面
						$this->error("您的账号已经被锁定,请点击返回");
					}else{
						$_SESSION['admin_username'] = $uname;
						$_SESSION['uid'] = $uname;
						$this->assign('jumpUrl','Index'); // 设置提示后跳转页面
						$this->error("您已经成功登陆后台");
					}
				}else{
					$this->assign('jumpUrl','Login'); // 设置提示后跳转页面
					$this->error("用户名或密码错误,请点击返回");
				}
			}else{
				$this->assign('jumpUrl','Login'); // 设置提示后跳转页面
       			$this->error($admins->getError());
			}
		}else{
			$this->assign('jumpUrl','Login'); // 设置提示后跳转页面
			$this->error("登陆出错");
		}
	}
	//验证码
	public function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Image");
        Image::buildImageVerify(4,1,$type);
	}
	/**
	 * 退出系统
	 */
	public function loginout(){
		if($_SESSION['admin_username']!=''){
			unset($_SESSION['admin_username']);
			$this->assign('jumpUrl','Login'); // 设置提示后跳转页面
			$this->error("您已经成功退出系统");
			
		}
	} 
}