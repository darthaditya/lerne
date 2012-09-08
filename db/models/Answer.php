<?php
class Answer extends ActiveRecord\Model{
 public function search($params){
  $quesid = $params['questionid'];
  $rs = $this->all(array('conditions' => "question_id = '$quesid'"));
  return $rs;
 }
 public function get($params){
  $id  = $params['id'];
  $rs = $this->find($id);//array('conditions' => "location LIKE '%$location%'"));
  return $rs;
 }
 public function add($params){
		$rs = $this->create(array('answer_text'=>$params['text'],'question_id'=>$params['questionid'],'creator'=>$params['userid'],'created'=>time()));
		return $rs;
	}
}
?>
