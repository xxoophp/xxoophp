<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  ----------------------------------------------------------------------
	xxoophp框架引导程序，Bootstrap
	加载应用程序配置、基础类库，实现整个框架流程
	
	@pack xxoophp
	@version 0.2
	@link http://xxoophp.com
	@author bing.peng	
  ----------------------------------------------------------------------
*/

// 设置当前请求语言，默认设置为简体中文
$GLOBALS['request']['lang'] = 'zh_cn';

// 载入应用程序配置
require XXOO . 'xxoo.conf.php';

// 载入应用程序配置
require ROOT . 'conf'.DS.'app.conf.php';

// 载入数据库配置
require ROOT . 'conf'.DS.'database.conf.php';

// 载入核心函数库
require XXOO . 'core'.DS.'core.fn.php';

// 载入日志类 
require XXOO . 'core'.DS.'Logger.lib.php';

// 设置时区
date_default_timezone_set( conf('app','timezone') );

// 载入数据库操作函数
require XXOO . 'core'.DS.'db.fn.php';

// 载入应用程序全局函数（用户扩展函数库）
require ROOT . 'exts'.DS.'app.fn.php';

// 取消自动转义
transcribe();

// 如果用户没有设置site_domain，则自动配置生成site_domain
if( !$site_domain = conf( 'app', 'site_domain' ) ) {
   $GLOBALS['app']['site_domain'] = gen_site_domain();
}

// 获取当前请求URL
$GLOBALS['request']['url'] = get_current_url();

// 获取请求URI
$GLOBALS['request']['uri'] = get_current_uri();

// 解析URI，如果不存在则响应404
if( ! parse_uri( $GLOBALS['request']['uri'] ) ) {
	show_404();
}

/**
 * base controller
 */
abstract class _Controller { public function __construct() {} }

// Controller预处理
$__cont_file = ROOT . $GLOBALS['request']['file'];
if( !is_file( $__cont_file ) ) trigger_error( "Can\'t find controller file: {$__cont_file}", E_USER_ERROR ); 
require( $__cont_file );

$__class_name = $GLOBALS['request']['class'];
if( !class_exists( $__class_name ) ) trigger_error( "Can\'t find class: {$__class_name}", E_USER_ERROR );
$__xxoo = new $__class_name();

$__method = $GLOBALS['request']['fn'];
if( !method_exists( $__xxoo, $__method ) ) trigger_error( "Can\'t find method: {$__method}", E_USER_ERROR );

$__params = isset($GLOBALS['request']['params']) ? $GLOBALS['request']['params'] : array();

// 执行拦截器before()
call_interceptor('before');

// 执行action()方法
call_user_func_array( array($__xxoo, $__method), $__params );

// 执行拦截器after()
call_interceptor('after');

exit;

