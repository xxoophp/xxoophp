<?php if ( !defined('XXOO') ) exit('No direct script access allowed');

/**
 * 分页类
 * @author bing.peng
 *
 */
abstract class Paginator {
	
	/**
	 * 计算，获取分页信息
	 * @param int $totalRows 总记录数
	 * @param int $pageRows 每页显示的记录数
	 * @param int $paging 当前页号
	 */
	public static function gen( $total_rows, $page_rows=10, $tag='page' ) {
		$arr = array();
		// 计算总页数
		$total_page = ceil( $total_rows / $page_rows );
		if( $total_page < 0 ) { $total_page = 0; }

		
		// 从GET/POST请求中获取当前页码
		$paging = 1;
		if( isset( $_GET[ $tag ] ) ) {
			$paging = $_GET[ $tag ];			
		}
		elseif( isset( $_POST[ $tag ] ) ) {
			$paging = $_POST[ $tag ];
		}
		
		if( $paging < 1 ) {
			$paging = 1;
		}
		elseif( $paging > $total_page ) {
			$paging = $total_page;
		}
		Logger::debug( 'paging:' . $paging );
		
		$upto = ($paging - 1) * $page_rows;
		$upto = ($upto < 0) ? 0 : $upto;
		$arr['upto'] 		= $upto;	// 数据库开始行
		$arr['limit'] 		= ' LIMIT '.$arr['upto'].','.$page_rows;	// mysql limit sql part
		$arr['paging'] 		= $paging;	// 当前页
		$arr['previous'] 	= ($paging <= 1) ? $paging : ($paging - 1); 		// 上一页
		$arr['next'] 		= ($paging >= $total_page) ? $total_page : ($paging + 1); // 下一页
		$arr['total_page'] 	= $total_page;	// 总页数
		$arr['total_rows']  = ($total_rows < 0) ? 0 : $total_rows;	// 总记录数
		$arr['page_rows'] 	= $page_rows;	// 每页记录数
		$arr['tag'] 		= $tag;
		$arr['pages'] 		= self::__pages( $total_page, $page_rows, $paging );	// 分页页码
		
		return $arr;
	}
	
	/**
	 * 生成分页码数组
	 * @param int $totalPage 总页数
	 * @param int $pageRows 每页显示的记录数
	 * @param int $paging 当前页
	 */
	private static function __pages( $totalPage, $pageRows, $paging  ) {
		// 只有一页
		if( $totalPage == 1 ) {
			return array(1);
		}
		
		// 开始页码
		$start = $paging - 5;
		if( $start < 1 ) {
			$start = 1;
		}
		
		// 结束页码
		$end = $paging + 5;
		if( $end - $start < $pageRows ) {	// 不够10个页码时，补够
			$end += $end - $start;
		}
		if( $end > $totalPage ) {	// 超过总页数
			$end = $totalPage;
		}
		
		$arr = array();
		for( $i=$start; $i<=$end; $i++ ) {
			$arr[] = $i;
		}
		return $arr;
	}
	
	/**
	 * 生成分页HTML
	 * @param array $info 分页信息数组
	 * @param string $url 分页链接URL，默认为当前URL
	 */
	public static function html( array $info, $url='' ) {
		// 当只有一页时，返回空字符串
		if( $info['total_page'] <= 1 ) {
			return '';
		}
		
		// 获取当前URL
		$url = self::__genUrl( $info['tag'], $url );

		$str = '';
		if( $info['paging'] > 1 ) {
			$str .= '<a href="'.$url.$info['previous'] .'">上一页</a>';
		}
		else {
			$str = "<span>上一页</span>";
		}
		
		foreach( $info['pages'] as $i ) {
			if( $i == $info['paging'] ) {
				$str .= "<span class='active'>". $i ."</span>";		
			}
			else {
				$str .= "<a href='".$url.$i."'>$i</a>";
			}
		}
		
		if( $info['paging'] == $info['total_page'] ) {
			$str .= "<span>下一页</span>";
		}
		else {
			$str .= '<a href="'.$url.$info['next'] .'">下一页</a>';
		}
		return $str;
	}
	
	/**
	 * 生成分页url链接
	 * @param string $tag
	 * @param string $url
	 * @return string
	 */
	private static function __genUrl( $tag, $url ) {
		if( empty($url) ) {
			$http_protocol = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) ? 'https://' : 'http://';
			$url = $http_protocol . $_SERVER ['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
		
		$query_string = '';
		$new_url = '';
		if( $pos = strpos( $url, '?' ) ) {
			$new_url = substr( $url, 0, $pos+1 );
			$query_string = substr( $url, $pos+1 );
		}
		else {
			$new_url = $url . '?';
		}
		
		// 重新组装url请求参数
		if( !empty($query_string) ) {
			$query_string_arr = explode( '&', $query_string );
			$qs_arr = array();
			$pattern = '/^'.$tag.'=\d+$/';
			foreach( $query_string_arr as $qs ) {
				if( !preg_match($pattern, $qs) ) {
					$qs_arr[] = $qs;
				}	
			}
			
			if( count($qs_arr) > 0 ) {
				$new_url .= implode( '&', $qs_arr ) . '&';
			}
		}
		
		$new_url .= $tag . '=';
		return $new_url;
	}
	
}

