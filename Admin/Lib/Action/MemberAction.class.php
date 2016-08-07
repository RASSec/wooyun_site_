<?php
/*
 * 白帽管理
 */
class MemberAction  extends CommonAction{
	public function index(){
		$user	=	new UsersModel();
		import("ORG.Page");
		$count      = $user->count(); // 查询满足要求的总记录数
		$Page       = new Page($count,5); // 实例化分页类传入总记录数和每页显示的记录数

		$show       = $Page->show(); // 分页显示输出

		$list = $user->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list); // 赋值数据集
		
		$this->assign('page',$show); // 赋值分页输出
		echo $this->display('index');
	}
	
	//修改会员的信息
	
	public function modify(){
		if ($_POST){
			$member	=	new UsersModel();
			if ($member->autoCheckToken($_POST)){
				if ($member->create()){
				$id	=	intval($_POST['id']);
				$exp_username	=	htmlspecialchars($_POST['username']);
				$exp_email	=	htmlspecialchars($_POST['email']);
				$exp_ip	=	htmlspecialchars($_POST['ipaddress']);
				$exp_regtime	=	htmlspecialchars($_POST['regtime']);
				$exp_homepage	=	htmlspecialchars($_POST['homepage']);
				$exp_truename	=	htmlspecialchars($_POST['truename']);
				$exp_telephone	=	htmlspecialchars($_POST['telephone']);
				$exp_postalcode	=	htmlspecialchars($_POST['postcode']);
				$exp_userprofile	=	htmlspecialchars($_POST['exp_userprofile']);
				$exp_status	=	intval($_POST['confirm']);
				$exp_mobile	=	htmlspecialchars($_POST['mobile']);
				$exp_useraddress	=	htmlspecialchars($_POST['exp_useraddress']);
				
				$data	=	array(
					'exp_username'=>$exp_username,
					'exp_regtime'=>$exp_regtime,
					'exp_ip'=>$exp_ip,
					'exp_status'=>$exp_status,
					'exp_homepage'=>$exp_homepage,
					'exp_usermail'=>$exp_email,
					'exp_userprofile'=>$exp_userprofile,
					'exp_truename'=>$exp_truename,
					'exp_mobile'=>$exp_mobile,
					'exp_telephone'=>$exp_telephone,
					'exp_useraddress'=>$exp_useraddress,
					'exp_postalcode'=>$exp_postalcode
				);
				$res	=	$member->where('id="'.$id.'"')->save($data);
				if ($res>0){
					$this->assign('jumpUrl','/Member/modify/id/'.$id);
					$this->success('修改成功');
				}else{
					$this->assign('jumpUrl','/Member/modify/id/'.$id);
					$this->success('修改失败');
				}
				}else{
					echo $member->getError();
				}
			}else{
				
			}
		}else{
			$id	=	$_GET['id'];
			$member	=	new UsersModel();
			$users=	$member->where("id='$id'")->find();
			$sec0	=	'';
			$sec1	=	'';
			$sec2	=	'';
			switch ($users['exp_status']){
				case 0;
					$sec0	=	"selected";
					break;
				case 1:
					$sec1	=	"selected";
					break;
				case 2:
					$sec2	=	"selected";
					break;
			}
			$this->assign('sec0',$sec0);
			$this->assign('sec1',$sec1);
			$this->assign('sec2',$sec2);
			$this->assign('user',$users);
			echo $this->display('modify');
		}
	}

	
	//删除会员
	public function deluser(){
		$id	=	intval($_GET['id']);
		$user	=	new UsersModel();
		$res	=	$user->where('id="'.$id.'"')->delete();
		$post	=	new PostsModel();
		$res2	=	$post->where('exp_author_id')->delete();
		if ($res2>0){
				$this->assign('jumpUrl','/Member');
				$this->success('修改账号失败');
			
		}else{
			$this->assign('jumpUrl','/Member');
			$this->success('修改账号失败');
		}
	}

	
	public function showcode(){
		$code	=	new CodeModel();
		import("ORG.Page");
		$count      = $code->count(); // 查询满足要求的总记录数
		$Page       = new Page($count,5); // 实例化分页类传入总记录数和每页显示的记录数

		$show       = $Page->show(); // 分页显示输出

		$list = $code->order('exp_isused asc, id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('list',$list); // 赋值数据集
		
		$this->assign('page',$show); // 赋值分页输出
		
		echo $this->display('showcode');
	}
	//生成邀请码
	public function invitecode(){
		$counts	=	intval($_POST['counts']);
		if ($counts<1){
				$this->assign('jumpUrl','Member/showcode');
				$this->error('请正确填写申请个数');
		}
		$code	=	new CodeModel();
		$resid	=	$code->order('id desc')->find();
		$id	=	$resid['id'];
		import("ORG.String");
		$sql	=	"insert into exp_code(`exp_code`,`exp_isused`,`codetime`)values";
		for ($i=0;$i<$counts;$i++){
			$codes	=	String::rand_string(9,0,'');
			$codes.=$id;
			if($i==($counts-1)){
				$sql.="('$codes','0',"."'".date("Y-m-d H:i:s",time())."'".")";
			}else{
				$sql.="('$codes','0',"."'".date("Y-m-d H:i:s",time())."'"."),";
			}
			$id++;
		}
	$res2	=	$code->query($sql);
	if ($res2>0){
				$this->assign('jumpUrl','Member/showcode');
				$this->success('邀请码申请成功');
			
		}else{
			$this->assign('jumpUrl','Member/showcode');
			$this->error('邀请码申请失败');
		}
	}


	//删除邀请码
	public function delcode(){
		$id	=	intval($_GET['id']);
		$code	=	new CodeModel();
		$res	=	$code->where('id="'.$id.'"')->delete();
		if ($res>0){
				$this->assign('jumpUrl','Member/showcode');
				$this->success('邀请码删除成功');
			
		}else{
			$this->assign('jumpUrl','Member/showcode');
			$this->error('邀请码删除失败');
		
		}
	}
}