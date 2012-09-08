<?php
require_once('../config.php');
require_once(FILE_ROOT."db/answer/getdata.php");

$action = $_REQUEST['action'];
$request = new WS;

switch($_SERVER['REQUEST_METHOD']){
	case "GET":
		$request->get($action,$_REQUEST);
		break;
	case "POST":
		$request->post($action,$_REQUEST);
		break;
	default:
		break;
};

class WS{
	function get($action,$_REQUEST){
		switch($action){
			case "list":
				$this->listAnswers($_REQUEST);
			break;
			case "questioninfo":
					$this->answerInfo($_REQUEST);
			break;
			default:
			break;
		};
	}
	function post($action,$_REQUEST){
		switch($action){
			case "add":
				$this->addAnswer($_REQUEST);
				break;
			default:
				break;
		};
	}
	function listAnswers($params){
		$getdata = new getData;
		$answerlist = $getdata->get_answers($params);
		header('Content-Type:application/json');
		echo json_encode($answerlist);
	}
	function addAnswer($params){
		$getdata = new getData;
		$params['userid'] = $_SESSION["userid"];
		$answer = $getdata->add_answer($params);
		header('Content-Type:application/json');
		echo json_encode($answer);
	}
	function questionInfo($params,$returnflag){
		$getdata = new getData();
		$questioninfo = $getdata->get_question_info($params);
		if($returnflag){
			return $questioninfo;
		}else{
			header('Content-Type:application/json');
			echo json_encode($questioninfo);
		}
	}
}
?>

