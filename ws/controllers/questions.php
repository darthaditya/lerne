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
//		$getdata = new getData;
//		$questionlist = $getdata->get_questions();
		$ques = new Question;
		$rs_obj = $ques->search($params);
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
	function addQuestion($params){
//		$getdata = new getData;
//		$questionlist = $getdata->add_question($params);
//		header('Content-Type:application/json');
//		echo json_encode($questionlist);
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
//		$getdata = new getData();
//		$questioninfo = $getdata->get_question_info($params);
//		if($returnflag){
//			return $questioninfo;
//		}else{
//			header('Content-Type:application/json');
//			echo json_encode($questioninfo);
//		}
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
