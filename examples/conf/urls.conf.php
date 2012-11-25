<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  ---------------------------------------------------------------------- 
	URL请求资源配置
	eg:
	$urls['url'] = array(
		'c'	=> 'front/Article', 		// 控制器文件名、类名
		'f'	=> 'show', 					// 方法名
		'p'	=> 'sp',					// 额外参数
	);
  ----------------------------------------------------------------------
*/

// default controller
$urls['default'] = array('c'=>'front/Article');
$urls['article\/(\d+)'] = array('c'=>'front/Article','f'=>'show');
$urls['about'] = array('c'=>'front/Page','f'=>'show', 'p'=>'about');
