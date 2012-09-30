<?php
class Saas{
	public function setupDb($dbname,$dbhost,$dbuser,$dbpw,$dbfile){
		$con = mysql_connect($dbhost,$dbuser,$dbpw);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db($dbname);
		$createTables = $this->createTables();
		foreach($createTables as $value){
			mysql_query($value);
		}
		mysql_close($con);
		
	}
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
	private function createTables(){
		$answers = "CREATE TABLE `answers` (
				  `id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `answer_text` text NOT NULL,
				  `question_id` bigint(20) NOT NULL,
				  `creator` bigint(20) NOT NULL,
				  `created` bigint(20) NOT NULL,
				  `votes` bigint(20) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;";
		$questions = "CREATE TABLE `questions` (
				  `id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `question_text` text NOT NULL,
				  `subject` varchar(255) NOT NULL,
				  `tags` text NOT NULL,
				  `creator` bigint(20) NOT NULL,
				  `created` bigint(20) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;";
		$users = "CREATE TABLE `users` (
				  `id` bigint(20) NOT NULL AUTO_INCREMENT,
				  `username` varchar(255) NOT NULL,
				  `password` varchar(255) NOT NULL,
				  `totalamount` decimal(10,2) NOT NULL,
				  `facebookid` bigint(20) NOT NULL,
				  `facebookusername` varchar(255) NOT NULL,
				  `facebookfirstname` varchar(255) NOT NULL,
				  `facebooklastname` varchar(255) NOT NULL,
				  `facebookuserpic` text NOT NULL,
				  `facebookemail` varchar(255) NOT NULL,
				  `closingvalue` float(10,2) DEFAULT '0.00',
				  `currentgain` float(10,2) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;";
		return array($answers,$questions,$users);
	}
}



?>
