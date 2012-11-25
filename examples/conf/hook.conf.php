<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  -------------------------------------------------------------------
	钩子挂载配置文件
	eg:
	  $hooks['article/\d+'] = array(
	      'weld'	=> 'pre_controller',	// 挂载点
		  'fn'		=> 'hook_test',			// 需要执行的钩子函数名
		  'params'	=> array('red')			// 参数
	  );
  -------------------------------------------------------------------
*/

$hooks['article\/\d+'] = array(
	'weld'		=> 'pre_controller',
	'fn'		=> 'hook_test',
	'params'	=> array('red')
);
