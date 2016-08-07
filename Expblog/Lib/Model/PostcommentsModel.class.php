<?php
/*
 * 留言模型类
 */
class PostcommentsModel extends RelationModel{
	
	protected $_map	=	array(
		'comment_content'=>'content',
	);
	protected $_validate	=	array(
		array('content','require','评论不能为空'),
		array('captcha','require','验证码不能为空'),
		);
		
	  protected $_link = array(

        'profile'=>array(

			'mapping_type'    =>BELONGS_TO,
            'class_name'   =>'Users',
			'mapping_name'=>'id',
			'foreign_key'=>'user_id',
			'as_fields'=>'exp_username',

                  ),

		);
}