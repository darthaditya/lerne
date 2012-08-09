<?php
require_once('../config.php');
class getData {
	function __construct(){
		$link = mysql_connect(DB_HOST, DB_USER, DB_PW);
		if (!$link) {
		    die('Could not connect: ' . mysql_error());
		}
		mysql_select_db(DB_NAME, $link);
		$this->link = $link;
	}
	function get_answers(){
		$query = 'SELECT * FROM '.DB_NAME.'.answers order by votes desc';
		return $this->rs_to_array($query);
	}
	function add_answer($params){
		$query = "INSERT INTO ".DB_NAME.".answers(id, answer_text, question_id, creator, created, votes) VALUES('', '".$params['text']."','".$params['questionid']."', '".$params['userid']."', '".time()."',0)";
echo $query;
		$result = mysql_query($query,$this->link);
		if($result){
			return 1;
		}else{
			return 0;
		}
	}
	function get_answer_info($params){
		$query = "SELECT * FROM ".DB_NAME.".answers WHERE id=".$params['id'];
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
			$getuserexistsquery = "select id,username,facebookuserpic,totalamount from users where id=".$_SESSION['lerne_userid'];
                        $getuserid = $this->rs_to_array($getuserexistsquery);
                        $_SESSION['totalamount'] = $getuserid["resultlist"][0]["totalamount"];
			$totalamount = $getuserid["resultlist"][0]["totalamount"];

	}
	function __destruct() {
		mysql_close();
	}
}
?>

