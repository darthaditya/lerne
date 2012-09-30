<?php
class answer_WS{
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
	function listAnswers($params,$json=0){
		$ans = new Answer;
		$rs_obj = $ans->search($params);
		$json_obj = array();
		foreach($rs_obj as $result){
			array_push($json_obj,$result->attributes());
		}
		if(!$json){
			header('Content-Type:application/json');
			echo json_encode($json_obj);
		}else{
			return $json_obj;
		}
	}
	function addAnswer($params){
		$ans = new Answer;
		$params['userid'] = $_SESSION["userid"];
		$rs_obj = $ans->add($params);
		if($rs_obj->attributes()){
			$json_obj = $rs_obj->attributes();
			header('Content-Type:application/json');
			echo json_encode($json_obj);
		}else{
			return 0;
		}
	}
}
?>
