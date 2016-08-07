<?php
/*
 *管理员模型类 
 */
class AdminsModel extends Model{
	protected $_map	=	array(
		'uname'=>'exp_username',
		'passwd'=>'exp_password'
	);
	protected $_validate	=	array(
		array('exp_username','require','用户名必须填写,点击返回'),
		array('exp_password','require','密码必须填写,点击返回'),
	);
}