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
   <?php require_once('config.php'); ?>
   <?php require_once('view/css.inc'); ?>
</head>
<body class="yui-skin-sam">
  <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : 388315841230762, // App ID
            //channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
          });
        };
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
      </script>
	<div id="lr_header" class="header">
	</div>
	<div id="lr_content" class="container">
		<div id="lr_content_student" class="lr_content_student span5">
			<h1>Student?</h1>
			<a href="<?php echo $loginUrl ?>"><img src="view/img/fb_connect.png" alt="Login with Facebook"/></a>
		</div>
		<div id="lr_content_teacher" class="lr_content_teacher span5">
			<h1>Admin?</h1>
			<p>Get Lerne for your school or class now!</p>
			<a class="btn btn-primary btn-large" href="setup.php">Get lerne for your class</a>
		</div>
		<div style="clear:both"></div>
	</div>
	<!-- YOUR NAVIGATION GOES HERE -->
<!--  <object width="425" height="350" data="http://www.youtube.com/v/a6kwIBI3j98" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/a6kwIBI3j98" /></object>-->
<!--
<script src="http://yui.yahooapis.com/3.4.1/build/yui/yui-min.js"></script>
<script type="text/javascript" src="view/js/constants.js"></script>
<script type="text/javascript" src="view/js/modules.js"></script>
<script type="text/javascript" src="view/js/main.js"></script>
-->
<?php require_once('view/footer.inc'); ?>
