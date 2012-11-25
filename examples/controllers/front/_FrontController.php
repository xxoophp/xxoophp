<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/**
 * 前台控制器基类
 * @author bing.peng
 *
 */
class _FrontController extends _Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function layout( $tpl, $data = array() ) {
		
		// 使用公共meta
		if( !isset( $data['meta'] ) ) {
			$data['meta'] = array(
				'title'			=> conf( 'app', 'site_name' ),
				'keywords'		=> 'xxoophp，开源，框架',
				'description'	=> 'xxoophp是一套PHP开发框架和工具包，国产，开源，超轻量级。'
			);	
		}
		
		$data['tpl'] = $tpl;
		render( 'front/main.layout', $data );
	}
	
}