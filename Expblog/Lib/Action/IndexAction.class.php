<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
	
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
    	//最新提交的等待厂商处理的漏洞
    	$sql1	=	"select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=1 and ep.exp_ispub=0  order by ep.id desc limit 0,5";
    	
    	//最新公开的漏洞
    	
    	$sql2	=	"select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_ispub = 0   order by ep.id desc limit 0,5";
    	
    	//最新确认漏洞的
    	$sql3	=	"select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=3 and ep.exp_ispub=0  order by ep.id desc limit 0,5";
    	
    	//等待认领
    	
    	$sql4	=	"select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=0 and ep.exp_ispub=0  order by ep.id desc limit 0,5";
    	$posts	=	new PostsModel();
    	
    	
    	$res1	=	$posts->query($sql1);
    	
    	$res2	=	$posts->query($sql2);
    	
    	$res3	=	$posts->query($sql3);
    	

    	$res4	=	$posts->query($sql4);
		
    	
		
    	
    	$this->assign("res1",$res1);
    	$this->assign("res2",$res2);
    	$this->assign("res3",$res3);
    	$this->assign("res4",$res4);
    	echo $this->display('index');
    }

  	public function getexpbyid(){
  		$sql	=	'';
  		$id	=	intval($_GET['id']);
  		switch ($id){
  			case 1:
  				$sql="select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=1 and ep.exp_ispub=0  order by ep.id desc";
  			break;
  			case 2:
  				$sql="select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_ispub = 1   order by ep.id desc";
  			break;
  			case 3:
  				$sql="select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=3 and ep.exp_ispub=0  order by ep.id desc";
  			break;
  			case 4:
  				$sql="select ep.exp_ispub, ep.id,ep.exp_exploit_status,ep.exp_post_time,ep.exp_post_title ,eu.id euid,eu.exp_username from exp_posts ep join exp_users eu on ep.exp_author_id=eu.id where ep.exp_exploit_status=0 and ep.exp_ispub=0  order by ep.id desc";
  			break;
  			default:
  				$this->assign('jumpUrl','index');
  				$this->error("查询出错");
  		}
  		$posts	=	new PostsModel();
  		$res1	=	$posts->query($sql);
  		import("ORG.Page");
		$count	=	count($res1);
		$p	=	new Page($count,5);
		$sql.=" limit $p->firstRow,$p->listRows";
		$res	=	$posts->query($sql);
  		$this->assign("res",$res);
  		$page=	$p->show();
		$this->assign ( "page", $page );
		$this->assign ( "list", $list );
  		echo $this->display('getexpbyid');
  		
  	}

}
?>