<?php

/*
  ---------------------------------------------------------------------------
	xxoophp框架入口
	
	@version 0.2
	@link http://xxoophp.com
  ---------------------------------------------------------------------------
*/

/*
 * 运行环境
 * 通过定义不同的运行环境，框架自动适应错误、日志等处理方式
 * 
 * 框架支持三种产品状态
 * 		开发: development
 * 		测试: testing
 * 		产品: production
 */
define('ENV', 'development');


// 根据不同的产品状态，设置错误报告
switch(ENV) {
	case 'development':
		error_reporting(E_ALL);
	break;	
	
	case 'testing':
	case 'production':
		error_reporting(0);
	break;
	
	default:
		exit('The application environment is not set correctly.');
}


// 分隔符
define( 'DS', DIRECTORY_SEPARATOR );

// 项目根目录路径
define( 'ROOT', dirname(__FILE__).DS );

// xxoo目录路径
define( 'XXOO', dirname(__FILE__).DS.'_xxoo'.DS );

// 载入框架引导文件
require( XXOO . '_xxoo.php' );

