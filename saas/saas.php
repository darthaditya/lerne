<?php
class Saas{
	public function genearteConfig($domaininfo){
		$config = 'define("FILE_ROOT","'.$domaininfo["file_root"].'");
		define("DB_NAME","lerne");
		define("DB_USER","root");
		define("DB_PW","root");
		define("DB_HOST","localhost");

		define("DATA_ROOT","'.$domaininfo["file_root"].'");
		define("APP_ROOT","'.$domaininfo["app_root"].'");

		require_once (FILE_ROOT."php-activerecord/ActiveRecord.php");

		ActiveRecord\Config::initialize(function($cfg)
		{
				$cfg->set_model_directory(FILE_ROOT."db/models");
				$cfg->set_connections(array(
					"development" => "mysql://DB_USER:DB_PW@DB_HOST/DB_NAME"));
		});
		session_start();';
		$configfile = 'config.php';
		$fh = fopen($configfile,'w') or die("can't open file");
		fwrite($fh, $config);
		fclose($fh);
	}
}



?>
