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
			case "vote":
				$this->addVote($_REQUEST);
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
		$votes = new Vote;
		$params['userid'] = 1;//get this from SESSION
		foreach($rs_obj as $result){
			$answers_count = Answer::count(array('question_id'=>$result->id));	
			$resultObj = $result->attributes();
			$resultObj['answer_count'] = $answers_count;

			$vote_count = $votes->getCount(array('componentid'=>$result->id,'type'=>'question'));
			$resultObj['votecountup'] = $vote_count['voteup'];
			$resultObj['votecountdown'] = $vote_count['votedown'];
			
			$resultObj['voted'] = 0;
			$voted = $votes->getVote(array('componentid'=>$result->id,'userid'=>$params['userid'],'type'=>'question'));
			if($voted){
				$resultObj['voted'] = 1;
				$votetype = $voted->attributes();
				$resultObj['votetype'] = 0; 
				if($votetype['votes'] > 0){
					$resultObj['votetype'] = 1; 
				}else if($votetype['votes'] < 0){
					$resultObj['votetype'] = -1; 
				}
			}
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
	function addVote($params){
		$vote = new Vote;
		$params['userid'] = 1;//$_SESSION["userid"];
		$params['componentid'] = $params['questionid'];
		if($params['voteup']){
			$params['vote'] = 1;
		}else{
			$params['vote'] = -1;
		}
		$rs_obj = $vote->add($params);
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
