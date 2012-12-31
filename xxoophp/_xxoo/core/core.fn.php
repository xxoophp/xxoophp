<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  ---------------------------------------------------------------
	xxoophp框架基础函数库
	提供框架/开发所需的常用函数，包括错误处理，URL，日志记录，配置文件读写等函数.
	
	@version 0.2
	@link http://xxoophp.com/api/core.fn
  	@author bing.peng yanhong.liu
  ---------------------------------------------------------------
*/

/**
 * 错误处理函数，用自定义错误处理函数，接管PHP错误处理
 * @param string $severity
 * @param string $message
 * @param string $filepath
 * @param string $line
 */
function show_error( $severity, $message='', $filepath='', $line='' ) {
	$levels = array(
		E_ERROR				=>	'Error',
		E_WARNING			=>	'Warning',
		E_PARSE				=>	'Parsing Error',
		E_NOTICE			=>	'Notice',
		E_CORE_ERROR		=>	'Core Error',
		E_CORE_WARNING		=>	'Core Warning',
		E_COMPILE_ERROR		=>	'Compile Error',
		E_COMPILE_WARNING	=>	'Compile Warning',
		E_USER_ERROR		=>	'User Error',
		E_USER_WARNING		=>	'User Warning',
		E_USER_NOTICE		=>	'User Notice',
		E_STRICT			=>	'Runtime Notice'
	);
	$title = $levels[$severity] . ' - ' . $message;
	if( $filepath != '' && $line != '' ) {
		$message = "Error on line $line in $filepath";
	}
	
	Logger::error( $title . ' - ' . $message );
	
	if( ENV == 'development' ) {	
		include XXOO.'core'.DS.'error.php';
	}
	else {
		include ROOT.'errors'.DS.'error.php';
	}
	exit;
}
set_error_handler('show_error');	// 注册错误处理函数

/**
 * shutdown函数，用于捕获至命错误
 */
function shutdown() {
	if (($error = error_get_last())) {
		show_error($error['message'], $error['type'], $error['file'], $error['line']);
  	}
}
register_shutdown_function('shutdown');	// 注册shutdown函数

/**
 * 如果用户设置了自动转义，取消自动转义
 */
function transcribe() {
	// magic_quotes_gpc can't be turned off
	if(get_magic_quotes_gpc()) {
		for($i = 0, $_SG = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST), $c = count($_SG); $i < $c; ++$i) {
			$_SG[$i] = array_map('stripslashes', $_SG[$i]);
		}
	}
}

/**
 * 显示404页面
 */
function show_404() {
	header('HTTP/1.1 404 Not Found');
	Logger::error( '404 Not Found - ' . $GLOBALS['request']['url'] );
	if( ENV == 'development' ) {
		show_error( E_ERROR, '404 Not Found - ' . $GLOBALS['request']['url'] );
	}
	else {
		include ROOT.'errors'.DS.'404.php';
	}
	exit;
}

/**
 * 解析URI
 * 根据URI获取请求所需的类、方法、参数、拦截器等信息
 * @param string $uri
 * @return bool
 */
function parse_uri( $uri ) {
	$urls_file = ROOT . 'conf'. DS . 'urls.conf.php';
	if( !file_exists( $urls_file ) ) show_error( 'Can\'t find file - ' . $urls_file );
	$urls = include( $urls_file );	// 载入URL配置
	if( !isset( $urls ) || !is_array( $urls ) ) show_error( 'Invalid urls config in ' . $urls_file );
	
	foreach( $urls as $pattern=>$c ) {
		if( preg_match( "#^{$pattern}$#", $uri, $matches ) ) {
			// URL中携带的参数
			$matches = array_slice($matches, 1);
			if( isset( $GLOBALS['request']['params'] ) ) {
				$GLOBALS['request']['params'] = array_merge( $GLOBALS['request']['params'], $matches );
			}
			else {
				$GLOBALS['request']['params'] = $matches;
			}	
			
			// 额外参数	
			if( isset( $c['p'] ) ) {		
				$GLOBALS['request']['params'] = array_merge( $GLOBALS['request']['params'], explode(',', $c['p']) );	
			}
			
			// 控制器
			if( isset( $c['c'] ) ) {
				$GLOBALS['request']['file'] = 'controllers' . DS . $c['c'] . 'Controller.php';
				$GLOBALS['request']['class'] = end( ( explode('/', $c['c']) ) ) . 'Controller';		
			}
			
			// action方法
			$GLOBALS['request']['fn'] = isset( $c['f'] ) ? $c['f'] : 'index';	
			
			// 拦截器
			if( isset( $c['i'] ) ) {
				if( isset( $GLOBALS['request']['interceptor_list'] ) ) { 
					$GLOBALS['request']['interceptors'] = 
						array_merge( $GLOBALS['request']['interceptors'], explode(',', $c['i']) );
				}
				else {
					$GLOBALS['request']['interceptors'] = explode(',', $c['i']);
				}
			}	
		}
	}
	
	if( isset($GLOBALS['request']['class']) && isset($GLOBALS['request']['class']) 
			&& isset($GLOBALS['request']['fn']) ) {
		return true;		
	}
	else {
		return false;
	}
}

/**
 * 执行拦截器方法
 * @param string $method before/after
 */
function call_interceptor( $method ) {
	static $interceptors = array();
	if( !isset( $GLOBALS['request']['interceptors'] ) ) return false;
	
	foreach( $GLOBALS['request']['interceptors'] as $in ) {
		if( !isset( $interceptors[$in] ) ) {
			$in_file = ROOT.'exts'.DS."{$in}Interceptor.php";
			if( !file_exists( $in_file ) ) trigger_error( "Can\'t find interceptor file: {$in_file}", E_USER_ERROR );
			require $in_file;
			$interceptor = $in . 'Interceptor';
			$interceptors[$in] = new $interceptor();
		}
		
		if( method_exists( $interceptors[$in], $method ) ) {
			call_user_func_array( array($interceptors[$in], $method), array() );
		}
	}
}

/**
 * 挂载钩子
 * @param string $uri
 */
function mount_hooks( $uri ) {
	$hook_conf_file =  ROOT.'conf'.DS.'hook.conf.php';
	if( !file_exists( $hook_conf_file ) ) show_error( 'Can\'t find file - ' . $hook_conf_file, E_ERROR, __FILE__, __LINE__ );
	$hooks = include( $hook_conf_file );	// 载入URL配置
	if( !isset( $hooks ) || !is_array( $hooks ) ) show_error( 'Invalid hooks config', E_ERROR, __FILE__, __LINE__ );
	
	foreach( $hooks as $pattern=>$c ) {
		if( preg_match( "/^$pattern$/", $uri ) ) {
			$params = isset($c['params']) ? $c['params'] : array() ;
			add_func_coll( $c['weld'], $c['fn'], $params );
		}
	}
}

/**
 * 添加欲执行函数到函数集
 * @param string $weld
 * @param string $fn
 * @param array $params
 */
function add_func_coll( $weld, $fn, $params ) {
	if( empty( $GLOBALS['__sc_func_coll'] ) ) {
        $GLOBALS['__sc_func_coll'] = array();
    }
    if( empty( $GLOBALS['__sc_func_coll'][$weld] ) ) {
        $GLOBALS['__sc_func_coll'][$weld] = array();
    }
    array_push( $GLOBALS['__sc_func_coll'][$weld], array( 'fn' => $fn, 'params' => $params ) );
}

/**
 * 执行函数集
 * @param string $weld
 */
function run_func_coll( $weld ) {
	if( empty( $GLOBALS['__sc_func_coll'][$weld] ) || ! is_array( $GLOBALS['__sc_func_coll'][$weld] ) ) {
        return FALSE;
    }
    // 执行函数集
    foreach( $GLOBALS['__sc_func_coll'][$weld] as $v ) {
        if( function_exists( $v['fn'] ) ) {
            call_user_func_array( $v['fn'], $v['params'] );
        }
    }
    return TRUE;
}

/**
 * 自动生成site_domain
 * @return string
 */
function gen_site_domain() {
	$http_protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) ? 'https://' : 'http://';
	$site_domain = rtrim( $http_protocol . $_SERVER ['HTTP_HOST'], '/' ) . '/';
    $__droot = str_replace( '\\', '/', $_SERVER['DOCUMENT_ROOT'] );
    $__root  = str_replace( '\\', '/', ROOT );
    $__root  = trim( str_replace( $__droot, '', $__root ), '/' );
   	return $site_domain . $__root;
}

/**
 * 获取当前url
 * @return string
 */
function get_current_url() {
	$http_protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) ? 'https://' : 'http://';
	return $http_protocol . $_SERVER ['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * 获取当前uri
 */
function get_current_uri() {
	$uri = 'default';
	if( conf('xxoo', 'protocol') == 'PATH_INFO' ) { 	// pathinfo url
		$uri = isset( $_SERVER['PATH_INFO'] ) ? trim( $_SERVER['PATH_INFO'], '/') : 'default';
	}
	else {	// query string url
		$uri = isset( $_GET['p'] ) ? $_GET['p'] : 'default';	
	}
	return $uri;
}


/**
 * 读取配置信息
 * @param string $key[, ... string $key]
 * @return mixed 
 */
function conf() {
	return __get_var( $GLOBALS, func_get_args() );
}

/**
 * 无限获取数组key
 * @param $data
 * @param array $keys
 */
function __get_var( &$data, array $keys ) {
    if( empty( $keys ) ) {
        return $data;
    }
    $key = array_shift( $keys );
    // $key不存在
    if( ! isset( $data[$key] ) ) {
        return NULL;
    }
    // 到达最底层
    if( empty( $keys ) ) {
        return isset( $data[$key] ) ? $data[$key] : NULL;
    }
    return __get_var( $data[$key], $keys );
}

/**
 * 获取站点基础URL
 * app.conf.php中site_domain的配置，如果配置不是以'/'结束，添加'/'
 * @return string
 */
function base_url() {
	return rtrim( conf('app', 'site_domain'), '/' ) . '/';
}

/**
 * 生成站点url
 * 根据URL协议和入口页配置生成站点URL
 * @param string $uri
 * @return string
 */
function site_url( $uri='' ) {
	$url = '';
	if( empty($uri) ) {
		$url = base_url();
	}
	
	$portal_page = conf('xxoo', 'index');
	if( !empty($portal_page) ) {
		$portal_page = conf('xxoo', 'index') . '/';
	}
	
	if( conf('xxoo', 'uri_protocol') == 'PATH_INFO' ) {	// pathinfo
		$url = base_url() . $portal_page . $uri;
	}
	else {	// query string
		$url = base_url() . $portal_page . '?p=' . $uri;
	}
	return $url;
}


/**
 * 判断PHP是否小于某个版本
 * @param string $version
 * @return true
 */
function is_php( $version ) {
	return version_compare(PHP_VERSION, $version) >= 0;
}

/**
 * 系统消息
 * @param string $k
 * @param string $v
 * @return mixed
 */
function m( $k = NULL, $v = NULL ) {
	static $ms = array();
	if ( $k == NULL && $v == NULL ) {	// all
		return $ms;
	}
	else if ( $k != NULL && $v == NULL ) {	// by key
		return isset($ms[$k]) ? $ms[$k] : '';
	}
	else {	// add
		$ms[$k] = $v;
	}
}

if (!function_exists('lang')) {
	/**
	 * 读取语言文件
	 * 根据全局语言设置载入相应的语言文件
	 * @param string $key
	 * @return string
	 */
	function lang($key) {
		static $language = array();
		if( empty( $language ) ) {
			$lang_file = ROOT . 'language'. DS .$GLOBALS['request']['lang'].'.lang.php';
			if( !file_exists( $lang_file ) ) show_error( 'Can\'t find file - ' . $lang_file );
			$lang = require_once( $lang_file );	// 载入URL配置
			if( !isset( $lang ) || !is_array( $lang ) ) show_error( 'Invalid language config in ' . $lang_file );
			$language = $lang;
		}
		
		if( isset( $language[$key] ) ) {
			return $language[$key];
		}
		else {
			show_error( $key .' not found in '. $GLOBALS['request']['lang'].'.lang.php' );
		}
	}
}

/**
 * 渲染视图
 * @param string $tpl 模板路径
 * @param array $data 视图数据
 * @param bool $is_return 是否返回渲染结果
 * @return void/string
 */
function render( $tpl = '', $data = array(), $is_return = FALSE ) {
	$_tpl = ROOT . 'views/' . $tpl . '.tpl.php';
	extract($data);
	
	ob_start();
	include( $_tpl );
	$contents = ob_get_contents();
	ob_end_clean();
	
	if( $is_return ) {
		return $contents;
	}
	else {
		echo $contents;
	}
	
}

/**
 * 获取输入GET/POST/COOKIE
 * @param string $key
 * @return string
 */
function input( $key ) {
	return isset( $_REQUEST[$key] ) ? $_REQUEST[$key] : false;
}

/**
 * 安全输出
 * 对输出字符串转义，避免xss攻击
 * @param mixd $out
 */
function secho( $output ) {
	echo htmlspecialchars( $output );
}

/**
 * 递规目录，如果目录不存在，创建目录
 * @param string $dir
 */
function mkdirs($dir) {
	if( ! is_dir( $dir ) )	{  
		if( ! mkdirs( dirname($dir) ) ) {  
			return false;  
		}  
		if( ! mkdir($dir,0777) ) {  
			return false;  
		}  
	}  
	return true;
}
