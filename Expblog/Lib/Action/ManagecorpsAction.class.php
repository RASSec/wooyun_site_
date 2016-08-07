<?php
/*
 * 厂商的后台面板
 */
class ManagecorpsAction extends CorpscommonAction{
	public function index(){
		
		$corps_id	=	$_SESSION['corps_id'];
		$corps	=	new CorpsModel();
		$res	=	$corps->where('corps_id="'.$corps_id.'"')->find();
		$this->assign("vo",$res);
		echo $this->display('index');
	}
	
	/**
	 * 编辑公司资料
	 */
	public function editinfo(){
		$corps	=	new CorpsModel();
		if($corps->autoCheckToken($_POST)){
			$id	=	Session::get("corps_id");
			$data['exp_homepage']	=	htmlspecialchars($_POST['homepage']);
			$data['exp_corps_intro']	=	htmlspecialchars($_POST['brief']);
			
			$res=$corps->where('corps_id="'.$id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->success("修改信息成功");
			}else{
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->error("修改信息失败或未更新");
			}
		}
		
	}
	/**
	 * 编辑联系方式
	 */
	public function editcontact(){
		$corps	=	new CorpsModel();
		if($corps->autoCheckToken($_POST)){
			$corps_id	=	Session::get("corps_id");
			$data['exp_username']	=	htmlspecialchars($_POST['name']);
			$data['corps_mobile']	=	htmlspecialchars($_POST['mobile']);
			$data['corps_telephone']	=	htmlspecialchars($_POST['phone']);
			$res=$corps->where('corps_id="'.$corps_id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->success("修改信息成功");
			}else{
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->error("修改信息失败或未更新");
			}
		}

	}
	/**
	 * 修改密码
	 */
	public function modifypasswd(){
		$corps	=	new CorpsModel();
		if($corps->autoCheckToken($_POST)){
			$corps_id	=	Session::get("corps_id");
			$this->assign('jumpUrl','Managecorps');
			$password	=	md5($_POST['password']);
			$password1	=	md5($_POST['password1']);
			$password2	=	md5($_POST['password2']);
			$result	=	$corps->where('corps_id="'.$corps_id.'"')->find();
			if($result['exp_password']!=$password)	{
				 // 设置提示后跳转页面
				$this->error("您输入的原密码不正确，请返回重试");
			}
			if($password1 != $password2){
				$this->error("两次输入的密码不一致");
			}
			
			$data['exp_password']	=	$password2;
			$res=$corps->where('corps_id="'.$corps_id.'"')->save($data);
			if($res>0){
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->success("密码修改成功");
			}else{
				$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
				$this->error("密码修改失败");
			}
			
		}	
	}
	/**
	 * 厂商信息
	 */
	public function corpsinfo(){
		$corps_id	=	Session::get("corps_id");
		$corps	=	new CorpsModel();
		$corpsinfo	=	$corps->where('corps_id="'.$corps_id.'"')->find();
		$this->assign('corpsinfo',$corpsinfo);
		
		$exps	=	new PostsModel();
		$res	=	$exps->where('exp_post_producter="'.$corps_id.'"')->findAll();
		
		$this->assign('list',$res);
		echo $this->display('corpsinfo');
	}
	/**
	 * 退出系统
	 */
	public function loginout(){
			if($_SESSION['corps_id']!=''){
			unset($_SESSION['corps_id']);
			$this->assign('jumpUrl','Managecorps/corpslogin'); // 设置提示后跳转页面
			$this->error("您已经成功退出系统");
		}
	}
	
	/**
	 * 厂商回应
	 */
	public function replay(){
		$id	=	intval($_GET['id']);
		$posts	=	new PostsModel();
		$corps_id	=	$_SESSION['corps_id'];
		$res	=	$posts->where('id="'.$id.'" and exp_post_producter="'.$corps_id.'"')->find();
		if ($res==null){
			$this->assign('jumpUrl','Managecorps/corpsinfo');
			$this->error("修改出错，请点击返回 ");
		}
		$this->assign('list',$res);
		echo $this->display('replay');
	}
	
	/**
	 * 回应保存
	 */
	public function replaysave(){
		$posts	=	new PostsModel();
		$this->assign('jumpUrl','Managecorps/corpsinfo');
		if ($posts->autoCheckToken($_POST)) {
			$id	=	$_SESSION['corps_id'];
			$postid	=	intval($_POST["postid"]);
			$data['exp_exploit_status']=3;
			$data['exp_replay']	=	htmlspecialchars($_POST['exp_replay']);
			$res	=	$posts->where('exp_post_producter="'.$id.'" and id="'.$postid.'" ')->save($data);
			if ($res>=0){
				$this->success("回复成功");
			}else {
				$this->error("回复失败");
			}
		}
	}
}