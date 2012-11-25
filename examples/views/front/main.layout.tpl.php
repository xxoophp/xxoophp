<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $meta['title'] ?></title>
	<meta name="description" content="<?php echo $meta['description'] ?>..." />
	<meta name="keywords" content="<?php echo $meta['keywords'] ?>" />
	<link rel="stylesheet" href="<?php echo static_url('front/xxoodemo.css'); ?>" />
</head>
<body>
	<div class="header box">
		<h3>xxoophp blog</h3>
		<div class="nav">
			<ul>
				<li><a href="<?php echo base_url(); ?>">首页</a></li>
				<li><a href="<?php echo site_url('about'); ?>">关于</a></li>
			</ul>
			<div class="c"></div>
		</div>
	</div>
	<div class="blank2"></div>
	<div class="content-box box">
		<?php include ROOT . "views/{$tpl}.tpl.php"; ?>
	</div>
	<div class="blank5"></div>
	<div class="footer box">
		<p>
			&copy;<a href="http://xxoophp.com">xxoophp.com</a>
		</p>
	</div>
</body>
</html>