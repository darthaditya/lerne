<?php
require_once('config.php');
require_once('saas/saas.php');
print_r($_POST);
$domainname = $_POST['lr_setup_domain'];
if($domainname){
//Create DB
//CREATE DATABASE  `helloworld` ;
//run db/db.sql on this DB
	$con = mysql_connect(DB_HOST,DB_USER,DB_PW);
	if (!$con){
  die('Could not connect: ' . mysql_error());
 }
	if(mysql_query("CREATE DATABASE $domainname",$con)){
  echo "Database created";
		$dirname = SAAS_ROOT.$domainname;
		$rootdir = DATA_ROOT;
echo "ln -s  $rootdir $dirname";
		system("ln -s  $rootdir $dirname");
		//system("rm $dirname/config.php");
		//system("touch $dirname/config.php");
//		$saas = new Saas;
//		$saas->generateConfig($domainname);
	}
	else{
  echo "Error creating database: " . mysql_error();
	}
	mysql_close($con);
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
	<div id="lr_header" class="header">
	</div>
	<div id="lr_content" class="content">
		<form action="setup.php" method="POST">
		<div class="label">Firstname</div>
		<div class="input"><input type="text" id="lr_setup_firstname" name="lr_setup_firstname"/></div>
		<div style="clear:both"></div>
		<div class="label">Lastname</div>
		<div class="input"><input type="text" id="lr_setup_lastname" name="lr_setup_lastname" /></div>
		<div style="clear:both"></div>
		<div class="label">Admin Username</div>
		<div class="input"><input type="text" id="lr_setup_adminusername" name="lr_setup_adminusername" /></div>
		<div style="clear:both"></div>
		<div class="label">Admin Password</div>
		<div class="input"><input type="password" id="lr_setup_adminpassword" name="lr_setup_adminpassword" /></div>
		<div style="clear:both"></div>
		<div class="label">Domain</div>
		<div class="input"><input type="text" id="lr_setup_domain" name="lr_setup_domain" /></div>
		<div style="clear:both"></div>
		<div style="input"><input type="submit" id="lr_setup_submit" value="Add Domain" /></div>
		</form>
<?php require_once('view/footer.inc'); ?>
