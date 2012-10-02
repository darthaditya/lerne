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
		$votes = new Vote();
		$params['userid'] = 1;//get this from session
		foreach($rs_obj as $result){
			$resultObj = $result->attributes();

			$vote_count = $votes->getCount(array('componentid'=>$result->id,'type'=>'answer'));
            $resultObj['votecountup'] = $vote_count['voteup'];
            $resultObj['votecountdown'] = $vote_count['votedown'];

            $resultObj['voted'] = 0;
            $voted = $votes->getVote(array('componentid'=>$result->id,'userid'=>$params['userid'],'type'=>'answer'));
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
