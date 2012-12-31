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

// 入口页
$GLOBALS['xxoo']['index'] = 'index.php';

/*
 * URL协议
 * 根据不同的协议，生成不同的URL，目前支持两种协议方式：
 * pathinfo: 	 PATH_INFO
 * query string: QUERY_STRING
 */
$GLOBALS['xxoo']['uri_protocol'] = 'PATH_INFO';

// 文件缓存目录
$GLOBALS['xxoo']['cache_path'] = 'data/cache';

// 上传目录
$GLOBALS['xxoo']['uploadir'] = 'static/uploads';

// 时区
$GLOBALS['xxoo']['date_timezone'] = 'Asia/Chongqing';

/* 定义日志输出
 * none: 不启用日志输出
 * console: 输出到eclispe控制台，需要Java支持
 * file: 输出到文件
 * database: 输出到数据库
 */
define( 'LOG_OUTPUT', 'none' );

// 文件日志目录
$GLOBALS['xxoo']['logs_dir'] = 'logs';

require( XXOO . '_xxoo.php' );

