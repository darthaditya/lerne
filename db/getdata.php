<?php
require_once('../config.php');
require_once("SimpleRestClient.php");
class getData {
	function __construct(){
		$link = mysql_connect(DB_HOST, DB_USER, DB_PW);
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}
		mysql_select_db(DB_NAME, $link);
		$this->link = $link;
	}
	function get_questions(){
		$query = 'SELECT * FROM lerne.questions order by created desc';
		return $this->rs_to_array($query);
	}
	function add_question($params){
		$query = "INSERT INTO questions(id, question_text, subject, tags, creator, created) VALUES('', '".$params['text']."','".$params['subject']."', '".$params['tags']."', '".$params['userid']."', '".time()."')";
		$result = mysql_query($query,$this->link);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	function get_question_info($params){
		$query = "SELECT * FROM questions WHERE id=".$params['id'];
		return $this->rs_to_array($query);
	}
	function rs_to_array($query){
		$result = mysql_query($query,$this->link);
    $resultlist = array();
		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		$rows = array();
		while($r = mysql_fetch_assoc($result)) {
			$rows[] = $r;
		}
		$resultlist['resultlist'] = $rows;
		return $resultlist;
	}
	function current_user_info(&$totalamount){
			$getuserexistsquery = "select id_user,username from lerne_users where id=".$_SESSION['lerne_userid'];
                        $getuserid = $this->rs_to_array($getuserexistsquery);
                        $_SESSION['totalamount'] = $getuserid["resultlist"][0]["totalamount"];
			$totalamount = $getuserid["resultlist"][0]["totalamount"];

	}
	function __destruct() {
		mysql_close();
	}
}
?>

