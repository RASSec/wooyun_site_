<?php
/*
 *厂商的模型类 
 */
class CorpsModel extends Model{
	protected $_map	=	array(
		'corps'=>'exp_corpser',
		'homepage'=>'exp_homepage',
		'email'=>'exp_email',
	);
	protected $_validate	=	array(
		array('exp_corpser','require','厂商必须填写,点击返回'),
		array('exp_homepage','require','主页必须填写,点击返回'),
		array('exp_email','require','邮箱必须填写,点击返回'),
		array('email','','邮箱已经存在！',0,’unique’,1),
		array('exp_password','require','密码必须填写,点击返回'),
	);	
}