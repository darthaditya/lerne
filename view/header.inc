<?php
//require FILE_ROOT.'view/fb/facebook.php';
//require_once(FILE_ROOT."view/fb/fbconfig.php");
//
//$facebook = new Facebook(array(
//  'appId'  => FB_APPID,
//  'secret' => FB_SECRET,
//));
//
//
//$user = $facebook->getUser();
//
//if ($user) {
//  try {
//    $user_profile = $facebook->api('/me');
//  } catch (FacebookApiException $e) {
//    error_log($e);
//    $user = null;
//  }
//}
//
//if ($user) {
//  $logoutUrl = $facebook->getLogoutUrl();
//} else {
//  header( 'Location: '.FB_REDIRECT ) ;
//}
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
			<div class="dropdown">
				<div id="lr_login_user_name" class="lr_login_user_name dropdown-toggle" data-toggle="dropdown" href="#">
					<?php echo "Niranjan B Prithviraj";//$_SESSION['username']; ?>
					<img src="<?php echo $_SESSION['fbuserpic']; ?>"  height="16px" width="16px" style="border:1px solid #ccc;"/>
				</div>
				<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel">
					<li id="lr_logout" class="lr_logout"><a href="<?php echo $logoutUrl; ?>">Logout</a></li>
					<li id="lr_logout" class="lr_logout"><a href="<?php echo $logoutUrl; ?>">Edit your Profile</a></li>
					<li id="lr_logout" class="lr_logout"><a href="<?php echo $logoutUrl; ?>">Logout</a></li>
					<li id="lr_logout" class="lr_logout"><a href="<?php echo $logoutUrl; ?>">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
