<?php
class user_WS{
	function get($action,$_REQUEST){
		switch($action){
			case "getnotifications":
				$this->listNotifications($_REQUEST);
			break;
			case "getuservotes":
					$this->getUserVotes($_REQUEST);
			break;
			default:
			break;
		};
	}
	function post($action,$_REQUEST){
		switch($action){
			case "add":
				$this->addQuestion($_REQUEST);
			break;
			case "vote":
				$this->addVote($_REQUEST);
			break;
			default:
				break;
		};
	}
	function listNotifications($params,$json=0){
		$ques = new Question;
		$ans = new Answer;
		$notificationArr = array();
		//get all answers posted since last login
		$rs_obj = $ques->getUserQuestions($params);
		$qids = array();	
		foreach($rs_obj as $result){
			$temp = $result->attributes();
			array_push($qids,$temp['id']);	
		}
		$rs_ans = $ans->getUserQuestionAnswers(array('qids'=>$qids));	
		foreach($rs_ans as $result){
			$temp = $result->attributes();
			array_push($notificationArr,$temp);	
		}
		//get all newly added questions
		$rs_ques = $ques->getQuestionsSinceTimestamp(array('timestamp'=>$_SESSION['lastlogin']));
		$json_obj = array();
	}
	function getUserVotes($params,$json=0){
	}
}
?>
