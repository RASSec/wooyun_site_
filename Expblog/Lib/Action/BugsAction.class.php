<?php
/*
 * 显示漏洞列表
 */

class BugsAction extends Action{
	/**
	 * 显示首页信息
	 */
	public function index(){
		$model	=	new PostsModel();
				//分页
		import("ORG.Page");
		$count	=	$model->where("posts_confrim=0")->count();
		$p	=	new Page($count,5);
		$list=$model->where("posts_confrim=0 and exp_ispub=0")->limit($p->firstRow.','.$p->listRows)->order('id desc')->relation(true)->select();
		$page=	$p->show();
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
		
		//获取分类导航
		$category	=	new CategoryModel();
		//互联网厂商
		$cat1	=	$category->where('exp_category_fid=0 and exp_corptype=1')->findAll();
		//传统应用厂商
		$cat2	=	$category->where('exp_category_fid=0 and exp_corptype=2')->findAll();
		
		$this->assign('cat1',$cat1);
		$this->assign('cat2',$cat2);
		
		echo $this->display('index');
	}
	
	/**
	 * 
	 */
	
	/**
	 * 漏洞详细信息
	 */
	public function getdetailexp(){
		$id	=	intval($_GET['postid']);
		$bugs	=	new Model();
		$judgeModel	=	new PostsModel();
		$judge	=	$judgeModel->where('id="'.$id.'"')->find();

		$sql='';
		if (($judge['other_bugtype']!='')&&($judge['other_corpname']!='')){
			$sql	=	"select ep.*,eu.exp_username from exp_posts ep JOIN exp_users eu on eu.id=ep.exp_author_id  where ep.id='$id' and ep.posts_confrim=0";
			
			//echo "两者都不为空";
		}
		if (($judge['other_bugtype']=='')&&($judge['other_corpname']!='')){
			//
			$sql	=	"select ep.*,eu.exp_username,eca.exp_bugtype from exp_posts ep  JOIN exp_users eu on eu.id=ep.exp_author_id join exp_category  eca on eca.exp_category_id=ep.exp_bugtype  where ep.id='".$id."' and ep.posts_confrim=0";

			//echo "漏洞分类为空,厂商名不为空";
		}
		if (($judge['other_bugtype']!='')&&($judge['other_corpname']=='')){
			//
			$sql	=	"select ec.exp_corpser, ep.*,eu.exp_username from exp_posts ep JOIN exp_users eu on eu.id=ep.exp_author_id JOIN exp_corps ec on ep.exp_post_producter=ec.corps_id where ep.id='".$id."' and ep.posts_confrim=0 ";
			//echo "漏洞分类不为空,厂商名为空";
		}
		if (($judge['other_bugtype']=='')&&($judge['other_corpname']=='')){
			//
			$sql	=	"select ep.*,ec.exp_corpser,eu.exp_username,eca.exp_bugtype from exp_posts ep JOIN exp_corps ec on ep.exp_post_producter=ec.corps_id  JOIN exp_users eu on eu.id=ep.exp_author_id join exp_category  eca on eca.exp_category_id=ep.exp_bugtype  where ep.id='".$id."' and ep.posts_confrim=0";
			//echo "漏洞分类为空,厂商名为空";
		}
		
		$res	=	$bugs->query($sql);
		
		$data	=	array();
		foreach($res as $key=>$value){
			$data	=	$value;
		}
		$exp_hazard_rating	=	'';
		switch ($data['exp_hazard_rating']){
			case 1:
				$exp_hazard_rating	=	'低';
				break;
			case 2:
				$exp_hazard_rating	=	'中';
				break;
			case 3:
				$exp_hazard_rating	=	'高';
				break;
		}
		$exp_exploit_status	=	0;
		switch ($data['exp_exploit_status']){
			case 0:
				$exp_exploit_status	=	'正在联系厂商或者等待认领';
				break;
			case 1:
				$exp_exploit_status	=	'等待厂商处理';
				break;
			case 2:
				$exp_exploit_status	=	'未联系到厂商或者厂商积极忽略';
				break;
			case 3:
				$exp_exploit_status	=	'厂商已经确认';
				break;
			case 4:
				$exp_exploit_status	=	'漏洞已经通知厂商但是厂商忽略漏洞';
		}
		$replay	=	'';
		if ($data['exp_replay']==''){
			$replay	=	'暂无';
		}else{
			$replay	=	$data['exp_replay'];
		}
		$this->assign('replay',$replay);
		//获取留言信息
		$leavemsg	=	new PostcommentsModel();
		$msgs	=	$leavemsg->relation(true)->where('posts_id="'.$id.'"')->findAll();
		$this->assign('msgs',$msgs);
		
		
		$this->assign('exp_exploit_status',$exp_exploit_status);
		$this->assign('exp_hazard_rating',$exp_hazard_rating);
		$this->assign('list',$data);
		
		echo $this->display('detailexp');
		
	}
	
	//显示验证码
	public function verify(){
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("ORG.Image");
        Image::buildImageVerify(4,1,$type);
	}
	
	//留言内容
	public function leavemsg(){
		$comments	=	new PostcommentsModel();
		$id	=	intval($_POST['postid']);
		$this->assign('jumpUrl','bugs/getdetailexp/postid/'.$id);
		if($comments->autoCheckToken($_POST)){
		$captcha	=	md5($_POST['captcha']);
		$code=	$_SESSION['verify'];
		if ($captcha!=$code){
			$this->error('验证码不正确');
			}
			if ($comments->create()){
				$data['content']	=	htmlspecialchars($_POST['comment_content']);
				
				$data['posts_id']	=	$id;
				$data['user_id']	=	$_SESSION['id'];
				$data['addtime']	=	date("Y-m-d H:i:s",time());
				$res	=	$comments->add($data);
				if ($res){
					$this->success("评论成功");
					
				}else{
					$this->error("评论失败");
				}
			}else{
				$this->error($comments->getError());
			}
			//print_r($_POST);
		}
	}
	
	public function categoryexp(){
		import("ORG.Page");
		$id	=	intval($_GET['id']);
		$cortype	=	intval($_GET['cortype']);
		switch ($cortype){
			case 1:
				$this->assign("cortypeid","1");
				$this->assign("cortype","互联网厂商");
				break;
			case 2:
				$this->assign("cortypeid","2");
				$this->assign("cortype","传统应用厂商");
				break;
			default:
				$this->assign('jumpUrl','bugs');
				$this->error("查询出错");
		}
		$category	=	new CategoryModel();
		
		$categoryname	=	$category->where('exp_category_id="'.$id.'"')->find();
		
		$res	=	$category->where('exp_category_fid="'.$id.'"')->findAll();
		//分页
		$posts	=	new PostsModel();
		
		
		$sql	=	"select ep.id vulid,eu.id userid, ep.exp_post_time,ep.exp_post_title,eu.exp_username from exp_posts ep join exp_users  eu on ep.exp_author_id = eu.id where ep.exp_corptype='1' and exp_bugtype in (select exp_category_id from exp_category where exp_category_fid='$id')";
		
		if ($_GET['bugtype']){
			$bugtype	=	intval($_GET['bugtype']);
			$sql="select ep.id vulid,eu.id userid, ep.exp_post_time,ep.exp_post_title,eu.exp_username from exp_posts ep join exp_users  eu on ep.exp_author_id = eu.id where ep.exp_corptype='1' and exp_bugtype ='$bugtype'";
		}
		$count	=	$posts->query($sql);
		$count	=	count($count);
		$p	=	new Page($count,5);
		$sql.=" limit  $p->firstRow,$p->listRows";
		$vul	=	$category->query($sql);
		$this->assign("vul",$vul);
		$this->assign("cname",$categoryname);
		$this->assign("res",$res);
		
		$page=	$p->show();
		
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
		echo $this->display('categoryexp');
	}
}