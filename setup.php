<?php
	require_once('config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Welcome to Lern!</title>
   <?php require_once('view/css.inc'); ?>
</head>
<body class="yui-skin-sam">
	<div id="lr_header" class="header">
	</div>
	<div id="lr_content" class="content">
		<form action="setup-complete.php" method="POST">
		<legend>We need some info</legend>
		<input type="text" id="lr_setup_firstname" name="lr_setup_firstname" placeholder="Firstname"/>
		<div></div>
		<input type="text" id="lr_setup_lastname" name="lr_setup_lastname" placeholder="Lastname"/>
		<div></div>
		<input type="text" id="lr_setup_adminusername" name="lr_setup_adminusername" placeholder="Username"/>
		<div></div>
		<input type="password" id="lr_setup_adminpassword" name="lr_setup_adminpassword" placeholder="Password"/>
		<div></div>
		<input type="text" id="lr_setup_domain" name="lr_setup_domain" placeholder="Domain"/>
		<div></div>
		<input type="submit" id="lr_setup_submit" value="Add Domain" class="btn" />
		</form>
<?php require_once('view/footer.inc'); ?>
