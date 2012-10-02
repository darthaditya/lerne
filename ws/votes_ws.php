<?php
require_once('../config.php');
require_once(FILE_ROOT.'ws/controllers/votes.php');

$action = $_REQUEST['action'];
$request = new votes_WS;

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

//class WS{
//	function get($action,$_REQUEST){
//		switch($action){
//			case "list":
//				$this->listQuestions($_REQUEST);
//			break;
//			case "questioninfo":
//					$this->questionInfo($_REQUEST);
//			break;
//			default:
//			break;
//		};
//	}
//	function post($action,$_REQUEST){
//		switch($action){
//			case "add":
//				$this->addQuestion($_REQUEST);
//				break;
//			default:
//				break;
//		};
//	}
//	function listQuestions(){
//		$getdata = new getData;
//		$questionlist = $getdata->get_questions();
//		header('Content-Type:application/json');
//		echo json_encode($questionlist);
//	}
//	function addQuestion($params){
//		$getdata = new getData;
//		$params['userid'] = $_SESSION["userid"];
//		$questionlist = $getdata->add_question($params);
//		header('Content-Type:application/json');
//		echo json_encode($questionlist);
//	}
//	function questionInfo($params,$returnflag){
//		$getdata = new getData();
//		$questioninfo = $getdata->get_question_info($params);
//		if($returnflag){
//			return $questioninfo;
//		}else{
//			header('Content-Type:application/json');
//			echo json_encode($questioninfo);
//		}
//	}
//}
?>

