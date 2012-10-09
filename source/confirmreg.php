<?php
require_once("../config.php");
require_once("./include/membersite_config.php");

if(isset($_GET['code']))
{
   if($fgmembersite->ConfirmUser())
   {
        $fgmembersite->RedirectToURL("thank-you-regd.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Confirm registration</title>
      <?php require_once('../view/css.inc'); ?>
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body class="yui-skin-sam">
  <div id="lr_header" class="header">
  </div>
<!-- Form Code Start -->
<div id='fg_membersite' class="content span4 offset2">
  <h2 style="color:white;">Confirm registration</h2>
<p style="color:white;">
Please enter the confirmation code in the box below
</p>
<form id='confirm' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='get' accept-charset='UTF-8'>
    <input type='text' name='code' id='code' placeholder="Confirmation Code" /><div class='control-group error'><div class='controls'><span class='help-inline'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div></div>
    <span id='register_code_errorloc' class='error'></span>
    <input type='submit' name='Submit' value='Submit' class="btn btn-primary" />

</form>
<?php require_once('../view/footer.inc'); ?>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("confirm");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("code","req","Please enter the confirmation code");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>