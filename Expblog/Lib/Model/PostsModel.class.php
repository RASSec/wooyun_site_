<?php
/*
 * 漏洞模型类
 */
class PostsModel extends RelationModel{
	protected $_map	=	array(
		'corptype'=>'exp_corptype',
		'bugtype'=>'exp_bugtype',
		'bugtitle'=>'exp_post_title',
		'harmlevel'=>'exp_hazard_rating',
		'whitehat_rank'=>'exp_exploit_rank',
		'description'=>'exp_description',
		'editor_content'=>'exp_content',
		'editor_content1'=>'exp_content1',
		'editor_content2'=>'exp_exploit_fix',
		'email'=>'exp_email'
	);
	protected $_validate	=	array(
		array('exp_corptype','require','厂商必须填写,点击返回'),
		array('exp_post_title','require','漏洞标题必须填写,点击返回'),
		array('exp_hazard_rating','require','漏洞等级必须填写,点击返回'),
		array('exp_bugtype','require','漏洞类型必须填写,点击返回'),
		array('whitehat_rank','require','自评等级必须填写,点击返回'),
		
	);
	protected $_link = array(

        'Profile'=>array(

			'mapping_type'    =>BELONGS_TO,
	
			'mapping_name'=>'id',
	
			
		    'class_name'   =>'Users',
			
			'foreign_key'=>'exp_author_id',
		
			'as_fields'=>'exp_username',

		
		)
		
	);

	
}