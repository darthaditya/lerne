<?php
class votes_WS{
	function get($action,$_REQUEST){
		switch($action){
			case "countvote":
				$this->countVotes($_REQUEST);
			break;
			default:
			break;
		};
	}
	function post($action,$_REQUEST){
		switch($action){
			case "add":
				$this->addVote($_REQUEST);
				break;
			default:
				break;
		};
	}
	function countVotes($params,$json=0){
		$votes = new Vote;
		$params['componentid'] = 1;
		$params['type'] = 'question';
		$json_obj = $votes->getCount($params);
		if(!$json){
			header('Content-Type:application/json');
			echo json_encode($json_obj);
		}else{
			return $json_obj;
		}
	}
	function addVote($params){
		$ques = new Vote;
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
}
?>
