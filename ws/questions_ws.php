<?php
require_once('../config.php');
require_once(FILE_ROOT."db/getdata.php");

$action = $_REQUEST['action'];
$request = new WS;

switch($_SERVER['REQUEST_METHOD']){
	case "GET":
		$request->get($action);
		break;
	case "POST":
		$request->post($action);
		break;
	default:
		break;
};

class WS{
	function get($action){
		switch($action){
			case "list":
				$this->listQuestions();
			break;
			default:
			break;
		};
	}
	function post($action){
		switch($action){
			case "add":
				$this->addQuestion();
				break;
			default:
				break;
		};
	}
	function listQuestions(){
		$getdata = new getData;
		$questionlist = $getdata->get_questions();
		header('Content-Type:application/json');
		echo json_encode($questionlist);
	}
	function addQuestion(){
		$getdata = new getData;
		$params = array();
		$params["text"] = $_REQUEST['text'];
		$params["userid"] = $_SESSION["userid"];
		$questionlist = $getdata->add_question($params);
		header('Content-Type:application/json');
		echo json_encode($questionlist);
	}
	function listStocks(){
		$getdata = new getData;
		$params['userid'] = $_REQUEST['userid'];
		$stocklist = $getdata->get_user_stocks($params);
		$stocklist = json_decode($stocklist);
		$overallhash = array();
		$overallhash['previousDayValue'] = $stocklist->previousDayValue;
		$overallhash['currentValue'] = $stocklist->currentValue;# + $_SESSION[totalamount];
		$overallhash['change'] = $stocklist->change;
		$overallhash['changePercent'] = $stocklist->changePercent;
		$overallhash['gain'] = $stocklist->gain;
		$overallhash['gainPercent'] = $stocklist->gainPercent;

		$stocklist->overall = $overallhash;
		$stocklist = json_encode($stocklist);
		header('Content-Type:application/json');
		echo $stocklist;
	}
	function getNewsFeed(){
		$getdata = new getData;
		$params['pagenumber'] = $_REQUEST['pagenumber'];
		$newsfeed = $getdata->get_news_feed($params);
		header('Content-Type:application/json');
		echo json_encode($newsfeed);

	}
	function searchStocks(){
		$getdata = new getData;
		$params['searchquery'] = $_REQUEST['q'];
		$searchstocks = $getdata->search_stocks($params);
		header('Content-Type:application/json');
		echo json_encode($searchstocks);
	}
	function addStock(){
		$getdata = new getData;
		$params['userid'] = $_SESSION["madaboutm_userid"];
		$params['stocksymbol'] = $_REQUEST['symbol'];
		$params['quantity'] = $_REQUEST['quantity'];
		$addstocks = $getdata->add_stocks($params);
		header('Content-Type:application/json');
		echo json_encode($addstocks);
	}
	function sellStock(){
		$getdata = new getData;
		$params['userid'] = $_SESSION["madaboutm_userid"];
		$params['stocksymbol'] = $_REQUEST['symbol'];
		$params['quantity'] = $_REQUEST['quantity'];
		$addstocks = $getdata->sell_stocks($params);
		header('Content-Type:application/json');
		echo json_encode($addstocks);
	}
}
?>

