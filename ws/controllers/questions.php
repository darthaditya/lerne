<?php
class question_WS{
	function get($action,$_REQUEST){
		switch($action){
			case "list":
				$this->listQuestions($_REQUEST);
			break;
			case "questioninfo":
					$this->questionInfo($_REQUEST);
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
			default:
				break;
		};
	}
	function listQuestions($params,$json=0){
		$ques = new Question;
		$rs_obj = $ques->search($params);
		$json_obj = array();
	
		$answers = new Answer;
		foreach($rs_obj as $result){
			$answers_count = Answer::count(array('question_id'=>$result->id));	
			$resultObj = $result->attributes();
			$resultObj['answer_count'] = $answers_count;
			array_push($json_obj,$resultObj);
		}
		if(!$json){
			header('Content-Type:application/json');
			echo json_encode($json_obj);
		}else{
			return $json_obj;
		}
	}
	function addQuestion($params){
		$ques = new Question;
		$params['userid'] = $_SESSION["userid"];
		$rs_obj = $ques->add($params);
		if($rs_obj->attributes()){
			$json_obj = $rs_obj->attributes();
		   header('Content-Type:application/json');
		   echo json_encode($json_obj);
		}else{
			return 0;
		}
	}
	function questionInfo($params,$json=0){
		$ques = new Question;
		$rs_obj = $ques->get($params);
		$json_obj = $rs_obj->attributes();
		if(!$json){
			header('Content-Type:application/json');
			echo json_encode($json_obj);
		}else{
			return $json_obj;
		}
	}
}
?>
