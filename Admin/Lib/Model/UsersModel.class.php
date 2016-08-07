<?php
/*
 * 白帽模型类
 */
class UsersModel extends Model{
	protected $_map	=	array(
		'email'=>'exp_useremail',
	);
	protected $_validate	=	array(
		array('username','require',"用户名必须填写,点击返回"),
		array('exp_useremail','require','邮件必须填写,点击返回'),
		array('password','require','密码必须填写,点击返回'),
		array('verify','require',"验证码必须填写,点击返回"),
		array('invitecode','require',"邀请码必须填写,点击返回"),
	);
}
