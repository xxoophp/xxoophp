<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  --------------------------------------------------------------
	扩展函数集
	系统在载入Controller文件前，自动加载入本文件
  --------------------------------------------------------------
*/

function static_url( $filepath ) {
	return base_url() . 'static/' . $filepath;
}