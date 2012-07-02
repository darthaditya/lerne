<?php
#ini_set("display_errors","1");
require_once('config.php');
Class fbUser {
        function __construct(){
                $link = mysql_connect(DB_HOST, DB_USER, DB_PW);
                if (!$link) {
                    die('Could not connect: ' . mysql_error());
                }
                mysql_select_db(DB_NAME, $link);
                $this->link = $link;
        }
	function add_user($params){
		$getuserexistsquery = "select id,username,facebookuserpic,totalamount from users where facebookid=".$params["id"];
		$getuserid = $this->rs_to_array($getuserexistsquery);
		if(!$getuserid["resultlist"]){
			$fbuserid = $params["id"];
			$fbusername = $params["username"];
			$fbfirstname = $params["first_name"];
			$fblastname = $params["last_name"];
			$fbpicture = "https://graph.facebook.com/$fbuserid/picture";
			$adduserquery = "insert into users values('','$fbusername','',1000000,$fbuserid,'$fbusername','$fbfirstname','$fblastname','$fbpicture','','','')";	
			$result = mysql_query($adduserquery,$this->link);
			if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
			}
			$getuserexistsquery = "select id,username,facebookuserpic,totalamount from users where facebookid=".$params["id"];
			$getuserid = $this->rs_to_array($getuserexistsquery);
			$_SESSION['fbuserpic'] = $getuserid["resultlist"][0]["facebookuserpic"];
			$_SESSION['username'] = $getuserid["resultlist"][0]["username"];
			$_SESSION['firstname'] = $getuserid["resultlist"][0]["facebookfirstname"];
			$_SESSION['lastname'] = $getuserid["resultlist"][0]["facebooklastname"];
			$_SESSION['name'] = $getuserid["resultlist"][0]["facebookfirstname"]." ".$getuserid["resultlist"][0]["facebooklastname"];
			$_SESSION['userid'] = $getuserid["resultlist"][0]["id"];
		}else{
			$_SESSION['fbuserpic'] = $getuserid["resultlist"][0]["facebookuserpic"];
			$_SESSION['username'] = $getuserid["resultlist"][0]["username"];
			$_SESSION['firstname'] = $getuserid["resultlist"][0]["facebookfirstname"];
			$_SESSION['lastname'] = $getuserid["resultlist"][0]["facebooklastname"];
			$_SESSION['name'] = $getuserid["resultlist"][0]["facebookfirstname"]." ".$getuserid["resultlist"][0]["facebooklastname"];
			$_SESSION['userid'] = $getuserid["resultlist"][0]["id"];
		}
		return 1;
	}
	function rs_to_array($query){
		$result = mysql_query($query,$this->link);
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		$rows = array();
		while($r = mysql_fetch_assoc($result)) {
			$rows[] = $r;
		}
		$resultlist[resultlist] = $rows;
		return $resultlist;
	}
}
?>
