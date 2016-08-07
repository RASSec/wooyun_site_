<?php
/*
 * 会员后台控制面板
 */
class MemberAction extends CommonAction{
	/**
	 * 显示首页控制面板
	 */
	public function index(){
		$username	=	Session::get("username");
		$users	=	new UsersModel();
		
		$result	=	$users->where('exp_username="'.$username.'"')->find();
		$this->assign('sessioname',$username);
		$this->assign('vo',$result);
		echo $this->display('index');
	}
	
	/**
	 * 退出登陆
	 */
	public function loginout(){
		if($_SESSION['username']!=''){
			unset($_SESSION['username']);
			$this->assign('jumpUrl','Whitehats/userlogin'); // 设置提示后跳转页面
			$this->error("您已经成功退出系统");
		}
	}
	
	/**
	 * 编辑信息
	 */
	public function editinfo(){
		$users	=	new UsersModel();
		if($users->autoCheckToken($_POST)){
			import("ORG.Input");
			$id	=	Session::get("id");
			$data['exp_homepage']	=	htmlspecialchars($_POST['homepage']);
			$data['exp_userprofile']	=	htmlspecialchars($_POST['brief']);
			
			$res=$users->where('id="'.$id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->success("修改信息成功");
			}else{
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->error("修改信息失败或未更新");
			}
		}
	}
	
	/**
	 * 编辑联系广式
	 */
	public function editcontact(){
		$users	=	new UsersModel();
		if($users->autoCheckToken($_POST)){
			import("ORG.Input");
			$id	=	Session::get("id");
			$data['exp_truename']	=	htmlspecialchars($_POST['name']);
			$data['exp_mobile']	=	htmlspecialchars($_POST['mobile']);
			$data['exp_telephone']	=	htmlspecialchars($_POST['phone']);
			$data['exp_postalcode']	=	htmlspecialchars($_POST['postalcode']);
			$data['exp_useraddress']	=	htmlspecialchars($_POST['address']);
			$res=$users->where('id="'.$id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->success("修改信息成功");
			}else{
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->error("修改信息失败或未更新");
			}
		}

	}
	
	/**
	 * 修改密码
	 */
	public function modifypasswd(){
		$users	=	new UsersModel();
		if($users->autoCheckToken($_POST)){
			$id	=	Session::get("id");
			$this->assign('jumpUrl','Member');
			$password	=	md5($_POST['password']);
			$password1	=	md5($_POST['password1']);
			$password2	=	md5($_POST['password2']);
			$result	=	$users->where('id="'.$id.'"')->find();
			if($result['exp_password']!=$password)	{
				 // 设置提示后跳转页面
				$this->error("您输入的原密码不正确，请返回重试");
			}
			if($password1 != $password2){
				$this->error("两次输入的密码不一致");
			}
			
			$data['exp_password']	=	$password2;
			$res=$users->where('id="'.$id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->success("密码修改成功");
			}else{
				$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
				$this->error("密码修改失败");
			}
			
		}	
	}
	
	/**
	 * 白帽信息
	 */
	public function memberinfo(){
		$id	=	Session::get("id");
		$users	=	new UsersModel();
		$memberinfo	=	$users->where('id="'.$id.'"')->find();
		$this->assign('memberinfo',$memberinfo);
		
		$exps	=	new PostsModel();
		$res	=	$exps->where('exp_author_id="'.$id.'"')->findAll();
		
		$this->assign('list',$res);
		echo $this->display('memberinfo');
	}
}