<?php
require_once("view/fb/facebook.php");
require_once("view/fb/fbconfig.php");
require_once("config.php");
require_once(FILE_ROOT."source/include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL(FILE_ROOT."source/login-home.php");
   }
}

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
   <link rel="STYLESHEET" type="text/css" href="source/style/fg_membersite.css" />
    <script type='text/javascript' src='source/scripts/gen_validatorv31.js'></script>
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
        <!-- Form Code Start -->
<div id='fg_membersite'>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <input type='text' name='username' id='username' onfocus="if(this.value == 'Username') {this.value=''}" cols="54" onblur="if(this.value == ''){this.value ='Username'}"value='<?php ($fgmembersite->SafeDisplay('username'))?$fgmembersite->SafeDisplay('username'):'Username' ?>' maxlength="50" />
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <input type='password' name='password' id='password' maxlength="50" onfocus="if(this.value == 'Password') {this.value=''}" cols="54" onblur="if(this.value == ''){this.value ='Password'}" />
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
<div class='short_explanation'><a href='./source/reset-pwd-req.php'>Forgot Password?</a><br/><a href='./source/register.php'> Register</a> </div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>

<p style="color: white;">OR</p><a href="<?php echo $loginUrl ?>"><img src="view/img/fb_connect.png" alt="Login with Facebook"/></a>
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
