<?php
/*
 * 漏洞提交页面
 */
class BugsubAction extends Action{
	public function index(){

		echo $this->display('index');
	}
	
	//显示验证码
	public function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Image");
        Image::buildImageVerify(4,1,$type);
	}
	
	/**
	 * 检查验证码
	 */
	public function checkcode(){
		$captcha	=	md5($_GET['captcha']);
		$code=	$_SESSION['verify'];
		if ($captcha==$code){
			echo 1;
			return   true;
		}else{
			echo 0;
			return  false;
		}
	}
	
	public function getcorpname(){
		$corps	=	new CorpsModel();
		$result	=	$corps->findAll();
		$data	=	array();
		$i	=	0;
		for ($i;$i<count($result);$i++){
			$data[$i]['corpid']=	$result[$i]['corps_id'];
			$data[$i]['corpname']=	$result[$i]['exp_corpser'];
		}
		echo json_encode($data);
		//echo '[{"corpid":"11","corpname":"\u4eba\u4eba\u7f51"}]';
	}
	
	public function getExp(){
		$id	=	intval($_GET['id']);
		$exp	=	new CategoryModel();
		$result	=	$exp->where("exp_corptype='$id' and exp_category_fid=0")->findAll();
		$data	=	array();
		$i	=	0;
		for ($i;$i<count($result);$i++){
			$data[$i]['type_name']=	$result[$i]['exp_bugtype'];
			$data[$i]['typeid']=	$result[$i]['exp_category_id'];
		}
		echo json_encode($data);
	}
	public function getCExp(){
		$id	=	intval($_GET['id']);
		$exp	=	new CategoryModel();
		$result	=	$exp->where("exp_category_fid='$id'")->findAll();
		$data	=	array();
		$i	=	0;
		for ($i;$i<count($result);$i++){
			$data[$i]['type_name']=	$result[$i]['exp_bugtype'];
			$data[$i]['typeid']=	$result[$i]['exp_category_id'];
		}
		echo json_encode($data);
		//echo '[{"type_name":"\u7f51\u7edc\u8bbe\u8ba1\u7f3a\u9677\/\u903b\u8f91\u9519\u8bef","typeid":"1"},{"type_name":"\u57fa\u7840\u8bbe\u65bd\u5f31\u53e3\u4ee4","typeid":"2"},{"type_name":"\u7f51\u7edc\u672a\u6388\u6743\u8bbf\u95ee","typeid":"3"},{"type_name":"\u7f51\u7edc\u654f\u611f\u4fe1\u606f\u6cc4\u6f0f","typeid":"4"}]';
	}

	/**
	 * 添加漏洞
	 */
	public function addexp(){
	$posts	=	new PostsModel();
		if ($posts->autoCheckToken($_POST)){
			if ($posts->create()){
				import("ORG.Input");
				$this->assign('jumpUrl','bugsub');
				$captcha	=	md5($_POST['captcha']);
				$code=	$_SESSION['verify'];
				if ($captcha!=$code){
					$this->error('验证码不正确');
				}
				$data['exp_email']	=	htmlspecialchars($_POST['email']);
				$data['exp_corptype']	=	htmlspecialchars($_POST['corptype']);
				$data['exp_post_producter']	=	htmlspecialchars($_POST['corpid']);
				$data['exp_bugtype']	=	htmlspecialchars($_POST['bug_subtype']);
				$data['exp_hazard_rating']	=	htmlspecialchars($_POST['harmlevel']);
				$data['exp_post_title']	=htmlspecialchars($_POST['bugtitle']);
				$data['exp_exploit_rank']=htmlspecialchars($_POST['whitehat_rank']);
				$data['exp_description']	=	htmlspecialchars($_POST['description']);
				$data['exp_content']	=	htmlspecialchars($_POST['content']);
				$data['exp_content1']	=	htmlspecialchars($_POST['poc']);
				$data['exp_exploit_fix']	=	htmlspecialchars($_POST['patch']);
				$data['exp_post_time']	=	date('Y-m-d',time());
				$data['exp_author_id']	=	'1';
				$data['exp_ispub']	=	'1';
				$data['exp_post_no']	= date('Ymd',time());

				if ($_POST['corpid']=='-1'){
					$this->error('请选择对应的厂商');
				}
				if ($_POST['corpid']=='0'){
					$data['other_corpname'] = htmlspecialchars($_POST['corpname']);
				}
				if ($_POST['bugtype']=='0'){
					$data['exp_bugtype']=0;
					$data['other_bugtype'] = htmlspecialchars($_POST['other_bugtype']);
				}
				if (isset($_SESSION['id'])){
					$data['exp_author_id']	=	$_SESSION['id'];
				}
				$res	=	$posts->add($data);
				if($res){
					$this->assign('jumpUrl','bugsub');
					$this->success('谢谢您的提交，我们会尽快审核');
				}else{
					echo $posts->getLastSql();
					$this->error('发布失败');
				}
				
			}else{
				$this->assign('jumpUrl','bugsub');
				$this->error($posts->getError());
			}
		}else{
			$this->assign('jumpUrl','bugsub');
			$this->error("请不要重复提交 ");
		}
	}
}