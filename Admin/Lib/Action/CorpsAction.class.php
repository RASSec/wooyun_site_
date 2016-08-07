<?php
/*
 * 厂商管理
 */
class CorpsAction extends Action{
	public function index(){
		echo $this->display('index');
	}
	
	/**
	 * 添加厂商
	 */
	public function addcorps(){
		$corps	=	new CorpsModel();
		
		if($corps->autoCheckToken($_POST)){
			if ($corps->create()){
				import("ORG.Input");
				$data['exp_corpser']	= Input::getVar($_POST['corpser'])	;
				$data['exp_homepage']	= Input::getVar($_POST['homepage']);
				$data['exp_corps_intro']	=	Input::getVar($_POST['corps_intro']);
				$data['exp_addtime']	=	date('Y-m-d',time());
				
				$res	=	$corps->add($data);
				if($res>0){
					$this->assign('jumpUrl','corps');
					$this->success("添加成功，点击返回");
				}else{
					$this->assign('jumpUrl','corps'); // 设置提示后跳转页面
					$this->error("添加失败");
				}
			}else{
				$this->assign('jumpUrl','corps'); // 设置提示后跳转页面
				$this->error($corps->getError());
			}
		}
	}
	/**
	 * 厂商显示管理
	 * 
	 */
	public function managecorps(){

					$corps	=	new CorpsModel();
					$result	=	$corps->findAll();
					$this->assign('list',$result);
					echo $this->display('manage');
				
		}
	
	/**
	 * 编辑修改厂商
	 */
	public function modifycorps(){
		$corps	=	new CorpsModel();
		if($_POST){
			if ($corps->create()){
				import("ORG.Input");
				$id	=	$_POST['corps_id'];
				$data['exp_corpser']	= Input::getVar($_POST['corpser'])	;
				$data['exp_homepage']	= Input::getVar($_POST['homepage']);
				$data['exp_corps_intro']	=	Input::getVar($_POST['corps_intro']);
				$res	=	$corps->where('corps_id="'.$id.'"')->save($data);
				if($res>0){
						$this->assign('jumpUrl','corps/modifycorps/id/'.$id);
						$this->success("更新成功，点击返回");
					}else{
						$this->assign('jumpUrl','corps/modifycorps/id/'.$id); // 设置提示后跳转页面
						$this->error("添加失败");
					}
			}
		}else{
			$id	=	intval($_GET['id']);
			$result	=	$corps->where('corps_id="'.$id.'"')->find();
			$this->assign("list",$result);
			echo $this->display('edit');
		}
	}

	/**
	 * 删除厂商
	 */
	public function delcorps(){
		$id	=	intval($_GET['id']);
		$corps	=	new CorpsModel();
		$res	=	$corps->where('corps_id="'.$id.'"')->delete();
		if($res>0){
					$this->assign('jumpUrl','corps/managecorps');
					$this->success("删除成功，点击返回");
				}else{
					$this->assign('jumpUrl','corps/managecorps'); // 设置提示后跳转页面
					$this->error("删除失败,点击返回");
				}
	}
}