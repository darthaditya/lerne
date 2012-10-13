<?php
class Question extends ActiveRecord\Model{
 public function search($params){
  $subject  = $params['subject'];
  $rs = $this->all(array('conditions' => "subject LIKE '%$subject%'"));
  return $rs;
 }
 public function get($params){
  $id  = $params['id'];
  $rs = $this->find($id);//array('conditions' => "location LIKE '%$location%'"));
  return $rs;
 }
 public function add($params){
		$rs = $this->create(array('question_text'=>$params['text'],'subject'=>$params['subject'],'creator'=>$params['userid'],'tags'=>$params['tags'],'created'=>time()));
		return $rs;
	}
	public function getUserQuestions($params){
		$userid = $params['userid'];
		$rs = $this->find('all',array('select'=>'id','conditions'=>array('creator = ?',$userid)));
		return $rs;
	}
	public function getQuestionsSinceTimestamp($params){
		$timestamp = $params['timestamp'];
		$rs = $this->find('all',array('select'=>'id','conditions'=>array('created > ?',$timestamp)));
		return $rs;
	}
}
?>
