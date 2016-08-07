<?php

// 定义TP框架路径(相对于入口文件)
define('APP_DEBUG', false);
define('THINK_PATH', './ThinkPHP');

//定义项目名称和路径

define('APP_NAME', 'Expblog');

define('APP_PATH', './Expblog');

// 加载框架入口文件 

require(THINK_PATH."/ThinkPHP.php");

//实例化一个网站应用实例

App::run();

?>
