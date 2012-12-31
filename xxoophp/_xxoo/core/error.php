<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<title><?php echo $title ?></title>
<style type="text/css">
* { margin:0; padding:0; }
body { text-align:center; line-height:30px; }
.error-box { border:1px solid #cccccc; margin:30px; padding:20px; text-align:left; }
.error-box h3 { font-size:16px; color:#a00a00; font-weight:normal; }
.error-box p { font-size:14px; color:#333333; }
pre { background:#f5f5f5; line-height:100%; margin:20px 0; padding:20px; word-wrap:break-word; }
</style>
</head>
<body>
	<div class="error-box">
		<h3><?php echo $title; ?></h3>
		<p><?php echo $message ?></p>
		<?php 
			if( ENV == 'development' ) {	
				echo '<pre>';
				print_r($GLOBALS);
				echo '</pre>';
			}
		?>
	</div>
</body>
</html>
