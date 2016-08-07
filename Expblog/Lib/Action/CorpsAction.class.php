<?php
/*
 * 厂商管理
 * 实现厂商的显示功能
 * 2011-04-23
 */
class CorpsAction extends Action{
	/**
	 * 显示厂商列表
	 */
	public function index(){
		//取得厂商的信息数组
		$model	=	new CorpsModel();
		//分页
		import("ORG.Page");
		$count	=	$model->count();
		$p	=	new Page($count,5);
		$list=$model->limit($p->firstRow.','.$p->listRows)->order('corps_id desc')->findAll();
		$page=	$p->show();
		
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
		echo $this->display('index');
	}
	
	/**
	 * 厂商注册
	 * 
	 * 
	 */
	public function reg(){
		$corps	=	new CorpsModel();
		if ($_POST){
		if ($corps->autoCheckToken($_POST)){
			$this->assign('jumpUrl','Corps/reg'); // 设置提示后跳转页面
			 if($_SESSION['verify'] != md5($_POST['verify'])) {
		 		$this->error("验证码不正确");
			 }
			 
			 if($corps->create()){
			 	import("ORG.Input");
			 	$code	=	Input::getVar($_POST['invitecode']);
			 	$codes	=	new CodeModel();
			 	$res	=	$codes->where('exp_code="'.$code.'" and exp_isused=0')->find();
			 	if ($res!=null){
			 		$data['exp_corpser']	=	Input::getVar($_POST['corps']);
			 		$data['exp_homepage']	=	Input::getVar($_POST['homepage']);
			 		$data['exp_email']	=	Input::getVar($_POST['email']);
			 		$data['exp_password']	=	md5($_POST['password']);
			 		$data['exp_corps_intro']	=	Input::getVar($_POST['corps_intro']);
			 		$data['exp_addtime']	=	date('Y-m-d',time());
			 		$exp_code	=	Input::getVar($_POST['invitecode']);
			 		$res	=	$corps->add($data);
			 		$res=1;
			 		if ($res>0){
			 			$data1['exp_isused']=1;
			 			$res2=$codes->where('exp_code="'.$code.'"')->save($data1);
			 			if ($res2>0){
			 				$this->success("您已经成功注册");
			 			}
			 		}
			 	}else{
			 		$this->error("邀请码不正确或已经被注册");
			 	}
			 	
			 	
			 }else{
			 	$this->error($corps->getError());
			 }
		}}else{
			echo $this->display('corpsreg');
		}
	}


	/**
	 * 厂商登陆
	 */
	public function corpslogin(){
		if (isset($_SESSION['corps_id'])){
			$this->assign('jumpUrl','Managecorps');
   			$this->success('您已经成功登陆');
		}
		echo $this->display('corpslogin');
	}
	
	/**
	 * 检查登陆
	 */
	public function checklogin(){
		$corps	=	new CorpsModel();
		$this->assign('jumpUrl','Corps/corpslogin'); // 设置提示后跳转页面
		 if($_SESSION['verify'] != md5($_POST['verify'])) {
		 	$this->error("验证码不正确");
		 }
		if($corps->autoCheckToken($_POST)){
			if ($corps->create()){
				$email	=	trim($_POST['email']);
				$password	=	$_POST['password'];
				import("ORG.Input");
				$email	=	Input::getVar($email);
				$result	=	$corps->where('exp_email="'.$email.'"')->find();
				if($result){
					if($result['exp_password']==md5($password)){
						if($result['exp_status==0']){
							$this->error("您的账号已经被锁定");
						}else{
							$_SESSION['exp_corpser'] = $result['exp_corpser'];
							$_SESSION['corps_id'] = $result['corps_id'];
							$this->assign('jumpUrl','Managecorps'); // 设置提示后跳转页面
							$this->success("您已经成功登陆后台");
						}
					}else{
						$this->error("用户账号或密码错误");
						
					}
				}else{
					$this->error("用户账号或密码错误");
				}
				
			}else{
				$this->error($corps->getError());
			}
		}
	}

	
	/**
	 * 厂商的详细信息
	 */
	public function company(){
		$id	=	intval($_GET['id']);
		$corps	=	new CorpsModel();
		$res	=	$corps->where('corps_id="'.$id.'"')->find();
		$this->assign('jumpUrl','Corps');
		if ($res==null){
			$this->error("出错啦,请点击返回");
		}else {
			$posts	=	new PostsModel();
			$exploits	=	$posts->where('exp_post_producter="'.$id.'"')->findAll();
			$this->assign('exploits',$exploits);
			$this->assign('list',$res);
			echo $this->display('company');
		}
		
	}
}