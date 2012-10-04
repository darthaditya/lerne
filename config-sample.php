<?php
define("FILE_ROOT","/path/to/app/dir/");
define("DB_NAME","lerne");
define("DB_USER","db_user");
define("DB_PW","db_passwd");
define("DB_HOST","localhost");

define("DATA_ROOT","/path/to/app/dir");
define('APP_ROOT','http://localhost-lerne/');
define('FACEBOOK_APPID','FB APP ID');
define('FACEBOOK_SECRET','FB SECRET');

require_once (FILE_ROOT.'php-activerecord/ActiveRecord.php');
require_once(FILE_ROOT.'source/include/membersite_config.php');
ActiveRecord\Config::initialize(function($cfg)
{
		$cfg->set_model_directory(FILE_ROOT.'db/models');
		$cfg->set_connections(array(
			'development' => 'mysql://db_user:db_passwd@db_host/db_name'));
});

session_start();
#go to view/fb/fbconfig.php and set the right stuff there
?>
