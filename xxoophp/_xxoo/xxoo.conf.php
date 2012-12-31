<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

// 入口页
$GLOBALS['xxoo']['index'] = 'index.php';

/*
 * xxoo支持两种形式的url：
 *   pathinfo: PATH_INFO
 *   query string: QUERY_STRING
 */
$GLOBALS['xxoo']['protocol'] = 'PATH_INFO';

// 文件缓存目录
$GLOBALS['xxoo']['cache_dir'] = 'data/cache';

// 上传目录
$GLOBALS['xxoo']['upload_dir'] = 'static/uploads';

// 文件日志目录
$GLOBALS['xxoo']['logs_dir'] = 'logs';




