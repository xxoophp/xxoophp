<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  ----------------------------------------------------------------------
	xxoophp框架引导程序，Bootstrap
	加载应用程序配置、基础类库，实现整个框架流程
	
	@pack xxoophp
	@version 0.1
	@link http://xxoophp.com
	@author bing.peng	
  ----------------------------------------------------------------------
*/

// 载入日志类 
require XXOO . 'core'.DS.'Logger.lib.php';

// 载入核心函数库
require XXOO . 'core'.DS.'core.fn.php';

// 载入应用程序配置
require ROOT . 'conf'.DS.'app.conf.php';

// 载入数据库配置
require ROOT . 'conf'.DS.'database.conf.php';

// 载入数据库操作函数
require XXOO . 'core'.DS.'db.fn.php';

// 关闭魔术引用（5.3以下版本）
//if ( !is_php('5.3')) {	
//	@set_magic_quotes_runtime(0); // Kill magic quotes
//}

// 设置时区
date_default_timezone_set( conf('xxoo', 'date_timezone') );

// 如果用户没有设置site_domain，则自动配置生成site_domain
if( !$site_domain = conf( 'app', 'site_domain' ) ){
   $GLOBALS['app']['site_domain'] = gen_site_domain();
}

// 获取当前请求URL
$GLOBALS['url'] = get_current_url();

// 获取请求URI
$GLOBALS['uri'] = get_current_uri();

// 根据uri，查找对应的处理资源
if( $request = gen_request( $GLOBALS['uri'] ) ) {
	$GLOBALS['request'] = $request;	
}
else { 	 
	show_404();	// 请求没有对应的处资源，响应404 
}

// 抽象类，所有Controller基类
abstract class _Controller {
	public function __construct() {}
}

// 载入应用程序全局函数
require ROOT . 'extension'.DS.'app.fn.php';

// 载入钩子函数集
require ROOT . 'extension'.DS.'hooks.fn.php';

// 挂载钩子
mount_hooks( $GLOBALS['uri'] );

// 执行前置钩子
run_func_coll('pre_controller');

// Controller预处理
$cont_file = ROOT . $GLOBALS['request']['file'];
if( !file_exists( $cont_file ) ) show_error('Can\'t find controller file: '.$GLOBALS['request']['file'], E_ERROR, __FILE__, __LINE__ ); 
require( $cont_file );

$class_name = $GLOBALS['request']['class'];
if( !class_exists( $class_name ) ) show_error('Can\'t find class: '.$class_name, E_ERROR, __FILE__, __LINE__ );
$__xxoo = new $class_name();

$method_name = $GLOBALS['request']['fn'];
if( !method_exists( $__xxoo, $method_name ) ) show_error('Can\'t find method: '.$method_name, E_ERROR, __FILE__, __LINE__);

$param_array = isset($GLOBALS['request']['params']) ? $GLOBALS['request']['params'] : array();

// 执行Controller
call_user_func_array( array($__xxoo, $method_name), $param_array );

// 执行后置钩子
run_func_coll('post_controller');

exit;

