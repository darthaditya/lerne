<?php
class Vote extends ActiveRecord\Model{
 public function search($params){
  $location  = $params['location'];
  $rs = $this->all();//array('conditions' => "location LIKE '%$location%'"));
  return $rs;
 }
 public function getCount($params){
	$id  = $params['componentid'];
	$type = $params['type'];
	$votecount_up = 0;
	$votecount_down = 0;
	$rs_voteup = $this->find('all',array('select'=>'sum(votes) as votecount','conditions'=>array('votes > 0 AND componentid = ?',$id)));
	foreach($rs_voteup as $r){
		if($r->votecount)
		$votecount_up = intval($r->votecount);
		break;
	}
	$rs_votedown = $this->find('all',array('select'=>'sum(votes) as votecount','conditions'=>array('votes < 0 AND componentid = ?',$id)));
	foreach($rs_votedown as $r){
		if($r->votecount)
		$votecount_down = intval($r->votecount);
		break;
	}
	return array('voteup'=>$votecount_up,'votedown'=>$votecount_down);
 }
public function getVote($params){
	$id = $params['componentid'];
	$userid = $params['userid'];
	$rs = $this->find(array('componentid'=>$id,'creator'=>$userid,'type'=>$params['type']));
	return $rs;
}
 public function add($params){
		$rs = $this->create(array('componentid'=>$params['componentid'],'votes'=>$params['vote'],'creator'=>$params['userid'],'type'=>$params['type'],'created'=>time()));
		return $rs;
	}
}
?>
