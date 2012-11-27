<?php
define("FILE_ROOT","/var/www/lerne/");
define("DB_NAME","lerne");
define("DB_USER","root");
define("DB_PW","root");
define("DB_HOST","localhost");

define("DATA_ROOT","/var/www/lerne");
define('APP_ROOT','http://localhost:8888/lerne/');
define('FACEBOOK_APPID','388315841230762');
define('FACEBOOK_SECRET','6258d703772f293c7fbf5351119039db');

require_once (FILE_ROOT.'php-activerecord/ActiveRecord.php');
require_once(FILE_ROOT.'source/include/membersite_config.php');

ActiveRecord\Config::initialize(function($cfg)
	{
		$cfg->set_model_directory(FILE_ROOT.'db/models');
		$cfg->set_connections(array(
			'development' => 'mysql://'.DB_USER.':'.DB_PW.'@'.DB_HOST.'/'.DB_NAME.''));
	});

session_start();
#go to view/fb/fbconfig.php and set the right stuff there
?>
