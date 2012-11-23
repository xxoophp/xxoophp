<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

class DefaultController extends _Controller {

	public function __controller() {
		parent::__construct();
	}
	
	public function index() {
		echo 'welcome to xxoophp.';
	}
	
} 