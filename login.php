<?php
require_once("view/fb/facebook.php");
require_once("view/fb/fbconfig.php");

$facebook = new Facebook(array(
  'appId'  => FB_APPID,
  'secret' => FB_SECRET,
));

$user = $facebook->getUser();

if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
  $_SESSION['lerne_userid'] = "";
  $_SESSION['totalamount'] = "";
  $_SESSION['fbuserpic'] = "";
  $_SESSION['username'] = "";

  header( 'Location: '.FB_REDIRECTLOGIN ) ;
} else {
  $loginUrl = $facebook->getLoginUrl();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Welcome to Lern!</title>
   <?php require_once('view/css.inc'); ?>
</head>
<body class="yui-skin-sam">  
<div id="doc2" class="yui-t2">
        <div id="leftheader">
           <a href="index.php"><div id="hd" role="banner">
                <h1>Lerne</h1>
           </div>
           </a>
        </div>

<div id="bd">
	<div id="yui-main">
		<div class="yui-b">
			<div class="yui-gc">
				<div class="yui-u first">
					<div id="loginbutton">
					  <a href="<?php echo $loginUrl ?>"><img src="view/img/fb_connect.png" alt="Login with Facebook"/></a>
					</div>
				</div>
				<div class="yui-u">
				</div>
			</div>
		</div>
	</div>
	<div class="yui-b">
	<!-- YOUR NAVIGATION GOES HERE -->
	</div>
	</div>
<!--
<script src="http://yui.yahooapis.com/3.4.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="view/js/constants.js"></script>
<script type="text/javascript" src="view/js/modules.js"></script>
<script type="text/javascript" src="view/js/main.js"></script>
-->
<?php require_once('view/footer.inc'); ?>
