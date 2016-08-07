<?php
/*
 *漏洞分类模型 
 */
class CategoryModel extends  Model{
	protected $_map	=	array(
		'bugtype'=>'exp_bugtype',
	);
	protected $_validate	=	array(
		array('exp_bugtype','require','漏洞类型必须填写'),
	);
	
}