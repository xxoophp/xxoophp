<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title><?php echo $title ?></title>	
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="Pragma" content="no-cache" />
	<style type="text/css">
		* { margin:0; padding:0; }
		body { text-align:center; line-height:30px; }
		.error-box { border:1px solid #cccccc; margin:30px; padding:20px; text-align:left; }
		.error-box h3 { font-size:16px; color:#a00a00; font-weight:normal; }
		.error-box p { font-size:14px; color:#333333; }
	</style>	
</head>

<body>
	<div class="error-box">
		<h3><?php echo $title; ?></h3>
		<p><?php echo $message ?></p>
	</div>
</body>
</html>
