<?php
require FILE_ROOT.'view/fb/facebook.php';
require_once(FILE_ROOT."view/fb/fbconfig.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Lerne</title>
	<?php require_once(FILE_ROOT.'view/css.inc'); ?>
</head>
<body class="yui-skin-sam">
<div id="doc2" class="yui-t2">
	<div id="lr_header" class="header">
		<div class="lr_login_user_info">
      <div id="lr_logout" class="lr_logout"><a href="<?php echo $logoutUrl; ?>">Logout</a></div>
		</div>
	</div>
