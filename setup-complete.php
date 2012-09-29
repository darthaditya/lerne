<?php
require_once('config.php');
require_once('saas/saas.php');
$domainname = $_POST['lr_setup_domain'];
$confirmSetup = 'Sorry. There was an error. Please contact us at help@lerne.in.';
if($domainname){
	$con = mysql_connect(DB_HOST,DB_USER,DB_PW);
	if (!$con){
		die('Could not connect: ' . mysql_error());
	 }
	if(mysql_query("CREATE DATABASE $domainname",$con)){
		mysql_close($con);
		$saas = new Saas;
		$saas->setupDb($domainname,DB_HOST,DB_USER,DB_PW,DATA_ROOT.'/db/db.sql');
		$dirname = SAAS_ROOT.$domainname;
		$rootdir = SAAS_APP;
		symlink($rootdir,$dirname);
		$confirmSetup = "Congratulations! Setup is complete. Access your site at ".SAAS_WWW.$domainname;
	}
	else{
	  echo "Error creating database: " . mysql_error();
	}
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
		<div class="well well-large">
			<?php echo $confirmSetup; ?>
		</div>
<?php require_once('view/footer.inc'); ?>
