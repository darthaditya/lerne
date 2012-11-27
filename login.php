<?php
//require_once("view/fb/facebook.php");
//require_once("view/fb/fbconfig.php");
require_once("config.php");

if(isset($_POST['submitted']))
{
  $fgmembersite->Login();
}

?>
<!DOCTYPE html">
<html lang="en-US">
<head>
   <title>Welcome to Lerne!</title>
   <?php require_once('view/css.inc'); ?>
    <script type='text/javascript' src='source/scripts/gen_validatorv31.js'></script>
</head>
<body>
	<div id="lr_header" class="header">
	</div>
	<div id="lr_content" class="content">
    <div class = "row">
		  <div id="lr_content_student" class="lr_content_student span4">
        <!-- Form Code Start -->
        <form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
          <fieldset>
            <h1 style="margin-left:70px;">Student?</h1>
            <h4>Login</h4>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <input type='text' name='username' id='username' placeholder="Username" />
            <span id='login_username_errorloc' class='error'></span>
            <input type='password' name='password' id='password' placeholder="Password"/>
            <span id='login_password_errorloc' class='error'></span>
            <input type='submit' name='Submit' value='Submit' class="btn btn-primary"/>
            <div class='short_explanation'><a href='./source/reset-pwd-req.php'>Forgot Password?</a>
            <p> Don't have an account?
            <a href='./source/register.php'> Register</a> </p></div>
          </fieldset>
        </form>
      </div>
      <div id="lr_content_teacher" class="lr_content_teacher offset4">
        <h1 style="margin-left: 50px;">Admin?</h1>
        <p style="margin-left: 50px;">Get Lerne for your school now!</p>
        <a style="margin-left:50px;"class="btn btn-primary " href="setup.php">Register</a>
      </div>
    </div>
  </div>
</body>
</html>
<?php require_once('view/footer.inc'); ?>
