<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/*
  --------------------------------------------------------
  	钩子扩展函数集
  --------------------------------------------------------
*/


function hook_test( $color ) {
	Logger::debug( 'exec hook test function username:' . $color );
}