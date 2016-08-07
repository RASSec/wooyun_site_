<?php
/*
 *厂商的模型类 
 */
class CorpsModel extends Model{
	protected $_map	=	array(
		'corpser'=>'exp_corpser',
		'homepage'=>'exp_homepage'
	);
	protected $_validate	=	array(
		array('exp_corpser','require','厂商必须填写,点击返回'),
		array('exp_homepage','require','主页必须填写,点击返回'),
	);	
}