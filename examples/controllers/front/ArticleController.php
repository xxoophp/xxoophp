<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

require ROOT . 'controllers/front/_FrontController.php';
require ROOT . 'libs/Paginator.lib.php';

/**
 * 文章控制器
 * @author bing.peng
 *
 */
class ArticleController extends _FrontController {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 文章列表
	 */
	public function index() {
		// 获取文章总数
		$total = get_var( 'select count(*) as num from article' );	
		
		// 没有文章
		if( $total <= 0 ) {	
			$this->layout( 'article_list_blank' );
		}
		
		// 生成分页信息
		$pageInfo = Paginator::gen( $total );	
		
		// 获取文章列表
		$article_list = get_data( "select id, title, summary from article order by created desc " . $pageInfo['limit'] );
		
		// 组装页面数据
		$data = array(
			'article_list'	=> $article_list,
			'pagination'	=> Paginator::html( $pageInfo )		 
		);
		
		// 调用视图
		$this->layout( 'front/article_list' , $data);
	}
	
	/**
	 * 文章单页
	 * @param int $id
	 */
	public function show( $id ) {
		// 根据id从数据库中取出文章
		$article = get_line( "select * from article where id={$id}" );
		
		// 构建页面meta信息
		$meta = array(
			'title'			=> $article['title'] .'-'. conf( 'app', 'site_name' ),
			'keywords'		=> $article['keywords'],
			'description'	=> $article['summary']
		);
		
		// 组装页面数据
		$data = array(
			'meta'		=> $meta,
			'article'	=> $article
		);
		
		// 调用视图
		$this->layout( 'front/article', $data );
	}
	
}
