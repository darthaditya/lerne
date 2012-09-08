<?php
class Question extends ActiveRecord\Model{
 public function search($params){
  $location  = $params['location'];
  $rs = $this->all();//array('conditions' => "location LIKE '%$location%'"));
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
}
?>
