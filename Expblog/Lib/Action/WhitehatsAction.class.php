<?php
/*
 * 白帽信息列表
 */
class WhitehatsAction extends Action{
	
	/**
	 * 首页显示白帽信息
	 */
	public function index(){
		$model	=	new UsersModel();
		//分页
		import("ORG.Page");
		$count	=	$model->count();
		$p	=	new Page($count,5);
		//$list=$model->limit($p->firstRow.','.$p->listRows)->order('id desc')->findAll();
		
		$sql	=	"select eu.id, eu.exp_regtime, count(eu.exp_username) ceu ,eu.exp_username  from exp_users eu JOIN exp_posts ep on eu.id=ep.exp_author_id group by eu.exp_username";
		$sql.=" limit  $p->firstRow,$p->listRows";
		$list	=	$model->query("$sql");
		
		$page=	$p->show();
		
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
		echo $this->display('index');
	}
	
	/*
	 * 用户登陆
	 */
	public function userlogin(){
		if (isset($_SESSION['username'])){
			$this->assign('jumpUrl','Member/index');
   			$this->error('您已经成功登陆');
		}
		echo $this->display('userlogin');
	}
	/*
	 * 用户验证登陆
	 */
	public function checklogin(){
	 if ($_POST){	
		$users	=	new UsersModel();
		$this->assign('jumpUrl','Whitehats/userlogin');// 设置提示后跳转页面
		if($_SESSION['verify'] != md5($_POST['verify'])) {
		 	$this->error("验证码不正确");
		}
		if($users->autoCheckToken($_POST)){
			if ($users->create()){
				$email	=	trim($_POST['email']);
				$password	=	$_POST['password'];
				import("ORG.Input");
				$email	=	Input::getVar($email);
				$result	=	$users->where('exp_useremail="'.$email.'"')->find();
				if($result){
					if($result['exp_password']==md5($password)){
						
						if ($result['exp_status']=='1'){
							$this->error("您的账号正在审核，请稍候再登陆");
						}
						
						if($result['exp_status']=='0'){
							$this->error("您的账号已经被锁定");
						}else{
							$_SESSION['username'] = $result['exp_username'];
							$_SESSION['id'] = $result['id'];
							$this->assign('jumpUrl','Member'); // 设置提示后跳转页面
							$this->success("您已经成功登陆后台");
						}
					}else{
						$this->error("用户账号或密码错误");
						
					}
				}else{
					$this->error("用户账号或密码错误");
				}
				
			}else{
				$this->error($users->getError());
			}
		}
	 }
		//$this->success();
	}
	
	/**
	 * 验证码
	 */
	public function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Image");
        Image::buildImageVerify(4,1,$type);
	}
	
	/**
	 * 会员注册
	 */
	public function reg(){
		$user	=	new UsersModel();
		if ($_POST){
		if ($user->autoCheckToken($_POST)){
			$this->assign('jumpUrl','Whitehats/reg');
			if($_SESSION['verify'] != md5($_POST['verify'])) {
		 		$this->error("验证码不正确");
			 }
			if($user->create()){
				import("ORG.Input");
				$code	=	$_POST["invitecode"];
				$codes	=	new CodeModel();
			 	$res	=	$codes->where('exp_code="'.$code.'" and exp_isused=0')->find();
			 	if($res!=null){
			 		$data['exp_username']	=	Input::getVar($_POST['username']);
					$data['exp_useremail']	=	Input::getVar($_POST['email']);
					$data['exp_password']	=	md5($_POST['password']);
					$data['exp_status']	=	1;
					$data['exp_ip']	=	$_SERVER['REMOTE_ADDR'];
					$data['exp_regtime'] = date("Y-m-d",time());
					$res1	=	$user->add($data);
					if ($res1>0){
						$data1['exp_isused']=1;
			 			$res2=$codes->where('exp_code="'.$code.'"')->save($data1);
			
			 			if ($res2>0){
			 				$this->assign('jumpUrl','Whitehats/userlogin');
			 				$this->success("您已经成功注册");
			 			}
					}else{
						$this->error("注册失败");
					}
			 	}else{
			 		$this->error("邀请码不正确或已经被注册");
			 	}
			}else{
				$this->assign('jumpUrl','Whitehats/reg');
				$this->error($user->getError());
			}
		}}else{
			echo $this->display('usereg');
		}
	}

	/**
	 * 白帽的详细信息
	 */
	public function viewhitehat(){
		
		$id	=	intval($_GET['id']);
		$users	=	new UsersModel();
		$res	=	$users->where('id="'.$id.'"')->find();
		$this->assign("list",$res);
		
		$posts	=	new PostsModel();
		$vul	=	$posts->where('exp_author_id="'.$id.'"')->findAll();
		$this->assign('vul',$vul);
		echo $this->display('viewhitehat');
	}
}